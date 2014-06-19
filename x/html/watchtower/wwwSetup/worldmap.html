{if isset($tutor) && $tutor == true}
	<!-- Map auto loaded due to no icons. RUN TUTOR? -->
	<script>
		// Basically want to activate the maps tutorial and walk them through superdom.
		$('#www-map').css({
			bottom : -70,
			opacity: 0
		});

		// Don't let them access the Axis right now... infinite loop bug...
		$('#key-axis').addClass('tutor').css({
			bottom : -70,
			opacity: 0
		});

		alert('Im the tutor');
	</script>
{/if}


<div class="bubble" width="800"  height="500" valign="center" align="center" >
	<a href="#/{$toBackDoor}/">
		<img src="{$thumb}src=/bin/images/logos/sdx.png&h=45" id="map-logo"/>
	<a/>
  <div class="bubble-arrow-border"></div>
  <div class="bubble-arrow"></div>
</div>
 
<div id="nav-map" valign="center" align="center" style="position: relative;" >
	{foreach $admin_menu as $key => $item}
		{if $key} 
			<div align="center" id="map-{$key}" area="{$key}" style="overflow: hidden"> 
				<img src="{$ICON.A}{$key}.png"  id="area-{$key}" height="128" width="128" >
				{foreach $xtras as $x => $xtra}
					{if $xtra.icon && $key == $xtra.see}
					<img src="{$ICON.48}{$xtra.icon}" desc="{$xtra.desc}" link="{$xtra.link}" file="{$x}" icon="{$xtra.icon}" title="{$xtra.name}"> 
					{/if}
				{/foreach}
				<p>{$item.area|ucfirst}</p>
				<span class="transparent-black-25" style="display: none; height: 48px; padding : 5px;">
					<img align="absmiddle" style="margin: 5px;" />
					<h1 style="float: left; margin-left: 60px;"></h1>
					<h3 style=" "></h3>
				</span> 
			</div>  
		{/if}
	{/foreach}
</div>
<img src="{$ICON.48}Map.png" style="position: absolute; display: none; cursor: pointer" onclick="x4.backToMap();" class="back-to-map spectMe spinMe"> 
<img src="{$ICON.32}curtain.png" style="position: absolute; display: none; cursor: pointer; top: -32px; right: -32px;" onclick="x4.windowfy();" class="windowfy-me spectMe spinMe"> 
	
<div id="sign-container" >
	
	<div class="sign" > 
		<div class="front"> 
			
			<span id="www_map_site_logo" style="padding: 10px"> 
				{if $site_logo}
					<img align="absmiddle" src="{$thumb}h=48&src={$site_logo}"/><br/>
				{/if}
			</span><br/>
			{$HTTP_HOST}<br/>
			<span style="font-size:  medium">
				<span id="www_map_site_name">{$site_name}</span><br/>
				<span id="www_map_site_moto">{$site_moto}</span> 
			</span><br/>  
			<span style="font-size:  small">
				<span id="www_map_site_copyright"> 
					{if isset($site_copyright)}{$site_copyright}{else}{$SDX_INSTALL}{/if}
				</span>	<br/>	
				Populace : {$users}  |  
				Visits   : {$visits}  |  
				Hits  : <span id="counter">{$hits}</span> 
			</span> 
		</div>
		<div class="back"  id="domain-info">   
		<div class='poleleft'></div> 
		<div class='poleright'></div>
		</div>
	 
	</div> 
	<div class="sign-bubble-arrow-border" onmouseover="$('#sign-container').animate({ top : -$('#sign-container').height()*1.5 }).fadeOut()"></div>
    <div class="sign-bubble-arrow" onmouseover="$('#sign-container').animate({ top : -$('#sign-container').height()*1.5  }).fadeOut()"></div>
