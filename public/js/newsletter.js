/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/newsletter.js ***!
  \************************************/
var closeModalButtons = document.querySelectorAll("[data-close-button]"),
    hidesForNewsletter = document.querySelectorAll(".hideForNewsletter"),
    newsletter = document.getElementById("modal");


    function openModal(e) {
  null != e && (e.classList.add("active"), hidesForNewsletter.forEach(function (e) {
    e.style.opacity = "0.3";
  }));
}

function closeModal(e) {
  null != e && (e.classList.remove("active"),newsletter.style.display="none", hidesForNewsletter.forEach(function (e) {
    e.style.opacity = "1";
  }));
}

window.addEventListener("load", function () {
  openModal(document.getElementById("modal"));
}), closeModalButtons.forEach(function (e) {
  e.addEventListener("click", function () {
    closeModal(e.closest(".modal"));
  });
});

/******/ })()
;
