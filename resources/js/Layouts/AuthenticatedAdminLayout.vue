<script setup>
import AdminSidebar from './AdminSidebar.vue';

</script>

<template>
    <header>
        <div class="container full-container">
            <div class="logo">
                <h2 class="mb-0">Dashboard</h2>
            </div>
            <div class="nav">
                <nav>
                    <ul>
                        <li><a :href="{}" class="site-btn">View Profile</a></li>
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