</div>
 
	<script type="text/javascript">

		Ext.require([
			'Ext.form.field.File',
			'Ext.form.field.Number',
			'Ext.form.Panel',
			'Ext.window.MessageBox'
		]);

	Ext.create('Ext.form.Panel', {
		 api		: {
			load	: $$.xWwwSetup.loadSettings,
			submit	: $$.xWwwSetup.saveSettings
		},
		renderTo    : 'domain-info',
		layout 		: 'form',
		frame       : false, 
		padding : 5,
		height      : '100%',
		unstyled	: true ,
        waitMsgTarget: true,
        listeners : {
        	submit : function  () {
        		var form = this.up('form').getForm();
                if(form.isValid()){
                    form.submit({
                        // url: 'file-upload.php',
                        waitMsg: 'Updating...',
                        success: function(fp, o) {


                        	var c = o.result.data.config; 
                        	$('#www_map_site_name').html(c.site_name);
                        	$('#www_map_site_moto').html(c.site_moto);
                        	if(typeof c.site_logo != 'undefined'){

	                        	$('#www_map_site_logo img').attr({ src : '{$thumb}h=50&src='+c.site_logo+'#time='+new Date().getTime() 	
	                        	});	
                        	}
                        	$('#www_map_site_copyright').html(c.site_copyright);
                        	
                        	$('.sign').removeClass('flip');

                            //msg('Success', 'Processed file "' + o.result + '" on the server');
                        },
                        failure: function() {
                            Ext.Msg.alert("Error", Ext.JSON.decode(this.response.responseText).message);
                        }
                    });
                };
        	}
        }, 
		unstyled	: true ,
        defaults: {	
			anchor     : '95%',
			allowBlank : false,
			msgTarget  : 'side',
			labelWidth : 70,
			labelAlign : 'top',
        },
		items : [{
			xtype      : 'textfield',
			fieldLabel : 'Site Name',
			name 		: 'config[site_name]',
			value		: '{$CONFIG.site_name|addslashes}'
        }, {
			xtype      : 'textfield',
			fieldLabel : 'Site Moto',
			name 		: 'config[site_moto]',
			value		: '{$CONFIG.site_moto|addslashes}'
        },  {
			xtype      : 'textfield',
			fieldLabel : 'Copyright',
			name 		: 'config[site_copyright]',
			value		: '{$CONFIG.site_copyright|addslashes}'
        }],
        tbarConfig : {
        	unstyled : true
        },
        dockedItems: [{
			xtype     : 'toolbar',
			dock      : 'bottom',
			unstyled  : true,
			style : 'background: transparent',
		    items: [{
				text    : 'Reset',
				iconCls : 'x-icon-16x16-arrow_rotate_clockwise',	
				handler : function() {  
	                this.up('form').getForm().reset(); 
	            }	
	        },'->',{
				xtype         : 'filefield', 
				allowBlank    : true,
				buttonOnly    : true,
				buttonText    : 'Upload Logo',
				emptyText     : 'Choose A File to Upload Logo', 
				fieldLabel    : 'Site Logo',
				hideLabel     : true,
				name          : 'config[site_logo]',
				id            : 'site-logo-upload', 
				selectOnFocus : true,
				buttonConfig  : {
	                iconCls: 'x-icon-16x16-upload'
	            },
	            listeners : {
	            	change : function  () {
	            		Ext.getCmp('www_settings_save').el.el.dom.click();
	            	}
	            }
		    },'->',{
	            text: 'Save',
	            id  : 'www_settings_save',
	            iconCls : 'x-icon-16x16-accept',
	            handler: function(){
	                var form = this.up('form').getForm();
	                if(form.isValid()){
	                    form.submit({
	                        // url: 'file-upload.php',
	                        waitMsg: 'Updating...',
	                        success: function(fp, o) {


	                        	var c = o.result.data.config; 
	                        	$('#www_map_site_name').html(c.site_name);
	                        	$('#www_map_site_moto').html(c.site_moto);
	                        	if(typeof c.site_logo != 'undefined'){

		                        	$('#www_map_site_logo img').attr({ src : '{$thumb}h=50&src='+c.site_logo+'#time='+new Date().getTime() 	
		                        	});	
	                        	}
	                        	$('#www_map_site_copyright').html(c.site_copyright);
	                        	
	                        	$('.sign').removeClass('flip');

	                            //msg('Success', 'Processed file "' + o.result + '" on the server');
	                        },
	                        failure: function() {
	                            Ext.Msg.alert("Error", Ext.JSON.decode(this.response.responseText).message);
	                        }
	                    });
	                }
	            }
	        }]
		}]
    });

		// setInterval(function() {
		// 	$.get('/x/xtra/xAnalytics/counter',function(data){
		// 		$('#counter').html(data);
		// 	});  
		// },10000);
 
		$('.sign').click(function(e){
			$('.sign').addClass('flip');
			//e.preventDefault(); !!! <- Careful with This!
		});
		$('.edit-submit').click(function(e){ 
			$('.sign').removeClass('flip');

			// // just for effect we'll update the content
			// e.preventDefault();
		});





		x4.centerUs = function(){
			$('#nav-map').center();
			$('.bubble').center();
			$('.bubble').css({ bottom : -10 });
			// $('#sign-container').center();
			

			// $('#sign-container').css({ top:50 });

			$("#nav-map img:first-child").center();	

			if(null !== x4.activeArea){
				if(x4.activeArea.css('position') == 'absolute'){
					
					x4.mapDirections = ['t','r','l','b','tr','bl','br','tl']; 

					x4.activeArea.children('img:first-child').center($('#nav-map'));	
					var xtras = x4.activeArea.children('img:not(:first-child)');
					//xtras.fadeIn(2000);

					xtras.each(function (argument) {
						var dir = x4.mapDirections[$(this).index()-1]; 
						$(this).center($('#nav-map'),dir,0,88);
					}); 	

					// $('#nav-map p').center('nav-map');

				}else{
					// $('#nav-map p').center('nav-map');
				}
			}

			$('.back-to-map').css({
				left : $('#nav-map').offset().left + ($('#nav-map').width/2) - ($('.back-to-map')/2)   ,
				top  : $('#nav-map').offset().top - 48 - 5 - $('.ux-taskbar').height()
			});


			$('.back-to-map').center(true,'t');

			$('.windowfy-me').css({
				left : $('#nav-map').offset().left + $('#nav-map').width() - 37,
				top  : $('#nav-map').offset().top - 32- 5 - $('.ux-taskbar').height()
			});
			
			// $('.windowfy-me').center('navmap','tl');
			// $('.windowfy-me').css({
			// 	left : $('#nav-map').offset().left    ,
			// 	top  : $('#nav-map').offset().top - 32- 5
			// });

			x4.log('Centered');
		};

		$(window).resize(function() {
		 	x4.waitForFinalEvent(x4.centerUs,200,'resizeAreaIcons');  
		});

		

		$(document).ready(function(){ 

			x4.centerUs();

			$('#sign-container').center(true,'t');

			$('#sign-container').css({ top: -$('#sign-container').height() }).animate({
				top : 0
			})
 

			$('.sign').css({ bottom : 0 });
			var nav_map = $('#nav-map');

			$('#sign-container').center(true,'br');

			var nav_map = $('#nav-map');
			
			var speed = 400;

			x4.backToMap = function (argument) {
				// body...
				var area = x4.activeArea.attr('id').replace('map-','');
				$('#area-'+area).click();
			};
		
			// All Icons of Area 
			$("#nav-map img:not(:first-child)").click(function(t){  
				// if we have a link attribute
				if(	this.getAttribute('link') ){
					var area  = $(this).siblings(':first-child');
					var areaC = area.clone();
					var icon  = $(this);
					var iconC = $(this).clone();

    				// remove these if active...
    				$('.back-to-map').fadeOut();
    				$('.windowfy-me').fadeIn();

    				$('#map-logo').fadeIn();
    				$('#active-icon').fadeOut(function (argument) { 
    					$(this).remove()
    				});
    				$('#active-area-icon').fadeOut(function (argument) { 
    					$(this).remove()
    				});

    				// copy our icons 
    				areaC.appendTo('#zyx-content').attr({ id:'active-area-icon' }).css({
						left     : area.offset().left  ,
						top      : area.offset().top  ,
						zIndex   : 999999,
						position : 'absolute',
						cursor   : 'pointer'
    				}).animate({
						left    : area.offsetParent().offset().left + 10 ,
						top     : area.offsetParent().offset().top - 64 - 5 - $('.ux-taskbar').height() ,
						opacity : 1,
						width   : 64,
						height  : 64
    				},speed*2.5,function (argument) {
    					// body...


						$(this).addClass('spectMe');
    					$(this).addClass('spinMe');

    					areaC.click(function(argument) {
    						 
    						$('#'+area.attr('id')).parent().css({ zIndex : 999 });
    						$('.back-to-map').slideDown();
    						$('.windowfy-me').fadeOut();

    						x4.activeArea.fadeOut(function(argument) { 
    							
    						}); 
    						 
    						areaC.animate({
								left     : area.offset().left  ,
								top      : area.offset().top,
								width : area.width(),
								height : area.height()
		    				},function (argument) {
		    					 
		    					// body... 
		    					$('#'+area.attr('id')).parent().click();
		    					//icon.remove();
		    					$('#overlay').fadeOut();
								$(this).remove();
		    					$('#active-icon').fadeOut(function (argument) { 
		    						$(this).remove();
		    						$('#overlay').remove();
			    				});  
		    				});

		    				iconC.animate({
								left     : icon.offset().left  ,
								top      : icon.offset().top
		    				});
    					})
    				});
	
					// Click to Create Axis Point
    				iconC.appendTo('#zyx-content').attr({ id:'active-icon' }).css({
						left     : icon.offset().left  ,
						top      : icon.offset().top  ,
						zIndex   : 9999,
						position : 'absolute'
    				}).animate({
						left : icon.offsetParent().offset().left + ($('#nav-map').width()/ 2)   - (iconC.width()/2)  ,
						top  : icon.offsetParent().offset().top-iconC.height() - 5 - $('.ux-taskbar').height()
    				},speed*2.5,function(argument) {
    					var click = this;

    					$(click).addClass('spectMe');
    					$(click).addClass('spinMe');

    					$(click).click(function(argument) {
    						// body...
    						$(click).fadeOut();
    						 Ext.Msg.prompt(
    						 		{$LANG.ADMIN.AXIS.ADD.TITLE}, 
    						 		'<center><img align="absmiddle" src="'+$(click).attr('src')+'" ></center><br/>'
    						 		+{$LANG.ADMIN.AXIS.ADD.MSG}+'<br/><br/>',
    						 	function(btn,text) {
	    							// body...
	    							if(btn == 'ok'){ 
    									$$.xWwwSetup.switchIcon(click.getAttribute('file'),text, function() {
    										$(click).fadeIn();
    										$('#key-axis').css({
												opacity : 1,
												bottom : 0
											}).removeClass('tutor');
    									});
	    							} 
	    						},null,null,$(click).attr('title')	
	    					); 
    					});
    				});



					location = "#/{$toBackDoor}/"+this.getAttribute('link');
				}

			}).css({
				cursor: 'pointer'
			});


			$( "#nav-map div img:not(:first-child)" ).css({
				display : 'none'
			});
			
			$( "#nav-map div img:first-child" ).css({
				display : 'block',
				cursor  : 'pointer'
			})

			$(".grassV,.waterV,.gravel").css({
				cursor: 'pointer'
			});

			var css = $('#nav-map div');

			// This is a visualization. 
			$(css[0]).addClass('gravel');
			$(css[3]).addClass('gravel');
			$(css[6]).addClass('gravel');

			$(css[1]).addClass('grass');
			$(css[4]).addClass('grass');
			$(css[7]).addClass('grass');

			$(css[2]).addClass('water');
			$(css[5]).addClass('water');
			$(css[8]).addClass('water');

			var box = $(".grass,.water,.gravel");


			// JS for Text Headers.

			$('#nav-map > div p').css({
				position        : 'absolute',
				width           : '100%',
				backgroundColor : 'rgba(0,0,0,.33)',
				display			: 'none',
				left            : 0,
				margin          : 0,
				bottom 			: 0,
				padding			: 5
			});

			// Hover over Info Data 

			$('#nav-map > div img:not(:first-child)').mouseenter(function() {
				// The icon should holds it own info...					
				heading = $(this).parent().children('span').css({
					position     : 'absolute',
					top          : 0,
					left         : 0,
					width        : '100%',
					height       : 58,
					borderRadius : '25 25 0 0 ',
					color        : 'white'
				}); 

				heading.children('img').attr({ 
					src : $(this).attr('src') 
				}).css({
					top  : 0,
					left : 10
				});

				HTML = this;

				heading.children('h1').html( this.getAttribute('title') )
				heading.children('h1').css({
					position : 'absolute',
					left     : -heading.children('h1').width(),
					opacity  : .9
				});
				heading.children('h1').animate({
					right   : heading.children('h1').parent().width() + heading.children('h1').width(),
					opacity : 0
				});


				heading.children('h3').html( this.getAttribute('desc')); 
				heading.slideDown('fast');

			});

			$('#nav-map > div img:not(:first-child)').mouseleave(function() {
				// The icon should holds iszt own info...					
				$(this).parent().children('span').slideUp('fast');

			});

			box.mouseenter(function () {
				$(this).children('p').fadeIn();

				$(this).siblings('div').children('p').each(function () {
					if($(this).css('display') != 'none')
						$(this).fadeOut(); 
				}); 
			});

			box.mouseleave(function () {
				
				// body...
			});

			// TEXT HEADERS END
			// box.hover(function(){
			// 	$('<div/>', {
			// 	    id: 'overlay',
			// 	    class  : 'overlay'
			// 	}).appendTo('#nav-map').fadeIn();
				
			// 	$(this).css({
			// 		zIndex : 101,
			// 	//	position : 'absolute'
			// 	}); 

			// 	$(this).css({
			// 		zIndex : 101,
			// 	//	position : 'absolute'
			// 	}); 

			// });

			// box.mouseout(function (argument) {
			// 	$('#overlay').remove();
			// 	// body...
			// });
			

			$("#nav-map img:first-child").click(function(argument) {
				
				var p = $(this).parent(), icon = this;
				if($(this).is(':animated') || p.is(':animated') ) 
					return;

				if(p.css('position') === 'absolute'){




					p.children('img:not(:first-child)').each(function(argument) {
						$(this).hide(); 
					});

					var cImg = $('#clone').children('img:first-child'); 

					$('#overlay').fadeOut();
					$('#map-logo').fadeIn();
    				$('.back-to-map').fadeOut();



    				$('#map-logo').animate({
						opacity : 1
					});
    				$(icon).animate({
						left : cImg.offset().left - cImg.offsetParent().offset().left,
						top  : cImg.offset().top - cImg.offsetParent().offset().top,
						opacity : 1
    				},500);

    				$(icon).removeClass('spectMe');
    					$(icon).removeClass('spinMe');

					p.removeClass('active-area').animate({
						top      : p.attr('oTop'),
						left     : p.attr('oLeft'),
						width  	 : p.attr('oWidth'),
						height   : p.attr('oHeight'),
						borderRadius: 0
					},500,function  (argument) {
						$('#clone').remove();
						$('#overlay').remove();

						p.css({
							position : 'relative',
							zIndex   : 0,
							top      : 0,
							left     : 0,
							width    : '33.33%',
							height   : '33.33%',
							cursor   : 'pointer'
						});

						x4.centerUs();

						$(icon).center().fadeIn();
					});
				}else{

				}

				


			});

			box.click(function (argument) { 
				// Prevents Breaking on mulitple clicks 
				
				if($(this).css('position') !== 'absolute'){ 

					$('#sign-container').animate({ top: -$('#sign-container').height()*1.75 }).fadeOut()

					var icon = $(this).children('img:first-child');

					var clone = icon.clone();
					clone.appendTo('#nav-map');
					clone.css({ 
						zIndex : 999999 
					}).center($('#nav-map'));
						
						//alert(clone.offset().left);

			// 		icon.css({
			// 			left : icon.offset().left - icon.offsetParent().offset().left-1,
						// top  : icon.offset().top - icon.offsetParent().offset().top-1
			// 		})

					icon.animate({
						left : clone.offset().left - clone.offsetParent().offset().left-2,
						top  : clone.offset().top - clone.offsetParent().offset().top-2,
						//opacity : .65
					},speed)
					clone.remove();
					$(icon).addClass('spectMe');
					$(icon).addClass('spinMe');

			// 		var oOff = $(this).offset();

			// 		// icon.css({ 
			// 		// 	position : 'relative'
			// 		// });

			// 		var newOff = $(this).offset();

    		// 	// 		icon.css({ 
						// 	// position : 'absolute',
						// 	// left     : oOff.left,
						// 	// top      : oOff.top 
    		// 	// 		});

				 
			// 		icon.animate({
						// top      : icon.attr('oTop'),
						// left     : icon.attr('oLeft')
			// 		},500,function(argument) {
			// 			// body...

			// 		})


					$('.back-to-map').fadeIn();
					$('#map-logo').animate({
						opacity : .1
					});


					var clone = $(this).clone().attr({ id : 'clone' });
					
					$('.overlay').remove();
					$('#overlay').remove()

					$('<div/>', {
					    id: 'overlay',
					    class  : 'overlay'
					}).css({
						borderRadius: 25
					}).appendTo('#nav-map').fadeIn();

					$(this).addClass('active-area').attr({
						oTop    : $(this).offset().top -  $(this).offsetParent().offset().top,
						oLeft   : $(this).offset().left -  $(this).offsetParent().offset().left,
						oWidth  : $(this).width(),
						oHeight : $(this).height()
					}).css({
						position : 'absolute',
						zIndex   : 9999, 
						border   : '0px solid black',
						top      : $(this).offset().top -  $(this).offsetParent().offset().top,
						left     : $(this).offset().left - $(this).offsetParent().offset().left,
						cursor   : 'default'
					}).animate({
						width  : '100%',
						height : '100%',
						borderRadius : 25,
						top    : 0,
						left   : 0, 
						borderSize : '3px'
						// right  : 0
					},speed,function(argument) {
						// body... 
						//icon.css({ position:'relative' });

						x4.activeArea = $(this);

						x4.mapDirections = ['t','r','l','b','tr','bl','br','tl']; 

						var xtras = x4.activeArea.children('img:not(:first-child)');
						xtras.fadeIn(500/2);

						xtras.each(function (argument) {
							var dir = x4.mapDirections[$(this).index()-1]; 
							$(this).center($('#nav-map'),dir,15);
						}); 

						
						x4.centerUs();
					});

					 

	    			 

					clone.insertAfter(this); 

					// After all that... send them to their destination.
					location = "#"+this.getAttribute('area');
				} 

				

			});  
		});
	</script>
