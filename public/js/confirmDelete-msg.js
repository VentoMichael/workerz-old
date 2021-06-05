/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************!*\
  !*** ./resources/js/confirmDelete-msg.js ***!
  \*******************************************/
var deleteBtnsMsg = document.getElementsByClassName("button-delete-msg");

function confirmDelete(e) {
  return !0 === confirm("Toutes la discussion sera supprimée, êtes vous sûr ?") || (e.preventDefault(), !1);
}

for (var i = 0; i < deleteBtnsMsg.length; i++) {
  deleteBtnsMsg[i].addEventListener("click", confirmDelete);
}
/******/ })()
;