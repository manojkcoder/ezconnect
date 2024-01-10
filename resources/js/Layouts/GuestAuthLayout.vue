<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <section class="section singinForm">
        <div class="container"> 
            <div class="half-column image-col">
                <div class="logo">
                    <h2 class="mb-0">EZCONNECT</h2>
                </div>
                <div class="img-box">
                <img src="../../images/sign-in-img.svg" alt="Sign in">
                </div>
            </div> 
            <div class="half-column">
                <slot />
            </div> 
        </div>    
    </section>    
</template>
