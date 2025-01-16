/** @type {HTMLFormElement} */
const form = document.querySelector('.form');
/** @type {HTMLButtonElement} */
const logout = document.querySelector('.logout');
/** @type {HTMLDivElement} */
const accountImage = document.querySelector('.account-image');
/** @type {HTMLImageElement} */
const imageSource = document.querySelector('#image-source');

let selectedFile = null;

form.addEventListener('submit', async event => {
  event.preventDefault();

  const formData = new FormData(form);
  formData.set('image', selectedFile || '');

  await fetch('./php/account.php', {
    body: formData,
    method: 'post',
  });
});

logout.addEventListener('click', async () => {
  await fetch('./php/logout.php');

  location.href = './login.php';
});

const fakeInputBecauseDOMAPIIsReallyStupid = document.createElement('input');
fakeInputBecauseDOMAPIIsReallyStupid.type = 'file';
fakeInputBecauseDOMAPIIsReallyStupid.accept = 'image/*';

fakeInputBecauseDOMAPIIsReallyStupid.addEventListener('change', async () => {
  const files = fakeInputBecauseDOMAPIIsReallyStupid.files;

  if (!files || !files?.length) return;

  const reader = new FileReader();
  reader.addEventListener('load', event => {
    selectedFile = file;
    imageSource.src = event.target.result;
  });

  const file = files[0];
  reader.readAsDataURL(file);
});

accountImage.addEventListener('click', () => {
  fakeInputBecauseDOMAPIIsReallyStupid.click();
});

accountImage.addEventListener('dragover', event => {
  event.preventDefault();
});

accountImage.addEventListener('drop', event => {
  event.preventDefault();

  if (!event.dataTransfer) return;

  const reader = new FileReader();
  reader.addEventListener('load', event => {
    selectedFile = file;
    imageSource.src = event.target.result;
  });

  const [file] = event.dataTransfer.files;
  reader.readAsDataURL(file);
});
