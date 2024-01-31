<script setup>
import AuthenticatedUserLayout from '@/Layouts/AuthenticatedUserLayout.vue';
import { Head } from '@inertiajs/vue3';
import { withDirectives } from 'vue';
import { watch } from 'vue';
import { ref } from 'vue';

const props = defineProps({
    contact_requests: {
        type: Array,
        default: () => [],
    },
});

const formData = ref({
    time_period : 'today'
});

const stats = ref({
    social_networks : [],
    visits : null,
    previous_visits : null,
    clicks : null,
    previous_clicks : null,
    tap_through_rate : null,
});

const loadStatsFromServer = async () => {
    const response = await fetch(route('dashboard.get-stats', formData.value));
    const data = await response.json();
    stats.value = data;
}

watch(formData, () => {
    loadStatsFromServer();
}, { deep: true });

loadStatsFromServer();

const vTooltip = {
    mounted(el, binding) {
      init(el, binding);
    },
    updated(el, binding) {
      init(el, binding);
    }
};

function init(el, binding) {
  let position = binding.arg || "top";
  let tooltipText = binding.value || "Tooltip text";
  el.setAttribute("position", position);
  el.setAttribute("tooltip", tooltipText);
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedUserLayout>
        <main class="content dashboard-content flex-row">
            <div class="full-row">
                    <div class="select-form mb-0">
                        <select v-model="formData.time_period">
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="last_7_days">Last 7 Days</option>
                            <option value="last_30_days">Last 30 Days</option>
                            <option value="last_90_days">Last 90 Days</option>
                            <option value="last_365_days">Last 365 Days</option>
                            <option value="all_time">All Time</option>
                        </select>
                        <img class="select-icon" src="../../images/icons/select-icon.svg" alt="Select">
                        <img class="select-dropdown" src="../../images/icons/dropdown-arrow.svg" alt="Dropdown">
                    </div>
                </div>
                <div class="dashLeft">
                    <div class="top-cards flex-row">
                        <!-- Card 1-->
                        <div class="card performace-card">
                            <div>
                                <span class="numberr">{{stats.visits}}</span>
                                <span :class="stats.visits > stats.previous_visits ? 'icreament' : 'decreament'">
                                    <span>
                                        <img src="../../images/icons/up-arrow.svg" alt="Increament" v-if="stats.visits > stats.previous_visits">
                                        <img src="../../images/icons/decreament-icon.svg" alt="Increament" v-else>
                                    </span>
                                    {{stats.previous_visits}}
                                </span>
                            </div>

                            <div class="performace-icons">
                                <span style="display: flex;column-gap: 8px;"><img src="../../images/icons/view-gray-icon.svg">Views</span>
                                <span style="display: flex;" v-tooltip:left.tooltip="'Profile Visits in the selected period v/s last period.'"><img src="../../images/icons/info-icon.svg"></span>
                            </div>
                        </div>
                        <!-- Card 2-->
                        <div class="card performace-card">
                            <div>
                                <span class="numberr">{{stats.clicks}}</span>
                                <span :class="stats.clicks > stats.previous_clicks ? 'icreament' : 'decreament'">
                                    <span>
                                        <img src="../../images/icons/up-arrow.svg" alt="Increament" v-if="stats.clicks > stats.previous_clicks">
                                        <img src="../../images/icons/decreament-icon.svg" alt="Increament" v-else>
                                    </span>
                                    {{stats.previous_visits}}
                                </span>
                            </div>

                            <div class="performace-icons">
                                <span style="display: flex;column-gap: 8px;"><img src="../../images/icons/tap-links-icon.svg">Link Taps</span>
                                <span style="display: flex;" v-tooltip:left.tooltip="'Social Links tapped in the selected period v/s last period.'"><img src="../../images/icons/info-icon.svg"></span>
                            </div>
                        </div>

                        <!-- Card 3-->
                        <div class="card performace-card">
                            <div>
                                <span class="numberr">{{stats.tap_through_rate}}%</span>
                            </div>

                            <div class="performace-icons">
                                <span style="display: flex;column-gap: 8px;"><img src="../../images/icons/rate-icon.svg">Tap through rate</span>
                                <span style="display: flex;" v-tooltip:left.tooltip="'No. of profile visits leading to link clicks.'"><img src="../../images/icons/info-icon.svg"></span>
                            </div>
                        </div>
                    </div>
                    <!---  Top Card  Row  End  -->
                    <h1 class="full-field contact-requests-heading">Contact Requests</h1>
                    <section class="section contactRequestSection">
                        <div class="container">
                            <div class="table-container">
                                <table style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!---  Table   Row  1-->
                                        <tr v-for="request in contact_requests">
                                            <td v-text="request.name"></td>
                                            <td v-text="request.phone"></td>
                                            <td v-text="request.email"></td>
                                            <td v-text="request.formatted_created_at"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a v-if="contact_requests.length == 5" class="linktext" :href="route('contact-requests.index')">View All Contact Requests</a>

                        </div>
                    </section>

                </div>
                <div class="dashRight">
                    <div class="card app-overview-card">
                        <h2>Apps Overview</h2>
                        <ul class="apps-overview-list">
                            <li v-for="network in stats.social_networks">
                                <span class="icons"><span class="icon svg-icon" :class="network.social_network.icon"></span>
                                    {{network.name}} </span>
                                <span class="taps-number"><strong>{{ network.clicks_count }}</strong> Taps</span>
                            </li>
                        </ul>
                    </div>

                <!-- <div class="card app-overview-card">
                    <h2>Contact Engagement</h2>
                    <ul class="apps-overview-list">
                        <li><span class="icons"><img src="../../images/icons/Phn-icon.svg" alt="Phone Number">Phone
                                Number</span> <span class="taps-number"><strong>0</strong> Taps</span></li>
                        <li><span class="icons"><img src="../../images/icons/email-envelope-icon.svg"
                                    alt="Email">Email</span> <span class="taps-number"><strong>0</strong> Taps</span></li>
                        <li><span class="icons"><img src="../../images/icons/link-icon.svg" alt="URL">URL</span> <span
                                class="taps-number"><strong>0</strong> Taps</span></li>
                        <li><span class="icons"><img src="../../images/icons/save-icon.svg" alt="Save Contact">Save
                                Contact</span> <span class="taps-number"><strong>0</strong> Taps</span></li>
                    </ul>
                </div> -->
            </div>
        </main>
    </AuthenticatedUserLayout>
</template>
