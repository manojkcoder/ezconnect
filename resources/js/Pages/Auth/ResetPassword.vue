<script setup>
import GuestAuthLayout from '@/Layouts/GuestAuthLayout.vue';
import InputError from '@/Components/InputError.vue';
// import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestAuthLayout>
        <Head title="Reset Password" />

        <form @submit.prevent="submit">
            <div class="form-wrapper">
                <div class="container">
                    <!-- <InputLabel for="email" value="Email" /> -->

                    <TextInput
                        id="email"
                        type="email"
                        label="Email"
                        v-model="form.email"
                        required
                        :class="'full-row'"
                        autofocus
                        autocomplete="username"
                        :error="form.errors.email"
                    />

                    <TextInput
                        id="password"
                        type="password"
                        label="Password"
                        :class="'full-row'"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                        :error="form.errors.password"
                    />

                    <TextInput
                        id="password_confirmation"
                        type="password"
                        :class="'full-row'"
                        label="Confirm Password"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                        :error="form.errors.password_confirmation" 
                    />
                    
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Reset Password
                    </PrimaryButton>
                </div>
            </div>
        </form>
    </GuestAuthLayout>
</template>
