<script setup>
import Modal from './Modal.vue';

const emit = defineEmits(['close']);

defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
});

const close = () => {
    emit('close');
};
</script>

<template>
    <Modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close">

        <div class="px-6 py-4 dark:border-gray-600">
            <!-- Modal header -->
            <div class="text-lg dark:text-white">
                <slot name="title" />
            </div>
            <!-- Modal body -->
            <div class="mt-4 dark:text-gray-400">
                <slot name="content" />
            </div>
        </div>
        <!-- Modal footer -->
        <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right dark:bg-gray-700">
            <slot name="footer" />
        </div>
    </Modal>
</template>
