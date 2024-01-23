<script setup>
import AuthenticatedUserLayout from '@/Layouts/AuthenticatedUserLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import axios from 'axios';
import draggable from 'vuedraggable'
import { toast } from 'vue3-toastify';
import TextInput from '@/Components/TextInput.vue';
import Show from './Show.vue';
import { ColorPicker } from "vue3-colorpicker";
import "vue3-colorpicker/style.css";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
    socialNetworks: {
        type: Array,
        required: true,
    },
});

// console.log(props.user);

const formData = ref({
    company_name: props.user.company_name,
    title: props.user.title,
    name: props.user.name,
    username: props.user.username || '',
    email: props.user.email,
    bio: props.user.bio,
    logo: props.user.logo,
    banner_picture: props.user.banner_picture,
    profile_picture: props.user.profile_picture,
    social_networks: props.user.social_networks || [],
    customization: props.user.customization ? JSON.parse(props.user.customization) : {
        profile_picture_ring_color: '#8231D3',
        profile_background_color: '#FFFFFF',
        profile_text_color: '#606060',
        profile_buttons_color: '#8231D3',
        profile_buttons_text_color: '#FFFFFF',
        profile_buttons_hover_color: '#E9D6FF',
        profile_buttons_hover_text_color: '#8231D3',
        connect_button_color: '#E9D6FF',
        connect_button_text_color: '#8231D3',
        connect_button_hover_color: '#8231D3',
        connect_button_hover_text_color: '#FFFFFF',
    }
});

const formErrors = ref({});

components: {
    draggable
};

const emptyNetwork = { id: 'none', name: '', icon: 'custom', type: 'url' };
const networks = [emptyNetwork, ...props.socialNetworks];

const addNetwork = (index) => {
    formData.value.social_networks.splice(index + 1, 0, {name: '', url: '', social_network_id: emptyNetwork.id ,social_network: Object.assign({}, emptyNetwork)});
};

formData.value.social_networks.length == 0 && addNetwork(0);

const removeNetwork = (index) => {
    formData.value.social_networks.splice(index, 1);
};

const profile_picture = ref(null);
const banner_picture = ref(null);
const logo = ref(null);

const uploadPhoto = async (field) => {
    let file;
    switch (field) {
        case 'profile_picture':
            file = profile_picture.value.files[0];
            break;
        case 'banner_picture':
            file = banner_picture.value.files[0];
            break;
        case 'logo':
            file = logo.value.files[0];
            break;
        default:
            break;
    }
    const uploadFormData = new FormData();
    uploadFormData.append(field, file);
    try {
        const response = await axios.post(route('profile.upload-photo'), uploadFormData);
        formData.value[field] = response.data.url;
        toast.success(response.data.message, { timeout: 3000, position: 'bottom-right', closeOnClick: true });
    } catch (error) {
        console.error(error); // Handle error response
    }
};

// const unselectedNetworks = ((id) => {
//     return networks.filter(network => id || !formData.value.social_networks.find(selected => selected.key == network.key));
// });

const updateNetwork = (event, index) => {
    let network = networks.find(network => network.key == event.target.value);
    formData.value.social_networks[index]['name'] = network.name;
    formData.value.social_networks[index]['social_network_id'] = network.id;
    formData.value.social_networks[index]['social_network'] = Object.assign({}, network);
};

const getError = (index, field) => {
    let error = formErrors.value.hasOwnProperty('networks.'+index+'.'+field) ? formErrors.value['networks.'+index+'.'+field][0] : null;
    if(error){
        error = error.replace('The networks.'+index+'.'+field, 'This');
    }
    // console.log(error, index, field);
    return error;
};

const saveForm = async (event) => {
    event.preventDefault();
    formErrors.value = {};
    if(hasEmptyNetworks()){
        toast.error('Please fill all the social media fields');
        return;
    }
    try {
        const response = await axios.patch(route('profile.update'), formData.value);
        toast.success(response.data.message, { timeout: 3000, position: 'bottom-right', closeOnClick: true });
    } catch (error) {
        toast.error('Error updating profile');
        formErrors.value = error.response.data.errors;
    }
};

const hasEmptyNetworks = () => {
    return formData.value.social_networks.find(network => network.social_network_id == '' || network.name == '' || network.url == '');
};

const deleteBanner = async () => {
    try {
        const response = await axios.delete(route('profile.delete-banner'));
        formData.value.banner_picture = null;
        toast.success(response.data.message, { timeout: 3000, position: 'bottom-right', closeOnClick: true });
    } catch (error) {
        console.error(error); // Handle error response
    }
};

