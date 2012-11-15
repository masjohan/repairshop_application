// require jpopover
$(function(){
    $('.menu').each(function(){
        var veryRight = ($(this).parent("li").index() === 0);
        $(this).next('.sub-menu').popover({
            'containerCss' : {
                "width"		: 170
            },
            'position' : {
                "of" 		: 'trigger',
                "my" 		: veryRight ? 'right top' : 'left top',
                "at" 		: veryRight ? 'right bottom' : 'left bottom',
                "offset" 	: '0 0',
                "collision"	: 'fit fit'
            },
            'trigger' : {
                "hover" : this
            }
        });
    });
});