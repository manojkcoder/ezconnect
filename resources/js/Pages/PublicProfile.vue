<script setup>
import Show from './Profile/Show.vue';
import { ref } from 'vue';
import vCardFactory from 'vcards-js';
import TextInput from '@/Components/TextInput.vue';
import {toast} from 'vue3-toastify';
import { Head } from '@inertiajs/vue3';
import Checkbox from '@/Components/Checkbox.vue';
import { usePage } from '@inertiajs/vue3';


const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    networks: {
        type: Array,
        required: true
    }
});

const page = usePage();
const isLoggedIn = page.props.auth.user;

const connectFormVisible = ref(false);

const downloadVCF = () => {

    const vCard = vCardFactory();
    //set properties
    vCard.firstName = props.user.name.split(' ')[0];
    vCard.lastName = props.user.name.indexOf(' ') > -1 ? props.user.name.split(' ').splice(1).join(' ') : '';
    vCard.organization = props.user.company_name;
    if(props.user.profile_picture){
        vCard.photo.attachFromUrl(route('home')+(props.user.profile_picture), props.user.profile_picture.split('.').pop().toUpperCase());
    }
    if(props.user.logo){
        vCard.logo.attachFromUrl(route('home')+(props.user.logo), props.user.logo.split('.').pop().toUpperCase());
    }
    
    vCard.email = props.user.email;
    vCard.otherPhone = props.user.social_networks.filter(network => network.social_network.type == 'phone').map(network => network.url);
    vCard.email = props.user.social_networks.filter(network => network.social_network.type == 'email').map(network => network.url);
    vCard.socialUrls = props.user.social_networks.filter(network => network.social_network.type == 'url').reduce((acc, network) => {
        acc[network.social_network.name] = network.url;
        return acc;
    }, {});
    vCard.title = props.user.title;
    vCard.note = props.user.bio;
    
    const link = document.createElement("a");
    const content = vCard.getFormattedString();
    const file = new Blob([content], { type: 'text/plain' });
    link.href = URL.createObjectURL(file);
    link.target = "_blank";
    link.download = "sample.vcf";
    link.click();
    URL.revokeObjectURL(link.href);
}

const toggleConnectForm = () => {
    connectFormVisible.value = !connectFormVisible.value;
}

const emptyFormData = {
    name: '',
    phone: '',
    email: '',
    company: '',
    title: '',
    message: '',
    terms: false,
    user_id: props.user.id,
};

const formData = ref({...emptyFormData});

const formErrors = ref({});

const sendConnectRequest = () => {
    axios.post(route('connect_request'), formData.value).then(response => {
        console.log(response);
        if(response.data.success){
            formData.value = {...emptyFormData};
            toggleConnectForm();
            toast.success(response.data.message);
        }
    }).catch(error => {
        console.log(error);
        if(error.response.status == 422){
            formErrors.value = error.response.data.errors;
        }
    });
}

const clickTracker = (network) => {
    axios.post(route('click_tracker', network)).then(response => {
        // console.log(response);
    }).catch(error => {
        console.log(error);
    });
}
</script>

<template>
    <Head :title="user.name" />
    <a v-if="isLoggedIn" :href="route('dashboard')" class="profile-top-nav">Dashboard</a>
    <a :href="route('login')" v-else class="profile-top-nav">Login</a>
    <section class="sectionSideBar profile-page">
        <Show :user="props.user" :networks="props.networks" :downloadContact="downloadVCF" :connectFormToggle="toggleConnectForm" :clickTracker="clickTracker"/>
    </section>

    <div class="popup-wrapper profile-popup" v-show="connectFormVisible">
        <div class="container"> 
            <a class="close-btn" @click.prevent="toggleConnectForm"><i class="icon-close-icon"></i></a>
            <form class="section-main" @submit.prevent="sendConnectRequest">
                <div class="form-wrapper">
                    <div class="container">
                        
                        <TextInput label="Name" :class="'full-row'" v-model:modelValue="formData.name" :error="formErrors.name?.pop()"/>

                        <TextInput label="Phone Number" :class="'full-row'" v-model:modelValue="formData.phone" :error="formErrors.phone?.pop()"/>

                        <TextInput label="Email" :class="'full-row'" v-model:modelValue="formData.email" :error="formErrors.email?.pop()"/>

                        <TextInput label="Company" :class="'full-row'" v-model:modelValue="formData.company" :error="formErrors.company?.pop()"/>

                        <TextInput label="Title" :class="'full-row'" v-model:modelValue="formData.title" :error="formErrors.title?.pop()"/>

                        <TextInput label="Message" :type="'textarea'" :class="'full-row'" v-model:modelValue="formData.message" :error="formErrors.message?.pop()"/>

                        <Checkbox :checked="false" label="I agree to the <a href='https://google.com'>terms and conditions</a>" :class="'full-row'" v-model:modelValue="formData.terms" :error="formErrors.terms?.pop()"/>
                        
                    </div><!--- Form Container  End --> 
                </div><!--- Form wrapper End --> 
                <br>
                <div class="form-submit">
                    <input class="site-btn dark-btn submit" type="submit" value="Lets Connect">
                </div>
            </form><!-- Form End-->
        </div>
    </div>
</template>
