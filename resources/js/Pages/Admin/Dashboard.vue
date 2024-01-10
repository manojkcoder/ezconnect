<script setup>
import AuthenticatedAdminLayout from '@/Layouts/AuthenticatedAdminLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedAdminLayout>
        <main class="content dashboard-content flex-row">
            <div class="full-row">
            </div>
        </main>
    </AuthenticatedAdminLayout>
</template>
