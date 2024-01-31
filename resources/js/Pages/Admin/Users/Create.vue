<script setup>
import AuthenticatedAdminLayout from '@/Layouts/AuthenticatedAdminLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { toast } from 'vue3-toastify';
import Form from './Form.vue';

const formErrors = ref({});

const formData = ref({
    name: '',
    email: '',
    id: '',
    welcome_email: true,
});

const createUser = async () => {
    try {
        await axios.post(route('admin.users.store'), formData.value);
        toast.success('User created successfully');
        router.visit(route('admin.dashboard'));
    } catch (error) {
        toast.error('Error creating user');
        formErrors.value = error.response.data.errors;
    }
};

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedAdminLayout>
        <main class="content">
            <div class="flex-row user-row">
                <h1 class="mb-0">Add User</h1>
            </div>
            <section class="section">
                <Form :form-handler="createUser" :form-data="formData" :form-errors="formErrors"/>
            </section>
        </main>
    </AuthenticatedAdminLayout>
</template>

<style>
.contactRequestSection table{
    table-layout: fixed;
}
</style>