$.get({
    url: 'https://teamtreehouse.com/martynhorslen2',
    success: function(res) {
       let data = $.parseHTML(res);  //<----try with $.parseHTML().
       $(data).find('.total-points h1').each(function(){
           $("#score").append(this.innerText);
           console.log(this.innerText);
      });
 
    }
  });