import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
        display: ['Outfit', '"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        ink: {
          900: '#0b0f17',
          800: '#111827',
          700: '#1f2937',
        },
      },
      keyframes: {
        'ken-burns': {
          '0%': { transform: 'scale(1)' },
          '100%': { transform: 'scale(1.12)' },
        },
        'rise': {
          '0%': { opacity: '0', transform: 'translateY(110%)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        'fade-up': {
          '0%': { opacity: '0', transform: 'translateY(24px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        'scroll-dot': {
          '0%': { opacity: '0', transform: 'translateY(0)' },
          '40%': { opacity: '1' },
          '100%': { opacity: '0', transform: 'translateY(14px)' },
        },
        'marquee': {
          '0%': { transform: 'translateX(0)' },
          '100%': { transform: 'translateX(-50%)' },
        },
      },
      animation: {
        'ken-burns': 'ken-burns 7s ease-out forwards',
        'rise': 'rise .9s cubic-bezier(.2,.7,.2,1) both',
        'fade-up': 'fade-up .8s cubic-bezier(.2,.7,.2,1) both',
        'scroll-dot': 'scroll-dot 1.8s ease-in-out infinite',
        'marquee': 'marquee 40s linear infinite',
      },
    },
  },
  plugins: [],
}
