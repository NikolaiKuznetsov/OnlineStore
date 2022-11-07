/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
    content: [
        './storage/framework/views/*.php',
        './resources/views/*.blade.php',
        './resources/js/*.js',
        './node_modules/tw-elements/dist/js/**/*.js',
        './node_modules/flowbite/**/*.js',
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require('tw-elements/dist/plugin'),
        require('flowbite/plugin'),
    ],
}
