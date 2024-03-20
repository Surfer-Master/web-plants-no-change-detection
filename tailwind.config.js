const colors = require("tailwindcss/colors");

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                primary: colors.indigo,
                secondary: colors.rose,
                // dark: "#0f172a",
            },
        },
    },
    plugins: [require("flowbite/plugin")],
};
