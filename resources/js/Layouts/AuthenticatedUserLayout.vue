<script setup>
import { ref } from 'vue';
import UserSidebar from '@/Layouts/UserSidebar.vue';
import { usePage } from '@inertiajs/vue3'
import QrcodeVue from 'qrcode.vue'

const page = usePage();
const user = page.props.auth.user;

const showQR = ref(false);

const downloadQr = () => {
    const link = document.createElement('a')
    link.download = `qr-code.png`
    link.href = document.querySelector('.popup-wrapper canvas').toDataURL()
    link.click()
}
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
                        <li><button class="transparent-button" type="button" @click="showQR = !showQR"><i class="icon-qrcode"></i></button></li>
                        <li><a target="_blank" :href="route(user.username ? 'public_profile' :  'public_profile_id', user.username ? user.username : user.id)" class="site-btn">View Profile</a></li>
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
        <UserSidebar/>
        <!---- Content Start -->
        <slot />
    </div>

    <div class="popup-wrapper" v-show="showQR">
        <div class="container"> 
            <a class="close-btn" @click="showQR = !showQR"><i class="icon-close-icon"></i></a>
                <div style="background: white;display: flex; flex-direction: column; padding: 20px;">
                    <h2 style="text-align: center;margin-bottom: 0;">Profile QR Code</h2>
                    <qrcode-vue :margin="2" :size="400" :value="route('public_profile_id', user.id)"/>
                    <button class="site-btn" type="button" @click="downloadQr">Download <i class="icon-download-icon"></i></button>
                </div>
            </div>
        </div>
</template>
