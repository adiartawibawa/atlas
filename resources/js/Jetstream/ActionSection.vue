<script setup>
import JetSectionTitle from './SectionTitle.vue';
</script>

<template>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <JetSectionTitle>
            <template #title>
                <div class="dark:text-white">
                    <slot name="title" />
                </div>
            </template>
            <template #description>
                <div class="dark:text-gray-400">
                    <slot name="description" />
                </div>
            </template>
        </JetSectionTitle>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg dark:bg-gray-700">
                <slot name="content" />
            </div>
        </div>
    </div>
</template>
