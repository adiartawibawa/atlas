import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { resolve } from "path";
import vue from "@vitejs/plugin-vue";

export default defineConfig(async ({ command }) => {
    return {
        base:
            command === "serve"
                ? process.env.ASSET_URL || ""
                : `${process.env.ASSET_URL || ""}/build/`,
        publicDir: false,
        build: {
            manifest: true,
            outDir: "public/build",
            rollupOptions: {
                input: {
                    app: "resources/js/app.js",
                },
            },
        },
        server: {
            fs: { allow: [`${process.cwd()}`] },
            port: process.env?.VITE_PORT ?? 3000,
        },
        plugins: [
            laravel({
                input: "resources/js/app.js",
                ssr: "resources/js/ssr.js",
            }),
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
        ],
        resolve: {
            alias: {
                "@": resolve(__dirname, "resources/js"),
                "/img": resolve(__dirname, "public/img"),
            },
        },
        optimizeDeps: {
            include: [
                "@inertiajs/inertia",
                "@inertiajs/inertia-vue3",
                "axios",
                "vue",
            ],
        },
    };
});
