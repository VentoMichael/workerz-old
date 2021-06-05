/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/confirmDelete.js ***!
  \***************************************/
function confirmDelete(e) {
  return !0 === confirm("Toutes les données seront supprimé, êtes vous sûr ?") || (e.preventDefault(), !1);
}

document.getElementById("deleteButton").addEventListener("click", confirmDelete);
/******/ })()
;