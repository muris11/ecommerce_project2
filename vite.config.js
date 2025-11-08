import laravel from "laravel-vite-plugin";
import { defineConfig } from "vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    build: {
        // Optimize chunk size
        chunkSizeWarningLimit: 1000,
        rollupOptions: {
            output: {
                // Manual chunk splitting for better caching
                manualChunks(id) {
                    if (id.includes("node_modules")) {
                        if (id.includes("livewire")) {
                            return "vendor-livewire";
                        }
                        if (id.includes("alpine")) {
                            return "vendor-alpine";
                        }
                        return "vendor";
                    }
                },
            },
        },
        // Enable minification
        minify: "terser",
        terserOptions: {
            compress: {
                drop_console: true, // Remove console.log in production
            },
        },
    },
});
