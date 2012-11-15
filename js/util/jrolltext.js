// require function | jquery
/**
 * Use widget.scroll_text to make html makeup
 * $('#forumnotice_list').rolltext();
 */
(function( $, undefined ) {

	$.fn.rolltext = function(){
	   	return this.each(function(){
            var roll = function() {
                if (isRolling) {
                    jList.animate({scrollTop: 16 * i}, 'slow', 'swing', function(){
                        i++;
                        i %= n;
                        if (i == 0) {
                            jList.scrollTop(0);
                        }
                        roll.later(Math.random()*1000);
                    });
                } else {
                    roll();
                }
            }.slow(2000),

            isRolling = true,

            jList = $(this)
                    .bind('mouseenter',function(){
                        isRolling = false;
                    })
                    .bind('mouseleave',function () {
                        isRolling = true;
                    }),
            i = 0, n;

            jList.append(jList.children(':first').clone());
            n = jList.children("li").length;
            roll();
        });
	};

})(jQuery);

