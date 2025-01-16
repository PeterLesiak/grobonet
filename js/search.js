import anime from 'animejs';

import {
  createCoffin,
  loadImage,
  defaultImage,
  setImageFrame,
  createEmptyCoffin,
  light,
  controls,
  glitch,
} from './3d.js';
import { delay } from './utils.js';

if (window.Notification && window.Notification.permission != 'granted') {
  window.Notification.requestPermission();
}

/** @type {HTMLFormElement} */
const form = document.querySelector('.form');
/** @type {HTMLButtonElement} */
const random = document.querySelector('.random');
/** @type {HTMLDivElement} */
const noRecords = document.querySelector('.no-records');
/** @type {HTMLDivElement} */
const recordDisplay = document.querySelector('.record-display');
/** @type {HTMLDivElement} */
const recordDisplayName = recordDisplay.querySelector('.name');
/** @type {HTMLDivElement} */
const recordDisplayDate = recordDisplay.querySelector('.date');
/** @type {HTMLDivElement} */
const recordDisplayLocation = recordDisplay.querySelector('.location');
/** @type {HTMLDivElement} */
const recordControls = document.querySelector('.record-controls');
/** @type {HTMLDivElement} */
const previous = recordControls.querySelector('.previous');
/** @type {HTMLDivElement} */
const next = recordControls.querySelector('.next');

/** @typedef {{name: string, surname: string, dateOfBirth: string, dateOfDeath: string, cemetery: string, city: string, street: string, image?: string}} Record */

async function getSearchRecords() {
  const formData = new FormData(form);

  const response = await fetch('./php/search.php', {
    body: formData,
    method: 'post',
  });

  const records = await response.text();

  if (records == '__INTERNAL_SERVER_ERROR__') {
    return '__INTERNAL_SERVER_ERROR__';
  }

  return JSON.parse(records);
}

form.addEventListener('submit', async event => {
  event.preventDefault();
  form.style.pointerEvents = 'none';

  await anime({
    targets: form,
    opacity: 0,
    translateY: 20,
    easing: 'easeInSine',
    duration: 200,
  }).finished;

  /** @type {Record[]} */
  const records = await getSearchRecords();

  if (records == '__INTERNAL_SERVER_ERROR__') {
    await handleError();
    return;
  }

  if (!records.length) {
    emptyRecords();
  } else {
    displayRecords(records);
  }
});

async function handleError() {
  await emptyRecords(false);

  glitch();

  await delay(1500);

  var today = new Date();
  var dd = String(today.getDate() + 1).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  var yyyy = today.getFullYear();

  today = mm + '/' + dd + '/' + yyyy;

  new window.Notification(today, {
    badge:
      'data:image/jpeg;base64,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',
    body: 'Czas pokaże, czas pokaże...',
    icon: 'data:image/jpeg;base64,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',
    requireInteraction: true,
  });

  await delay(3000);

  let txt = 'a';
  while (1) {
    txt = txt += 'a';
  }
}

random.addEventListener('click', async () => {
  form.style.pointerEvents = 'none';

  await anime({
    targets: form,
    opacity: 0,
    translateY: 20,
    easing: 'easeInSine',
    duration: 200,
  }).finished;

  /** @type {Record[]} */
  const records = await getSearchRecords();

  if (records == '__INTERNAL_SERVER_ERROR__') {
    await handleError();
    return;
  }

  await randomRecord(records);
});

async function emptyRecords(showText = true) {
  const coffin = await createEmptyCoffin();

  controls.enabled = false;
  noRecords.style.pointerEvents = 'all';

  await anime({
    targets: light,
    intensity: 3,
    easing: 'easeOutSine',
    duration: 700,
    delay: 500,
  }).finished;
  await anime({
    targets: coffin.rotation,
    x: Math.PI / 2,
    easing: 'spring',
    duration: 300,
    delay: 700,
  }).finished;

  if (showText) {
    await anime({
      targets: noRecords,
      opacity: 1,
      easing: 'easeInSine',
      duration: 500,
      delay: 700,
    }).finished;
  }
}

