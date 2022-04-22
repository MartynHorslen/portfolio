var i = 0;
var txt = $('#type-effect').text(); /* The text */
var speed = 100; /* The speed/duration of the effect in milliseconds */

function typeWriter() {
  if (i < txt.length) {
    document.getElementById("type-effect").innerHTML += txt.charAt(i);
    i++;
    setTimeout(typeWriter, speed);
  }
  return;
}
$(document).ready(()=>{
    $('#type-effect').text("");
    typeWriter();
});
$('figcaption').on('mouseenter click', () => {
    $('#type-effect').text("");
    i=0;
    typeWriter();
});