const uploadIcon = async (event, element, index) => {
    let file = event.target.files[0];
    const uploadFormData = new FormData();
    uploadFormData.append('icon', file);
    try {
        const response = await axios.post(route('profile.upload-photo'), uploadFormData);
        formData.value.social_networks[index]['custom_icon_url'] = response.data.url;
        toast.success(response.data.message, { timeout: 3000, position: 'bottom-right', closeOnClick: true });
    } catch (error) {
        console.error(error); // Handle error response
    }
};

const customizePanel = ref(false);
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedUserLayout>
        <main class="content" @click="customizePanel = false">
            <h1>Profile Setting</h1>
            <section class="profileSection section">
                <div class="container">
                    <form class="section-main" @submit="saveForm">
                        <!-- Profile Top Section-->
                        <div class="profile-wrapper">
                            <div class="profile-picture">
                                <span class="img-wrapper">
                                    <img v-if="formData.profile_picture" :src="formData.profile_picture" alt="Jane cooper">  
                                </span>
                                <span class="upload-field">
                                    <label class="upload-field-label">
                                        <h4>Profile Photo</h4>
                                        <span class="site-btn dark-btn">Upload Photo</span>
                                    </label>
                                    <input type="file" id="profile-picture" ref="profile_picture" @change="uploadPhoto('profile_picture')">
                                </span>
                            </div>
                            <div class="profile-logo">
                                <span class="img-wrapper">
                                    <img :src="formData.logo" alt="FinovateFall">
                                </span>
                                <span class="upload-field">
                                    <label class="upload-field-label">
                                        <h4>Logo</h4>
                                        <span class="site-btn dark-btn">Upload Logo</span>
                                    </label>
                                    <input type="file" id="company-logo" ref="logo" @change="uploadPhoto('logo')">
                                </span>
                            </div>
                        </div>
                        <!--Profile  Form Section -->
                        <div class="form-wrapper">
                            <div class="container">
                                
                                <TextInput label="Name" :type="'text'" name="name" v-model="formData.name" :error="formErrors.name?.pop()" required />

                                <TextInput label="Username" :type="'text'" name="username" v-model="formData.username" :error="formErrors.username?.pop()" required />

                                <TextInput label="Company Name" :type="'text'" name="company_name" v-model="formData.company_name" :error="formErrors.company_name?.pop()" required />

                                <TextInput label="Title" :type="'text'" name="title" v-model="formData.title" :error="formErrors.title?.pop()" required />

                                <div class="field">
                                    <label>Upload Banner Picture</label>
                                    <div class="banner-upload-field">
                                        <input type="file" class="form-control" ref="banner_picture" @change="uploadPhoto('banner_picture')">
                                        <span class="banner-upload-label">
                                            <span class="site-btn dark-btn"> Choose Image</span>
                                            <span>Upload Image</span>
                                        </span>
                                    </div>
                                    <div class="banner-preview" v-if="formData.banner_picture">
                                        <a @click.prevent="deleteBanner"><i class="icon-delete-icon"></i></a>
                                        <img :src="formData.banner_picture" alt="">
                                    </div>
                                    
                                </div>

                                <TextInput label="Email" :type="'text'" name="email" v-model="formData.email" :error="formErrors.email?.pop()" required />

                                <TextInput :class="'full-row'" :placeholder="'Max 500 characters'" label="Bio" type="textarea" name="bio" v-model="formData.bio" :error="formErrors.bio?.pop()" required />
                            </div><!--- Form Container  End -->
                        </div><!--- Form wrapper End -->
                        

                        <!-- Social Media  Section -->
                        <div class="social-media-section">
                            <div class="container">
                                <h3 class="full-row mb-0">Links</h3>
                                <!--- Social Media Row 1 -->
                                <draggable v-model="formData.social_networks" item-key="index">
                                    <template #item="{element, index}">
                                        <div class="social-media-row">
                                            <div class="dragable-row" draggable="true">
                                                <div class="select-field field">
                                                    <select class="form-select" :class="getError(index, 'social_network_id') ? 'error' : ''" v-on:change="($event) => updateNetwork($event, index)">
                                                        <option v-for="network in networks" v-bind:value="network.key" v-bind:selected="network.id == element.social_network.id">{{ network.name }}</option>
                                                    </select>
                                                    <p class="error-msg">{{ getError(index, 'social_network_id') ? 'This field is required' : '' }}</p>
                                                </div>
                                                <div class="social-media-icon">
                                                    <label class="icon svg-icon" :class="element.social_network.icon" v-if="element.social_network.icon == 'custom'" :for="'upload_icon_'+index"  v-bind:style="[element.custom_icon_url ? {backgroundImage: 'url('+element.custom_icon_url+')'} : {}]"></label>
                                                    <input type="file" :id="'upload_icon_'+index" style="display: none;" @change="(event) => uploadIcon(event, this, index)">
                                                    <span class="icon svg-icon" :class="element.social_network.icon" v-if="element.social_network.icon !== 'custom'"></span>
                                                </div>
                                                <TextInput :placeholder="'Enter the '+element.social_network.type+' here'" label="" :type="'text'" name="url" v-model="element.url" :error="getError(index, 'url')" required />
                                                <TextInput :placeholder="'Enter the name here'" label="" :type="'text'" name="name" v-model="element.name" :error="getError(index, 'name')" required />

                                            </div>
                                            <div class="buttons-wrapper">
                                                <button type="button" class="drag">
                                                    <i class="icon-dragable"></i>
                                                </button>
                                                <button type="button" class="delete" @click="removeNetwork(index)">
                                                    <i class="icon-delete-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </template>
                                </draggable>
                                <div class="add-more">
                                    <button type="button" class="site-btn" @click="addNetwork(formData.social_networks.length - 1)">Add Link</button>
                                </div>
                            </div>
                        </div><!--- Social Media Section End -->
                        <div class="form-submit">
                            <button class="site-btn">Cancel</button>
                            <input class="site-btn dark-btn submit" type="submit" Value="Save">
                        </div>
                    </form><!-- Form End-->
                    <div>
                        <h1>Preview</h1>
                        <div class="sectionSideBar">
                            <Show :user="formData" :networks="networks" />
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <a class="setting-btn" @click.prevent="customizePanel = !customizePanel"><img src="../../../images/icons/settings-icon.svg" alt="Settings"></a>
        <div class="customize-popup popup-wrapper" v-show="customizePanel">
            <div class="customize-popup-container">
                <a @click.prevent="customizePanel = false"><i class="icon-close-icon"></i></a>
                <h2 class="text-center">Template Customizer</h2>
                <table>
                    <!--- Banner  Colors -->
                    <tr>
                        <td>Edit profile picture ring colour</td>
                        <td class="switcher-style-list">
                            <color-picker v-model:pureColor="formData.customization.profile_picture_ring_color" format="hex" picker-type="chrome"/>
                        </td>
                    </tr>

                    <!---  Profile Text  Colors-->
                    <tr>
                        <td>Profile Text Colour</td>
                        <td class="switcher-style-list">
                            <color-picker v-model:pureColor="formData.customization.profile_text_color"  format="hex" picker-type="chrome"/>
                        </td>
                    </tr>

                    <!---  Profile Buttons  Colors-->
                    <tr>
                        <td>Profile Buttons Colour</td>
                        <td class="switcher-style-list">
                            <color-picker v-model:pureColor="formData.customization.profile_buttons_color"  format="hex" picker-type="chrome"/>
                        </td>
                    </tr>

                    <!---  Profile Buttons Text  Colors-->
                    <tr>
                        <td>Profile Buttons Text Colour</td>
                        <td class="switcher-style-list">
                            <color-picker v-model:pureColor="formData.customization.profile_buttons_text_color"  format="hex" picker-type="chrome"/>
                        </td>
                    </tr>

                    <!---  Profile Buttons Hover  Colors-->
                    <tr>
                        <td>Profile Buttons Hover Colour</td>
                        <td class="switcher-style-list">
                            <color-picker v-model:pureColor="formData.customization.profile_buttons_hover_color"  format="hex" picker-type="chrome"/>
                        </td>
                    </tr>

                    <!---  Profile Buttons Hover Text  Colors-->
                    <tr>
                        <td>Profile Buttons Hover Text Colour</td>
                        <td class="switcher-style-list">
                            <color-picker v-model:pureColor="formData.customization.profile_buttons_hover_text_color"  format="hex" picker-type="chrome"/>
                        </td>
                    </tr>

                    <!---  Connect Button  Colors-->
                    <tr>
                        <td>Connect Button Colour</td>
                        <td class="switcher-style-list">
                            <color-picker v-model:pureColor="formData.customization.connect_button_color"  format="hex" picker-type="chrome"/>
                        </td>
                    </tr>

                    <!---  Connect Button Text  Colors-->
                    <tr>
                        <td>Connect Button Text Colour</td>
                        <td class="switcher-style-list">
                            <color-picker v-model:pureColor="formData.customization.connect_button_text_color" format="hex" picker-type="chrome"/>
                        </td>
                    </tr>

                    <!---  Connect Button Hover  Colors-->
                    <tr>
                        <td>Connect Button Hover Colour</td>
                        <td class="switcher-style-list">
                            <color-picker v-model:pureColor="formData.customization.connect_button_hover_color"  format="hex" picker-type="chrome"/>
                        </td>
                    </tr>

                    <!---  Connect Button Hover Text  Colors-->
                    <tr>
                        <td>Connect Button Hover Text Colour</td>
                        <td class="switcher-style-list">
                            <color-picker v-model:pureColor="formData.customization.connect_button_hover_text_color"  format="hex" picker-type="chrome"/>
                        </td>
                    </tr>
                </table>

            </div>

        </div>
</AuthenticatedUserLayout>
</template>

