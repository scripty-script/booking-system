const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        "./vendor/filament/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                danger: colors.rose,
                primary: {
                    50: "#bb6779",
                    100: "#af4e62",
                    200: "#bfdbfe",
                    300: "#a4354c",
                    400: "#981b35",
                    500: "#8d021f",
                    600: "#7f021c",
                    700: "#710219",
                    800: "#630116",
                    900: "#550113",
                    950: "#470110",
                },
                success: colors.green,
                warning: colors.yellow,
            },
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
