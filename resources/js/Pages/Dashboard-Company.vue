<script setup>
    import AuthenticatedCompanyAdminLayout from '@/Layouts/AuthenticatedCompanyAdminLayout.vue';
    import {Head} from '@inertiajs/vue3';
    import {withDirectives} from 'vue';
    import {watch} from 'vue';
    import {ref} from 'vue';
    import {Chart as ChartJS,CategoryScale,LinearScale,PointElement,LineElement,Title,Tooltip,Legend} from 'chart.js';
    import {Line} from 'vue-chartjs';
    ChartJS.register(CategoryScale,LinearScale,PointElement,LineElement,Title,Tooltip,Legend);
    const props = defineProps({
        contact_requests: {type: Array,default: () => []},
        topUsers: {type: Array,default: () => []}
    });
    const formData = ref({time_period: 'today',user_name: 'all-user',from_date: '',to_date: ''});
    const stats = ref({
        social_networks : [],
        visits : null,
        previous_visits : null,
        clicks : null,
        previous_clicks : null,
        tap_through_rate : null,
        contactRequest: null,
        chartData: null
    });
    const loadedCharts = ref({loaded: false});
    const users = ref([]);
    const loadUsers = async() => {
        const response = await fetch(route('companyAdmin.dashboard.get-users'));
        const data = await response.json();
        users.value = data;
    }
    const loadStatsFromServer = async() => {
        if(formData.value.time_period != "custom_range" && formData.value.from_date == "" && formData.value.to_date == ""){
            const response = await fetch(route('companyAdmin.dashboard.get-stats',formData.value));
            const data = await response.json();
            stats.value = data;
        }else if(formData.value.time_period == "custom_range" && formData.value.from_date != "" && formData.value.to_date != ""){
            const response = await fetch(route('companyAdmin.dashboard.get-stats',formData.value));
            const data = await response.json();
            stats.value = data;
        }
    }
    watch(formData,() => {
        loadStatsFromServer();
        // loadUsers();
    },{deep: true});
    loadUsers();
    loadStatsFromServer();
    const vTooltip = {
        mounted(el,binding){
            init(el,binding);
        },
        updated(el,binding){
            init(el,binding);
        }
    }
    function init(el,binding){
        let position = binding.arg || "top";
        let tooltipText = binding.value || "Tooltip text";
        el.setAttribute("position",position);
        el.setAttribute("tooltip",tooltipText);
    }
    const changeTimePeriod = () => {
        formData.value["from_date"] = "";
        formData.value["to_date"] = "";
    }
    const options = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            yAxes: [{
                ticks: {beginAtZero:true}
            }]
        }
    }
</script>
<template>
    <Head title="Dashboard"/>
    <AuthenticatedCompanyAdminLayout>
        <main class="content dashboard-content flex-row">
            <div class="full-row flex-row user_names">
                <div class="select-form mb-0">
                    <select v-model="formData.user_name">
                        <option value="all-user">All Users</option>
                        <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
                    </select>
                    <img class="select-icon" src="../../images/icons/select-icon.svg" alt="Select">
                    <img class="select-dropdown" src="../../images/icons/dropdown-arrow.svg" alt="Dropdown">
                </div>
                <div class="select-form mb-0">
                    <select v-model="formData.time_period" @change="changeTimePeriod">
                        <option value="today">Today</option>
                        <option value="yesterday">Yesterday</option>
                        <option value="last_7_days">Last 7 Days</option>
                        <option value="last_30_days">Last 30 Days</option>
                        <option value="last_90_days">Last 90 Days</option>
                        <option value="last_365_days">Last 365 Days</option>
                        <option value="custom_range">Custom Range</option>
                        <option value="all_time">All Time</option>
                    </select>
                    <img class="select-icon" src="../../images/icons/select-icon.svg" alt="Select">
                    <img class="select-dropdown" src="../../images/icons/dropdown-arrow.svg" alt="Dropdown">
                </div>
                <div class="select-date-range mb-0" v-if="formData.time_period == 'custom_range'">
                    <input type="date" v-model="formData.from_date" format="YYYY-MM-DD" :max="formData.to_date"/> - 
                    <input type="date" v-model="formData.to_date" format="YYYY-MM-DD" :min="formData.from_date"/>
                </div>
            </div>
            <div class="full-row">
                <Line v-if="stats.chartData" :data="stats.chartData" :options="options"/>
            </div>
            <div class="dashLeft">
                <div class="top-cards flex-row">
                    <div class="card performace-card" style="padding:25px;">
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
                            <span style="display:flex;column-gap:5px;font-size:12px;line-height:20px;"><img src="../../images/icons/view-gray-icon.svg">Views</span>
                            <span style="display:flex;" v-tooltip:left.tooltip="'Profile Visits in the selected period v/s last period.'"><img src="../../images/icons/info-icon.svg"></span>
                        </div>
                    </div>
                    <div class="card performace-card" style="padding:25px;">
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
                            <span style="display:flex;column-gap:5px;font-size:12px;line-height:20px;"><img src="../../images/icons/tap-links-icon.svg">Link Taps</span>
                            <span style="display:flex;" v-tooltip:left.tooltip="'Social Links tapped in the selected period v/s last period.'"><img src="../../images/icons/info-icon.svg"></span>
                        </div>
                    </div>
                    <div class="card performace-card" style="padding:25px;">
                        <div>
                            <span class="numberr">{{stats.contactRequest}}</span>
                        </div>
                        <div class="performace-icons">
                            <span style="display:flex;column-gap:5px;font-size:12px;line-height:20px;"><img src="../../images/icons/rate-icon.svg">Contacts</span>
                            <span style="display:flex;" v-tooltip:left.tooltip="'No. of contact request in the selected period.'"><img src="../../images/icons/info-icon.svg"></span>
                        </div>
                    </div>
                    <div class="card performace-card" style="padding:25px;">
                        <div>
                            <span class="numberr">{{stats.tap_through_rate}}%</span>
                        </div>
                        <div class="performace-icons">
                            <span style="display:flex;column-gap:5px;font-size:12px;line-height:20px;"><img src="../../images/icons/rate-icon.svg">Tap through rate</span>
                            <span style="display:flex;" v-tooltip:left.tooltip="'No. of profile visits leading to link clicks.'"><img src="../../images/icons/info-icon.svg"></span>
                        </div>
                    </div>
                </div>
                <h1 class="full-field contact-requests-heading">My User's latest Connections</h1>
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
                                    <tr v-for="request in contact_requests">
                                        <td v-text="request.name"></td>
                                        <td v-text="request.phone"></td>
                                        <td v-text="request.email"></td>
                                        <td v-text="request.formatted_created_at"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                <h2 class="full-field top-users-heading top_10_users">Top 10 Users by Connections</h2>
                <section class="section contactRequestSection">
                    <div class="container">
                        <div class="table-container">
                            <table style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Number of Connections</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in topUsers" :key="user.id">
                                        <td v-text="user.name"></td>
                                        <td v-text="user.contact_requests_count"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
            </div>
        </main>
    </AuthenticatedCompanyAdminLayout>
</template>
