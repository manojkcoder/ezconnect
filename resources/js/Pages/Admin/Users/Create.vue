<script setup>
import AuthenticatedAdminLayout from '@/Layouts/AuthenticatedAdminLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { toast } from 'vue3-toastify';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';

const formErrors = ref({});

const formData = ref({
    name: '',
    email: '',
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
                <form class="section-main" @submit.prevent="createUser">
                    <div class="form-wrapper">
                        <div class="container">

                            <TextInput class="full-row" label="Name" type="text" name="name" v-model="formData.name" :error="formErrors.name?.pop()" required />

                            <TextInput class="full-row" label="Email" type="text" name="email" v-model="formData.email" :error="formErrors.email?.pop()" required />

                            <Checkbox v-model:checked="formData.welcome_email" v-bind:label="'Send User a welcome email with password reset link'" />

                            <div class="form-submit full-row"><a class="site-btn" :href="route('admin.dashboard')">Cancel</a><input class="site-btn dark-btn submit" type="submit" value="Create"></div>
                        </div>
                    </div>
                </form>
            </section>
        </main>
    </AuthenticatedAdminLayout>
</template>

<style>
.contactRequestSection table{
    table-layout: fixed;
}
</style>