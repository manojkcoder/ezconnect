<script setup>
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';

const props = defineProps({
    formHandler: {
        type: Function,
        required: true
    },
    formData: {
        type: Object,
        required: true
    },
    formErrors: {
        type: Object,
        required: true
    }
})

</script>
<template>

    <form class="section-main" @submit.prevent="formHandler">
        <div class="form-wrapper">
            <div class="container">

                <TextInput class="full-row" label="Name" type="text" name="name" v-model="formData.name" :error="formErrors.name?.pop()" required />

                <TextInput class="full-row" label="Email" type="text" name="email" v-model="formData.email" :error="formErrors.email?.pop()" required />

                <Checkbox v-if="formData.hasOwnProperty('welcome_email')" v-model:checked="formData.welcome_email" v-bind:label="'Send User a welcome email with password reset link'" class="full-row" />

                <Checkbox v-if="formData.hasOwnProperty('is_blocked')" v-model:checked="formData.is_blocked" v-bind:label="'Block User'" />

                <div class="form-submit full-row"><a class="site-btn" :href="route('admin.dashboard')">Cancel</a><input class="site-btn dark-btn submit" type="submit" :value="formData.id ? 'Update' : 'Create'"></div>
            </div>
        </div>
    </form>
</template>