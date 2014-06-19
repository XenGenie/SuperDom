if('undefined' != typeof(Ext)){
	Ext.ns('x4');
}
x4 = {
	fx		: {
		
	},
	log : function  (log) {
		if('undefined' !== typeof console){
			console.log(log);
		}
	},
	waitForFinalEvent : (function () {
	  var timers = {};
	  return function (callback, ms, uniqueId) {
	  	x4.log('Waiting to Call: '+uniqueId+'...');
	    if (!uniqueId) {
	      uniqueId = "Don't call this twice without a uniqueId";
	    }
	    if (timers[uniqueId]) {
	    	x4.log('Resetting Call to: '+uniqueId+'...');
	      	clearTimeout (timers[uniqueId]);
	    }
	    timers[uniqueId] = setTimeout(callback, ms);
	  };
	})(),
	Window 	: function(winCfg){
		if(myDesktopApp){
			var desktop = myDesktopApp.getDesktop()  
		    var win = desktop.getWindow(winCfg.id)
		    if(!win){
				win = desktop.createWindow(winCfg);
		    }
		}else{
			var win = new Ext.Window(winCfg);
		}
		win.addListener('close',function(){
			location.hash = '!close='+win.id;	 
		});
		return win;
	}, 
	BFFrame	: function(cfg){
		// a predefined window with an iframe ...
		var id = ume.util.php.md5(cfg.src);
		
		var win = this.Window({
			id			: 'view-dom-win'+id,
			title		: cfg.title,
			iconCls		: (cfg.iconCls) ?  cfg.iconCls : 'x-icon-16x16-world',
			tbar		: [{
				iconCls	: 'x-icon-16x16-arrow_large_left',
				id		: 'view-dom-left'+id,
				handler	: function(){
					Ext.getCmp('view-dom-right'+id).enable();
					history.back();
				}
			},'-',{
				iconCls	: 'x-icon-16x16-arrow_large_right',
				id		: 'view-dom-right'+id,
				handler	: function(){
					history.forward();
				}
			},'-',' ',{
				iconCls	: 'x-icon-16x16-refresh',
				handler	: function(){
					var src = Ext.getCmp('bfframe-'+src).getValue();
					document.getElementById('view-www').src = src;
				}

			},' ','URL',{
				xtype	: 'textfield',
				readOnly: true,
				id		: 'view-dom-url'+id,
				width	: 800
			}],
			id			: 'view-dom-win-iframe'+id, 
			items	:[new Ext.ux.IFrameComponent({ 
				width	: '100%',
				height	: '100%',
				autoScroll	: true,
				layout	: 'fit',
				id		: 'view-www'+id,
				name	: 'view-www'+id,
				iconCls	: cfg.iconCls,
				onload	: "Ext.getCmp('view-dom-url'+id).setValue(this.contentWindow.document.location.href); Ext.getCmp('view-dom-win').setTitle(this.contentWindow.document.title)",
				style	: 'background-color: white',
				url		: cfg.src,
				src		: cfg.src,
			})]
		});
		return win;
	},	
	
	direct: function(load){
		try{
			JSAN.use(load);
			Ext.Direct.addProvider($$.APIDesc);
		}catch(e){
			//alert(e)
		}	
	},
	setAction: function(doThis,auth){
		x4.doAction = doThis;
		if(!$$.xAccess){
			// x4.direct('xAccess');	
		}
		switch(auth){
			default:	// Default - User Access
				// this.authUser();
			break;		
			case('admin'): // Admin Access 
			break;
			case('guest'): // Not-Authorized
			break;
		}
	},
	getIcon	: function(icon,align,type){
		type = (type) ? type: 'png';
		align = (align) ? align: 'absmiddle';
		return '<img src="/bin/images/icons/16x16/'+icon+'.'+type+'" align="'+align+'"/>';
	},
	fn		: function(fn){
		try{
			fn()
		}catch(e){
			Ext.Msg.alert('DEBUG ERROR',e);
		}
	},
	authUser : function(fn){
		if(!ume.isUser()){
			Ext.Msg.wait(x4.lang.wait,ume.getIcon('hcard')+'Authenticating User');
			ume.login.init();
		}else{
			ume.autoRun();
			delete(ume.autoRun);
		}
	},
	view	: {
		width	: function() {
			return Math.floor(window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth);
		},
		height	: function() {
			return Math.floor(window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight);
		}
	},
	lang: {
		wait: '<img src="/bin/images/loading/barbershop.gif" align="right" /> Please Wait... '
	},
	v	: {
		w 	: function(){
			return x4.view.width();
		},
		h	: function(){
			return x4.view.height();
		}
	},
	date: function(str){
		var date = new Date();
		return date.format(str)
	},
	greeting: function(){
		var greeting = new Date();
		var greeting = greeting.getHours();
		
		if(greeting >=0 && greeting <= 5){ 		// Night
			greeting = "Glorious Night to You, ";
		}else if(greeting >=6 && greeting <= 11){ // Morning
			greeting = "Good Morning to You, ";
		}else if(greeting >=12 && greeting <= 17){ // Noon
			greeting = "Good Afternoon to You, ";
		}else if(greeting >=18 && greeting <= 23){ // Evening
			greeting = "Good Evening to You, ";
		}
		return greeting;
	},
	copyright	: function(text){
		return {
			text	: text,
			handler	: function(){
				new Ext.Window({ 
					modal: true,
					title: 'Website Last Updated: '+VERSION+' | Created By:',
					iconCls: 'x-icon-wrench',
					height: 245,
					width: 310,
					bodyStyle: 'text-align: center; font-weight: bold;',
					html: '<a href="http://www.tucsonerd.com" style="color: #ccffff" target="_blank"><img src="http://tucsonerd.com/sites/default/files/acquia_marina_logo.png"><h1>www.TucsoNerd.com</h1></a><hr/>Christopher Dee Pollard <br/>www.xtiv.net'
				}).show();
			}
		};
	},
	domView		: function(){
		return {
			id			: 'view-dom-win',
			maximized	: true,
			title		: location.host,
			iconCls		: 'x-icon-16x16-eye',
			layout		: 'border',
			closable	: false,
			items		: [x4.xWwwSetup = new Ext.form.FormPanel({
				region		: 'south',
				  
				title		: 'DOMain Config',
				iconCls		: 'x-icon-16x16-box',
				fileUpload	: true,
				api		: {
					load	: $$.xWwwSetup.loadSettings,
					submit	: $$.xWwwSetup.saveSettings
				},
				layout		: 'column',
				frame		: true,
				collapsible	: true,
				defaults	: {
					columnWidth	: .20,
					layout		: 'form',
					labelWidth	: 65,
					defaults	: {
						anchor			: '-5',
						hideLabel		: true,
			            selectOnFocus	: true,
					},
				},
				items	: [{
					defaultType	: 'textfield',
					items	: [{
						emptyText	: 'Site Name',
						name		: 'config[site_name]'
					},{
						emptyText	: 'Site Moto',
						name		: 'config[site_moto]'
					}] 
				},{
					items	: [{
						emptyText	: 'Copyright',
						hideLabel: true,
						xtype		: 'textfield',
						name		: 'config[copyright]',
					},x4.costumes = new Ext.form.ComboBox({  
					    emptyText: 'Costume',
					    hideLabel: true,
					    store: new Ext.data.JsonStore({  
						    autoLoad: true,
					    	url: '/@/layout/getThemes/?json',
					    	root: 'data', 
					        fields : [{
						        name: 'id'
							},{
								name: 'name'
							}]  
					    }),  
					    valueField	: 'id',  
					    displayField: 'name',
					    mode		: 'remote',  
					    minChars 	: 0 ,
						anchor	 	: '100%',
						name		: 'config[www_costume]',
						hiddenName	: 'config[www_costume]',
						listeners	: {
							select: function(cb,r,i){
								var src =  Ext.getCmp('view-dom-url').getValue();
								src = src.replace('http://'+location.host+'/','');
								
								src = src.replace('?theme='+x4.costume,'');
								src = (src == '') ? 'index' : src;
								
								
								x4.costume = cb.getValue();
								
								
								document.getElementById('view-www').src = '/'+src+'?theme='+x4.costume;
							}
						}
					})] 
				},{
					xtype	: 'panel',
					id		: 'www-logo-jar',
					layout	: 'fit',
					style: 'display: table-cell; vertical-align: middle; text-align: center',
					height	: 50,
					html	: '<table width="100%" height="100%"><tr><td align="center"><img src="/bin/images/loading/blackloadus.gif" id="site-logo-img" /></td></tr></table>'
				},{
					defaults	: {
						anchor	: '-5',
					},
					defaultType	: 'textfield',
					items	: [{
						hideLabel	: true,
						emptyText	: 'Describe Domain for Search Engine Optimizations',
						xtype		: 'textarea',
						name		: 'config[describe_domain]',
						height	: 50
					}] 
				},{
					defaults	: {
						anchor	: '100%',
					},
					items	: [{
			            xtype	: 'fileuploadfield',
			            emptyText: 'Upload Logo',
			            hideLabel: true,
						name		: 'config[site_logo]',
						id			: 'site-logo-upload',
			            buttonText: '',
			            selectOnFocus	: true,
			            buttonCfg: {
			                iconCls: 'x-icon-16x16-ruby'
			            }
			        },{
						xtype	: 'button',
						text	: 'Apply',
						iconCls	:'x-icon-16x16-world_edit',
						align	: 'strech',
						handler	: function(){
							x4.xWwwSetup.mask.show();
							x4.xWwwSetup.getForm().submit({
								success	: function(r){
									var msg = x4.xWwwSetup.mask.msg;
									x4.xWwwSetup.mask.msg = 'Saved!';
									x4.xWwwSetup.getForm().load({
										success	: function(f,a){
											x4.xWwwSetup.mask.hide();
											x4.xWwwSetup.mask.msg = msg;
											$('#view-www').attr('src',$('#view-www').attr('src'));
											$('#site-logo-img').attr({
												src	: x4.phpThumb({
													src	: Ext.getCmp('site-logo-upload').getValue(),
													w	: $('#www-logo-jar').width()-5,
													h	: 45,
													zc	: 0
												})
											});
										}
									});
								}
							});
						}
					}]
				}]
			}),{
				region	: 'center',
				tbar		: [{
					iconCls	: 'x-icon-16x16-arrow_large_left',
					id		: 'view-dom-left',
					handler	: function(){
						Ext.getCmp('view-dom-right').enable();
						history.back();
					}
				},'-',{
					iconCls	: 'x-icon-16x16-arrow_large_right',
					id		: 'view-dom-right',
					handler	: function(){
						history.forward();
					}
				},'-',' ',{
					iconCls	: 'x-icon-16x16-refresh',
					handler	: function(){
						var src = Ext.getCmp('view-dom-url').getValue();
						document.getElementById('view-www').src = src;
					}

				},' ','URL',{
					xtype	: 'textfield',
					readOnly: true,
					id		: 'view-dom-url',
					width	: 800
				}],
				id			: 'view-dom-win-iframe',
			}],
			listeners	: {
				show	: function(){
					x4.xWwwSetup.mask = new Ext.LoadMask(x4.xWwwSetup.getEl(), {msg:"Reading DOMain, Please Wait..."});
					x4.xWwwSetup.mask.show();
					x4.xWwwSetup.getForm().load({
						success	: function(f,a){
							x4.xWwwSetup.mask.hide();
							$('#site-logo-img').attr({
								src	: x4.phpThumb({
									src	: Ext.getCmp('site-logo-upload').getValue(),
									w	: $('#www-logo-jar').width()-5,
									h	: 45,
									zc	: 0
								})
							});
						}
					});
					
					var pan = Ext.getCmp('view-dom-win-iframe');
					var iframe = new Ext.ux.IFrameComponent({
						region	: 'center',
						width	: '100%',
						height	: '100%',
						autoScroll	: true,
						layout	: 'fit',
						id		: 'view-www',
						name	: 'view-www',
						iconCls	: 'x-icon-world',
						onload	: "Ext.getCmp('view-dom-url').setValue(this.contentWindow.document.location.href); Ext.getCmp('view-dom-win').setTitle(this.contentWindow.document.title)",
						style	: 'background-color: white',
						url		: '/'
					});
					pan.remove('view-dom-jar');
					pan.add(iframe);
					pan.doLayout();
				}
			}
		};
	},
	deskApps	: {
		title		: 'Manage @xis',
		iconCls		: 'x-icon-16x16-add_small',
		id			: 'add-apps',
		border		: false,
		maximized	: true,
		layout		: 'fit',
		closeAction	: 'hide',
		items		: [{
			xtype		: 'tabpanel',
			id			: 'add-apps-tabs',
			activeTab	: 'icon-tabs',
			defferedRender	: false,
			//tabPosition	: 'bottom',
			autoScoll: true,
			buttonAlign		: 'center',
			buttons		: [{
				iconCls	: 'x-icon-16x16-home_green',
				iconAlign	: 'bottom',
				align	: 'strech',
				cls		: 'punch',
				text	: 'Return to the @xis', 
				scale	: 	'large',
				iconCls	: 'x-icon-32x32-exit',
				handler	: function(){
					x4.loadZyx('/x/');
					//Ext.getCmp('add-apps').close();
				}
			}],
			items		: [{
				title		: 'Local @pps',
				layout		: 'border',
				defaults	: {
					border		: false,
				},
				id			: 'icon-tabs',
				iconCls	: 'x-icon-16x16-briefcase',
				items		: [{
					region	: 'south',
					contentEl	: 'icon-cats',
					//iconCls	: 'x-icon-16x16-mouse',
					bodyStyle	: 'text-align: center;',
					//title	: '<u>1.</u> Change Between the Different Categories.', 
					frame	: false,
					height: 110,
				},{
					region	: 'center',
					title	: 'Manage the @pps shown in the @xis',
					iconCls	: 'x-icon-16x16-mouse',
					contentEl	: 'icon-areas',
					bodyStyle	: 'text-align: center; overflow: auto',
					layout		: 'fit',autoScroll	: true,
					
				}],
				
				listeners	: {
					activate	: function(){
						$('#icon-tabs').tabs();	
						$('.switch').checkbox({
							cls	: 'jquery-safari-checkbox', 
							empty: '/bin/js/jq/jquery-checkbox/empty.png'
						});
					}
				}
			},{
				title	: '@pp Core',
				iconCls	: 'x-icon-16x16-basket_add', 
				layout		: 'border',
				defaults	: {
					border		: false,
				},
				items		: [{
					region	: 'north',
					id		: 'apps-all-north',
					height	: 125
				},{
					region	: 'center',
					autoScoll: true,
					bodyStyle	: 'overflow	: auto; display: none',
					layout	: 'fit',
					autoLoad	: {
						url		: '/@/update/moreX?installed=1&html', 
						autoScoll: true,
						scripts	: true,
						callback	: function(el){
							el.hide();
							var north = Ext.getCmp('apps-all-north');
							north.add({
								contentEl	: 'moreX-tabs',
								style		: 'text-align: center',
								plain		: true,
								unstyled	: true
							});
							north.doLayout();
							
							north.getEl().fadeIn();
							el.fadeIn();
							x4.deskApps.allMask.hide();
						}
					}
				}],
				listeners	: {
					activate	: function(tp){
						if(!x4.deskApps.allMask){
							var mask = new Ext.LoadMask(tp.getEl(),{msg: "Finding @pps, Please Wait..."});
							mask.show();
							x4.deskApps.allMask = mask;	
						}
						
					}
				}
			}]
		}],
		listeners	: {
			afterrender	: function(win){
				 
			}
		}
	},
	activeArea : null,

	loadZyx	: function(url, name, callback,skipani){
		// This is what Does the actual Animation and Loading Magic...
		// History.pushState({state:1,rand:Math.random()}, "State 1", "?state=1") 

		loader = $('<div/>').addClass('loader').appendTo(document.body).fadeIn();

		$(document.body).mousemove(function( event ){
			loader.css({
				top    : event.pageY-50,
				left   : event.pageX-50,
				cursor : 'wait'
			});
		});



		var desk = $("#zyx-content"); 
		var map  = $("#nav-map"); 

		if(map.length && x4.activeArea  && location.pathname.search(/worldmap/i) < 1 && location.pathname.search(/logout/i) < 1){
			
			destroyme = x4.activeArea;

			x4.activeArea = x4.activeArea.clone().hide();
			x4.activeArea.appendTo('#nav-map');

			//destroyme.fadeOut().remove();

			x4.activeArea.fadeIn(function  (argument) {
				// body...
				// $('<div/>',
				// {
				// 	id    : 'overlay',
				// 	class : 'overlay'
				// }).appendTo('#nav-map').show(); 

				x4.activeArea.css({
					opacity : 1
				});


			});
			//x4.activeArea.html(data); 
			x4.log('yes map');
		}else{
			x4.activeArea = desk;
			x4.log('no map');
		}	

		try{
			// ( $(x4.activeArea).load('/x/html/'+url,function (response, status, xhr) {

			// 	loader.fadeOut().remove();
			// 	$(document.body).unbind('mousemove');

			// 	if ( status == "error" ) {
			// 	    var msg = "Sorry but there was an error: ";
			// 	    alert( msg + xhr.status + " " + xhr.statusText );
			// 	}

				

			// 	$('#halfmoon-right a').each(function(){
			// 		if ( $(this).attr('href').replace('#','') == location.pathname ){
			// 			$(this).animate({
			// 				opacity : 0
			// 			});
			// 		} else {
			// 			$(this).animate({
			// 				opacity : 1
			// 			});
			// 		}
			// 	});



			// 	// desk.animate({
			// 	// 	// left    : -$(window).width(),
			// 	// 	opacity : 0 
			// 	// })	// body...
			// }) ) ;

			$.ajax({
			    url: '/x/html/'+url,
			    type: 'GET',
			    error: function (err) {
			        console.log("AJAX error in request: " + JSON.stringify(err, null, 2));
			    }
			}).always(function(jqXHR, textStatus) {
			    if (textStatus != "success") {
			        alert("Error: " + jqXHR.statusText);
			    }

			    x4.activeArea.html(jqXHR);

			    $('.loader').fadeOut().remove();
				$(document.body).unbind('mousemove');

				$('#dom-cuts li a').each(function(){
					BTNS = [];
					if ( $(this).attr('href').replace('#','') == location.pathname ){
						$(this).parent().css({
							opacity : 0,
							
						}).css({
							bottom : 0
						});
 // 
					} else {

						BTNS.push($(this));

						if( $(this).parent().hasClass('tutor') == false ){
							$(this).parent().css({
								opacity : 1,
								bottom : 0
							});
						} 
						// alert($(this).hasClass('tutor'));
					}
				});

				

			});

		}catch(e){ 
			loader.fadeOut().remove();
			$(document.body).unbind('mousemove');

			 var msg = "Sorry but there was an error: ";
		    alert( msg + e.message );

		}

		

		// $("#zyx-content").flip({
		// 	direction : 'lr',
		// 	speed     : (skipani) ? 0 : 500,
		// 	onEnd 	  : callback,	
		// 	content   : html
		// });


		// var desk = $('#zyx-content');
		// if(skipani){
		// 	desk.load('/html/'+url,{});
		// }else{
		// 	var name = (name) ? name : '';
		// 	var gif = '<img src="/bin/images/loading/dots.gif"/>';
		// 	var hov = $('#hover-box').html(gif);
			
		// 	$('#dim-the-lights').fadeIn('fast');
		// 	desk.css({
		// 		position: 'absolute'
		// 	});
		// 	desk.animate({
		// 		left: -$(window).width(),
		// 		opacity: 0
		// 	},200,function(){
		// 		desk.css({ left : $(window).width() });	
		// 		desk.load('/x/html/'+url,{},function(){
		// 			$('#dim-the-lights').fadeOut('fast');
		// 			desk.animate({
		// 				left: 0,
		// 				opacity: 1,
		// 				//width	: $(window).width(),
		// 				//height	: $(window).height()
		// 			})
		// 		});	
		// 	})	
		// }
		// if(callback){ 
		// 	callback();
		// } 
		//$('#zyx-content').fadeOut();
	},
	phpThumb: function(cfg){
		Ext.apply(this, cfg);
		this.zc 	= (this.zc == 0)? 0 	: 1;
		this.src 	= (!this.src) 	? '' 	: this.src;
		this.w 		= (!this.w)		? ''	: '&w='+this.w;
		this.h 		= (!this.h)		? ''	: '&h='+this.h;
		// Returns phpThumb src for img tags.
		// SRC must be absolute source or relative to dir.
		
		var filter = '';
		if(cfg.sphere){
			filter = "&f=png&fltr[]=mask|masks/planet.png";
		}else if(cfg.rounded){
			filter = "&f=png&fltr[]=mask|masks/rounded.png";
		}
		return  '/@/libs/phpThumb/phpThumb.php?q=100'+this.w+this.h+'&f=png&zc='+this.zc+filter+'&src='+this.src;
	}
};


