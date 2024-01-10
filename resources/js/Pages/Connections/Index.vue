<script setup>
import AuthenticatedUserLayout from '@/Layouts/AuthenticatedUserLayout.vue';
import { Head } from '@inertiajs/vue3';

// defineProps({});
</script>

<template>
    <Head title="Connections" />

    <AuthenticatedUserLayout>
        <main class="content">
            <div class="flex-row connection-flex-row">
                <h1 class="mb-0">Connections</h1>
                <div class="search-form">
                    <span class="search-wrapper">
                        <input type="search" name="Search" id="search" placeholder="Search by name...">
                        <button type="submit">
                            <!-- <img src="../images/icons/search-icon.svg" alt="Search"> -->
                        </button>
                    </span>
                </div>
            </div>
            <section class="section connectionSection">
                <div class="container">
                    <!--- Card 1 -->
                    <div class="card">
                        <ul class="dropdown">
                            <li><a>
                                    <!-- <img src="../images/icons/dots-icons.svg" alt="Dropdown"> -->
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="">
                                            <!-- <img src="../images/icons/view-profile-icon.svg" alt="View Profile"> -->
                                            View</a></li>
                                    <li><a href="">
                                            <!-- <img src="../images/icons/delete-profile-icon.svg" alt="Delete Profile"> -->
                                            Delete</a></li>
                                </ul>
                            </li>
                        </ul>
                        <a href="#" class="img-wrapper">
                            <!-- <img src="../images/img/prifile-picture.jpg" alt="Jane cooper">   -->
                        </a>
                        <a href="#">
                            <h4>Kellie Marquot</h4>
                        </a>
                        <a class="phone-number" href="">
                            <!-- <img src="../images/icons/phone-icon.svg" alt="Phone">  -->
                            9876543210</a>
                    </div>
                    <!--- Cards  End-->
                </div>
            </section>
        </main>
    </AuthenticatedUserLayout>
</template>
