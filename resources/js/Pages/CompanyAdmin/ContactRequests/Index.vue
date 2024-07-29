<script setup>
import AuthenticatedCompanyAdminLayout from '@/Layouts/AuthenticatedCompanyAdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import Vue3EasyDataTable from 'vue3-easy-data-table';
import { ref, watch, onMounted } from 'vue';
import { toast } from 'vue3-toastify';
import axios from 'axios';

// Define table headers
const headers = [
    { text: "Name", value: "name", sortable: true },
    { text: "Email", value: "email", sortable: true },
    { text: "Phone", value: "phone", sortable: true },
    { text: "User Name", value: "user.name", sortable: true },
    { text: "Date", value: "created_at", sortable: true },
    { text: "Actions", value: "actions", sortable: false }
];

const items = ref([]);
const search = ref("");
const userOptions = ref([]); // For user dropdown options
const selectedUser = ref('all-user'); // Default to all users

const serverOptions = ref({
    page: 1,
    rowsPerPage: 10,
    sortBy: ["name"],
    sortType: ["asc"],
});

const serverItemsLength = ref(0);
const loading = ref(false);
const reRender = ref(0);

const loadUserOptions = async () => {
    try {
        const response = await fetch(route('companyAdmin.dashboard.get-users')); // Adjust the route if needed
        const data = await response.json();

        if (Array.isArray(data)) {
            userOptions.value = data.map(user => ({
                id: user.id,
                name: user.name
            }));
        } else {
            console.error('Unexpected data format:', data);
        }
    } catch (error) {
        console.error("Failed to load users:", error);
    }
}

// Load data from the server based on the selected user
// const loadFromServer = async () => {
//     loading.value = true;
//     try {
//         const response = await fetch(route('companyAdmin.contact-requests.all-requests', { 
//             ...serverOptions.value, 
//             search: search.value,
//             user_id: selectedUser.value === 'all-user' ? null : selectedUser.value // Pass user ID or null for all users
//         }));
//         const data = await response.json();
//         serverItemsLength.value = data.total;
//         items.value = data.data.map(item => ({
//             ...item,
//             user: item.user || {} // Ensure user data is present
//         }));
//     } catch (error) {
//         console.error("Failed to load contact requests:", error);
//     } finally {
//         loading.value = false;
//         reRender.value += 1;
//     }
// }

const loadFromServer = async () => {
    loading.value = true;
    try {
        const response = await fetch(route('companyAdmin.contact-requests.all-requests', { 
            ...serverOptions.value, 
            search: search.value,
            user_id: selectedUser.value === 'all-user' ? null : selectedUser.value // Pass user ID or null for all users
        }), {
            method: 'GET', // Ensure method is GET
            headers: {
                'Accept': 'application/json'
            }
        });
        const data = await response.json();
        serverItemsLength.value = data.total;
        items.value = data.data.map(item => ({
            ...item,
            user: item.user || {} // Ensure user data is present
        }));
    } catch (error) {
        console.error("Failed to load contact requests:", error);
    } finally {
        loading.value = false;
        reRender.value += 1;
    }
}


// Watch for changes in server options, search term, and selected user
watch([serverOptions, search, selectedUser], () => {
    loadFromServer();
}, { deep: true });

// Switch pages
const switchToPage = (page) => {
    serverOptions.value.page = page;
}

// Show details popup
const detailedItem = ref({});
const showDeailsPopup = ref(false);
const showCompleteDetails = (item = null) => {
    detailedItem.value = item;
    showDeailsPopup.value = !showDeailsPopup.value;
}

// Delete contact request
const deleteContactRequest = async (id) => {
    if (confirm('Are you sure you want to delete this Contact?')) {
        try {
            const response = await axios.delete(route('contact-requests.destroy', id));
            if (response.data.success) {
                loadFromServer();
                toast.success(response.data.message);
            }
        } catch (error) {
            console.error("Failed to delete contact request:", error);
        }
    }
}

// Load user options and contact requests on component mount
onMounted(() => {
    loadUserOptions();
    loadFromServer();
});
</script>

<template>
    <Head title="Connections" />
    <AuthenticatedCompanyAdminLayout>
        <main class="content">
            <div class="flex-row v-center">
                <h1 class="mb-0">User's Connections</h1>
                <div class="select-form mb-0">
                    <select v-model="selectedUser">
                        <option value="all-user">All Users</option>
                        <option v-for="user in userOptions" :key="user.id" :value="user.id">
                            {{ user.name }}
                        </option>
                    </select>
                </div>
                <a class="site-btn export-btn" :href="route('companyAdmin.contact-requests.export-requests', { user_id: selectedUser })">Export CSV</a>
                <!-- <a class="site-btn export-btn" :href="route('companyAdmin.contact-requests.export-requests')">Export CSV</a> -->
            </div>
            <section class="section contactRequestSection">
                <div class="">
                    <vue3-easy-data-table :key="reRender" alternating :headers="headers" :items="items" v-model:server-options="serverOptions" :server-items-length="serverItemsLength" buttons-pagination>
                        <template #item-actions="item">
                            <div class="flex-row">
                                <button class="transparent-button" type="button" @click="showCompleteDetails(item)">
                                    <i class="icon-view-profile-icon"></i>
                                </button>
                            </div>
                        </template>
                        <template #pagination="{ prevPage, nextPage, isFirstPage, isLastPage, currentPaginationNumber, maxPaginationNumber }">
                            <ul class="pagination">
                                <li><a :disabled="isFirstPage" @click="prevPage">❮</a></li>
                                <template v-for="page in maxPaginationNumber">
                                    <li v-if="page >= currentPaginationNumber - 3 && page <= currentPaginationNumber + 3">
                                        <a @click="switchToPage(page)" :class="currentPaginationNumber == page ? 'current' : ''">{{ page }}</a>
                                    </li>
                                </template>
                                <li><a :disabled="isLastPage" @click="nextPage">❯</a></li>
                            </ul>
                        </template>
                        <template #item-created_at="item">
                            {{ item.formatted_created_at }}
                        </template>
                        <template #item-user.name="item">
                            {{ item.user.name }}
                        </template>
                    </vue3-easy-data-table>
                </div>
            </section>
        </main>
        <div class="popup-wrapper profile-popup" v-show="showDeailsPopup">
            <div class="container"> 
                <a class="close-btn" @click.prevent="showCompleteDetails"><i class="icon-close-icon"></i></a>
                <form class="section-main" @submit.prevent="sendConnectRequest">
                    <div class="form-wrapper">
                        <div class="container">
                            <table>
                                <tr><td>Name:</td><td>{{ detailedItem.name }}</td></tr>
                                <tr><td>Email:</td><td>{{ detailedItem.email }}</td></tr>
                                <tr><td>Phone:</td><td>{{ detailedItem.phone }}</td></tr>
                                <tr><td>Title:</td><td>{{ detailedItem.title }}</td></tr>
                                <tr><td>Company Name:</td><td>{{ detailedItem.company_name }}</td></tr>
                                <tr><td>Message:</td><td>{{ detailedItem.message }}</td></tr>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedCompanyAdminLayout>
</template>
