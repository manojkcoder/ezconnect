<script setup>
import AuthenticatedUserLayout from '@/Layouts/AuthenticatedUserLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import axios from 'axios';
import draggable from 'vuedraggable'
import { toast } from 'vue3-toastify';
import TextInput from '@/Components/TextInput.vue';
import Show from './Show.vue';
import "vue3-colorpicker/style.css";
import Checkbox from '@/Components/Checkbox.vue';
import 'vanilla-colorful';

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
    custom_tnc: props.user.custom_tnc,
    bio: props.user.bio,
    logo: props.user.logo,
    banner_picture: props.user.banner_picture,
    profile_picture: props.user.profile_picture,
    social_networks: props.user.social_networks || [],
    customization: props.user.customization ? props.user.customization : {
        profile_picture_ring_color: '#8231D3',
        profile_background_color: '#FFFFFF',
        profile_text_color: '#606060',
        profile_buttons_color: '#8231D3',
        profile_buttons_text_color: '#FFFFFF',
        profile_buttons_hover_color: '#E9D6FF',
        profile_buttons_hover_text_color: '#8231D3',
        show_connect_button: true,
        connect_email_notificaions: true,
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

const emptyNetwork = { id: 'none', name: 'Select', icon: 'custom', type: 'url' };
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

const uploadAsset = async (field) => {
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
        const response = await axios.post(route('profile.upload-asset'), uploadFormData);
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
	formData.value.social_networks = response.data.user.social_networks;
        toast.success(response.data.message, { timeout: 3000, position: 'bottom-right', closeOnClick: true });
    } catch (error) {
        toast.error('Error updating profile');
        formErrors.value = error.response.data.errors;
    }
};

const hasEmptyNetworks = () => {
    return formData.value.social_networks.find(network => network.social_network_id == '' || network.name == '' || network.url == '');
};

const deleteAsset = async (type) => {
    try {
        const response = await axios.delete(route('profile.delete-asset', type));
        formData.value[type] = null;
        toast.success(response.data.message, { timeout: 3000, position: 'bottom-right', closeOnClick: true });
    } catch (error) {
        console.error(error); // Handle error response
    }
};

const uploadFile = async (event, element, index) => {
    let file = event.target.files[0];
    const uploadFormData = new FormData();
    uploadFormData.append('file', file);
    try {
        const response = await axios.post(route('profile.upload-asset'), uploadFormData);
        formData.value.social_networks[index]['url'] = response.data.url;
        toast.success(response.data.message, { timeout: 3000, position: 'bottom-right', closeOnClick: true });
    } catch (error) {
        console.error(error); // Handle error response
        toast.error('Error uploading file: '+error.response.data.message, { timeout: 3000, position: 'bottom-right', closeOnClick: true });
    }
};

const uploadIcon = async (event, element, index) => {
    let file = event.target.files[0];
    const uploadFormData = new FormData();
    uploadFormData.append('icon', file);
    try {
        const response = await axios.post(route('profile.upload-asset'), uploadFormData);
        formData.value.social_networks[index]['custom_icon_url'] = response.data.url;
        toast.success(response.data.message, { timeout: 3000, position: 'bottom-right', closeOnClick: true });
    } catch (error) {
        console.error(error); // Handle error response
    }
};


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

const customizePanel = ref(false);

const handleColorChanged = (event, field) => {
    formData.value.customization[field] = event.target.color;
};

const showPicker = (field) => {
    pickerShown.value == field ? pickerShown.value = null : pickerShown.value = field;
};
const pickerShown = ref(null);

const placeholderText = (type) => {
    switch (type) {
        case 'url':
            return 'Enter the full URL here';
        case 'phone':
            return 'Enter your phone number here';
        default:
            return 'Enter your '+type+' here';
    }
};

const handleConnectButtonVisibility = () => {
    if(formData.value.customization.hasOwnProperty('show_connect_button')){
        formData.value.customization.show_connect_button = !formData.value.customization.show_connect_button;
    }else{
        formData.value.customization.show_connect_button = false;
    }
};

