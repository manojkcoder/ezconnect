<script setup>
import AuthenticatedAdminLayout from '@/Layouts/AuthenticatedAdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { ref, watch } from 'vue';
import Vue3EasyDataTable from 'vue3-easy-data-table';
import {toast} from 'vue3-toastify';
import QrcodeVue from 'qrcode.vue';


const headers = [
    { text: "Name", value: "name", sortable: true },
    { text: "Company Name", value: "company_name", sortable: true },
    { text: "Email", value: "email", sortable: true },
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
    const response = await fetch(route('admin.all-company', {...serverOptions.value, search: search.value}));
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

const toggleUserBlockStatus = async (user) => {
    axios.put(route('admin.users.toggle-block-status', user.id)).then(response => {
        if(response.data.success){
            toast.success(response.data.message);
            loadFromServer();
        }
    }).catch(error => {
        console.log(error);
    });
}

const deleteUser = async (user) => {
    confirm("Are you sure you want to delete this user?") &&
    axios.delete(route('admin.users.destroy', user.id)).then(response => {
        if(response.data.success){
            toast.success(response.data.message);
            loadFromServer();
        }
    }).catch(error => {
        console.log(error);
    });
}

loadFromServer();

const showQRCode = ref(false);
const user = ref({});

const downloadQRCode = (item) => {
    showQRCode.value = !showQRCode.value;
    user.value = item;
}
const downloadQr = () => {
    const link = document.createElement('a')
    link.download = `qr-code.png`
    link.href = document.querySelector('.popup-wrapper canvas').toDataURL()
    link.click()
}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedAdminLayout>
        <main class="content">
            <div class="flex-row user-row">
                <h1 class="mb-0">All Companies Admin</h1>
                <div class="flex-row button-row">
                    <a class="site-btn dark-btn" :href="route('admin.company.create')"> + Add Company Admin</a>
                </div>
                <div class="search-form">
                    <span class="search-wrapper">
                    <input type="search" name="Search" id="search" placeholder="Search by name..." v-model.lazy="search" >
                    <button type="submit">
                        <i class="icon-search-icon"></i>
                    </button>
                </span>
                </div>
            </div>
            <section class="section contactRequestSection">
                <div class="">
                    <vue3-easy-data-table :key="reRender" alternating :headers="headers" :items="items" v-model:server-options="serverOptions" :server-items-length="serverItemsLength" buttons-pagination>
                        <template #item-name="user">
                            <div class="profile-picture">
                                <span class="img-wrapper">
                                    <img :src="user.profile_picture" :alt="user.name" v-if="user.profile_picture">
                                    <div v-else></div>
                                </span>
                                <span class="name" v-text="user.name"></span>
                                <span class="name" v-text="user.company_name"></span>
                               
                            </div>
                        </template>
                        <template #item-actions="user">
                            <div class="flex-row">
                                <!-- <button class="transparent-button" type="button" @click="downloadQRCode(user)">
                                    <i class="icon-qrcode"></i>
                                </button>
                                <button class="transparent-button" :class="user.is_blocked ? 'blocked' : 'not-blocked'" type="button" @click="toggleUserBlockStatus(user)">
                                    <i class="icon-blockuser-icon"></i>
                                </button> -->
                                <a :href="route('admin.company.users', user.id)" >
                                    <i class="icon-user-icon"></i>
                                </a>
                                <a :href="route('admin.company.edit', user.id)">
                                    <i class="icon-view-profile-icon"></i>
                                </a>
                                
                                <button class="transparent-button" type="button" @click="deleteUser(user)">
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

    <div class="popup-wrapper" v-show="showQRCode">
        <div class="container"> 
            <a class="close-btn" @click="showQRCode = !showQRCode"><i class="icon-close-icon"></i></a>
            <div style="background: white;display: flex; flex-direction: column; padding: 20px;">
                <h2 style="text-align: center;margin-bottom: 0;">Profile QR Code</h2>
                <qrcode-vue v-if="user && user.hasOwnProperty('id')" :margin="2" :size="400" :value="route('public_profile_id', user.id)"/>
                <button class="site-btn" type="button" @click="downloadQr">Download <i class="icon-download-icon"></i></button>
            </div>
        </div>
    </div>
    </AuthenticatedAdminLayout>
</template>

<style>
.contactRequestSection table{
    table-layout: fixed;
}
</style>