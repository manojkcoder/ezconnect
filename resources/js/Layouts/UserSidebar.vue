<script setup>
import { usePage } from '@inertiajs/vue3';
import { defineProps } from 'vue';
defineProps({
    mobileToggle: {
        type: Boolean,
        default: false,
    },
});

const {url} = usePage();

const active = url.split('/').pop();

</script>
<template>
    <div class="sidebar" :class="mobileToggle ? 'active' : ''">
        <ul class="sidebar-menu">
            <li>
                <a :href="route('dashboard')" :class="active == 'dashboard' || active == '' ? 'current' : ''"><img src="../../images/icons/dashboard-icon.svg" alt="Dashboard"> Dashboard</a>
            </li>
            <li>
                <a :href="route('profile.edit')" :class="active == 'profile' ? 'current' : ''"><img src="../../images/icons/profile-icon.svg" alt="Profile"> Profile</a>
            </li>
            <!-- <li>
                <a :href="route('connections.index')" :class="active == 'connections' ? 'current' : ''"><img src="../../images/icons/connection-icon.svg" alt="Connections">Connections</a>
            </li> -->
            <li>
                <a :href="route('contact-requests.index')" :class="active == 'contact-requests' ? 'current' : ''"><img src="../../images/icons/contact-icon.svg" alt="Connections">Connections</a>
            </li>
            <li>
                <a :href="route('profile.change-password')" :class="active == 'change-password' ? 'current' : ''"><img src="../../images/icons/password-icon.svg" alt="Change Password">Change Password</a>
            </li>
            <li class="show-on-mobile" style="display:none">
                <a :href="route('logout')"><i class="icon-logout-icon"></i>Logout</a>
            </li>
        </ul>
    </div>
</template>