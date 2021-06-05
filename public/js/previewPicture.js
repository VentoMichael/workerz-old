/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./resources/js/previewPicture.js ***!
  \****************************************/
var a = document.getElementById("picture"),
    t = document.getElementById("output");
a.addEventListener("change", function (e) {
  t.style.display = "block", t.src = URL.createObjectURL(e.target.files[0]), t.onload = function () {
    URL.revokeObjectURL(t.src);
  };
});
/******/ })()
;