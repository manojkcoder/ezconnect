<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        required: true,
    },
    value: {
        default: null,
    },
    label: {
        default: null,
    },
    class: {
        default: null,
    },
    error: {
        type: String,
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>

<template>
    <div class="field" :class="class">
        <div style="display: flex; align-items: center; column-gap: 20px;">
            <label class="switch">
                <input type="checkbox"
                :value="value"
                v-model="proxyChecked">
                <span class="switch-toggle"></span>
            </label>
            <span v-html="label"></span>
        </div>
        <p @if="error" class="error-msg">{{ error }}</p>
    </div>
</template>
