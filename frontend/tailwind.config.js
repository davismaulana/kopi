/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./src/**/*.{js,jsx,ts,tsx}"
  ],
  theme: {
    extend: {
      colors: {
          'light-beige': '#F5F0E6', // Light Beige for text
          'espresso': '#5D4037', // Espresso Brown
          'latte': '#F5F0E6',    // Light Beige (Latte)
          'caramel': '#D4A574',  // Caramel Accent
          'transparent-white': 'rgba(255, 255, 255, 0.8)',
      }
  },
  },
  plugins: [],
}

