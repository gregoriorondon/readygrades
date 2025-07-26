import defaultTheme from 'tailwindcss/defaultTheme';
const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
// export default {
//     content: [
//         './resources/**/*.blade.php',
//         './resources/**/*.js',
//         './resources/**/*.vue',
//     ],
//     theme: {
//         colors: {
//             'ready': '#4272d8',
//         },
//         extend: {
//             fontFamily: {
//                 sans: ['Figtree', ...defaultTheme.fontFamily.sans],
//                 inter: ['Inter'],
//                 staat: ['staatliches'],
//             },
//         },
//     },

//     plugins: [],
// };
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/views/errors/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
            'ready': '#4272d8',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                inter: ['inter'],
                staat: ['staatliches'],
                // CourierPrime: ['CourierPrime'],
                // CourierPrimeBold: ['CourierPrimeBold'],
                // CourierPrimeItalic: ['CourierPrimeItalic'],
                // CourierPrimeBoldItalic: ['CourierPrimeBoldItalic'],
            },
        },
    },
        plugins: [],

};
