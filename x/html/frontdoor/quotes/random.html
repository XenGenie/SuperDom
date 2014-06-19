<style>
.imgMiddle {
	position	: absolute;
	display		: none;
	left		: 0;
	top			: 0;
	border		: 0px;
}
</style>
<script type="text/javascript" src="/bin/js/jq/jquery-latest.pack.js"></script>
<script type="text/javascript" src="/bin/js/jq/ui.js"></script>
<script type="text/javascript" src="/bin/js/jq/jquery.ui.stars.min.js"></script>
{foreach from=$quote item=Q}
<script>
$(document).ready(function(){
	runAni(0);
});
	var v = {
		w	: function() {
			return Math.floor(window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth);
		},
		h	: function() {
			return Math.floor(window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight);
		}
	};

	 
	$('#quote').css({
		width	: v.h()*.70 + 'px',
		height	: v.h()*.50 + 'px',
		left	: v.w()*.15,
		bottom	: v.h()*.25 + 'px'
	}); 


	$('.imgMiddle').css({
		width	: v.h()*.70 + 'px',
		height	: v.h()*.50 + 'px',
		left	: v.w()*.15,
		bottom	: v.h()*.25 + 'px'
	}); 
	
	  
	
	function imgLoad(el){
		$(el).animate({ 
			width: v.w(), 
			height: v.h()*.90, 
			left: '0%', 
			top: '5%' 
		},1750,function(){
			$('#rating').fadeIn(750);
			setTimeout(function(){
				reload(el)
			},7500);
		});
	}
	function reload(el,fade){
		$().stop;
		function go(){  
			window.location = window.location; 
		}
		if(!fade){
			var left	=	Math.floor(Math.random()*125)+'%';
			var top		=	Math.floor(Math.random()*90)+'%';
			
			$(el).animate({ 
				opacity	: 0,
				top		: top,
				left	: left,
				width	: 0,
				height	: 0
			},6000,go);

			$('#rating').fadeOut(3000);
		}else{
			$(el).animate({ 
				width: v.w()*2, 
				height: v.h()*2, 
				left: '-50%', 
				top: '-50%',  
				opacity: 0 
			},550,go);
			$('#rating').fadeOut(500);
		}

		$('#quote').animate({ 
			opacity	: 0,
			top		: 0,
			left	: 0,
			width	: 0,
			height	: 0,
			fontSize: '0px'
		},6000,go);
		
	}


	
	function runAni(i){
		i = (i) ? i : 0;
		var thot1 = $('#thot-bubble1');
		var thot2 = $('#thot-bubble2');

		thot1.attr({
			src : bubbles[i++]
		});

		var time = 250 * i;
		if(i == 4){
			time = time + 1000;

		}

		
		
		thot1.animate({ 
			width	: v.w(), 
			height	: v.h()*.90,	
			opacity	: 1,  
			left	: '0%', 
			top		: '5%' 
		},time,function(){
			
			
			thot2.animate({
				opacity:0
			},100,function(){
				if(i<=4){
					thot2.attr({
						src : bubbles[i++]
					});
					thot2.animate({ 
						width	: v.w(), 
						height	: v.h()*.90,
						opacity	: 1,
						left	: '0%', 
						top		: '5%'
					},time,function(){
						thot1.animate({ 
							opacity	: 0,   
						},100,function(){
							runAni(i);
						});		
					});
					
				}else{
					$('#quote').fadeIn();
					$('#rating').fadeIn();
					setTimeout(function(){
						reload('#thot-bubble1')
					},6000);
				}
			});
			
		});

		
		
		
	}

	var loaded = 0;
	function runImg(){
		// counter
	    var i = 0;

		// create object
	    imageObj 	= new Image();
		loaded 		= 0;
		imageObj.onLoad = function(){
			loaded++;

			 
					
		};
		
		// set image list
	    bubbles = new Array();
	    for( i=0; i<5; i++ ){
			var src = null; 
			if(i == 4){
				src = "{$phpThumb}src=http://bin.xtiv.net/images/bubbles/gordon_bubble5.png&fltr[]=wmt||20|T|000000|COMICBD.TTF|100|165&f=png";
 
				
				
			}else{
				src = 'http://bin.xtiv.net/images/bubbles/gordon_bubble'+(1+i)+'.png';
			}
			bubbles[i] 		= src;
			imageObj.src	= src;
		}	
	}
	runImg();
</script>
	
	<img 
		class	= "imgMiddle"
		id		= "thot-bubble2"
	/>
	<img 
		onClick	= "reload(this,true);"
		id		= "thot-bubble1"
		src		= "{$phpThumb}src=http://bin.xtiv.net/images/bubbles/gordon_bubble5.png&fltr[]=wmt||20|C|000000|tahoma.ttf|100&f=png" 
	/>	
	
	
	<form id='rating' style="display: none; position: absolute; bottom: 3%; left: 30%; width: 50%; ">
	    <span id="stars-cap"></span>
	    <div id="stars-wrapper2">
	        <select name="selrate">
	            <option value="1">Very poor</option>
	            <option value="2">Not that bad</option>
	            <option value="3">Average</option>
	            <option value="4">Good</option>
	            <option value="5">Perfect</option>
	        </select>
	    </div>
	</form>
	
	<div class="imgMiddle" id="quote" style="z-index: 10; position: absolute; text-align: center">
		{$Q.quote}
	</div>
	
	<script>
	$("#stars-wrapper2").stars({
	    inputType: "select",
	    callback	: function(ui, type, value, event){
			// Send Vote
			window.location = '/{$toBackDoor}/{$Xtra}/vote/{$Q.id}/'+value
	    }
	});
	
	</script>
	
{/foreach}
<link rel="stylesheet" href="http://bin.xtiv.net/js/jq/jquery.ui.stars.min.css"/>