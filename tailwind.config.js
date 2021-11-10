module.exports = {
  purge: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php'],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      width: {
          '96': '24rem', 
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
