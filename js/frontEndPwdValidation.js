/**
 * Source: https://www.w3schools.com/howto/howto_js_password_validation.asp
 *
 * JS live password checking
 */

//HTML Elements
let champMdp = document.getElementById("pwd");
let minuscule = document.getElementById("lowercase");
let majuscule = document.getElementById("uppercase");
let chiffre = document.getElementById("number");
let longueurMin = document.getElementById("length");

//Regex checks
const LETTRE_MINUSCULE = /[a-z]/g;
const LETTRE_MAJUSCULE = /[A-Z]/g;
const CHIFFRE = /[0-9]/g;
const LONGUEUR_MIN = 8;

champMdp.onfocus = function () {
  document.getElementById("pwdRules").style.display = "block";
};

champMdp.onblur = function () {
  document.getElementById("pwdRules").style.display = "none";
};

champMdp.onkeyup = function () {
  if (champMdp.value.match(LETTRE_MINUSCULE)) {
    minuscule.classList.remove("invalid");
    minuscule.classList.add("valid");
  } else {
    minuscule.classList.remove("valid");
    minuscule.classList.add("invalid");
  }

  if (champMdp.value.match(LETTRE_MAJUSCULE)) {
    majuscule.classList.remove("invalid");
    majuscule.classList.add("valid");
  } else {
    majuscule.classList.remove("valid");
    majuscule.classList.add("invalid");
  }

  if (champMdp.value.match(CHIFFRE)) {
    chiffre.classList.remove("invalid");
    chiffre.classList.add("valid");
  } else {
    chiffre.classList.remove("valid");
    chiffre.classList.add("invalid");
  }

  if (champMdp.value.length >= LONGUEUR_MIN) {
    longueurMin.classList.remove("invalid");
    longueurMin.classList.add("valid");
  } else {
    longueurMin.classList.remove("valid");
    longueurMin.classList.add("invalid");
  }
};
