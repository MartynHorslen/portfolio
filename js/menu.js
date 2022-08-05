$('nav > a').on("click", () => {
    if ($('header nav ul').css("display") === "none"){
        $('header nav ul').slideDown(600).css("display", "flex");
    } else {
        $('header nav ul').slideUp(600);
    }
});
$( window ).resize(() => {
    if (window.innerWidth >= 768){
        $('header nav ul').slideDown(600).css("display", "flex");
    } else {
        $('header nav ul').hide();
    }
});
$(document).ready(()=>{
    if (window.innerWidth < 768){
        $("nav ul").delay(1200).slideUp();
    }
})

function slideUp() {
    if (window.innerWidth < 768){
        $("nav ul").delay(1200).slideUp();
    }
}