<script setup>
import AuthenticatedAdminLayout from '@/Layouts/AuthenticatedAdminLayout.vue';
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
        await axios.patch(route('admin.users.update', props.user.id), formData.value);
        toast.success('User updated successfully');
        router.visit(route('admin.dashboard'));
    } catch (error) {
        toast.error('Error updateing user');
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
                <Form :form-handler="updateUser" :form-data="formData" :form-errors="formErrors"/>
            </section>
        </main>
    </AuthenticatedAdminLayout>
</template>

<style>
.contactRequestSection table{
    table-layout: fixed;
}
</style>