</div>
<style>
	#sign-container{ 
		position : absolute;
		top      : 0;
		left     : 0;
		display  : block;
		width    : 400px;
		height   : 300px;
		font-family : Allerta;
	}

	.expose {
	    position:relative;
	}

	/*#overlay {
	    background:rgba(0,0,0,0.3);
	    display:none;
	    width:100%; height:100%;
	    position:absolute; top:0; left:0; z-index:99998;
	}*/

	 
	 #nav-map { 
		-webkit-box-shadow : 0px 0px 10px rgba(0,0,0,0.25);
		box-shadow         : 0px 0px 10px rgba(0,0,0,0.25); 	
		position           : absolute;
		overflow           : hidden;
		width              : 85%;
		min-width          : 70%;
		height             : 85%;
		margin             : auto auto;
		border-radius: 	25px;
  
		  
	 }
	 
	#nav-map .gravel{
		background : rgb(158,158,158); /* Old browsers */
		background : -moz-linear-gradient(left, rgba(158,158,158,1) 0%, rgba(188,188,188,1) 30%, rgba(165,165,165,1) 100%); /* FF3.6+ */
		background : -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(158,158,158,1)), color-stop(30%,rgba(188,188,188,1)), color-stop(100%,rgba(165,165,165,1))); /* Chrome,Safari4+ */
		background : -webkit-linear-gradient(left, rgba(158,158,158,1) 0%,rgba(188,188,188,1) 30%,rgba(165,165,165,1) 100%); /* Chrome10+,Safari5.1+ */
		background : -o-linear-gradient(left, rgba(158,158,158,1) 0%,rgba(188,188,188,1) 30%,rgba(165,165,165,1) 100%); /* Opera11.10+ */
		background : -ms-linear-gradient(left, rgba(158,158,158,1) 0%,rgba(188,188,188,1) 30%,rgba(165,165,165,1) 100%); /* IE10+ */
		filter     : progid:DXImageTransform.Microsoft.gradient( startColorstr='#9e9e9e', endColorstr='#a5a5a5',GradientType=1 ); /* IE6-9 */
		background : linear-gradient(left, rgba(158,158,158,1) 0%,rgba(188,188,188,1) 30%,rgba(165,165,165,1) 100%); /* W3C */
	}
	
	#nav-map .gravelV{
		background : rgb(158,158,158); /* Old browsers */
		background : -moz-linear-gradient(top, rgba(158,158,158,1) 0%, rgba(188,188,188,1) 30%, rgba(165,165,165,1) 100%); /* FF3.6+ */
		background : -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(158,158,158,1)), color-stop(30%,rgba(188,188,188,1)), color-stop(100%,rgba(165,165,165,1))); /* Chrome,Safari4+ */
		background : -webkit-linear-gradient(top, rgba(158,158,158,1) 0%,rgba(188,188,188,1) 30%,rgba(165,165,165,1) 100%); /* Chrome10+,Safari5.1+ */
		background : -o-linear-gradient(top, rgba(158,158,158,1) 0%,rgba(188,188,188,1) 30%,rgba(165,165,165,1) 100%); /* Opera11.10+ */
		background : -ms-linear-gradient(top, rgba(158,158,158,1) 0%,rgba(188,188,188,1) 30%,rgba(165,165,165,1) 100%); /* IE10+ */
		filter     : progid:DXImageTransform.Microsoft.gradient( startColorstr='#9e9e9e', endColorstr='#a5a5a5',GradientType=1 ); /* IE6-9 */
		background : linear-gradient(top, rgba(158,158,158,1) 0%,rgba(188,188,188,1) 30%,rgba(165,165,165,1) 100%); /* W3C */
	} 



	#nav-map .dirtH{

		background : rgb(182,141,76); /* Old browsers */
		background : -moz-linear-gradient(top, rgba(182,141,76,1) 0%, rgba(243,226,199,1) 33%, rgba(191,165,126,1) 50%, rgba(233,212,179,1) 66%, rgba(182,141,76,1) 100%); /* FF3.6+ */
		background : -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(182,141,76,1)), color-stop(33%,rgba(243,226,199,1)), color-stop(50%,rgba(191,165,126,1)), color-stop(66%,rgba(233,212,179,1)), color-stop(100%,rgba(182,141,76,1))); /* Chrome,Safari4+ */
		background : -webkit-linear-gradient(top, rgba(182,141,76,1) 0%,rgba(243,226,199,1) 33%,rgba(191,165,126,1) 50%,rgba(233,212,179,1) 66%,rgba(182,141,76,1) 100%); /* Chrome10+,Safari5.1+ */
		background : -o-linear-gradient(top, rgba(182,141,76,1) 0%,rgba(243,226,199,1) 33%,rgba(191,165,126,1) 50%,rgba(233,212,179,1) 66%,rgba(182,141,76,1) 100%); /* Opera11.10+ */
		background : -ms-linear-gradient(top, rgba(182,141,76,1) 0%,rgba(243,226,199,1) 33%,rgba(191,165,126,1) 50%,rgba(233,212,179,1) 66%,rgba(182,141,76,1) 100%); /* IE10+ */
		filter     : progid:DXImageTransform.Microsoft.gradient( startColorstr='#b68d4c', endColorstr='#b68d4c',GradientType=0 ); /* IE6-9 */
		background : linear-gradient(top, rgba(182,141,76,1) 0%,rgba(243,226,199,1) 33%,rgba(191,165,126,1) 50%,rgba(233,212,179,1) 66%,rgba(182,141,76,1) 100%); /* W3C */
	}

	 

	#nav-map .dirtV{

		background : rgb(182,141,76); /* Old browsers */
		background : -moz-linear-gradient(left, rgba(182,141,76,1) 0%, rgba(243,226,199,1) 33%, rgba(191,165,126,1) 50%, rgba(233,212,179,1) 66%, rgba(182,141,76,1) 100%); /* FF3.6+ */
		background : -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(182,141,76,1)), color-stop(33%,rgba(243,226,199,1)), color-stop(50%,rgba(191,165,126,1)), color-stop(66%,rgba(233,212,179,1)), color-stop(100%,rgba(182,141,76,1))); /* Chrome,Safari4+ */
		background : -webkit-linear-gradient(left, rgba(182,141,76,1) 0%,rgba(243,226,199,1) 33%,rgba(191,165,126,1) 50%,rgba(233,212,179,1) 66%,rgba(182,141,76,1) 100%); /* Chrome10+,Safari5.1+ */
		background : -o-linear-gradient(left, rgba(182,141,76,1) 0%,rgba(243,226,199,1) 33%,rgba(191,165,126,1) 50%,rgba(233,212,179,1) 66%,rgba(182,141,76,1) 100%); /* Opera11.10+ */
		background : -ms-linear-gradient(left, rgba(182,141,76,1) 0%,rgba(243,226,199,1) 33%,rgba(191,165,126,1) 50%,rgba(233,212,179,1) 66%,rgba(182,141,76,1) 100%); /* IE10+ */
		filter     : progid:DXImageTransform.Microsoft.gradient( startColorstr='#b68d4c', endColorstr='#b68d4c',GradientType=1 ); /* IE6-9 */
		background : linear-gradient(left, rgba(182,141,76,1) 0%,rgba(243,226,199,1) 33%,rgba(191,165,126,1) 50%,rgba(233,212,179,1) 66%,rgba(182,141,76,1) 100%); /* W3C */
	}
	
	#nav-map .grassV{
		background: rgb(75,128,33); /* Old browsers */
		background: -moz-linear-gradient(top, rgba(75,128,33,1) 0%, rgba(157,205,102,1) 48%, rgba(75,128,33,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(75,128,33,1)), color-stop(48%,rgba(157,205,102,1)), color-stop(100%,rgba(75,128,33,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, rgba(75,128,33,1) 0%,rgba(157,205,102,1) 48%,rgba(75,128,33,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, rgba(75,128,33,1) 0%,rgba(157,205,102,1) 48%,rgba(75,128,33,1) 100%); /* Opera11.10+ */
		background: -ms-linear-gradient(top, rgba(75,128,33,1) 0%,rgba(157,205,102,1) 48%,rgba(75,128,33,1) 100%); /* IE10+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4b8021', endColorstr='#4b8021',GradientType=1 ); /* IE6-9 */
		background: linear-gradient(top, rgba(75,128,33,1) 0%,rgba(157,205,102,1) 48%,rgba(75,128,33,1) 100%); /* W3C */
	}

	#nav-map .grass{
		background: rgb(75,128,33); /* Old browsers */
		background: -moz-linear-gradient(left, rgba(75,128,33,1) 0%, rgba(157,205,102,1) 48%, rgba(75,128,33,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(75,128,33,1)), color-stop(48%,rgba(157,205,102,1)), color-stop(100%,rgba(75,128,33,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(left, rgba(75,128,33,1) 0%,rgba(157,205,102,1) 48%,rgba(75,128,33,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(left, rgba(75,128,33,1) 0%,rgba(157,205,102,1) 48%,rgba(75,128,33,1) 100%); /* Opera11.10+ */
		background: -ms-linear-gradient(left, rgba(75,128,33,1) 0%,rgba(157,205,102,1) 48%,rgba(75,128,33,1) 100%); /* IE10+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4b8021', endColorstr='#4b8021',GradientType=1 ); /* IE6-9 */
		background: linear-gradient(left, rgba(75,128,33,1) 0%,rgba(157,205,102,1) 48%,rgba(75,128,33,1) 100%); /* W3C */
	}

	#nav-map .water{
		background: #1e5799; /* Old browsers */
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIxMDAlIiB5Mj0iMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzFlNTc5OSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjUwJSIgc3RvcC1jb2xvcj0iIzI5ODlkOCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjYxJSIgc3RvcC1jb2xvcj0iIzIwN2NjYSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiM3ZGI5ZTgiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(left,  #1e5799 0%, #2989d8 50%, #207cca 61%, #7db9e8 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, right top, color-stop(0%,#1e5799), color-stop(50%,#2989d8), color-stop(61%,#207cca), color-stop(100%,#7db9e8)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(left,  #1e5799 0%,#2989d8 50%,#207cca 61%,#7db9e8 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(left,  #1e5799 0%,#2989d8 50%,#207cca 61%,#7db9e8 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(left,  #1e5799 0%,#2989d8 50%,#207cca 61%,#7db9e8 100%); /* IE10+ */
background: linear-gradient(to right,  #1e5799 0%,#2989d8 50%,#207cca 61%,#7db9e8 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#7db9e8',GradientType=1 ); /* IE6-8 */
}

#nav-map .waterV{
		background: #1e5799; /* Old browsers */
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIxMDAlIiB5Mj0iMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzFlNTc5OSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjUwJSIgc3RvcC1jb2xvcj0iIzI5ODlkOCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjYxJSIgc3RvcC1jb2xvcj0iIzIwN2NjYSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiM3ZGI5ZTgiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top,  #1e5799 0%, #2989d8 50%, #207cca 61%, #7db9e8 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#1e5799), color-stop(50%,#2989d8), color-stop(61%,#207cca), color-stop(100%,#7db9e8)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #1e5799 0%,#2989d8 50%,#207cca 61%,#7db9e8 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #1e5799 0%,#2989d8 50%,#207cca 61%,#7db9e8 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #1e5799 0%,#2989d8 50%,#207cca 61%,#7db9e8 100%); /* IE10+ */
background: linear-gradient(to bottom,  #1e5799 0%,#2989d8 50%,#207cca 61%,#7db9e8 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#7db9e8',GradientType=1 ); /* IE6-8 */

	}

	#nav-map > div{
		width      : 33.33%;
		height     : 33.33%;
		float      : left;
		padding    : 0; 
		position   : relative;
		overflow-y : auto;
		cursor     : pointer;
	}

	

	#nav-map .roadV{
		text-align : center;
		margin     : auto; 
		height     : 100%;
		width      : 25px;
		min-width  : 25px;
		float: left;
		
		background : rgb(13,13,13); /* Old browsers */
		background : -moz-linear-gradient(left, rgba(13,13,13,1) 1%, rgba(78,78,78,1) 40%, rgba(239,155,0,1) 42%, rgba(149,149,149,1) 44%, rgba(1,1,1,1) 49%, rgba(149,149,149,1) 54%, rgba(239,155,0,1) 56%, rgba(56,56,56,1) 58%, rgba(27,27,27,1) 100%); /* FF3.6+ */
		background : -webkit-gradient(linear, left top, right top, color-stop(1%,rgba(13,13,13,1)), color-stop(40%,rgba(78,78,78,1)), color-stop(42%,rgba(239,155,0,1)), color-stop(44%,rgba(149,149,149,1)), color-stop(49%,rgba(1,1,1,1)), color-stop(54%,rgba(149,149,149,1)), color-stop(56%,rgba(239,155,0,1)), color-stop(58%,rgba(56,56,56,1)), color-stop(100%,rgba(27,27,27,1))); /* Chrome,Safari4+ */
		background : -webkit-linear-gradient(left, rgba(13,13,13,1) 1%,rgba(78,78,78,1) 40%,rgba(239,155,0,1) 42%,rgba(149,149,149,1) 44%,rgba(1,1,1,1) 49%,rgba(149,149,149,1) 54%,rgba(239,155,0,1) 56%,rgba(56,56,56,1) 58%,rgba(27,27,27,1) 100%); /* Chrome10+,Safari5.1+ */
		background : -o-linear-gradient(left, rgba(13,13,13,1) 1%,rgba(78,78,78,1) 40%,rgba(239,155,0,1) 42%,rgba(149,149,149,1) 44%,rgba(1,1,1,1) 49%,rgba(149,149,149,1) 54%,rgba(239,155,0,1) 56%,rgba(56,56,56,1) 58%,rgba(27,27,27,1) 100%); /* Opera11.10+ */
		background : -ms-linear-gradient(left, rgba(13,13,13,1) 1%,rgba(78,78,78,1) 40%,rgba(239,155,0,1) 42%,rgba(149,149,149,1) 44%,rgba(1,1,1,1) 49%,rgba(149,149,149,1) 54%,rgba(239,155,0,1) 56%,rgba(56,56,56,1) 58%,rgba(27,27,27,1) 100%); /* IE10+ */
		filter     : progid:DXImageTransform.Microsoft.gradient( startColorstr='#0d0d0d', endColorstr='#1b1b1b',GradientType=1 ); /* IE6-9 */
		background : linear-gradient(left, rgba(13,13,13,1) 1%,rgba(78,78,78,1) 40%,rgba(239,155,0,1) 42%,rgba(149,149,149,1) 44%,rgba(1,1,1,1) 49%,rgba(149,149,149,1) 54%,rgba(239,155,0,1) 56%,rgba(56,56,56,1) 58%,rgba(27,27,27,1) 100%); /*
W3C */}
		

	
	#nav-map .roadH{ 
		vertical-align   : middle;
		display: block;
		height           : 25px;
		width: 33%;
		text-align       : center;
		font-weight      : bold; 
		color            : white;
		/*text-transform : uppercase; */
		background       : rgb(13,13,13); /* Old browsers */
		background       : -moz-linear-gradient(top, rgba(13,13,13,1) 1%, rgba(78,78,78,1) 40%, rgba(239,155,0,1) 42%, rgba(149,149,149,1) 44%, rgba(1,1,1,1) 49%, rgba(149,149,149,1) 54%, rgba(239,155,0,1) 56%, rgba(56,56,56,1) 58%, rgba(27,27,27,1) 100%); /* FF3.6+ */
		background       : -webkit-gradient(linear, left top, left bottom, color-stop(1%,rgba(13,13,13,1)), color-stop(40%,rgba(78,78,78,1)), color-stop(42%,rgba(239,155,0,1)), color-stop(44%,rgba(149,149,149,1)), color-stop(49%,rgba(1,1,1,1)), color-stop(54%,rgba(149,149,149,1)), color-stop(56%,rgba(239,155,0,1)), color-stop(58%,rgba(56,56,56,1)), color-stop(100%,rgba(27,27,27,1))); /* Chrome,Safari4+ */
		background       : -webkit-linear-gradient(top, rgba(13,13,13,1) 1%,rgba(78,78,78,1) 40%,rgba(239,155,0,1) 42%,rgba(149,149,149,1) 44%,rgba(1,1,1,1) 49%,rgba(149,149,149,1) 54%,rgba(239,155,0,1) 56%,rgba(56,56,56,1) 58%,rgba(27,27,27,1) 100%); /* Chrome10+,Safari5.1+ */
		background       : -o-linear-gradient(top, rgba(13,13,13,1) 1%,rgba(78,78,78,1) 40%,rgba(239,155,0,1) 42%,rgba(149,149,149,1) 44%,rgba(1,1,1,1) 49%,rgba(149,149,149,1) 54%,rgba(239,155,0,1) 56%,rgba(56,56,56,1) 58%,rgba(27,27,27,1) 100%); /* Opera11.10+ */
		background       : -ms-linear-gradient(top, rgba(13,13,13,1) 1%,rgba(78,78,78,1) 40%,rgba(239,155,0,1) 42%,rgba(149,149,149,1) 44%,rgba(1,1,1,1) 49%,rgba(149,149,149,1) 54%,rgba(239,155,0,1) 56%,rgba(56,56,56,1) 58%,rgba(27,27,27,1) 100%); /* IE10+ */
		filter           : progid:DXImageTransform.Microsoft.gradient( startColorstr='#0d0d0d', endColorstr='#1b1b1b',GradientType=0 ); /* IE6-9 */
		background       : linear-gradient(top, rgba(13,13,13,1) 1%,rgba(78,78,78,1) 40%,rgba(239,155,0,1) 42%,rgba(149,149,149,1) 44%,rgba(1,1,1,1) 49%,rgba(149,149,149,1) 54%,rgba(239,155,0,1) 56%,rgba(56,56,56,1) 58%,rgba(27,27,27,1) 100%); /* W3C */
	}
	
	

		.sign {
			float               : left;
			width               : 100%;
			height              : 240px;
			margin              : 0;
			position            : absolute; 
			-webkit-transform   :rotate3d(0, 1, 0, 10deg); 
			-webkit-perspective : 600px;
			-moz-perspective    : 600px;
		}

		.sign{
			color         : white;
			text-align    : center; 
			font-size     : 30px;
			line-height   : 		23px;

			font-wieght   : bold; 
			font-family   : 'Allerta'; 
			position      : absolute;
			padding       : 5px;
			left          : 0; 
			z-index       : 101;
			width         : 100%;
			margin        :  5px 0 0 5px; 
			border-radius : 10px; 	
			cursor        : pointer;
			perspective   : 600px;
			bottom:         : 0;
		}
 
		/* -- make sure to declare a default for every property that you want animated -- */
		/* -- general styles, including Y axis rotation -- */
		 
		.sign .front {
			float                       : none; 
			left                        : 0;
			z-index                     : 900;
			position                    : absolute; 
			width                       : inherit;
			height                      : inherit;  
			
			-webkit-transform           : rotateX(0deg) rotateY(0deg);
			-webkit-transform-style     : preserve-3d;
			-webkit-backface-visibility : hidden;
			
			-moz-transform              : rotateX(0deg) rotateY(0deg);
			-moz-transform-style        : preserve-3d;
			-moz-backface-visibility    : hidden;
			
			/* -- transition is the magic sauce for animation -- */
			-o-transition               : all .4s ease-in-out;
			-ms-transition              : all .4s ease-in-out;
			-moz-transition             : all .4s ease-in-out;
			-webkit-transition          : all .4s ease-in-out;
			transition                  : all .4s ease-in-out;
			box-shadow    : -0px -0px 100px rgba(0,0,0,0.85); 

			border-radius: 15px;
			padding : 15px;

			border                : 5px solid white;
			border-top-color      : #fafafa; 
			border-right-color    : #f6f6f6;
			border-bottom-color   : #c7c7c7;
			border-left-color     : #ddd; 
			/*text-transform      : uppercase;*/
			background            : rgb(6,99,70); /* Old browsers */
			background            : -moz-linear-gradient(top, rgba(6,99,70,1) 0%, rgba(0,78,51,1) 95%, rgba(6,99,70,1) 100%); /* FF3.6+ */
			background            : -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(6,99,70,1)), color-stop(95%,rgba(0,78,51,1)), color-stop(100%,rgba(6,99,70,1))); /* Chrome,Safari4+ */
			background            : -webkit-linear-gradient(top, rgba(6,99,70,1) 0%,rgba(0,78,51,1) 95%,rgba(6,99,70,1) 100%); /* Chrome10+,Safari5.1+ */
			background            : -o-linear-gradient(top, rgba(6,99,70,1) 0%,rgba(0,78,51,1) 95%,rgba(6,99,70,1) 100%); /* Opera11.10+ */
			background            : -ms-linear-gradient(top, rgba(6,99,70,1) 0%,rgba(0,78,51,1) 95%,rgba(6,99,70,1) 100%); /* IE10+ */
			filter                : progid:DXImageTransform.Microsoft.gradient( startColorstr='#1f3b08', endColorstr='#1f3b08',GradientType=0 ); /* IE6-9 */
			background            : linear-gradient(top, rgba(6,99,70,1) 0%,rgba(0,78,51,1) 95%,rgba(6,99,70,1) 100%); /* W3C */

		}
		.sign.flip .front {
			z-index            : 900;
			border-color       : #eee; 

			-webkit-transform  : rotateY(180deg);
			-moz-transform     : rotateY(180deg);
			
			-moz-box-shadow    : 0 15px 50px rgba(0,0,0,0.2);
			-webkit-box-shadow : 0 15px 50px rgba(0,0,0,0.2);
			box-shadow         : 0 15px 50px rgba(0,0,0,0.2);
		}
		.sign .back input{
			text-align: center
		}
		.sign .back {
			float                       : none;
			position                    : absolute;
			top                         : 0;
			left                        : 0;
			z-index                     : 800;
			width                       : inherit;
			height                      : inherit; 
			padding-top: 15px;
			font-family                 : 'Allerta';
			font-size                   :  14px;
			text-align                  : left;
			color                       : white;
			border-radius               : 5px;
			border                      : 2px solid #777;
			text-align: center;
			box-shadow                  : -0px -0px 100px rgba(0,0,0,0.85); 
			
			filter                      : progid:DXImageTransform.Microsoft.gradient( startColorstr='#e6eff7', endColorstr='#c2cecc',GradientType=0 ); /* IE6-8 */
			
			-webkit-transform           : rotateY(-180deg);
			-webkit-transform-style     : preserve-3d;
			-webkit-backface-visibility : hidden;
			
			-moz-transform              : rotateY(-180deg);
			-moz-transform-style        : preserve-3d;
			-moz-backface-visibility    : hidden;
			
			/* -- transition is the magic sauce for animation -- */
			-o-transition               : all .4s ease-in-out;
			-ms-transition              : all .4s ease-in-out;
			-moz-transition             : all .4s ease-in-out;
			-webkit-transition          : all .4s ease-in-out;
			transition                  : all .4s ease-in-out;
		} 

		.sign.flip .back {
			z-index            : 1000;
			background         : #ccc; 
			background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAa0lEQVQYV2NkgIKmQ37/6+w2MYK4xpnX/h9piWDgFL4E54MZhBSdna7FyEiMIpBhYBNxWQcyCWYjTjchKwK5nRGbw9EVga3+/lbvP7LvsCkCGYbiRlyKdtW2QDwD0oFPkbDUMogbCSkCGQYAka1/qtkEIQkAAAAASUVORK5CYII=);

			color : white;
			-webkit-transform  : rotateX(0deg) rotateY(0deg);
			-moz-transform     : rotateX(0deg) rotateY(0deg); 
			box-shadow         : 0 15px 50px rgba(0,0,0,0.2);
			-moz-box-shadow    : 0 15px 50px rgba(0,0,0,0.2);
			-webkit-box-shadow : 0 15px 50px rgba(0,0,0,0.2); 
		}
		 

		
		
	.leftTilt{
		 
		-webkit-box-shadow : 10px 5px 20px rgba(0,0,0,0.25);
		border             : 20px solid #fff4de; 
		border-right       : 0; 
		z-index            : 10;
		display            : inline-block;
		height             : 100%;
		width              : 33%;
		float              : left;
	}

	.middleTilt{
		 
		-webkit-box-shadow : 10px 5px 20px rgba(0,0,0,0.25);
		border             : 20px solid #e6dac4; 
		border-right       : 0;
		z-index            : 9;
		border-left        : 0;
		display            : inline-block;
		height             : 100%; 
	}
	 .rightTilt{
		 
		-webkit-box-shadow : 10px 5px 20px rgba(0,0,0,0.25);
		border             : 20px solid #fff4de; 
		border-left        : 0;
		display            : inline-block;
		height             : 100%;
		width              : 33%; 
		float              : right;
	}
	
	 
	.poleleft{
		position           : absolute;
		top: -75px;
		left: 50px;
		margin             : auto;
		width              : 15px;
		height             :  100px;
		background         : rgb(155,155,155); /* Old browsers */
		background         : -moz-linear-gradient(left, rgba(155,155,155,1) 0%, rgba(219,220,226,1) 21%, rgba(184,186,198,1) 49%, rgba(221,223,227,1) 80%, rgba(175,175,175,1) 100%); /* FF3.6+ */
		background         : -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(155,155,155,1)), color-stop(21%,rgba(219,220,226,1)), color-stop(49%,rgba(184,186,198,1)), color-stop(80%,rgba(221,223,227,1)), color-stop(100%,rgba(175,175,175,1))); /* Chrome,Safari4+ */
		background         : -webkit-linear-gradient(left, rgba(155,155,155,1) 0%,rgba(219,220,226,1) 21%,rgba(184,186,198,1) 49%,rgba(221,223,227,1) 80%,rgba(175,175,175,1) 100%); /* Chrome10+,Safari5.1+ */
		background         : -o-linear-gradient(left, rgba(155,155,155,1) 0%,rgba(219,220,226,1) 21%,rgba(184,186,198,1) 49%,rgba(221,223,227,1) 80%,rgba(175,175,175,1) 100%); /* Opera11.10+ */
		background         : -ms-linear-gradient(left, rgba(155,155,155,1) 0%,rgba(219,220,226,1) 21%,rgba(184,186,198,1) 49%,rgba(221,223,227,1) 80%,rgba(175,175,175,1) 100%); /* IE10+ */
		filter             : progid:DXImageTransform.Microsoft.gradient( startColorstr='#9b9b9b', endColorstr='#afafaf',GradientType=1 ); /* IE6-9 */
		background         : linear-gradient(left, rgba(155,155,155,1) 0%,rgba(219,220,226,1) 21%,rgba(184,186,198,1) 49%,rgba(221,223,227,1) 80%,rgba(175,175,175,1) 100%); /* W3C */
		-webkit-transform  :rotate3d(0, 1, 0, -2deg);
		
		box-shadow : 0px -10px 10px rgba(0,0,0,0.5);
		border-radius: 5px;
		/*margin             : -30px 0 0 5% */
		border: 1px solid #999;
	}

	 .poleright{ 
		position           : absolute;
		top: -75px;
		right: 60px;

		margin             : auto;
		width              : 13px;
		height             : 100px;
		background         : rgb(155,155,155); /* Old browsers */
		background         : -moz-linear-gradient(left, rgba(155,155,155,1) 0%, rgba(219,220,226,1) 21%, rgba(184,186,198,1) 49%, rgba(221,223,227,1) 80%, rgba(175,175,175,1) 100%); /* FF3.6+ */
		background         : -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(155,155,155,1)), color-stop(21%,rgba(219,220,226,1)), color-stop(49%,rgba(184,186,198,1)), color-stop(80%,rgba(221,223,227,1)), color-stop(100%,rgba(175,175,175,1))); /* Chrome,Safari4+ */
		background         : -webkit-linear-gradient(left, rgba(155,155,155,1) 0%,rgba(219,220,226,1) 21%,rgba(184,186,198,1) 49%,rgba(221,223,227,1) 80%,rgba(175,175,175,1) 100%); /* Chrome10+,Safari5.1+ */
		background         : -o-linear-gradient(left, rgba(155,155,155,1) 0%,rgba(219,220,226,1) 21%,rgba(184,186,198,1) 49%,rgba(221,223,227,1) 80%,rgba(175,175,175,1) 100%); /* Opera11.10+ */
		background         : -ms-linear-gradient(left, rgba(155,155,155,1) 0%,rgba(219,220,226,1) 21%,rgba(184,186,198,1) 49%,rgba(221,223,227,1) 80%,rgba(175,175,175,1) 100%); /* IE10+ */
		filter             : progid:DXImageTransform.Microsoft.gradient( startColorstr='#9b9b9b', endColorstr='#afafaf',GradientType=1 ); /* IE6-9 */
		background         : linear-gradient(left, rgba(155,155,155,1) 0%,rgba(219,220,226,1) 21%,rgba(184,186,198,1) 49%,rgba(221,223,227,1) 80%,rgba(175,175,175,1) 100%); /* W3C */
		-webkit-transform  :rotate3d(0, 1, 0, -2deg);
		box-shadow : 0px -10px 10px rgba(0,0,0,0.5);
		border-radius: 5px;
		border: 1px solid #999;
		/*margin             : -35px 0 0 150px;*/
		/*z-index            : -1;*/
	}	
 

 	 

 	#nav-map .overlay{
		background-color : rgba(0,0,0,0.75);
		border-radius    : 25px;
		position         : absolute;
		width            : 100%;
		height           : 100%;
		display          : none;
		min-height       : 100%;
		min-width        :  100%;
		top              : 0;
		bottom           : 0;
		left             : 0;
		right            : 0; 
		z-index          : 100;
	}

	.center{
		position : relative; 
		width    : 55%; 
		/*min-width: 400px;*/
		margin   : auto auto;
		bottom:  : 10px; 
		display  : block;
		min-width: 150px;
	}

	 .bubble {
			background-color : rgba(255,255,255,0.75);
			border        : 2px solid #2989d8;
			border-top    : 2px solid rgba(157,205,102,1);
			border-bottom: 0;
			font-size     :35px;
			line-height   :1.3em;
			padding       :10px; 
			text-align    :center;  
			box-shadow    : 0 0px 10px rgba(255,255,255,0.55); 
			border-radius : 3000px 3000px 5px 5px; 
 
			position : absolute; 
			width    : 95%;
			height   : 98%; 
			margin   : auto auto;
			bottom: 0;
			
			background: #f0f9ff; /* Old browsers */
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2YwZjlmZiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjExJSIgc3RvcC1jb2xvcj0iI2ExZGJmZiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjM2JSIgc3RvcC1jb2xvcj0iI2NiZWJmZiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjczJSIgc3RvcC1jb2xvcj0iI2YwZjlmZiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNmZmZmZmYiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top,  #f0f9ff 0%, #a1dbff 11%, #cbebff 36%, #f0f9ff 73%, #ffffff 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f0f9ff), color-stop(11%,#a1dbff), color-stop(36%,#cbebff), color-stop(73%,#f0f9ff), color-stop(100%,#ffffff)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #f0f9ff 0%,#a1dbff 11%,#cbebff 36%,#f0f9ff 73%,#ffffff 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #f0f9ff 0%,#a1dbff 11%,#cbebff 36%,#f0f9ff 73%,#ffffff 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #f0f9ff 0%,#a1dbff 11%,#cbebff 36%,#f0f9ff 73%,#ffffff 100%); /* IE10+ */
background: linear-gradient(to bottom,  #f0f9ff 0%,#a1dbff 11%,#cbebff 36%,#f0f9ff 73%,#ffffff 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f0f9ff', endColorstr='#ffffff',GradientType=0 ); /* IE6-8 */


		}
		.bubble-arrow-border {
		  border-color: rgba(255,255,255,0.75) transparent transparent transparent;
		  border-style: solid;
		  border-width: 10px;
		  height:0;
		  width:0;
		  position:absolute;
		  bottom:-22px;
		  left:48%;
		}
		.bubble-arrow {
		  border-color: rgba(255,255,255,0.75) transparent transparent transparent;
		  border-style: solid;
		  border-width: 10px;
		  height:0;
		  width:0;
		  position:absolute;
		  bottom:-19px;
		  left:48%;
		}

		#nav-map > img{
			margin: 0;
			padding: 0;
			
		}

		.nav-map-border{
			border-color       : #FFF4DE;
			border-image       : none;
			border-style       : solid none solid solid;
			border-width       :  20px;
			z-index            : 0;
			-webkit-box-shadow : 0px 0px 10px rgba(0,0,0,0.25);
			box-shadow         : 0px 0px 10px rgba(0,0,0,0.25); 	
			position           : absolute;
			overflow           : hidden;
			width              : 80%;
			min-width          : 70%;
			height             : 70%;
			margin             : auto auto;
		}

		@-webkit-keyframes spin {
		   0% { -webkit-transform: rotateY(0); }
		 100% { -webkit-transform: rotateY(360deg); }
		}
		
		.spectMe{
		 -webkit-perspective: 1000;
		}

		.spinMe {
		 /*//background-image: url(modernizr-logo.png);*/
		 overflow: hidden;
		 -webkit-animation: spin 1s linear;
		}

		.spinMeForever {
		 /*//background-image: url(modernizr-logo.png);*/
		 overflow: hidden;
		 -webkit-animation: spin 2s linear infinite;
		}

		#nav-map > div p {
			color: white;
			text-shadow : 0px 0px 1px #EEE;
		}

		 
		.sign-bubble-arrow-border {
		  border-color: transparent transparent rgba(255,255,255,0.95)  transparent;
		  border-style: solid;
		  border-width: 20px;
		  height:0;
		  width:0;
		  position:absolute;
		    top:25px;
		  left:46%;
		  z-index: 9999;
		  cursor: pointer;
		}
		.sign-bubble-arrow {
		  border-color: transparent transparent rgb(6,99,70)  transparent;
		  border-style: solid;
		  border-width: 20px;
		  height:0;
		  width:0;
		  position:absolute;
		  top:30px;
		  left:46%;
		  z-index: 99999999;
		  cursor: pointer;
		}

		.sign-bubble-arrow:hover {
			top:28px;
		}

</style>  