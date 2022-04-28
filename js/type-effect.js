var i = 0;
var txt = $('#type-effect').text(); /* The text */
var speed = 100; /* The speed/duration of the effect in milliseconds */
let running = false;

function typeWriter() {
  running = true;
  if (i < txt.length) {
    document.getElementById("type-effect").innerHTML += txt.charAt(i);
    i++;
    setTimeout(typeWriter, speed);
  } else {
    running = false;
  }
  return;
}
$(document).ready(()=>{
    $('#type-effect').text("");
    typeWriter();
});
$('figcaption').on('mouseenter click', () => {
    if (running === false){
      $('#type-effect').text("");
      i=0;
      typeWriter();
    }
});

