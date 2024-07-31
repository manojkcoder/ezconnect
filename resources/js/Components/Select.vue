<script setup>
    import {onMounted,ref} from 'vue';
    const props = defineProps({
        modelValue: {type: String,required: true},
        label: {type: String},
        name: {type: String,default: 'select'},
        error: {type: String},
        class: {type: String},
        placeholder: {type: String},
        required: {type: Boolean,default: false},
        options: {type: Array,required: true}
    });
    defineEmits(['update:modelValue']);
    const select = ref(null);
    // onMounted(() => {
    //     if(input.value.hasAttribute('autofocus')){
    //         input.value.focus();
    //     }
    // });
    // defineExpose({focus: () => input.value.focus()});
</script>
<template>
    <div class="field full-field" :class="class">
        <label v-if="label">{{label}} <span v-if="required" class="required">*</span></label>
        <select class="form-control" :class="error ? 'error' : ''" :name="name" :value="modelValue" @change="$emit('update:modelValue',$event.target.value)" ref="select">
            <option value="">Select</option>
            <option v-for="option in options" :key="option.id" :value="option.id">{{ option.name }}</option>
        </select>
        <p @if="error" class="error-msg">{{ error }}</p>
    </div>
</template>
