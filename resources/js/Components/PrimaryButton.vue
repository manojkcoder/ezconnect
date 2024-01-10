<script setup>

defineProps({
    class: {
        type: String,
        default: '',
    },
});
</script>
<template>
    <div class="flex-row button-row">
        <button type="submit" class="site-btn dark-btn" :class="class"><slot /></button>
    </div> 
</template>
