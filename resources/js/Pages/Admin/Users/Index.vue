<script setup>
import AuthenticatedAdminLayout from '@/Layouts/AuthenticatedAdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import Vue3EasyDataTable from 'vue3-easy-data-table';


const headers = [
    { text: "Name", value: "name", sortable: true },
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
    const response = await fetch(route('admin.all-users', {...serverOptions.value, search: search.value}));
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


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedAdminLayout>
        <main class="content">
            <div class="flex-row user-row">
                <h1 class="mb-0">Users</h1>
                <div class="flex-row button-row">
                    <a class="site-btn dark-btn" :href="route('admin.users.create')"> + Add User</a>
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
                                    <img :src="user.profile_picture" :alt="user.name">  
                                </span>
                                <span class="name" v-text="user.name"></span>
                            </div>
                        </template>
                        <template #item-actions="user">
                            <div class="flex-row">
                                <button class="transparent-button" type="button">
                                    <i class="icon-blockuser-icon"></i>
                                </button>
                                <button class="transparent-button" type="button">
                                    <i class="icon-view-profile-icon"></i>
                                </button>
                                <button class="transparent-button" type="button">
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
    </AuthenticatedAdminLayout>
</template>

<style>
.contactRequestSection table{
    table-layout: fixed;
}
</style>