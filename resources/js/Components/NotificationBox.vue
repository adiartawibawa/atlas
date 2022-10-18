<template>
    <div
        class="fixed inset-0 z-50 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end">
        <transition appear enter-active-class="transform ease-out duration-300 transition"
            enter-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
            leave-active-class="transition ease-in duration-100" leave-class="opacity-100" leave-to-class="opacity-0">
            <div v-show="status && show"
                class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden"
                @mouseleave="show = false">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <Icon :class="'text-' + notification.color + '-400'" :icon="icon" />
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <template v-if="notification.title && notification.message">
                                <p class="text-sm font-medium text-gray-900">
                                    {{ notification.title }}
                                </p>
                                <p class="mt-1 text-sm text-gray-500">
                                    {{ notification.message }}
                                </p>
                            </template>
                            <template v-else>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ notification.message || notification.title }}
                                </p>
                            </template>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button
                                class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                @click="show = false">
                                <span class="sr-only">Close</span>
                                <icon icon="x" class="h-5 w-5" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import Icon from "@/Components/Icon.vue";

export default {
    components: { Icon },

    props: {
        status: Number,
    },

    data() {
        return {
            show: true,
        }
    },

    computed: {
        title() {
            return {
                503: '503: Service Unavailable',
                500: '500: Server Error',
                404: '404: Page Not Found',
                403: '403: Forbidden',
            }[this.status]
        },
        description() {
            return {
                503: 'Sorry, we are doing some maintenance. Please check back soon.',
                500: 'Whoops, something went wrong on our servers.',
                404: 'Sorry, the page you are looking for could not be found.',
                403: 'Sorry, you are forbidden from accessing this page.',
            }[this.status]
        },
        icon() {
            return {
                503: 'Sorry, we are doing some maintenance. Please check back soon.',
                500: 'Whoops, something went wrong on our servers.',
                404: 'Sorry, the page you are looking for could not be found.',
                403: 'Sorry, you are forbidden from accessing this page.',
            }[this.status]
        },
        color() {
            return {
                503: 'Sorry, we are doing some maintenance. Please check back soon.',
                500: 'Whoops, something went wrong on our servers.',
                404: 'Sorry, the page you are looking for could not be found.',
                403: 'Sorry, you are forbidden from accessing this page.',
            }[this.status]
        },
        // notification() {
        //     return this.$page.props.flash.notification;
        // },

        // icon() {
        //     return {
        //         red: 'exclamation-circle',
        //         green: 'check-circle',
        //     }[this.notification.color];
        // }
    },
}
</script>