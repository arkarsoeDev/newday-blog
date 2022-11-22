import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

let testModalToggle = document.querySelector('#testModalToggle');
let testModal = document.querySelector('#testModal');
let testModalBackdrop = document.querySelector("#testModalBackdrop");
let testModalClose = document.querySelector('#testModalClose');

if (testModalToggle) {
   testModalToggle.addEventListener('click', function () {
      testModal.classList.toggle('hidden')
   })
}

if (testModalBackdrop) {
   testModalBackdrop.addEventListener("click", function () {
        testModal.classList.toggle('hidden')
    });
}

if (testModalClose) {
   testModalClose.addEventListener('click', function () {
      testModal.classList.toggle('hidden')      
   })
}