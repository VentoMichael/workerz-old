/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/passwordCheck.js ***!
  \***************************************/
document.getElementById("password").addEventListener("keyup", function () {
  var e = new RegExp("(?=.*?[0-9])", "g"),
      t = new RegExp("(?=.*?[A-Z])", "g"),
      s = new RegExp("(?=.{8,}).*", "g"),
      l = document.getElementById("cara"),
      d = document.querySelector("#cara p"),
      i = document.getElementById("maj"),
      n = document.querySelector("#maj p"),
      o = document.getElementById("symbole"),
      r = document.querySelector("#symbole p"),
      a = document.getElementById("password");
  s.test(a.value) ? (d.classList.add("good"), d.style.transition = ".5s", d.style.alignItems = "center", l.style.display = "flex", document.querySelector(".list-password-required li:nth-child(1) img").style.display = "inline") : (d.classList.remove("good"), document.querySelector(".list-password-required li:nth-child(1) img").style.display = "none"), t.test(a.value) ? (n.classList.add("good"), n.style.transition = ".5s", n.style.alignItems = "center", i.style.display = "flex", document.querySelector(".list-password-required li:nth-child(2) img").style.display = "inline") : (n.classList.remove("good"), document.querySelector(".list-password-required li:nth-child(2) img").style.display = "none"), e.test(a.value) ? (r.classList.add("good"), r.style.transition = ".5s", r.style.alignItems = "center", o.style.display = "flex", document.querySelector(".list-password-required li:nth-child(3) img").style.display = "inline") : (r.classList.remove("good"), document.querySelector(".list-password-required li:nth-child(3) img").style.display = "none");
});
/******/ })()
;