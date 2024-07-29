<script setup>
import AuthenticatedCompanyAdminLayout from '@/Layouts/AuthenticatedCompanyAdminLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { toast } from 'vue3-toastify';
import Form from './Form.vue';

const formErrors = ref({});

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});

const formData = ref({
    name: props.user.name,
    email: props.user.email,
    id: props.user.id,
    is_blocked: props.user.is_blocked
});

const updateUser = async () => {
    try {
        await axios.patch(route('companyAdmin.users.update', props.user.id), formData.value);
        toast.success('User updated successfully');
        router.visit(route('companyAdmin.dashboard'));
    } catch (error) {
        toast.error('Error updateing user');
        formErrors.value = error.response.data.errors;
    }
};

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedCompanyAdminLayout>
        <main class="content">
            <div class="flex-row user-row">
                <h1 class="mb-0">Update User</h1>
            </div>
            <section class="section">
                <Form :form-handler="updateUser" :form-data="formData" :form-errors="formErrors"/>
            </section>
        </main>
    </AuthenticatedCompanyAdminLayout>
</template>

<style>
.contactRequestSection table{
    table-layout: fixed;
}
</style>