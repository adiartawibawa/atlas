<template>
    <div>
        <!-- Navigation Bar -->
        <NavBar />

        <div class="flex overflow-hidden bg-white pt-16">
            <!-- Left Side Bar -->
            <LeftSide />

            <div
                id="main-content"
                class="h-full w-full bg-gray-50 relative overflow-y-auto lg:ml-64"
            >
                <!-- Page Heading -->
                <header
                    v-if="$slots.header"
                    class="bg-gray-50 dark:bg-gray-800"
                >
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <slot name="header" />
                    </div>
                </header>
                <!-- Page Content -->
                <main>
                    <slot />
                </main>

                <!-- Footer -->
                <Footer></Footer>
            </div>
        </div>
    </div>
</template>

<script setup>
import NavBar from "@/Layouts/Partials/NavBar.vue";
import LeftSide from "@/Layouts/Partials/LeftSide.vue";
import Footer from "@/Layouts/Partials/Footer.vue";
</script>
