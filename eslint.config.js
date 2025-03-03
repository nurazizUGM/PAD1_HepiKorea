import pluginJs from "@eslint/js";
import pluginVue from "eslint-plugin-vue";
import globals from "globals";

/** @type {import('eslint').Linter.Config[]} */
export default [
    { languageOptions: { globals: globals.browser } },
    pluginJs.configs.recommended,
    ...pluginVue.configs["flat/essential"],
    {
        files: ["resources/js/**/*.{js,mjs,cjs,vue}"],
        rules: {
            "no-unused-vars": "warn",
            "no-undef": "warn",
            semi: "warn",
            "prefer-const": "error",
            "vue/multi-word-component-names": "off",
            "vue/no-mutating-props": "off",
            "vue/no-reserved-component-names": "off",
        },
    },
    {
        // Note: there should be no other properties in this object
        ignores: [
            "**/temp.js",
            "config/*",
            "vendor/*",
            "public/*",
            "webpack.mix.js",
        ],
    },
];
