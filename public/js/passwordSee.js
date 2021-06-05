/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/passwordSee.js ***!
  \*************************************/
document.getElementById("container-checkpass").style.display = "inherit", document.getElementById("checkPass").addEventListener("click", function () {
  var e = document.getElementById("password"),
      t = document.getElementById("password-confirm");
  t && ("password" === t.type ? t.type = "text" : t.type = "password"), "password" === e.type ? e.type = "text" : e.type = "password";
});
/******/ })()
;