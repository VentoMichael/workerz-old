/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/successMsg.js ***!
  \************************************/
var e = document.getElementById("successMsg");

if (e) {
  setTimeout(function () {
    e.style.transition = ".5s", e.style.transform = "scale(0)";
  }, 1e4);
  var t = document.getElementById("crossHide");
  t.addEventListener("click", function () {
    t.parentNode.style.transform = "scale(0)", t.parentNode.style.transition = ".5s";
  });
}
/******/ })()
;