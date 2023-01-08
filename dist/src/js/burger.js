let burgerMenu = document.getElementById('burger-menu');
let overlay = document.getElementById('menu');
let button = document.getElementById('bouton')
burgerMenu.addEventListener('click',function(){
  this.classList.toggle("close");
  overlay.classList.toggle("overlay");
  button.classList.toggle("hidden");
});