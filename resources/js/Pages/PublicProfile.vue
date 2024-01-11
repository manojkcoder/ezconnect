<script setup>
import Show from './Profile/Show.vue';
import { ref } from 'vue';
import vCardFactory from 'vcards-js';
import TextInput from '@/Components/TextInput.vue';
import {toast} from 'vue3-toastify';

const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    networks: {
        type: Array,
        required: true
    }
})

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
    message: '',
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
    <section class="sectionSideBar profile-page" v-bind:style="props.user.banner_picture ? { backgroundImage: 'url(' + props.user.banner_picture + ')' } : {}">
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

                        <TextInput label="Message" :type="'textarea'" :class="'full-row'" v-model:modelValue="formData.message" :error="formErrors.message?.pop()"/>
                        
                    </div><!--- Form Container  End --> 
                </div><!--- Form wrapper End --> 

                <div class="form-submit">
                    <input class="site-btn dark-btn submit" type="submit" value="Lets Connect">
                </div>
            </form><!-- Form End-->
        </div>
    </div>
</template>
