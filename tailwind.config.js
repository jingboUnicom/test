const colors = require("tailwindcss/colors");
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
        screens: {
            sm: "640px",
            md: "768px",
            lg: "1024px",
            xl: "1200px",
        },
        extend: {
            colors: {
                danger: colors.rose,
                primary: {
                    DEFAULT: "#4058AA",
                    50: "#ECEFF8",
                    100: "#D6DCF0",
                    200: "#ADB9E0",
                    300: "#889AD2",
                    400: "#6077C3",
                    500: "#4058AA",
                    600: "#344889",
                    700: "#273668",
                    800: "#192343",
                    900: "#0D1121",
                },
                success: colors.green,
                warning: colors.amber,
            },
            fontFamily: {
                primary: ["montserrat", ...defaultTheme.fontFamily.sans],
                sans: ["montserrat", ...defaultTheme.fontFamily.sans],
                serif: ["montserrat", ...defaultTheme.fontFamily.serif],
                mono: ["montserrat", ...defaultTheme.fontFamily.mono],
                secondary: ["source-sans-pro", ...defaultTheme.fontFamily.sans],
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
