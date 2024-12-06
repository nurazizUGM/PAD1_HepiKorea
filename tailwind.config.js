import flowbitePlugin from "flowbite/plugin";

/** @type {import('tailwindcss').Config} */

export const content = [
    "./resources/**/*.blade.php",
    "./resources/**/**/*.blade.php",
    "./storage/framework/views/*.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",
];
export const theme = {
    extend: {
        fontFamily: {
            poppins: ["Poppins", "sans-serif"],
        },
    },
};
export const plugins = [flowbitePlugin];
