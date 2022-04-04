const colors = require('tailwindcss/colors')
const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    corePlugins: {
        preflight: true,
    },

    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/views/**/*.antlers.html",
        "./vendor/filament/**/*.blade.php",
    ],

    theme: {
        extend: {
            colors: {
                danger: colors.rose,
                primary: {
                    DEFAULT: "#340657",
                    50: "#EDD9FC",
                    100: "#DBB3FA",
                    200: "#B562F4",
                    300: "#9115EF",
                    400: "#640CA7",
                    500: "#340657",
                    600: "#2B0548",
                    700: "#1F0434",
                    800: "#140221",
                    900: "#0B0113",
                },
                success: colors.green,
                warning: colors.amber,
            },
            fontFamily: {
                sans: [...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require("@tailwindcss/aspect-ratio"),
        require("@tailwindcss/forms"),
        require("@tailwindcss/line-clamp"),
        require("@tailwindcss/typography"),
        require("tailwindcss-debug-screens"),
    ],
};
