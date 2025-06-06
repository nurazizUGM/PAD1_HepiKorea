<template>
    <div v-if="show" class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
        <div class="relative">
            <slot />
        </div>
    </div>
</template>

<script>
export default {
    props: {
        show: { type: Boolean, required: true },
    },
    emits: ['close'],
};
</script>