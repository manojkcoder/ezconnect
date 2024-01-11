<script setup>

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

</script>
<template>
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

        <h3>Social Media</h3>
        <div class="flex-row social-media">
            <a class="" :href="network.url" v-for="(network, index) in user.social_networks" target="_blank" v-on:click="clickTracker(network.id)">
                <span class="icon svg-icon" :class="network.social_network.icon"></span>
                <span v-text="network.name"></span>
            </a>
        </div>
    </div>
</template>