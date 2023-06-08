import './bootstrap';

const contentWrapper = document.querySelector('.content-wrapper');
const navbarHeight = '3.5rem';
const borderHeight = '1px';

function updateContentWrapperHeight() {
  const windowHeight = window.innerHeight;
  const newHeight = `calc(${windowHeight}px - calc(${navbarHeight} + ${borderHeight}) - calc(${navbarHeight} + ${borderHeight}))`;
  const newHeight1 = `calc(100vh - calc(3.5rem + 1px) - calc(3.5rem + 1px))`;
  contentWrapper.style.minHeight = newHeight;
}

// Wywołanie funkcji na starcie oraz przy zmianie rozmiaru okna
window.addEventListener('DOMContentLoaded', updateContentWrapperHeight);
window.addEventListener('resize', updateContentWrapperHeight);