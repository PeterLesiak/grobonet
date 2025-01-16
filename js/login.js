/** @type {HTMLInputElement} */
const password = document.querySelector('#password');
/** @type {HTMLDivElement} */
const visible = document.querySelector('.visible');
/** @type {HTMLDivElement} */
const invisible = document.querySelector('.invisible');

visible.addEventListener('click', () => {
    visible.style.display = 'none';
    invisible.style.display = 'block';
    password.type = 'password';
});

invisible.addEventListener('click', () => {
    invisible.style.display = 'none';
    visible.style.display = 'block';
    password.type = 'text';
});
