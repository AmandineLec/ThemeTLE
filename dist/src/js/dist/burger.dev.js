"use strict";

var burgerMenu = document.getElementById('burger-menu');
var overlay = document.getElementById('menu');
var button = document.getElementById('bouton');
burgerMenu.addEventListener('click', function () {
  this.classList.toggle("close");
  overlay.classList.toggle("overlay");
  button.classList.toggle("hidden");
});