$.get({
    url: 'https://teamtreehouse.com/martynhorslen2',
    success: function(res) {
       let data = $.parseHTML(res);  //<----try with $.parseHTML().
       $(data).find('.total-points h1').each(function(){
           $("#score").empty().append(this.innerText);
           console.log(this.innerText);
      });
      
    },
    // Used just to test in case script couldn't fetch score.
    // error: function() {
    //   alert("there was an error.");
    // }
  });