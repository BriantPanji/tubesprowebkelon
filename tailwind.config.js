/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.html"],
  darkMode: "selector",
  theme: {
    extend: {
      boxShadow: {
        'xs': '1px 1px 1px #0d0d0d',
      },
      colors: {
        dark: {
          // background: "#070f0e",
          // bg: "#060909",
          /* bg: "#0e1917",
          text: "#e4f1ef",
          primary: "#96e8da",
          secondary: "#0f8a75",
          accent: "#0dfdd5", */
          /* bg: "#0D0D0D",
          text: "#D9D9D9",
          accent: "#400101",
          secondary: "#A60F0F",
          primary: "#F20F0F", */
          /* bg: "#0C0C0D",
          text: "#F2EFE9",
          accent: "#8C8B88",
          primary: "#595959",
          secondary: "#201F26", */

          /* 'text': '#f2f2f2',
          'bg': '#071616',
          'primary': '#0de3e3',
          'secondary': '#0da7c9',
          'accent': '#bcf5e5', */
          'text': '#393D3F',
          'bg': '#FEF6EB',
          'primary': '#493628',
          'secondary': '#1A1414',
          'tertiary': '#505050',
          'accent': '#393D3F',



        },
        light: {
          // bg: "#dedede",
          // text: "#0e1b19",
          // primary: "#17695b",
          // secondary: "#75f0db",
          // accent: "#02f2ca",
          'text': '#393D3F',
          'bg': '#FEF6EB',
          'primary': '#493628',
          'secondary': '#1A1414',
          'tertiary': '#505050',
          'accent': '#393D3F',
        },
        shadark: {
          'text': {
            50: '#f2f2f2',
            100: '#e6e6e6',
            200: '#cccccc',
            300: '#b3b3b3',
            400: '#999999',
            500: '#808080',
            600: '#666666',
            700: '#4d4d4d',
            800: '#333333',
            900: '#1a1a1a',
            950: '#0d0d0d',
          },
          'bg': {
            50: '#ecf9f9',
            100: '#d8f3f3',
            200: '#b1e7e7',
            300: '#8bdada',
            400: '#64cece',
            500: '#3dc2c2',
            600: '#319b9b',
            700: '#257474',
            800: '#184e4e',
            900: '#0c2727',
            950: '#061313',
          },
          'primary': {
            50: '#e7fefe',
            100: '#cffcfc',
            200: '#9ff9f9',
            300: '#6ef7f7',
            400: '#3ef4f4',
            500: '#0ef1f1',
            600: '#0bc1c1',
            700: '#089191',
            800: '#066060',
            900: '#033030',
            950: '#011818',
          },
          'secondary': {
            50: '#e7f9fd',
            100: '#cff4fc',
            200: '#9fe8f9',
            300: '#6fddf6',
            400: '#3fd2f3',
            500: '#0fc7f0',
            600: '#0c9fc0',
            700: '#097790',
            800: '#064f60',
            900: '#032830',
            950: '#021418',
          },
          'accent': {
            50: '#e9fcf6',
            100: '#d3f8ee',
            200: '#a6f2dc',
            300: '#7aebcb',
            400: '#4ee4ba',
            500: '#21dea8',
            600: '#1bb187',
            700: '#148565',
            800: '#0d5943',
            900: '#072c22',
            950: '#031611',
          },
        }
      },
    },
  },
  plugins: [],
}