/** @param {Record[]} records */
async function coffinHandler(records, startsAt = 0, showControls = true, faster = false) {
  let currentCoffin = createCoffin();
  let nextCoffin = createCoffin();
  nextCoffin.visible = false;

  const coffinImages = records.map(() => null);

  for (let i = 1; i < coffinImages.length; ++i) {
    if (!records[i].image) {
      coffinImages[i] = defaultImage;
      continue;
    }

    loadImage(`./images/${records[i].image}`).then(image => {
      coffinImages[i] = image;
    });
  }

  let current = startsAt;

  await coffinTransition(0);

  async function coffinTransition(direction, duration) {
    const offset = 20;
    const record = records[current];
    const image =
      coffinImages[current] ||
      (record.image ? await loadImage(`./images/${record.image}`) : defaultImage);

    if (direction == 0) {
      setImageFrame(currentCoffin, image);
      nextCoffin.position.x = offset;
      nextCoffin.rotation.x = 1.3;

      await anime({
        targets: light,
        intensity: 3,
        easing: 'easeOutSine',
        duration: faster ? 400 : 600,
        delay: 500,
      }).finished;
      await anime({
        targets: currentCoffin.rotation,
        x: 1.3,
        easing: faster ? 'spring(1, 90, 4, 0)' : 'spring',
        duration: 300,
        delay: 1000,
      }).finished;

      recordDisplayName.textContent = `${record.name} ${record.surname}`;
      recordDisplayDate.textContent = `U: ${record.dateOfBirth} Z: ${record.dateOfDeath}`;
      recordDisplayLocation.textContent = `${record.cemetery} - ${record.city} ul. ${record.street}`;

      await anime({
        targets: recordDisplay,
        opacity: 1,
        easing: 'easeInSine',
        duration: 300,
      }).finished;

      if (showControls) {
        await anime({
          targets: recordControls,
          opacity: 1,
          easing: 'easeInSine',
          duration: 300,
        }).finished;
      } else {
        await delay(300);
      }

      return;
    }

    setImageFrame(nextCoffin, image);
    nextCoffin.visible = true;
    nextCoffin.position.x = direction * offset;

    await Promise.all([
      anime({
        targets: nextCoffin.position,
        x: 0,
        easing: 'easeOutSine',
        duration,
      }).finished,
      anime({
        targets: currentCoffin.position,
        x: -direction * offset,
        easing: 'easeOutSine',
        duration,
      }).finished,
    ]);

    recordDisplayName.textContent = `${record.name} ${record.surname}`;
    recordDisplayDate.textContent = `U: ${record.dateOfBirth} Z: ${record.dateOfDeath}`;
    recordDisplayLocation.textContent = `${record.cemetery} - ${record.city} ul. ${record.street}`;

    [currentCoffin, nextCoffin] = [nextCoffin, currentCoffin];

    nextCoffin.visible = false;
  }

  let locked = 0;

  return {
    handlePreviousParallel: async duration => {
      if (locked < 0 || performance.now() - locked < duration - 150) return;

      current = current == 0 ? records.length - 1 : current - 1;

      locked = -1;
      await coffinTransition(-1, duration);
      locked = performance.now();
    },
    handleNextParallel: async duration => {
      if (locked < 0 || performance.now() - locked < duration - 150) return;

      current = current == records.length - 1 ? 0 : current + 1;

      locked = -1;
      await coffinTransition(1, duration);
      locked = performance.now();
    },

    handlePrevious: async duration => {
      current = current == 0 ? records.length - 1 : current - 1;

      await coffinTransition(-1, duration);
      await delay(100);
    },

    handleNext: async duration => {
      current = current == records.length - 1 ? 0 : current + 1;

      await coffinTransition(1, duration);
      await delay(100);
    },
  };
}

/** @param {Record[]} records */
async function displayRecords(records) {
  recordDisplay.style.pointerEvents = 'all';
  recordControls.style.pointerEvents = 'all';

  const { handlePreviousParallel, handleNextParallel } = await coffinHandler(records);

  previous.addEventListener('click', async () => handlePreviousParallel(600));

  next.addEventListener('click', async () => handleNextParallel(600));

  document.addEventListener('keydown', async event => {
    if (event.key == 'ArrowLeft') {
      await handlePreviousParallel(400);
    }

    if (event.key == 'ArrowRight') {
      await handleNextParallel(400);
    }
  });
}

/** @param {Record[]} records */
async function randomRecord(records) {
  recordDisplay.style.pointerEvents = 'all';
  recordControls.style.pointerEvents = 'all';

  const startsAt = Math.floor(Math.random() * records.length);

  const { handlePrevious, handleNext } = await coffinHandler(
    records,
    startsAt,
    false,
    true,
  );

  const range = 15 + Math.floor(Math.random() * 15);

  let last = 0;

  for (let i = 0; i < range; ++i) {
    const t = (i + 1) / range;

    if (Math.random() > 0.8 || (last == 1 && t > 0.8 && Math.random() > 0.1)) {
      await handlePrevious(300);
      last = 0;
    } else {
      await handleNext(300);
      last = 1;
    }
  }
}
