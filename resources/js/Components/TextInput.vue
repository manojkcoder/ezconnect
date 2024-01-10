<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    label: {
        type: String,
    },
    type: {
        type: String,
        default: 'text',
    },
    name: {
        type: String,
        default: 'text',
    },
    error: {
        type: String,
    },
    class: {
        type: String,
    },
    placeholder: {
        type: String,
    },
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <div class="field full-field" :class="class">
        <label v-if="label" v-text="label"></label>
        <input v-if="type !== 'textarea'" :type="type" class="form-control" :class="error ? 'error' : ''" v-bind:placeholder="placeholder ? placeholder : 'Enter '+label" :name="name" :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
        />
        <textarea v-else rows="10" class="form-control" :class="error ? 'error' : ''" v-bind:placeholder="placeholder ? placeholder : 'Enter '+label" :name="name" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input"></textarea>
        <p @if="error" class="error-msg">{{ error }}</p>
    </div>
</template>
