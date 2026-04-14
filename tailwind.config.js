const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
  content: ["./src/**/*.{html,js}"],
  theme: {
    fontFamily: {
      Roboto: ["Rubik", "sans-serif"],
      poppins: ["Rubik, sans-serif"],
    },
    extend: {
      colors: {
        primary: {
          DEFAULT: "rgb(var(--rgb-primary, 115 85 247) / <alpha-value>)",
          hover: "#dd3e6e",
          dark: "#7b1534",
          light: "#f4f2ff",
          gradient: "#f8ae56",
          rgba: "245 95 141",
        },
        colorTheme1: {
          primary: {
            default: "rgb(var(--rgb-primary, 115 85 247) / <alpha-value>)",
            hover: "#4b24f5",
            dark: "#2608ab",
            light: "#f4f2ff",
            rgba: "115 85 247",
          },
          secondary: {
            default: "#1f2471",
          },
        },
        colorTheme2: {
          primary: {
            default: "rgb(var(--rgb-primary, 245 95 141) / <alpha-value>)",
            hover: "#dd3e6e",
            dark: "#7b1534",
            light: "#ffedf3",
            gradient: "#f8ae56",
            rgba: "245 95 141",
          },
          secondary: {
            default: "#1f2471",
          },
          gradient: {
            default: "#f8ae56",
          },
        },
        colorTheme3: {
          primary: {
            default: "rgb(var(--rgb-primary, 240 31 117) / <alpha-value>)",
            hover: "#d40c5e",
            dark: "#631032",
            light: "#ffecf4",
            rgba: "240 31 117",
          },
          secondary: {
            default: "#1f2471",
          },
          gradient: {
            one: "#ef146e",
            two: "#fea958",
            three: "#111c58",
            four: "#5c2782",
          },
        },
        colorTheme4: {
          primary: {
            default: "rgb(var(--rgb-primary, 35 74 218) / <alpha-value>)",
            hover: "#0e2ea7",
            dark: "#021e89",
            light: "#f1f4ff",
            rgba: "35 74 218",
          },
          secondary: {
            default: "#1f2471",
          },
        },
        colorTheme5: {
          primary: {
            default: "rgb(var(--rgb-primary, 0 83 169) / <alpha-value>)",
            hover: "#004893",
            dark: "#003c7a",
            light: "#fbf7ff",
            rgba: "0 83 169",
          },
          secondary: {
            default: "#390d74",
          },
        },

        current: "currentColor",
        yellow: "#ffa808",
        red: "#ff586e",
        blue: "#5543d1",
        green: "#029e76",
        gray: "#f8f5ff",
        skyblue: "#00aeff",
        orange: "#ff8853",
        maroon: "#9e0168",
      },
      backgroundColor: (theme) => ({
        primaryhover: "var(--primary-hover)",
        primarylight: "var(--primary-light)",
        primarydark: "var(--primary-dark)",
      }),
      textColor: (theme) => ({
        primaryhover: "var(--primary-hover)",
        primarylight: "var(--primary-light)",
        primarydark: "var(--primary-dark)",
      }),
      borderColor: (theme) => ({
        primaryhover: "var(--primary-hover)",
        primarylight: "var(--primary-light)",
        primarydark: "var(--primary-dark)",
      }),

      spacing: {
        4.5: "1.125rem",
        7.5: "30px",
        25: "100px",
      },
      zIndex: {
        1: "1",
        99: "99",
      },
      boxShadow: {
        default: "0 20px 50px 0 rgba(0, 0, 0, 0.1)",
        wrapper: "0 0 60px 0 rgba(0, 0, 0, 0.1)",
        card: "1px -15px 50px 0 rgba(0, 0, 0, 0.1)",
      },
      overflow: {
        unset: "unset",
      },
      backgroundSize: {
        full: "100%",
      },
      keyframes: {
        move: {
          "0%": { transform: "rotate(1deg) translate(2px, 2px)" },
          "50%": { transform: "rotate(-1deg) translate(-2px, -2px)" },
          "100%": { transform: "rotate(1deg) translate(2px, 2px)" },
        },
        move_4: {
          "0%": { transform: "translate(0, -5px)" },
          "50%": { transform: " translate(0, 5px)" },
          "100%": { transform: "translate(0, -5px)" },
        },
        move_3: {
          "0%": { transform: "translate(0, 0)" },
          "20%": { transform: " translate(5px, 0)" },
          "40%": { transform: " translate(5px, 5px)" },
          "65%": { transform: " translate(0, 5px)" },
          "65%": { transform: " translate(5px, 0)" },
          "100%": { transform: "translate(0, 0)" },
        },
        toLeftFromRight: {
          "49%": { transform: "translateX(100%)" },
          "80%": { opacity: "0" },
          "50%": { transform: "translateX(-100%)" },
          "51%": { opacity: "1" },
        },
      },
      animation: {
        move: "move 5s infinite",
        move_4: "move_4 5s infinite",
        move_3: "move_3 5s infinite",
        toLeftFromRight: "toLeftFromRight 0.5s forwards",
      },
    },
    container: {
      center: true,
      padding: "15px",
    },
    screens: {
      sm: "574px",
      // => @media (min-width: 574px)

      md: "768px",
      // => @media (min-width: 768px)

      lg: "990px",
      // => @media (min-width: 990px)

      xl: "1200px",
      // => @media (min-width: 1200px)

      "max-sm": { max: "576px" },
      // => @media (max-width: 576px)

      "max-md": { max: "767px" },
      // => @media (max-width: 767px)

      "max-lg": { max: "991px" },
      // => @media (max-width: 991px)

      "max-xl": { max: "1199px" },
      // => @media (max-width: 1199px)

      "max-2xl": { max: "1400px" },
      // => @media (max-width: 1400px)
    },
  },
  plugins: [],
};
