$.get("https://teamtreehouse.com/profiles/martynhorslen2", function(res) {
    let data = $.parseHTML(res);  //<----try with $.parseHTML().
    $(data).find('.total-points h1').each(function(){
      $("#score").empty().append(this.innerText);
    })
})
.fail(function(){
    $("#score").empty().append("16200"); // Last manually recorded score.
});