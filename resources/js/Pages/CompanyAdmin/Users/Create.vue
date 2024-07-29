<script setup>
import AuthenticatedCompanyAdminLayout from '@/Layouts/AuthenticatedCompanyAdminLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { toast } from 'vue3-toastify';
import Form from './Form.vue';
import { usePage } from '@inertiajs/vue3';

const { props } = usePage();
const formErrors = ref({});

const formData = ref({
    name: '',
    email: '',
    company_id: props.auth.user.id,
    welcome_email: true,
});

const createUser = async () => {
    try {
        await axios.post(route('companyAdmin.users.store'), formData.value);
//         console.log('form data shub');
// console.log(formData.value);
        toast.success('User created successfully');
        router.visit(route('companyAdmin.dashboard'));
    } catch (error) {
        // console.log('shub');
        // console.log(error);
        toast.error('Error creating user');
        formErrors.value = error.response.data.errors;
    }
};

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedCompanyAdminLayout>
        <main class="content">
            <div class="flex-row user-row">
                <h1 class="mb-0">Add User</h1>
            </div>
            <section class="section">
                <Form :form-handler="createUser" :form-data="formData" :form-errors="formErrors"/>
            </section>
        </main>
    </AuthenticatedCompanyAdminLayout>
</template>

<style>
.contactRequestSection table {
    table-layout: fixed;
}
</style>
