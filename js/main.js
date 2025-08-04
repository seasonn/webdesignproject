const buttonTop = document.getElementById("backToTop");
window.onscroll = function () {
    scrollFunction();
};

function scrollFunction() {
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