const handleConnectEmailNotifications = () => {
    if(formData.value.customization.hasOwnProperty('connect_email_notificaions')){
        formData.value.customization.connect_email_notificaions = !formData.value.customization.connect_email_notificaions;
    }else{
        formData.value.customization.connect_email_notificaions = false;
    }
};

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
                                    <button class="delete-photo-btn" type="button" v-if="formData.profile_picture" @click="deleteAsset('profile_picture')"><i class="icon-delete-icon"></i></button>
                                    <img v-if="formData.profile_picture" :src="formData.profile_picture" alt="Jane cooper">  
                                    <div class="empty-photo" v-else></div>
                                </span>
                                <span class="upload-field">
                                    <div class="upload-field-label">
                                        <h4>Profile Photo <span v-tooltip:left.tooltip="'To ensure optimal display, please upload profile photos with an aspect ratio of 1:1, such as 250x250 pixels.'"><img src="../../../images/icons/info-icon.svg" width="15"></span></h4>
                                        <label class="site-btn dark-btn" for="profile_picture">Upload Photo</label>
                                        <input type="file" id="profile_picture" ref="profile_picture" @change="uploadAsset('profile_picture')">
                                    </div>
                                </span>
                            </div>
                            <div class="profile-logo">
                                <span class="img-wrapper">
                                    <button class="delete-photo-btn" type="button" v-if="formData.logo" @click="deleteAsset('logo')"><i class="icon-delete-icon"></i></button>
                                    <img v-if="formData.logo" :src="formData.logo" alt="FinovateFall">
                                    <div class="empty-photo" v-else></div>
                                </span>
                                <span class="upload-field">
                                    <div class="upload-field-label">
                                        <h4>Logo</h4>
                                        <label class="site-btn dark-btn" for="company-logo">Upload Logo</label>
                                        <input type="file" id="company-logo" ref="logo" @change="uploadAsset('logo')">
                                    </div>
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
                                    <label>Upload Banner Picture  <span v-tooltip:left.tooltip="'To ensure optimal display, please upload photo with an aspect ratio of 4:1, such as 1000x250 pixels.'"><img src="../../../images/icons/info-icon.svg" width="15"></span></label>
                                    <div class="banner-upload-field">
                                        <input type="file" class="form-control" ref="banner_picture" @change="uploadAsset('banner_picture')">
                                        <span class="banner-upload-label">
                                            <span class="site-btn dark-btn"> Choose Image</span>
                                            <span>Upload Image</span>
                                        </span>
                                    </div>
                                    <div class="banner-preview" v-if="formData.banner_picture">
                                        <a @click.prevent="deleteAsset('banner_picture')"><i class="icon-delete-icon"></i></a>
                                        <img :src="formData.banner_picture" alt="">
                                    </div>
                                    
                                </div>

                                <TextInput label="Email" :type="'text'" name="email" v-model="formData.email" :error="formErrors.email?.pop()" required />

                                <TextInput :class="'full-row'" :placeholder="'Max 500 characters'" label="Bio" type="textarea" name="bio" v-model="formData.bio" :error="formErrors.bio?.pop()" required />

                                <TextInput :class="'full-row'" label="Terms & Conditions (Optional)" placeholder="Link To Terms & Conditions (Optional)" :type="'text'" name="custom_tnc" v-model="formData.custom_tnc" :error="formErrors.custom_tnc?.pop()" />

                            </div><!--- Form Container  End -->
                        </div><!--- Form wrapper End -->
                        

                        <!-- Social Media  Section -->
                        <div class="social-media-section">
                            <div class="container">
                                <h3 class="full-row mb-0">Links</h3>
                                <!--- Social Media Row 1 -->
                                <draggable v-model="formData.social_networks" item-key="index" handle=".drag">
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
                                                <TextInput :placeholder="placeholderText(element.social_network.type)" label="" :type="'text'" name="url" v-model="element.url" :error="getError(index, 'url')" required v-if="element.name !== 'File'"/>
                                                <div v-else class="field full-field" style="flex-direction: row;">
                                                    <input type="file" style="display: none;" :id="'file_'+index" @change="(event) => uploadFile(event, this, index)">
                                                    <label type="button" class="site-btn text-center" :for="'file_'+index"><i class="icon-upload-icon"></i></label>
                                                    <a :href="element.url" v-if="element.url" target="_blank" class="site-btn site-btn-dark"><i class="icon-link"></i></a>
                                                </div>
                                                

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
                        <Show :user="formData" :networks="networks" />
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
                        <td>Profile background color</td>
                        <td class="switcher-style-list">
                            <a class="swatch" v-bind:style="{backgroundColor: formData.customization.profile_background_color}" @click.prevent="showPicker('profile_background_color')"></a>
                        </td>
                    </tr>
                    <tr v-show="pickerShown == 'profile_background_color'" class="mb-20">
                        <td colspan="2">
                            <hex-color-picker :color="formData.customization.profile_background_color" @color-changed="(event) => handleColorChanged(event, 'profile_background_color')"></hex-color-picker>
                            <input type="text" v-model="formData.customization.profile_background_color" class="color-input">
                        </td>
                    </tr>

                    <tr>
                        <td>Profile picture ring color</td>
                        <td class="switcher-style-list">
                            <a class="swatch" v-bind:style="{backgroundColor: formData.customization.profile_picture_ring_color}" @click.prevent="showPicker('profile_picture_ring_color')"></a>
                        </td>
                    </tr>
                    <tr v-show="pickerShown == 'profile_picture_ring_color'" class="mb-20">
                        <td colspan="2">
                            <hex-color-picker :color="formData.customization.profile_picture_ring_color" @color-changed="(event) => handleColorChanged(event, 'profile_picture_ring_color')"></hex-color-picker>
                            <input type="text" v-model="formData.customization.profile_picture_ring_color" class="color-input">
                        </td>
                    </tr>

                    <tr>
                        <td>Text color</td>
                        <td class="switcher-style-list">
                            <a class="swatch" v-bind:style="{backgroundColor: formData.customization.profile_text_color}" @click.prevent="showPicker('profile_text_color')"></a>
                        </td>
                    </tr>
                    <tr v-show="pickerShown == 'profile_text_color'" class="mb-20">
                        <td colspan="2">
                            <hex-color-picker :color="formData.customization.profile_text_color" @color-changed="(event) => handleColorChanged(event, 'profile_text_color')"></hex-color-picker>
                            <input type="text" v-model="formData.customization.profile_text_color" class="color-input">
                        </td>
                    </tr>


                    <tr>
                        <td colspan="2"><h3 class="mb-0 mt-10">Primary button - Save My Contact Card</h3></td>
                    </tr>
                    <!--- Buttons  Colors -->
                    <tr>
                        <td>Background color</td>
                        <td class="switcher-style-list">
                            <a class="swatch" v-bind:style="{backgroundColor: formData.customization.profile_buttons_color}" @click.prevent="showPicker('profile_buttons_color')"></a>
                        </td>
                    </tr>
                    <tr v-show="pickerShown == 'profile_buttons_color'" class="mb-20">
                        <td colspan="2">
                            <hex-color-picker :color="formData.customization.profile_buttons_color" @color-changed="(event) => handleColorChanged(event, 'profile_buttons_color')"></hex-color-picker>
                            <input type="text" v-model="formData.customization.profile_buttons_color" class="color-input">
                        </td>
                    </tr>

                    <tr>
                        <td>Text color</td>
                        <td class="switcher-style-list">
                            <a class="swatch" v-bind:style="{backgroundColor: formData.customization.profile_buttons_text_color}" @click.prevent="showPicker('profile_buttons_text_color')"></a>
                        </td>
                    </tr>
                    <tr v-show="pickerShown == 'profile_buttons_text_color'" class="mb-20">
                        <td colspan="2">
                            <hex-color-picker :color="formData.customization.profile_buttons_text_color" @color-changed="(event) => handleColorChanged(event, 'profile_buttons_text_color')"></hex-color-picker>
                            <input type="text" v-model="formData.customization.profile_buttons_text_color" class="color-input">
                        </td>
                    </tr>

                    <tr>
                        <td>Hover background color</td>
                        <td class="switcher-style-list">
                            <a class="swatch" v-bind:style="{backgroundColor: formData.customization.profile_buttons_hover_color}" @click.prevent="showPicker('profile_buttons_hover_color')"></a>
                        </td>
                    </tr>
                    <tr v-show="pickerShown == 'profile_buttons_hover_color'" class="mb-20">
                        <td colspan="2">
                            <hex-color-picker :color="formData.customization.profile_buttons_hover_color" @color-changed="(event) => handleColorChanged(event, 'profile_buttons_hover_color')"></hex-color-picker>
                            <input type="text" v-model="formData.customization.profile_buttons_hover_color" class="color-input">
                        </td>
                    </tr>

                    <tr>
                        <td>Hover text color</td>
                        <td class="switcher-style-list">
                            <a class="swatch" v-bind:style="{backgroundColor: formData.customization.profile_buttons_hover_text_color}" @click.prevent="showPicker('profile_buttons_hover_text_color')"></a>
                        </td>
                    </tr>
                    <tr v-show="pickerShown == 'profile_buttons_hover_text_color'" class="mb-20">
                        <td colspan="2">
                            <hex-color-picker :color="formData.customization.profile_buttons_hover_text_color" @color-changed="(event) => handleColorChanged(event, 'profile_buttons_hover_text_color')"></hex-color-picker>
                            <input type="text" v-model="formData.customization.profile_buttons_hover_text_color" class="color-input">
                        </td>
                    </tr>


                    <tr>
                        <td colspan="2"><h3 class="mb-0 mt-10">Secondary button - Connect With Me</h3></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <Checkbox :class="'full-row'" type="checkbox" v-model="formData.customization.show_connect_button" :checked="formData.customization.hasOwnProperty('show_connect_button') ? formData.customization.show_connect_button : true" label="Show button on profle" v-on:update:checked="handleConnectButtonVisibility"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <Checkbox :class="'full-row'" type="checkbox" v-model="formData.customization.show_connect_button" :checked="formData.customization.hasOwnProperty('connect_email_notificaions') ? formData.customization.connect_email_notificaions : (formData.customization.hasOwnProperty('show_connect_button') && formData.customization.show_connect_button == false ? false : true)" label="Send email notifications for new connections" v-on:update:checked="handleConnectEmailNotifications"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Background color</td>
                        <td class="switcher-style-list">
                            <a class="swatch" v-bind:style="{backgroundColor: formData.customization.connect_button_color}" @click.prevent="showPicker('connect_button_color')"></a>
                        </td>
                    </tr>
                    <tr v-show="pickerShown == 'connect_button_color'" class="mb-20">
                        <td colspan="2">
                            <hex-color-picker :color="formData.customization.connect_button_color" @color-changed="(event) => handleColorChanged(event, 'connect_button_color')"></hex-color-picker>
                            <input type="text" v-model="formData.customization.connect_button_color" class="color-input">
                        </td>
                    </tr>

                    <tr>
                        <td>Text color</td>
                        <td class="switcher-style-list">
                            <a class="swatch" v-bind:style="{backgroundColor: formData.customization.connect_button_text_color}" @click.prevent="showPicker('connect_button_text_color')"></a>
                        </td>
                    </tr>
                    <tr v-show="pickerShown == 'connect_button_text_color'" class="mb-20">
                        <td colspan="2">
                            <hex-color-picker :color="formData.customization.connect_button_text_color" @color-changed="(event) => handleColorChanged(event, 'connect_button_text_color')"></hex-color-picker>
                            <input type="text" v-model="formData.customization.connect_button_text_color" class="color-input">
                        </td>
                    </tr>

                    <tr>
                        <td>Hover background color</td>
                        <td class="switcher-style-list">
                            <a class="swatch" v-bind:style="{backgroundColor: formData.customization.connect_button_hover_color}" @click.prevent="showPicker('connect_button_hover_color')"></a>
                        </td>
                    </tr>
                    <tr v-show="pickerShown == 'connect_button_hover_color'" class="mb-20">
                        <td colspan="2">
                            <hex-color-picker :color="formData.customization.connect_button_hover_color" @color-changed="(event) => handleColorChanged(event, 'connect_button_hover_color')"></hex-color-picker>
                            <input type="text" v-model="formData.customization.connect_button_hover_color" class="color-input">
                        </td>
                    </tr>

                    <tr>
                        <td>Hover text color</td>
                        <td class="switcher-style-list">
                            <a class="swatch" v-bind:style="{backgroundColor: formData.customization.connect_button_hover_text_color}" @click.prevent="showPicker('connect_button_hover_text_color')"></a>
                        </td>
                    </tr>
                    <tr v-show="pickerShown == 'connect_button_hover_text_color'" class="mb-20">
                        <td colspan="2">
                            <hex-color-picker :color="formData.customization.connect_button_hover_text_color" @color-changed="(event) => handleColorChanged(event, 'connect_button_hover_text_color')"></hex-color-picker>
                            <input type="text" v-model="formData.customization.connect_button_hover_text_color" class="color-input">
                        </td>
                    </tr>
                </table>

            </div>

        </div>
</AuthenticatedUserLayout>
</template>
<style>
input.color-input {
    width: 200px;
    border-radius: 0 0 8px 8px;
    font-size: 12px;
    text-align: center;
    border: 1px solid #CCC;
}

hex-color-picker::part(hue) {
    border-radius: 0;
}
</style>

