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
                <a  :href="route('companyAdmin.dashboard')" :class="{'current': route().current('companyAdmin.dashboard')}">
                    <img src="../../images/icons/dashboard-icon.svg" alt="Dashboard">Dashboard</a>
            </li>
            <li>
                <a :href="route('companyAdmin.contact-requests.index')" :class="{'current': route().current('companyAdmin.contact-requests.index')}">
                    <img src="../../images/icons/contact-icon.svg" alt="Users">Connections
                </a>
            </li>
            <li>
                <a :href="route('companyAdmin.my-users')" :class="{'current': route().current('companyAdmin.my-users')}">
                    <img src="../../images/icons/user-icon.svg" alt="Users">Users
                </a>
            </li>
          
        </ul>
    </div>
</template>