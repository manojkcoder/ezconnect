<script setup>
import AdminSidebar from './AdminSidebar.vue';

</script>

<template>
    <header>
        <div class="container full-container">
            <div class="logo">
                <img src="../../images/logo.svg" alt="Logo">
            </div>
            <div class="nav">
                <nav>
                    <ul>
                        <li><a :href="{}" style="visibility: hidden;" class="site-btn">View Profile</a></li>
                        <li><a :href="route('logout')"> <i class="icon-logout-icon"></i>Logout</a></li>
                    </ul>
                </nav>
            </div>
            <div class="togglebtn" style="display:none;">
                <div><span></span><span></span><span></span></div>
            </div>
        </div>
    </header>
    <!---Mai Wrapper Start -->
    <div class="main-wrapper">
        <!---Sidebar Start -->
        <AdminSidebar/>
        <!---- Content Start -->
        <slot />
    </div>
</template>
