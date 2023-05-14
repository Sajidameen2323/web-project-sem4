/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    darkMode: 'class',
  theme: {
    extend: {
      colors: {
        dark: {
          bg: '#000',
          text: '#fff',
        },
      },
    },
  },
    extend: {},
  },
  plugins: [
      require('flowbite/plugin')
  ],
}
