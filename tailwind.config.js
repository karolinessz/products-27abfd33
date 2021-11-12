module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/vue/**/*.vue',
    './resources/css/**/*.css',
  ],
  darkMode: 'class',
  theme: {
    extend: {}
  },
  variants: {},
  plugins: [
    require('@tailwindcss/ui'),
  ]
}
