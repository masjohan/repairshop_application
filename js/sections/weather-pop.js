// require jpopover
$(function(){
    $('.today-weather .weather-desc').popover({
		'containerCss' : {
			"width"		: 271         	// exp: "200px"
		},
		'position' : {
			"of" 		: 'trigger',
			"my" 		: 'left top',
			"at" 		: 'left bottom',
			"offset" 	: '0 0',
			"collision"	: 'fit fit'
		},
       	'trigger' : {
       		"hover" : '.today-weather .weather-short'
       	}
	});
});

