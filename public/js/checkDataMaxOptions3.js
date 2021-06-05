/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/checkDataMaxOptions3.js ***!
  \**********************************************/
for (var checksCat = document.querySelectorAll(".checkCat"), maxCat = 3, i = 0; i < checksCat.length; i++) {
  checksCat[i].onclick = selectiveCheckCat;
}

function selectiveCheckCat(e) {
  if (document.querySelectorAll(".checkCat:checked").length >= maxCat + 1) return alert("Uniquement 3 catégories sont possible."), !1;
}

for (var checks = document.querySelectorAll(".check"), max = 1, j = 0; j < checks.length; j++) {
  checks[j].onclick = selectiveCheck;
}

function selectiveCheck(e) {
  if (document.querySelectorAll(".check:checked").length >= max + 1) return alert("Uniquement 1 région est possible."), !1;
}

if (document.getElementById("checkDispo")) {
  var selectiveCheckDispo = function selectiveCheckDispo(e) {
    if (document.querySelectorAll(".checkDispo:checked").length >= maxDispo + 1) return alert("Uniquement 1 mois est possible."), !1;
  };

  for (var checksDispo = document.querySelectorAll(".checkDispo"), maxDispo = 1, k = 0; k < checksDispo.length; k++) {
    checksDispo[k].onclick = selectiveCheckDispo;
  }
}
/******/ })()
;