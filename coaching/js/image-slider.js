$(function() {
 
	var dur = 1000;
	var pDur = 3000;
 
	$('.carousel').carouFredSel({
		items: {
			visible: 1,
			width: 700,
			height: 420
		},
		scroll: {
			fx: 'fade',
			easing: 'linear',
			duration: dur,
			timeoutDuration: pDur,
			onBefore: function( data ) {
				animate( data.items.visible, pDur + ( dur * 3 ) );
			},
			onAfter: function( data ) {
				data.items.old.find( 'img' ).stop().css({
					width: 700,
					height: 420,
					marginTop: 0,
					marginLeft: 0
				});
			}
		},
		onCreate: function( data ) {
			animate( data.items, pDur + ( dur *2 ) );
		}
	});
	
	function animate( item, dur ) {
		var obj = {
			width: 900,
			height: 540
		};
		switch( Math.ceil( Math.random() * 2 ) ) {
			case 1:
				obj.marginTop = 0;
				break;
			case 2:
				obj.marginTop = -120
				break;
		}
		switch( Math.ceil( Math.random() * 2 ) ) {
			case 1:
				obj.marginLeft = 0;
				break;
			case 2:
				obj.marginLeft = -200
				break;
		}
		item.find( 'img' ).animate(obj, dur, 'linear' );
	}
 
});