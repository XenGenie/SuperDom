 
<script type="text/javascript" src="/fileServer/js/ext-3.2.1/examples~ux~statusbar~StatusBar.js"></script>

<script type="text/javascript">
	var iframeLoc = null;
	x4.loadElement = function (element,icon){
		cssElement = element;
		Ext.Msg.wait('Please Wait...','Loading Element: '+element);

		var pan = Ext.getCmp('style-editor');
		pan.expand();
		
		Ext.getCmp('css-style-prop-grid').setTitle(element);
		Ext.getCmp('css-style-prop-grid').setIconClass('x-icon-16x16-'+icon);
		  
		cssStore.load({
			params: {
				'style'		: costume,
				'element'	: element,
				'show_null'	: Ext.getCmp('show-null').getValue()
			},
			success: function(f,a){ 
				
				Ext.Msg.hide();
				Ext.getCmp('element-chooser').close();
			},
			failure: function(){
				Ext.Msg.hide();
			}
		});
			
	};
 
	Ext.onReady(function(){
		
		costume = '{$www_costume}';

				
		x4.Window({ 
			id		: 'editor',
			title	: 'Costume-izer',
			iconCls	: 'x-icon-16x16-wand', 
			layout	: 'border',
			width	: $(window).width()*.75, 
			height	: $(window).height()*.75,
			tools	: [{
				id	: 'refresh',
				handler	: function(){
					document.getElementById('iframe').src = document.getElementById('iframe').src;
				}

			}],
			defaults	: {
				border	: 0,
			},
			
			items: [{
				title	: 'CSS Editor',
				iconCls	: 'x-icon-16x16-css',
				id		: 'style-editor',
				collapsible	: true,
				collapsed	: true,
				collapseMode: 'mini', 
				tbar	: [{
					text	: 'New Selector',
					iconCls	: 'x-icon-16x16-css_add', 
					handler	: function(){
						
						Ext.Msg.prompt('Please Enter the name of your style selector','".example" for classes; "#example" for elements',function(btn,promp){
							if(btn == 'ok'){ 
								if(promp[0] != '.' && promp[0] != '#'){
									Ext.Msg.alert('Your selector does not identify an id or class.');
									 
								}
								x4.loadElement(promp,'css_add');
							}
						});
						
					}
				},'->','-', new Ext.form.ComboBox({  
				    id	: 'css-element-list',  
				    emptyText : 'Search for an Selector',
				    store: new Ext.data.JsonStore({  
					    autoLoad: false,
				    	url: '/{$toBackDoor}/{$Xtra}/getElements/?json',
				    	root: 'data', 
				        fields : [{
					        name: 'id'
						},{
							name: 'element'
						}]  
				    }),  
				    valueField: 'element',  
				    displayField: 'element', 
				    //hiddenName: 'active_id',  
				    mode: 'remote',  
				    minChars : 0 ,
					width:140,
					listeners: {
						select: function(cb,r,i){ 
						 	x4.loadElement(cb.getValue()); 
						}
					}
				})],
				
				hideCollapseTool: true,
				split: true,
				width	: 250,
				region	: 'east', 
				buttonAlign: 'center',
				buttons	: [{
					text: 'Save Style',
					iconAlign : 'bottom',
					iconCls: 'x-icon-16x16-disk',
					handler	: function(){
						$.post('/{$toBackDoor}/layout/updateElement/',{ 
							costume : costume,
							element	: (cssElement) ? cssElement : 'HTML',
							data	: Ext.getCmp('css-style-prop-grid').getSource()
						},function(data) {
							ume.msg(cssElement,'Updated and Live');
							Ext.getCmp('style-editor').collapse();
						});
					}
				}],
				border	: 0,
				layout	: 'fit',
				items	: [{
					xtype	: 'tabpanel',
					activeTab	: 'css-style-prop-grid',
					defaults	: {
						border	: 0,
					},
					items	: [{
						title	: 'Wysiwyg',
						layout	: 'accordion', 
						disabled	: true,
						iconCls	: 'x-icon-16x16-eye',
						defaults: {
							layout	: 'accordion',
							frame	: true,
						},
						fileUpload	: true,
						xtype	: 'form',
						items	: [{
							title	: 'Styling',
							iconCls	: 'x-icon-16x16-palette',
							defaults: {
								layout	: 'form',
								defaultType	: 'fieldset',
							},
							items	: [{
								title	: 'Background',
								iconCls	: 'x-icon-16x16-color_swatch',
								items	: [{
									title	: 'Color Properties',
								},{
									title	: 'Image Properties',
									labelWidth	: 50,
									items	: [{
										xtype	: 'fileuploadfield',
										emptyText: 'Select an image',
							            hideLabel	: 'true',
							            name: 'bg-path',
							            width	: 150,
							            buttonText: 'Upload Image',

							            buttonOnly: true,
							            buttonCfg: {
							                iconCls: 'x-icon-16x16-upload'
							            }
									}]
								}]
							},{
								title	: 'Font',
								iconCls	: 'x-icon-16x16-text_letter_omega',
							},{
								title	: 'Lists',
								iconCls	: 'x-icon-16x16-text_list_bullets',
							},{
								title	: 'Links',
								iconCls	: 'x-icon-16x16-link',
							},{
								title	: 'Tables',
								iconCls	: 'x-icon-16x16-table',
							}]
						},{
							title	: 'Box Model',
							iconCls	: 'x-icon-16x16-shape_group',
							items	: [{
								title	: 'Sizing',
								iconCls	: 'x-icon-16x16-shape_handles',
							},{
								title	: 'Border',
								iconCls	: 'x-icon-16x16-picture',
							},{
								title	: 'Outline',
								iconCls	: 'x-icon-16x16-picture',
							},{
								title	: 'Margin',
								iconCls	: 'x-icon-16x16-picture',
							},{
								title	: 'Padding',
								iconCls	: 'x-icon-16x16-picture',
							}]
						},{
							title	: 'Advance',
							iconCls	: 'x-icon-16x16-picture',
							items	: [{
								title	: 'Background',
								iconCls	: 'x-icon-16x16-picture',
							},{
								title	: 'Font',
								iconCls	: 'x-icon-16x16-picture',
							},{
								title	: 'Lists',
								iconCls	: 'x-icon-16x16-picture',
							},{
								title	: 'Links',
								iconCls	: 'x-icon-16x16-picture',
							},{
								title	: 'Tables',
								iconCls	: 'x-icon-16x16-picture',
							}]
						}]
					},new Ext.grid.PropertyGrid({
						title	: 'CSS',
						//title	: 'Editing ',
						layout	: 'fit',
						frame	: true,
						iconCls	: 'x-icon-16x16-css',
						buttonAlign	: 'center',
						border	: 0,
						buttonDefaults	: {
							
						},
						buttons	: [{
							text	: 'Import CSS',
							iconCls : 'x-icon-16x16-css_add',
							iconAlign: 'top', 
							handler	: function(){
								Ext.Msg.wait(x4.lang.wait,'Loading Import Tool')
								x4.loadZyx('/{$toBackDoor}/{$Xtra}/importCss'); 
							}

						}, {
							text	: 'Full Editor',
							iconCls	: 'x-icon-16x16-css_go',
							iconAlign: 'top',
							handler	: function(){
								Ext.Msg.wait('Loading Full Editor',x4.lang.wait);
								x4.loadZyx('layout/editor');
							} 
						}, {
							text	: 'Text Editor',
							iconCls	: 'x-icon-16x16-css_valid',
							iconAlign: 'top',
							disabled	: true,
							handler	: function(){
								//x4.loadZyx('layout/editor');
							} 
						}], 
						bbar	: ['->',{
							xtype	: 'checkbox',
							checked	: true,
							id	: 'show-null',
							boxLabel	: 'Show Empty Fields',
							listeners	: {
								check	: function(){
							 		x4.loadElement(cssElement);
								} 
							}
						}],
						id		: 'css-style-prop-grid',
						store	: cssStore = new Ext.data.JsonStore({
							autoSave: false, 
						    //autoDestroy: true,
							id	: 'cssStore',
							proxy : new Ext.data.HttpProxy({
								api: {
							        read    : '/{$toBackDoor}/layout/getElement/',
							        create  : '/{$toBackDoor}/layout/createElement/',
							        update  : '/{$toBackDoor}/layout/updateElement/',
							        destroy : '/{$toBackDoor}/layout/destroyElement/'
							    }
							}),
						    //storeId: 'cssStore',
						    writer : new Ext.data.DataWriter({
						    	writeAllFields  : true,
						        encode: false   // <--- false causes data to be printed to jsonData config-property of Ext.Ajax#reqeust
						    }),
						    // reader configs 
						    baseParams: [
								costume, 'html'
							],
							root: 'data',  
						    fields: {$store_fields},
							listeners: {
								update: function(s,rec,op){
									alert(op);
								},
					            load: function(store, records, options){
									// get the property grid component
					                var propGrid = Ext.getCmp('css-style-prop-grid');
					                // make sure the property grid exists
					                if (propGrid) {
					                    // populate the property grid with store data
					                    propGrid.setSource(store.reader.jsonData.data);
										Ext.Msg.hide();	
										if(Ext.getCmp('element-chooser')){
											Ext.getCmp('element-chooser').close();	
										}
														                     
					                }
					            }
					        }
						     
						}),
						autoScroll: true,
					    source: {$style_properties},
						listeners	: {
							afterEdit: function(e){
								css = e.record.id.replace('_','-');
								value = e.value;
								$.frameReady( function() {
									cssElement = parent.cssElement;
									css = parent.css;
									value = parent.value;
									$(cssElement).css(css,value);
								  },
								  "top.frontpage"
								);
							}
						}
					}),{
						title	: '3rd Party',
						 iconCls	: 'x-icon-16x16-wrench',
						layout: {
		        	        type:'vbox',
			                align:'stretch'
		                },
						defaultType	: 'button',
						defaults	: {
							flex	: 1,
							margin	: 5
						},
						items	: [{
							text	: 'Ultimate CSS Gradient Generator',
							
						},{
							text	: '0-to-255',
							handler	: function(){
								var win = x4.BFFrame({
									title	: 'www.0to255.com',
									iconCls	: 'x-icon-16x16-palette',
									src		: 'http://www.0to255.com/facade',
									width	: 700,
									height	: 475

								});
								win.show();
								//win.maximize();
							}
						},{
							text	: 'Background Patterns'
						},{
								text	: 'Stripe Generator 2.0',
								handler	: function(btn){
							
									var win = x4.BFFrame({
										title	: 'www.StripeGenerator.com', 
										src		: 'http://www.stripegenerator.com',
										width	: 1000,
										height	: 475
	
									}).show(btn,function(win){
										 
									})
								}								
						}]
					}] 
				}]
			},{ 
				region	: 'center',
				iconCls	: 'x-icon-16x16-palette',
				layout	: 'fit',
				id		: 'theme-editor',
				autoScroll	: false,
				title	: 'Live View',
				bbar	: new Ext.ux.StatusBar({
		            id: 'css-statusbar',
		            statusAlign: 'right',
		            // defaults to use when the status is cleared:
		            defaultText: '<img src="{$ICON.16}/information.png" align="absmiddle" />   Click the Page to begin Costumize-ing... <img src="{$ICON.16}/mouse.png" align="absmiddle" />',
		            //defaultIconCls: 'default-icon',
		        
		            // values to set initially:
		           // text: 'Ready',
		           // iconCls: 'x-status-valid',

		            // any standard Toolbar items:
		            items: [  ]
		        }),
				tbar	: [{
					xtype	: 'buttongroup',
					title	: 'Costumes',
					columns: 2,
					items	: [ new Ext.form.ComboBox({  
					    fieldLabel: 'Copy Costume',
					    id	: 'choose-themes',  
					    store: new Ext.data.JsonStore({  
						    autoLoad: true,
					    	url: '/{$toBackDoor}/layout/getThemes/?returnJson',
					    	root: 'data', 
					        fields : [{
						        name: 'id'
							},{
								name: 'name'
							}]  
					    }),  
					    valueField: 'id',  
					    displayField: 'name',
					      
					    //hiddenName: 'active_id',  
					    mode: 'remote',  
					    minChars : 0 ,
						width:125,
						name	: 'form[theme]',
						hiddenName	: 'form[theme]',
						listeners: {
							select: function(cb,r,i){
								var src =  top.frontpage.window.location.href;
								src = src.replace('http://{$HTTP_HOST}/','');
								src = src.replace('?theme='+costume,'');
								
								src = (src == '') ? 'index' : src; 
								
								costume 	= Ext.getCmp('choose-themes').getValue();
								
								document.getElementById('iframe').src = '/'+src+'?theme='+costume;
							}
						}
					}), {
						text: 'Create New Costume',
						iconCls	: 'x-icon-16x16-new',
						handler	: function(){
							var win = x4.Window({
								title	: 'Creating a New Costume',
								iconCls	: 'x-icon-16x16-new',
								width	: 300,
								height	: 150,
								
								modal	: true,
								items	: [{
									xtype	: 'form',
									layout	: 'form',
									frame	: true,
									items	: [new Ext.form.ComboBox({  
									    fieldLabel: 'Copy Costume',
									    id	: 'copy-theme',  
									    store: new Ext.data.JsonStore({  
									    	url: '/{$toBackDoor}/layout/getThemes/?returnJson',
									    	root: 'data', 
									        fields : [{
										        name: 'id'
											},{
												name: 'name'
											}]  
									    }),  
									    valueField: 'id',  
									    displayField: 'name',
									    emptyText: 'Leave Blank for None',  
									    //hiddenName: 'active_id',  
									    mode: 'remote',  
									    minChars : 0  
									}),{
										fieldLabel: 'Label Costume',
										id		: 'label-theme',
										allowBlank: true,
										anchor	: '100%',
										xtype	: 'textfield'
									}],
									buttons	: [{
										text		: 'Create Costume',
										bindForm	: true,
										handler		: function(){
											var theme = Ext.getCmp('label-theme').getValue();
											var copy = Ext.getCmp('copy-theme').getValue();
											Ext.Msg.wait('Creating Costume','Please wait...');
											$.post('/{$toBackDoor}/layout/newTheme/'+theme+'/'+copy,{},function(data) {
												Ext.Msg.alert('Success!',' New Costume has been Created!');
												win.close();
											});
										}
									}]

								}]
							}).show();
						}
					}]
				},'->','-',{
					text	: 'Refresh Costume',
					iconAlign	: 'bottom',
					iconCls	: 'x-icon-16x16-refresh',
					handler	: function(){
						document.getElementById('iframe').src = document.getElementById('iframe').src;
					}
				}],
				//height	: $(document.body).height()-$('#shortcut-panel').outerHeight()-$('#neck-breadcrumbs').outerHeight()-40,
				//renderTo: 'zyx-content', 
				items: new Ext.ux.IFrameComponent({
					width	: '100%',
					height	: '100%',
					layout	: 'fit',
					title	: 'Click something that you would like to edit.',
					iconCls	: 'x-icon-mouse',
					name: 'frontpage',
					id		: 'iframe',
					style	: 'background-color: white',
					onload	: 'loadFrame()',
					url	: '/'
				})
			}]
		}).show(null,function(win){			
			//win.setHeight($(document.body).height()-$('#shortcut-panel').outerHeight()-$('#neck-breadcrumbs').outerHeight()-$('#moonmenu').outerHeight());
			win.maximize();
			win.doLayout();
			Ext.getCmp('choose-themes').setRawValue('{$www_costume}');
			//Ext.getCmp('choose-themes').focus();
			
		});
	
		 
	});
	task = new Ext.util.DelayedTask(function(){
		var html = $('#element-chooser').html();
		if(html != ''){
			$("#element-chooser-div").find('*').hover(function() {
				$(this).siblings().stop().fadeTo(500,0.65);
			}, function() {
				$(this).siblings().stop().fadeTo(500,1);
			});
		}else{
			Ext.getCmp("#element-chooser-div").hide();
			alert('Elements are without an ID or Class');
		}
	});
		

		function fixHeight(height){
			//Ext.getCmp('editor').setHeight(height);
		}
		
		function clickBridge(e){
			var win = Ext.getCmp('element-chooser');
			if(!win){
				win = x4.Window({
					id		: 'element-chooser',
					title	: 'Click an Element to Update',
					iconCls	: 'x-icon-16x16-mouse',
					autoWidth: true,
					autoHeight: true,
					autoScroll: true,
					 
					layout	: 'table',
					modal	: true,
					layoutConfig: {
				        // The total column count must be specified here
				        columns: 3
				    },
					defaults: {
						bodyStyle: 'text-align: center'
					}
					//html	: '<div id="element-chooser-div"  align="center"></div>'
				});
			}

			win.show(null,function(win){
				win.doLayout();
			});
			
			var DIV = Ext.getCmp('element-chooser');

			function addBtn(button,icon){
				var loadEl = function(){ x4.loadElement(button,icon) };
				DIV.add({
					buttons :[{
						text : button, 
						iconCls: 'x-icon-16x16-'+icon,
						handler	: loadEl
					}]
				});
				DIV.doLayout();
			}
			
			if(e['type'] != ''){
				addBtn(e['type'],'tag');
				
			}

			if(e['id'] != ''){
				addBtn('#'+e['id'],'tag_blue');
				
			}
			
			if(e['class'] != ''){
				var classes = e['class'].split(' ');
				for(i in classes){
					if(classes[i] != '' && typeof classes[i] != 'function'){
						addBtn('.'+classes[i],'palette');
					}
				}
			}

			task.delay(500); 
		}
		 
		function loadFrame(){
			 
			$.frameReady(function() {
				//parent.fixHeight($(document).height()+20);
				
				$(document.body).css('cursor','url(/bin/images/cur/wand.cur),default'); 
				$(document).find('*').click(function(){
					var e = new Array();
					e['class'] = $(this).attr('class');
					e['id'] = $(this).attr('id');
					e['href'] = $(this).attr('href');
					var domEl = $(this).get(0);
					e['type'] = domEl.tagName;
					parent.clickBridge(e);
				});
				$(document).find('*').hover(function() {
					var domEl = $(this).get(0);
					if(domEl.tagName != 'SCRIPT'){
						$(this).css('border-color','yellow');
						$(this).siblings().stop().fadeTo(500,0.5);	
					}else{
						$(this).css('display','none');
					}
				}, function() {
					var domEl = $(this).get(0);
					if(domEl.tagName != 'SCRIPT'){
						$(this).css('border-color','');
						$(this).siblings().stop().fadeTo(500,1);
					}else{
						$(this).css('display','none');
					}
				});
				//Ext.Msg.alert('Layout Style','Please Select what you would like to edit');
			  },
			  "top.frontpage"
			); 
		}
</script>
