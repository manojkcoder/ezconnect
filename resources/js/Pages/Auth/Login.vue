<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestAuthLayout from '@/Layouts/GuestAuthLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import {toast} from 'vue3-toastify';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestAuthLayout>

        <Head title="Log in" />

        <!-- <div v-if="status && toast.success(status)" class="mb-4 font-medium text-sm text-green-600">
        </div> -->

        <form @submit.prevent="submit" class="sign-in-form">
            <div class="container">
                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" v-bind:label="'Email'"
                    required autofocus autocomplete="Email"  :error="form.errors.email"/>

                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                    v-bind:label="'Password'" required autocomplete="current-password"  :error="form.errors.password"/>

                <Checkbox name="remember" v-model:checked="form.remember" v-bind:label="'Remember me'" />
                <div class="field ">
                    <Link v-if="canResetPassword" :href="route('password.request')" class="forget-pass">
                    Forgot your password?
                    </Link>

                </div>

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </div>
        </form>
    </GuestAuthLayout>
</template>
