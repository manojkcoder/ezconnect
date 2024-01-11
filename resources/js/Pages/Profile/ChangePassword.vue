<script setup>
import AuthenticatedUserLayout from '@/Layouts/AuthenticatedUserLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';
import { toast } from 'vue3-toastify';

const emptyFormData = {
    current_password: '',
    password: '',
    password_confirmation: '',
};

const formData = ref(emptyFormData);

const formErrors = ref({});

const changePassword = async () => {
    axios.post(route('profile.change-password.store'), formData.value).then(response => {
        toast.success(response.data.message);
        formData.value = emptyFormData;
    }).catch (error => {
        console.log(error);
        toast.error('Error changing password');
        formErrors.value = error.response.data.errors;
    });
};

// defineProps({});
</script>

<template>
    <Head title="Change Password" />

    <AuthenticatedUserLayout>
        <main class="content">
            <h1>Change Password</h1>

            <section class="section changepasssSection">
                <form class="change-passsword" @submit.prevent="changePassword">
                    <div class="form-wrapper">
                            <TextInput :label="'Current Password'" :type="'password'" :name="'current_password'" v-model:model-value="formData.current_password" :error="formErrors.current_password?.pop()" required />
                            <TextInput :label="'New Password'" :type="'password'" :name="'password'" v-model:model-value="formData.password" :error="formErrors.password?.pop()" required />
                            <TextInput :label="'Confirm Password'" :type="'password'" :name="'password_confirmation'" v-model:model-value="formData.password_confirmation" :error="formErrors.password_confirmation?.pop()" required />
                            <div class="form-submit">
                                <button class="site-btn">Cancel</button>
                                <input class="site-btn dark-btn submit" type="submit" value="Save">
                            </div>
                        </div>        
                        
                </form>
            </section>
        </main>
    </AuthenticatedUserLayout>
</template>
