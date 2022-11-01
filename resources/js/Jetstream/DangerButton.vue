<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type"
        class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-red-500 rounded-lg border border-red-200 hover:bg-red-600 hover:text-white focus:z-10 focus:ring-4 focus:ring-red-200 dark:focus:ring-red-600 dark:bg-gray-800 dark:text-red-600 dark:border-red-600 dark:hover:text-white dark:hover:bg-red-700">
        <slot />
    </button>
</template>
