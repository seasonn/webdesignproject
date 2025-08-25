const buttonTop = document.getElementById("backToTop");
window.onscroll = function () {
    showBackToTopButton();
    scrollDownHideNavbar();
};

function showBackToTopButton() {
    if (
        document.documentElement.scrollTop > 20
    ) {
        buttonTop.style.display = "block";
    } else {
        buttonTop.style.display = "none";
    }
}

buttonTop.addEventListener("click", backToTop);
function backToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

let prevScrollpos = window.pageYOffset;
function scrollDownHideNavbar() {
  let currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos || document.documentElement.scrollTop < 100) {
    document.querySelector("nav").style.top = "0";
  } else {
    document.querySelector("nav").style.top = "-180px";
  }
  prevScrollpos = currentScrollPos;
}