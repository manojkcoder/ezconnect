<script setup>

import { ref } from 'vue';

const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    networks: {
        type: Array,
        required: true
    },
    downloadContact: {
        type: Function,
        default: null
    },
    connectFormToggle: {
        type: Function,
        default: null
    },
    clickTracker: {
        type: Function,
        default: null
    }
})


const customization = ref(typeof props.user.customization == 'string' ? JSON.parse(props.user.customization) : props.user.customization);

</script>
<template>
    <div class="profile-background" v-bind:style="user.banner_picture ? { backgroundImage: 'url(' + user.banner_picture + ')' } : {}"></div>
    <div class="ss-inner">
        <span class="company-logo">
            <img :src="user.logo" v-if="user.logo" :alt="user.company_name">
        </span>
        <a href="#" class="img-wrapper profile-pic">
            <img :src="user.profile_picture" v-if="user.profile_picture" :alt="user.name">
        </a>
        <ul class="user-info">
            <li class="user-company-name"> {{ user.company_name  }}</li>
            <li class="user-desigination"> {{user.title}}</li>
        </ul>

        <h4 class="mb-0" v-text="user.name"></h4>
        <p v-text="user.bio"></p>

        <a href="#" @click.prevent="downloadContact" class="site-btn dark-btn">Save my contact card</a>
        <a href="#" class="site-btn" @click="connectFormToggle">Connect with me</a>

        <h3>______________</h3>
        <br>
        <div class="flex-row social-media">
            <a class="" :href="network.social_network.format.replace('{value}', network.url)" v-for="(network, index) in user.social_networks" target="_blank" v-on:click="clickTracker(network.id)">
                <span class="icon svg-icon" :class="network.social_network.icon" v-bind:style="[network.custom_icon_url ? {backgroundImage: 'url('+network.custom_icon_url+')'} : {}]"></span>
                <span v-text="network.name"></span>
            </a>
        </div>
    </div>
</template>

<style>
.sectionSideBar.profile-page *{
    color: v-bind(customization.profile_text_color) !important;
}
.img-wrapper.profile-pic{
    border-color: v-bind(customization.profile_picture_ring_color) !important;
}
.ss-inner .site-btn.dark-btn{
    background-color: v-bind(customization.profile_buttons_color) !important;
    color: v-bind(customization.profile_buttons_text_color) !important;
}
.ss-inner .site-btn.dark-btn:hover{
    background-color: v-bind(customization.profile_buttons_hover_color) !important;
    color: v-bind(customization.profile_buttons_hover_text_color) !important;
}
.ss-inner .site-btn{
    background-color: v-bind(customization.connect_button_color) !important;
    color: v-bind(customization.connect_button_text_color) !important;
}
.ss-inner .site-btn:hover{
    background-color: v-bind(customization.connect_button_hover_color) !important;
    color: v-bind(customization.connect_button_hover_text_color) !important;
}
.sectionSideBar.profile-page{
    background-color: v-bind(customization.profile_background_color) !important;
}
</style>