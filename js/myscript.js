 /*$(function() {  // FOr the transtiton affects
        $('a[href=#footer]').click(function() {
          if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
              || location.hostname == this.hostname) {

            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
              $('html,body').animate({
                scrollTop: target.offset().top
              }, 1000);
              return false;
            }
          }
        });
      });*/
    
    
/*var onre = function(){
    var changes=new Array;
    changes[0]='imgmain';
    var ww = window.innerWidth;
    var wh = window.innerHeight;
    for(var i=0;i<1;i++)
    {
        var w = document.getElementById(changes[i]).offsetWidth;
        var h = document.getElementById(changes[i]).offsetHeight;
        var p = (Math.floor((ww/wh)*100)/100<1)?(ww/w):(wh/h);
        p*=0.25;
        var nw = Math.round(w * p);
        var nh =  Math.round(h * p);
        document.getElementById(changes[i]).width = nw;
        document.getElementById(changes[i]).height = nh;
    }
    document.getElementById("imgmain").style.position = "absolute";
    document.getElementById("imgmain").style.bottom = document.getElementById("coming-soon").height/2+"px" ;
    document.getElementById("imgmain").style.left=(ww/2-nw/2.2)+"px";
    if(ww<550)
        ww=550;
    document.getElementById("vert-text").style.fontSize= (80*ww)/1366+"px";
}
window.onresize = onre;
window.onload = onre;*/


