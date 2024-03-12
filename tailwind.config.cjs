// https://tailwindcss.com/docs/configuration
const defaultTheme = require('tailwindcss/defaultTheme');
const plugin = require('tailwindcss/plugin');

let leading = (level, lh, ratio = 1.125, base = 16) => {
  return lh / (base * (Math.pow(ratio, level)));
}

let toRem = (px, base = 16) => {
  return px / base + 'rem';
}

module.exports = {
  content: ["./index.php", "./app/**/*.php", "./resources/**/*.{php,vue,js}"],
  theme: {
    screens: {
      'xs': '360px',
      ...defaultTheme.screens,
      '2xl': '1366px',
      '3xl': '1440px',
      '4xl': '1600px',
      '5xl': '1920px',
    },
    fontFamily: {
      primary: ['Montserrat', 'Helvetica', 'Arial', 'sans-serif'],
      button: ['Prompt', 'Helvetica', 'Arial', 'sans-serif'],
      headings: ['Montserrat', 'Helvetica', 'Arial', 'sans-serif'],
      headings_sec: ['Raleway', 'Helvetica', 'Arial', 'sans-serif'],
      product_title: ['PlayfairDisplay-SemiBoldItalic', 'Helvetica', 'Arial', 'sans-serif'],
    },

    extend: {
      borderRadius: {
        'hero': '480px',
        'bg': '300px',
        'bg-xl': '200px',
        'bg-lg': '100px',
        'bg-md': '50px',
        'bg-sm': '25px',
        'bg-xs': '10px',
      },
    colors: {
      current: "currentColor",
      transparent: "transparent",

      black: "#2B2B2A",
      white: "#fff",

      primary: {
        DEFAULT: "#B13126",
      },
      'gray': {
        DEFAULT: "#605F5F",
      },
      'gray-dark': {
        DEFAULT: "#ACACAC",
      },
      'gray-light': {
        DEFAULT: "#F4F4F4",
      }

    },
    spacing: {
      'half': '50px',
      'full': '100px',
      '30': '30px',
      '60': '60px',
    },
    fontSize: {
      'smallest': [11, {
        lineHeight: 1.91,
      }],
      'caption':[14, {
        lineHeight: 1.214,
        letterSpacing: '0.05em',
      }],
      'menu' : [18, {
        lineHeight: 1.44,
       
      }],
      'base': [15, 1.73],
      'desc': [18, 1.67],
      'button': [16, {
        lineHeight: 1.25,
        letterSpacing: '0.05em',
      }],
      // https://modern-fluid-typography.vercel.app/
      // where u can get fluid typography

      //h5 - 20px
      '5xl': [20, 1.5],
      //h4 = 26px - to 22px
      '6xl': ['clamp(1.375rem, 1vw + 1rem, 1.625rem);', {
        lineHeight: 1.38,
      }],
      //h3 - 38px - to 26px
      '7xl': ['clamp(1.625rem, 2vw + 1rem, 2.375rem);', {
        lineHeight: 1.29,
      }],
      //h2 - 54px - to 42px
      '8xl': ['clamp(2.375rem, 4vw + 1rem, 3.375rem);', {
        lineHeight: 1.12,
      }],
      //h1 - 58px to 38px
      '9xl': ['clamp(2.375rem, 4vw + 1rem, 3.625rem);', {
        lineHeight: 1.21,
      }],
  },
    },
  },
  plugins: [
    require('tailwind-hamburgers'),
    require('@tailwindcss/forms')({
      strategy: 'base',
    }),
    plugin(function ({addBase, addComponents, addUtilities, theme}) {
      addComponents({
        ".container": {
          paddingLeft: "1.25rem",
          paddingRight: "1.25rem",
          width: "100%",
          maxWidth: "1488px",
          margin: "0 auto",
        },
        ".wrapper": {
          paddingLeft: "1.25rem",
          paddingRight: "1.25rem",
        },
        '.font-size-inherit': {
          fontSize: 'inherit',
        },
        '.color-inherit': {
          color: 'currentColor !important',
        },
        '.theme-radius-base': {
          borderRadius: toRem(6)
        },
        '.theme-radius-base-md': {
          borderRadius: toRem(8)
        },
        '.theme-radius-base-lg': {
          borderRadius: toRem(10)
        },
        '.theme-radius-base-xl': {
          borderRadius: toRem(12)
        },
      })
    })
  ],
};