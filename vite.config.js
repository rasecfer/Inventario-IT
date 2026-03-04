import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import fs from "fs";

const host = "inventario-it.test";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            detectTls: host,
            refresh: true,
        }),
    ],
    server: {
        // Set host to true to listen on all network interfaces
        host,
        hmr: {
            host,
        },
        https: {
            key: fs.readFileSync(
                `/Users/fermoreno/Library/Application Support/Herd/config/valet/Certificates/${host}.key`,
            ),
            cert: fs.readFileSync(
                `/Users/fermoreno/Library/Application Support/Herd/config/valet/Certificates/${host}.crt`,
            ),
        },
    },
});
