var $j = jQuery.noConflict();
//based on the tutorial located here http://andreaslagerkvist.com/archives/2011/06/24/how-to-create-a-scrolling-twitter-feed-using-jquery/
var Twitter = {
    init: function () {
        // Pass in the username you want to display feeds for
		var twitname=document.getElementById("twitname").innerHTML;
		
		this.fancyMarquee();
    }, 
   // Replaces the marquee-element with a fancy one
    fancyMarquee: function () {
        // Replace the marquee and do some fancy stuff (taken from remy sharp's website)
        $j('#twitter marquee').marquee('pointer')
            .mouseover(function () {
                $j(this).trigger('stop');
            })
            .mouseout(function () {
                $j(this).trigger('start');
            })
            .mousemove(function (event) {
                if ($j(this).data('drag') == true) {
                    this.scrollLeft = $j(this).data('scrollX') + ($j(this).data('x') - event.clientX);
                }
            })
            .mousedown(function (event) {
                $j(this).data('drag', true).data('x', event.clientX).data('scrollX', this.scrollLeft);
            })
            .mouseup(function () {
                $j(this).data('drag', false);
            });
    }, 
};

Twitter.init();
