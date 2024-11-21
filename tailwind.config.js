/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.html"],
  darkMode: "selector",
  theme: {
    /* screens: {
      'xs': '500px',
      'sm': '640px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1280px',
      '2xl': '1536px',
      }, */
    extend: {
      screens: {
        'xs': '500px',
      },
      boxShadow: {
        'xs': '1px 1px 1px #0d0d0d',
      },
      colors: {
        dark: {
          /* 'text': '#393D3F',
          'bg': '#FEF6EB',
          'primary': '#493628',
          'secondary': '#1A1414',
          'tertiary': '#505050',
          'accent': '#393D3F', */



        },
        light: {
          'text': '#393D3F',
          'bg': '#FEF6EB',
          'primary': '#493628',
          'secondary': '#1A1414',
          'tertiary': '#505050',
          'accent': '#393D3F',
        },
      },
    },
  },
  plugins: [],
}

