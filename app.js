document.addEventListener('DOMContentLoaded', () => {
  const toggle = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.nav-links');
  if (toggle && nav) {
    toggle.addEventListener('click', () => {
      const isOpen = nav.classList.toggle('open');
      toggle.setAttribute('aria-expanded', String(isOpen));
      toggle.textContent = isOpen ? '✕' : '☰';
    });
  }

  const comment = document.querySelector('#body');
  const counter = document.querySelector('#comment-count');
  if (comment && counter) {
    const updateCount = () => { counter.textContent = String(comment.value.length); };
    comment.addEventListener('input', updateCount);
    updateCount();
  }

  // Friendly client-side password confirmation. Server-side validation remains authoritative.
  const password = document.querySelector('#password');
  const confirm = document.querySelector('#confirm_password');
  if (password && confirm) {
    confirm.addEventListener('input', () => {
      confirm.setCustomValidity(confirm.value && confirm.value !== password.value ? 'Passwords do not match.' : '');
    });
    password.addEventListener('input', () => {
      confirm.setCustomValidity(confirm.value && confirm.value !== password.value ? 'Passwords do not match.' : '');
    });
  }
});