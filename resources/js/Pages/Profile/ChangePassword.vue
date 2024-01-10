<script setup>
import AuthenticatedUserLayout from '@/Layouts/AuthenticatedUserLayout.vue';
import { Head } from '@inertiajs/vue3';

// defineProps({});
</script>

<template>
    <Head title="Change Password" />

    <AuthenticatedUserLayout>
        <main class="content">
            <h1>Change Password</h1>

            <section class="section changepassSection">
                <div class="container">
                <h3 class="full-row mb-0">Change Password</h3>
                <form class="change-password">
                    <div class="form-wrapper">
                    <div class="container">
                    <div class="field">
                        <label>New Password</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="field">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="form-submit">
                        <button class="site-btn">Cancel</button>
                        <input class="site-btn dark-btn submit" type="submit" value="Save">
                    </div>
                    </div>        
                    
                </div></form>
            </div></section>
        </main>
    </AuthenticatedUserLayout>
</template>
