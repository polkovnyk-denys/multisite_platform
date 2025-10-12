/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./template-parts/**/*.php",
    "./includes/**/*.php",
    "./modules/**/*.php",
    "./src/**/*.{js,jsx,ts,tsx,scss,css}",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
