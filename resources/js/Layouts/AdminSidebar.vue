<script setup>
import { defineProps } from 'vue';
defineProps({
    active: {
        type: String,
        default: '',
    },
});
</script>
<template>
    <div class="sidebar">
        <ul class="sidebar-menu">
            <li>
                <a :href="route('admin.dashboard')" :class="active == 'dashboard' || active == '' ? 'current' : ''"><img src="../../images/icons/dashboard-icon.svg" alt="Dashboard"> Dashboard</a>
            </li>
            <!-- <li>
                <a :href="route('admin.users')" :class="active == 'users' || active == '' ? 'current' : ''"><img src="../../images/icons/dashboard-icon.svg" alt="Users"> Users</a>
            </li> -->
            <!-- <li>
                <a :href="route('profile.change-password')" :class="active == 'change-password' ? 'current' : ''"><img src="../../images/icons/password-icon.svg" alt="Change Password">Change Password</a>
            </li> -->
        </ul>
    </div>
</template>