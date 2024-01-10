<script setup>
import AuthenticatedUserLayout from '@/Layouts/AuthenticatedUserLayout.vue';
import { Head } from '@inertiajs/vue3';
import Vue3EasyDataTable from 'vue3-easy-data-table';
import { ref, watch } from 'vue';
import {toast} from 'vue3-toastify';

const headers = [
    { text: "Name", value: "name", sortable: true },
    { text: "Email", value: "email", sortable: true },
    //phone
    { text: "Phone", value: "phone", sortable: true },
    {text: "Actions", value: "actions", sortable: false}
];


const items = ref([]);

const search = ref("");

const serverOptions = ref({
    page: 1,
    rowsPerPage: 10,
    sortBy: ["name"],
    sortType: ["asc"],
});

const serverItemsLength = ref(0);
const loading = ref(false);
const reRender = ref(0);

const loadFromServer = async () => {
    loading.value = true;
    const response = await fetch(route('contact-requests.all-requests', {...serverOptions.value, search: search.value}));
    const data = await response.json();
    serverItemsLength.value = data.total;
    items.value = data.data;
    loading.value = false;
    reRender.value += 1;
    return data;
}

const switchToPage = (page) => {
    serverOptions.value.page = page;
}

watch([serverOptions, search], () => {
    loadFromServer();
}, { deep: true });

loadFromServer();

const detailedItem = ref({});
const showDeailsPopup = ref(false);

const showCompleteDetails = (item = null) => {
    detailedItem.value = item;
    showDeailsPopup.value = !showDeailsPopup.value;
}

const deleteContactRequest = (id) => {
    axios.delete(route('contact-requests.destroy', id)).then(response => {
        if(response.data.success){
            loadFromServer();
            toast.success(response.data.message);
        }
    }).catch(error => {
        console.log(error);
    });
}

// defineProps({});
</script>

<template>
    <Head title="Contact Requests" />

    <AuthenticatedUserLayout>
        <main class="content">
            <div class="flex-row v-center">
                <h1 class="mb-0">Contact Requests</h1>
                <a class="site-btn export-btn">
                    <!-- <img src="../images/icons/export-icon.svg" alt="Export CSV"> -->
                    Export CSV</a>
            </div>
                <section class="section contactRequestSection">
                    <div class="">
                        <vue3-easy-data-table :key="reRender" alternating :headers="headers" :items="items" v-model:server-options="serverOptions" :server-items-length="serverItemsLength" buttons-pagination>
                            <template #item-actions="item">
                                <div class="flex-row">
                                    <button class="transparent-button" type="button" @click="showCompleteDetails(item)">
                                        <i class="icon-view-profile-icon"></i>
                                    </button>
                                    <button class="transparent-button" type="button" @click="deleteContactRequest(item.id)">
                                        <i class="icon-delete-profile-icon"></i>
                                    </button>
                                </div>
                            </template>
                            <template #pagination="{ prevPage, nextPage, isFirstPage, isLastPage,  currentPaginationNumber, maxPaginationNumber}">
                                <ul class="pagination">
                                    <li><a :disabled="isFirstPage" @click="prevPage">❮</a></li>
                                    <template v-for="page in maxPaginationNumber">
                                        <li v-if="page >= currentPaginationNumber - 3 && page <= currentPaginationNumber + 3"><a @click="switchToPage(page)" :class="currentPaginationNumber == page ? 'current' : ''">{{ page }}</a></li>
                                    </template>
                                    <li><a :disabled="isLastPage" @click="nextPage">❯</a></li>
                                </ul>
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
                                <tr>
                                    <td>Name:</td>
                                    <td>{{ detailedItem.name }}</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td>{{ detailedItem.email }}</td>
                                </tr>
                                <tr>
                                    <td>Phone:</td>
                                    <td>{{ detailedItem.phone }}</td>
                                </tr>
                                <tr>
                                    <td>Message:</td>
                                    <td>{{ detailedItem.message }}</td>
                                </tr>
                            </table>
                        </div><!--- Form Container  End --> 
                    </div><!--- Form wrapper End --> 
                    </form><!-- Form End-->
                </div>
            </div>
    </AuthenticatedUserLayout>
</template>
