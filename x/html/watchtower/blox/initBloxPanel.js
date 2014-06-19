MyDesktop.bloxPanel = Ext.define('MyDesktop.bloxPanel', {
	extend   : 'Ext.ux.desktop.Module',
	requires : [
		'Ext.tab.Panel'
	],
	
	id       :'bloxPanel-win',
	path     : null,
	
	// this code released under the GPL and (c) 2002 Steve Pomeroy
    draw_ruler : function ( container, width, unit, interval ){
        var r = document.getElementById( container );

        // genocide of the any children (erase any old ruler ticks)
        while( r.hasChildNodes() ){
        r.removeChild( r.firstChild );
        }

        // set the ruler's width
        r.setAttribute( "style", "width: " + width + unit );

        for( var i = 0; i < width * interval; i++ ){
            var newcell;
            if( i % interval == 0 ){
                // major ticks
                newcell = document.createElement('div');
                newcell.setAttribute( "class", 'majortick' );
                newcell.setAttribute( "style", "left: " + (i/interval) + 
                unit + "; " + 
                "width: 1"  + unit);
                r.appendChild( newcell );

                // text labels
                newcell = document.createElement('div');
                newcell.setAttribute( "class", 'label' );
                newcell.setAttribute( "style", "left: "+ ((i+1)/interval) + 
                unit + "; " + 
                "width: " + (1/interval) + 
                unit );

                newcell.appendChild( document.createTextNode( i/interval ) ); 
                r.appendChild( newcell );

            }

            // minor ticks
            newcell = document.createElement('div');
            newcell.setAttribute( "class", 'minortick' );
            newcell.setAttribute( "style", "left: " + (i/interval) + unit);
            r.appendChild( newcell );

        }
    },
    buildBlox : function() {
		var source = '#build-a-blox-source-code textarea[name="_CODE_"]';

		var code = {
			css  : $(source.replace('_CODE_','css_code')).val(),
			html : $(source.replace('_CODE_','html_code')).val(),
			js   : $(source.replace('_CODE_','js_code')).val()
		};

		code.css = '<style type="text/css">' + code.css + '</style>';
		
		var iframeBody = $('#blox-iframe iframe').contents().find('body');

		iframeBody.html(
			code.css + code.html 
		);
 
		var script=document.createElement('script');
		script.type='text/javascript';
		script.innerHTML = code.js;

		iframeBody.append(script); 
	},
	init     : function(){
	    // this.launcher = {
	    //     text: 'supportTicket',
	    //     iconCls:'tabs'
	    // };

		// var path  = $('#no-desktop');
		// this.path = path.clone();
		// path.remove(); 

		x4.direct('xBlox');

		$('.blox-body').click(this.clickEvent);

		this.blueprint_form = Ext.create('Ext.form.Panel',{
			dock          : 'bottom', 
			id            : 'blueprint_form', 
			frame         : true,
			shadow        : false, 
			unstyled      : true,
			bodyStyle     : 'padding:5px 5px 0', 
			fieldDefaults : {
				labelAlign : 'side',
				msgTarget  : 'side'
	        },
	        layout: 'hbox', 
	        api : {
	        	save  : $$.xBlox.blueprint,
	        	load  : $$.xBlox.blueprint
	        }, 
	        paramOrder : ['crud','a'],
	        defaults: {
				border    : false,
				xtype     : 'textfield',
				flex      : 1,
				layout    : 'anchor',
				anchor    : '95%',

				margin  :'0 5 0 0',
				bodyStyle : 'padding:5px 5px 0 0'
	        }, 
	        items : [{
				fieldLabel : 'Label',							
				id         : 'blueprint_label',
				name       : 'blueprint_label'
			},{ 
				fieldLabel : 'Architect', 
				readOnly   : true,
				value      : Ext.util.Cookies.get('user[username]'),
				name       : 'blueprint_architect'
			},{ 
				fieldLabel : 'Architect Email',
				readOnly   : true,
				value      : Ext.util.Cookies.get('user[email]'),
				name       : 'blueprint_architect_email'
			},{
				fieldLabel : 'Domain Origin',
				readOnly   : true,
				value      : location.origin,
				name       : 'blueprint_domain_origin'
			},{
				xtype : 'hidden',
				name  : 'blueprint_body'
			},{
				xtype : 'hidden',
				name  : 'id'
			}] 
		});

		

		this.panel = Ext.create('Ext.tab.Panel', { 
			layout    : 'fit',
			width     : '100%',
			height    : '100%',
			cls       : 'blue-paper',
			bodyStyle : 'background: transparent',
			items     : [{
				title     : 'Blueprints',
				iconCls   : 'x-icon-16x16-blueprint-0',
				layout    : 'border',
				bodyStyle : 'background: transparent',
				bodyCls   : 'blue-paper',
				items     : [ this.tree = this.returnTree() ,{
					region    : 'center',
					layout    : 'border', 
					items: [{
						region    : 'center',
						layout    : 'fit',
						contentEl : 'no-desktop',
						title     : 'Blueprint'
					},{ 
						region      : 'east',
						title       : 'Tools', 
						iconCls		: 'x-icon-16x16-wrench',
						width       : '10%',
						maxWidth    : 150,
						minWidth    : 85,
						collapsible : true,
						// split        : true,
						collapseMode : 'mini',
						//header       : false,
						layout       : 'fit',
						// padding      : '5', 
						defaults     : {
							iconAlign : 'top',
							scale     : 'large'
			            },
			            layout: {
							type    :'vbox',
							padding :'5',
							align   :'stretch'
			            },
			            defaults:{ 
							margin  :'0 0 5 0',
							bodyCls : 'punch',
							scope   : this
			            }, 
						bodyStyle   : 'background: transparent',
						dockedItems : [{
							title       : 'Dimension', 
							id          : 'blox-dimension-form',
							dock        : 'bottom',
							xtype       : 'form',
							defaultType : 'textfield', 
							defaults    : {
								labelWidth : 25,
								padding    : '0 5px 0 5px',
							},

							items : [{ 
								fieldLabel : 'ID',
								id         : 'blox-dimension-id',
								listeners  : {
									change : function(t,n,o,eOpts){
										var s = x4.bloxPanel.selectedElement;
										if(false === s.hasClass('blox-body') ){
											s.attr({
												id : n
											});
										}
									}
								}
							},{ 
								fieldLabel : 'W',
								id         : 'blox-dimension-w'
							},{
								fieldLabel : 'H',
								id         : 'blox-dimension-h'
							},{
								fieldLabel : 'X',
								id         : 'blox-dimension-x'
							},{
								fieldLabel : 'Y',
								id         : 'blox-dimension-y'
							}],
							buttons : [{
								text    : 'Set',
								flex    : 1,
								iconCls : 'x-icon-16x16-vector',
								handler : function () {
									var e = $('.blox-selected');

									function getDim (d) {

										var v = Ext.getCmp('blox-dimension-'+d).getValue();
										$('.blox-selected').children('fieldset').find('[name="legend['+d+']"]').val(v) ;

										return v;
									}

									e.css({
										width  : getDim('w'),
										height : getDim('h'),
										top    : getDim('y'),
										left   : getDim('x')
									}); 

									


								}
							}], 
						}],
						bodyCls     : 'blue-paper',
			            items:[{
							xtype   : 'button',
							text    : '<img src="{$ICON.48}blueprint.png" align="absmiddle" ><br/>{$LANG.XBLOX.BTN1} ',
							flex    : 1,
							scope   : this,
							handler : this.newElement
			            },{
							xtype   :'button',
							text    : '<img src="{$ICON.48}blueprint2.png" align="absmiddle" ><br/>{$LANG.XBLOX.BTN2} ',
							flex    : 1,
							handler : this.copyElement
			            },{
							xtype   :'button',
							text    : '<img src="{$ICON.48}Badge-multiply.png" align="absmiddle" ><br/>{$LANG.XBLOX.DELETEBTN} ',
							flex    : 1,
							handler : this.deleteElement
			            },{
							xtype   :'button',
							text    : '<img src="{$ICON.48}blueprint3.png" align="absmiddle" ><br/>{$LANG.XBLOX.BTN3}',
							flex    : 1,
							scope   : this,
							handler : this.redrawElement
			            }/*,{
							xtype   :'button',
							text    : '<img src="{$ICON.48}blueprint4.png" align="right" > {$LANG.XBLOX.BTN4}',
							flex    : 1,
							handler : this.newElement
			            },{
							xtype   :'button',
							text    : '<img src="{$ICON.48}blueprint6.png" align="right" > {$LANG.XBLOX.BTN6}',
							flex    : 1,
							handler : this.newElement
			            }, {
							xtype   :'button',
							text    : '<img src="{$ICON.48}blueprint.png" align="absmiddle" ><br/>{$LANG.XBLOX.BTN8} ',
							flex    : 1,
							handler : this.loadBlueprint
			            }*/]
					},{
						region       : 'south',
						layout       : 'fit',
						contentEl    : 'ruler2',
						height       : '10%',
						bodyCls      : 'ruler2',
						cls          : 'ruler2', 
						header       : false,
						collapsible  : true,
						collapseMode : 'mini',
						resizable    : false,
						split        : true,
						unstyled     : true,
						dockedItems   : [ this.blueprint_form ]
					}]
				}] 
			},{
				title   : 'Build a Blox',
				iconCls : 'x-icon-16x16-blueprint-0',
				layout  : 'border',
				items   : [{
					title  : 'Saved Blox',
					region : 'west',
					width  : '20%',
					type   : 'border',
					items  : [{
						region : 'center'
					}]

				},{
					title    : 'Source',
					region   : 'center',
					layout   : 'border',
					type     : 'form',
					split : true,
					defaults : { 
						margin:'0 0 5 0',
						labelAlign : 'top'
						 
					},
                    items:[{
						region : 'east', 
						width : 100, 
						layout: {
							type    :'vbox',
							padding :'5',
							align   :'stretch'
                        },
                        defaults: { margin:'0 0 5 0'},
                        items:[{
							xtype :'button',
							text  : 'Build',
							flex  : 2,
							handler : this.buildBlox
                        },{
							xtype :'button',
							text  : 'Tidy',
							flex  :1
                        },{
							xtype :'button',
							text  : 'JSHint',
							flex  :1
                        },{
							xtype  :'button',
							text   : 'Save',
							flex   :2,
							margin : 0,
							handler : this.saveBlox
                        }]
					},{ 
						region : 'center',
						layout : 'border',
						id 	   : 'build-a-blox-source-code',
						items : [{
							region       : 'north',
							xtype        :'textarea',
							flex         : 1,
							height       : '15%',
							collapsible  : true,
							split        : true,
							collapseMode : 'mini',
							name 		 : 'css_code'
	                    },{ 
							region       : 'center',
							xtype        :'textarea', 
							flex         : 1,
							height       : '70%',
							collapsible  : true,
							split        : true,
							collapseMode : 'mini',
							name 		 : 'html_code'
						},{
							region       : 'south',
							xtype        :'textarea', 
							flex         : 1,
							height       : '15%',
							collapsible  : true,
							split        : true,
							collapseMode : 'mini',
							name 		 : 'js_code'
	                    }]
                    }]
				},{
					title        : 'Result',
					collapsible  : true,
					split        : true,
					collapseMode : 'mini',
					region       : 'east', 
					layout       : 'fit', 
					width        : '50%',
					// defaults : {
					// 	layout : 'fit'
					// },
					items        : [new Ext.create('Ext.ux.IFrame',{
						 
						id     : 'blox-iframe',
						name   : 'result', 
						html : 'Enter Your Code and Click Build.'
					})]
				} ],
			}],
			renderTo  : x4.activeArea[0]
		}); 

        this.draw_ruler( "ruler2", 24, "in", 16 );


        // $('.blox-html').ruler({
        //     vRuleSize     : 20,
        //     hRuleSize     : 20,
        //     showCrosshair : false,
        //     showMousePos  : false
        // });    

        // $('.vRule,.hRule').css({
        //     opactiy : 0.05,
        //     position: 'absolute'
        // });

        $('.blox-html').css({ width: '100%' })
        

	},

	returnTree : function (){
		var ticket_store = Ext.create('Ext.data.TreeStore', {
			root  : { 
				expanded : true,
				visible  : false
			},	
			rootVisible : false,
			autoLoad    : false,
			proxy : {
				type        : 'direct',
				directFn    : $$.xBlox.blueprintTree,
				paramOrder  : ['node'],
				extraParams : {
					crud : 'read'
				}
	        }
	    });

		return Ext.create('Ext.tree.Panel', {
			store        : ticket_store,
			layout       : 'fit',
			region       : 'west',
			bodyPadding  : 0,
			title        : 'Saved Blueprints',
			iconCls      : 'x-icon-16x16-blueprint-3',
			width        : 200,
			collapsed    : false,
			collapsible  : true,
			collapseMode : 'mini',
			rootVisible  : false,
			buttons : [{
				xtype   :'button',
				text    : '<img src="{$ICON.48}blueprint5.png"   ><br/> {$LANG.XBLOX.BTN5}',
				flex    : 1,
				iconAlign : 'top', 
				scope   : this,
				handler : this.newBlueprint
            },{
				xtype   :'button',
				text    : '<img src="{$ICON.48}blueprint sticky.png" align="absmiddle" ><br/>{$LANG.XBLOX.BTN7} ',
				flex    : 1,
				scope   : this,
				handler : this.saveBlueprint
            }],
			listeners : {
				itemclick : function(view, record) {
                //some node in the tree was clicked
                //you have now access to the node record and the tree view
                // record.get('id')
                x4.bloxPanel.blueprint_form.getForm().load({
			        params: {
			        	crud : 'read',
			            a : {
			             	id : record.get('id')
			            }
			        },
			        success : function(f,result){ 
			        	$('.blox-body').html(JSON.parse(result.result.data.blueprint_body));
						x4.bloxPanel.applyDragEvents($('.blox-body div'));
			        }
			    });
                //now you have all the information about the node
                //Node id
                //Node Text
                //Parent Node
                //Is the node a leaf?
                //No of child nodes
                //......................
                //go do some real world processing
            	}
            }
		});
	},
	
	newBlueprint : function  () {
		var blox_body = $('.blox-body div').remove();
		this.blueprint_form.getForm().reset();

		this.selectedElement = $('.blox-body').addClass('blox-selected');
	},
	saveBlueprint : function  () {
		// Get the Body.
		var blox_body = $('.blox-body');

		form = this.blueprint_form.getForm();

		var $data = form.getValues();

		// JSONIFY
		$data.blueprint_body = JSON.stringify($('.blox-body').html());

		// // DIRECT
		$$.xBlox.blueprint('create',$data,function($data){
			// Callback
			if(true == $data.success){
				Ext.Msg.alert('Success!','Your Blueprint has been Saved!');	
				x4.bloxPanel.tree.store.reload();
			}else{
				Ext.Msg.alert('Failed!','ERROR:'+$data.error)
			}
		});


	},

	createWindow : function(el){ 
		var desktop = myDesktopApp.getDesktop();
		var win     = desktop.getWindow('bloxPanel-win');

	    if(!win){
	        win = desktop.createWindow({        
				//id   : 'supportTicket-win',
				title  : '{$LANG.LOGIN.CREATE_ADMIN}',
				width  : $(window).width()/2,
				height : $(window).height()/2,
				layout : 'fit',
				items  : x4.bloxPanel
	        });
	    }
	    return win;
	},

	selectedElement : $('.blox-body'), 
    clickEvent : function  (e) {
        e.stopPropagation(); 
        $('.blox-selected').addClass('blox-deselected').removeClass('blox-selected');
        $(this).addClass('blox-selected').removeClass('blox-deselected');  
        x4.bloxPanel.selectedElement = $(this); 

        x4.bloxPanel.readDimensions( $(this) );
        // Put values into legend. 
    },

    sprite : {
		brick       : "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAALklEQVQYV2O8++m/jzIf4xYGAoBxABWCnAayHtmJIDejizFi8wM2dw+0QmI8AwAiby4/aZdGTwAAAABJRU5ErkJggg==)",
		grid        : 'url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAM0lEQVQYV2PkN0oxZiACMIIUfjw35yyyWi7jNMlvZ2c9RxYbaIW/GZmeEfLPQLuRmHAEANlSQ585pZIGAAAAAElFTkSuQmCC)',
		yellowBrick : 'url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAJ0lEQVQIW2NkQAP/XzH8Z0QWAwuIMTDCBWECIEVgQZgAXCWyCpgCAGiDFNaUfKHTAAAAAElFTkSuQmCC)',
		darkBrick   : 'url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAKElEQVQIW2NkQAMWFhb1jMhiIIETJ040wgVhAiBFYEGYAFwlsgqYAgBclxZU/dTbJgAAAABJRU5ErkJggg==)',
		div         : 'url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAMklEQVQYV2NkIBIwEqmOgUYKjx8/fgbkBEtLSxMQDeKD2Mg02GpsEpQrxGY1sm3U9zUAD+xBbmnFMWAAAAAASUVORK5CYII=)',
		html        : 'url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAARElEQVQYV2NkIBIwgtQdP378jKWlpQmMhonBzADJwRUiC8LYyBpxmohsE4gNVkgMIE0hyC3obkR2H9xqkhQSFTzEeAYAoCw8Cw0RmdUAAAAASUVORK5CYII=)',
		blox        : 'url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAQklEQVQYV2NkIBIwgtQdP378DIi2tLQ0gekDiSHzURQiKyZJIcx0kMlgE4kBBK2GOQGuEGQ8uruQ+aSZSLQbiVEIAAywPAtUM9veAAAAAElFTkSuQmCC)',
		img         : 'url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAU0lEQVQYV2NkQALHjx8/Y2lpaYIsBmMzwhgwRbgUgxUiKwLxsZnKiG4SiA+zBVkDion4nAF3Iy5FMBtRFOLyEEgcp4nIngSxMRTiCgWsCtFNA/EB8f5XLD5iSb4AAAAASUVORK5CYII=)',
		vid         : 'url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAT0lEQVQYV2NkIBIw4lJ3/PjxMzA5S0tLE6wKQYpAkjCFID6KQmQF6GwME7EpRjERn2kYbsSlGORWRmwOh3kEWQ7sRnwmwXwO9wx6uKGHLwDm6k1uMLnm5AAAAABJRU5ErkJggg==)',
		spiral      : 'url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAWUlEQVQYV3WQsQ3AMAgEw05p2L+gyVDxW0I6bKAxwsc/YM+KiPjc/VU+hRFSTpDNlh+datb0brBTTbV0KeDZILgFqU5b1ccZL3DamjMqv5bheShSrM9j844/1S5jsJPX0zMAAAAASUVORK5CYII=)',
		body        : 'url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAASklEQVQYV2NkIBIwgtQdP378DIi2tLQ0QeYji6EohEmANII0wWiQOE6FMBfBbAErJAbgdCNOq9ElkN2H4UaYe2A+R+aT5kZiPAMAsN08Cz17CIEAAAAASUVORK5CYII=)',
		nav         : 'url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAARUlEQVQYV2NkYGBIA2IQmAVlg2gMwEiqQphpMJNxmoiuEOQcFCeArEYHMEUoinEphGmGm0qRichOgTsDm4lkKQRpApsKAMfAEdeV1OJMAAAAAElFTkSuQmCC)'
    },

    dummyElement : function () {

        // Lets make a copy of the legend....
         
        form = this.selectedElement.children('.blox-key').clone(true);

        var el = this.applyDragEvents($('<div/>')
            .click(x4.bloxPanel.clickEvent)
            .css({
                // position : 'absolute',
                width    : '94%',
                height   : '94%',
                left     : '3%',
                top      : '3%', 
                margin   : 0,
                padding  : 0,
               	overflow : 'hidden',
                display : 'none'
                // resize : 'both'
                //border        : '1px dashed rgba(255,255,255,.5)',
                // borderTop    : 0,
                // borderBottom : 0,
                //background      : this.sprite.grid,
            })
        );

        form.appendTo(el);
        return el;

    },

    applyDragEvents : function  (element) { 
        // Make all children draggable. 


        element.find('.ui-resizable-handle').remove();
        element.resizable().resizable("destroy").resizable({
                snap        : true
        });

        element.children('.blox-deselected').each(function() {   
            $(this).find('.ui-resizable-handle').remove();  
            $(this).resizable().resizable("destroy");

            x4.bloxPanel.applyDragEvents($(this)); 
            console.log($(this));
           // x4.bloxPanel.applyResizeEvents($(this))
            // body...
        }); 

        //element = x4.bloxPanel.applyResizeEvents(element); 
        return element.click(this.clickEvent)
            .addClass('blox-selected')
            .addClass('blox-selected')
            .draggable({ 
				snap        : true,
				//grid        : [ 1, 1 ], 
				containment : 'parent', 
				cursor      : 'move', 
				distance    : 5,
				drag        : function() { 
					var left       = $(this).css('left').replace('px','');
					var whole_width = $(this).parent().width();
					left = ((left / whole_width) * 100).toFixed(0)+'%';
                    $(this).children('fieldset').find('[name="legend[x]"]').val(left);
                    Ext.getCmp('blox-dimension-x').setValue(left); 
                    $(this).css('left', left);

					var top       = $(this).css('top').replace('px','');
					var whole_height = $(this).parent().height();
					top = ((top / whole_height) * 100).toFixed(0)+'%';

                    $(this).children('fieldset').find('[name="legend[y]"]').val(top) ;
                    Ext.getCmp('blox-dimension-y').setValue(top); 



                    $(this).css('top', top); 
                } ,
                stop: function( event, ui ) {
                	UI = ui;
                	x4.bloxPanel.readDimensions($(ui));  
                }
                //cursorAt: { top : this.selectedElement.height()/2, left : this.selectedElement.width()/2 } 
            }).resizable({
                snap        : true,  
                //grid        : [ 10, 10 ], 
                //handles : element.children('.blox-deselected'),
                containment : 'parent',
                resize: function() { 
                    //$(id+'p').val(Math.round($(this).css('position'));

                	$(this).css({
                		fontSize :  ($(this).width() + $(this).height) / 100
                	});

                	var width       = Math.round($(this).width());
					var whole_width = $(this).parent().width();
					width = ((width / whole_width) * 100).toFixed(0)+'%';
                    // $(this).children('fieldset').find('[name="legend[x]"]').val(width);
                    $(this).css({
						width : width
					});

					var height       =  Math.round($(this).height());
					var whole_height = $(this).parent().height();
					height = ((height / whole_height) * 100).toFixed(0)+'%';

                    // $(this).children('fieldset').find('[name="legend[y]"]').val(height);

                    $(this).children('fieldset').find('[name="legend[w]"]').val(width);
                    Ext.getCmp('blox-dimension-w').setValue(width);
                    $(this).children('fieldset').find('[name="legend[h]"]').val(height);
                    Ext.getCmp('blox-dimension-h').setValue(height);

					$(this).css({
						height : height
					});
                	// $(id+'z').val(Math.round($(this).css('z-index')); 
                } 
            })
        ;
    },

    readDimensions : function  ($e,d) { 

    	if($e.attr('id') != ''){
    		Ext.getCmp('blox-dimension-id').setValue($e.attr('id'));	
    	}


    	if("undefined" != typeof $e.css('left')){ 
	    	switch(d){
	    		case('w&h'):
	    			$e.css({
	            		fontSize :  ($e.width() + $e.height) / 100
	            	});

	            	var width       = Math.round($e.width());
					var whole_width = $e.parent().width();
					width = ((width / whole_width) * 100).toFixed(0)+'%';
	                // $e.children('fieldset').find('[name="legend[x]"]').val(width);
	               

					var height       =  Math.round($e.height());
					var whole_height = $e.parent().height();
					height = ((height / whole_height) * 100).toFixed(0)+'%'; 

	                $e.children('fieldset').find('[name="legend[w]"]').val(width);
	                Ext.getCmp('blox-dimension-w').setValue(width);
	                $e.children('fieldset').find('[name="legend[h]"]').val(height);
					Ext.getCmp('blox-dimension-h').setValue(height);

					$e.css({
						width : width,
						height : height
					});
	    		break;

	    		case('x&y'):
	    			

		    			var left       = $e.css('left').replace('px','');
						var whole_width = $e.parent().width();
						left = ((left / whole_width) * 100).toFixed(0)+'%';
		 

		                $e.children('fieldset').find('[name="legend[x]"]').val(left);
		 				Ext.getCmp('blox-dimension-x').setValue(left);


		                $e.css('left',left);

		 				x4.log('left:'+left);


						var top       = $e.css('top').replace('px','');
						var whole_height = $e.parent().height();
						top = ((top / whole_height) * 100).toFixed(0)+'%'; 
		 

		                $e.children('fieldset').find('[name="legend[y]"]').val(top); 
		                Ext.getCmp('blox-dimension-y').setValue(top); 

		                $e.css('top',top);


	    		break;
	    		default:
	    			this.readDimensions($e,'x&y');
	    			this.readDimensions($e,'w&h');
	    		break;
	    	}


		}
    },

    applyResizeEvents : function  (element) {
        element.find('.ui-resizable-handle').remove(); 
        return element.resizable({
            snap        : true, 
            grid        : [ 5,5 ], 
            containment : 'parent'
        });
    },

    redrawElement : function  () {
    	x4.bloxPanel.selectedElement = x4.bloxPanel.dummyElement();
    	$('.blox-selected').html( x4.bloxPanel.selectedElement.html() );
    },

    newElement : function  () {
        this.selectedElement = this.dummyElement().appendTo(
            this.selectedElement.addClass('blox-deselected').removeClass('blox-selected')
        ).slideDown(); 

        if(!this.selectedElement.parent().hasClass('.block-body')){

        }

        // this.selectedElement
        // console.log(this.selectedElement);

        // Add a default element to active element.
        // Activate this element.
    },

    deleteElement : function  () { 
    	var s = $('.blox-selected');
    	if(false === s.hasClass('blox-body')){ 
	    	x4.bloxPanel.selectedElement = s.parent().addClass('blox-selected').removeClass('blox-deselected');
	    	s.remove();
    	}else{
    		Ext.Msg.alert('Nothing to Remove!','The Workbench has been cleared.')
    	}
    },

    copyElement : function  () { 
        if(!this.selectedElement.hasClass('blox-body')){

            var se = this.selectedElement.clone(); 

            se.appendTo(this.selectedElement.parent());

            //se.find('.ui-resizable-handle').remove(); 
            se = this.applyDragEvents(se); 

            this.selectedElement.addClass('blox-deselected').removeClass('blox-selected'); 

            this.selectedElement = se;

            this.selectedElement.animate({
                // top  : '+=75',
                left : '+='+	(this.selectedElement.width()/8),
                top : '+='+		(this.selectedElement.height()/8)
            });
        }else{
            alert('Please Select an Element other then the Body');
        }
       
    },

    updateCords : function  (form) {
    	$(form).parents('.blox-selected').css({
			top    : $(form).find('[name="legend[y]"]').val(),
			left   : $(form).find('[name="legend[x]"]').val(),
			width  : $(form).find('[name="legend[w]"]').val(),
			height : $(form).find('[name="legend[h]"]').val(),
			zIndex : $(form).find('[name="legend[z]"]').val(),
    	});
    },

	returnForm : function(area,field) {
		switch (area){
			default:
				return this.returnBloxPanelForm(area);
			break;
		}
	},



	returnBloxPanelForm : function (type){
		return Ext.create('Ext.form.FormPanel',{
			layout	: 'form',
			frame	: true,
			items	: [],
			buttons	: [{
				text      : 'Grant Administration Access',
				iconAlign : 'right',
				iconCls   : 'x-icon-32x32-lock',
				scale     : 'large'
			}]
		})
	}
}); 

Ext.onReady(function() {
	x4.bloxPanel = new MyDesktop.bloxPanel(); 
	//x4.activeArea.sortable('destroy');
		
});
// var d = myDesktopApp.getDesktop(), me = new MyDesktop.supportTicket(); 
// d.restoreWindow(me.createWindow());