
<script type="text/javascript">
	var iframeLoc = null;
	Ext.onReady(function(){
		costume = '{$www_costume}';
		x4.Window({ 
			id		: 'editor',
			title	: 'Costume-ize',
			iconCls	: 'x-icon-16x16-paintcan',
			maximized: true,
			layout	: 'border',
			items: [{
				title	: 'Updating Style ',
				iconCls	: 'x-icon-16x16-palette',
				id		: 'style-editor',
				collapsible	: true,
				//collapsed	: true,
				width	: 250,
				region	: 'east',
				layout	: 'fit', 
				items	: [new Ext.grid.PropertyGrid({
					//title	: 'Editing ',
					layout	: 'fit',
					bbar	: [{
						xtype	: 'checkbox',
						checked	: true,
						id	: 'show-null',
						boxLabel	: 'Show Empty Fields',
						listeners	: {
							check	: function(){
						 		loadElement(cssElement);
							} 
						}
					},'->','-',{
						text: 'Save Style',
						iconCls: 'x-icon-16x16-database_save',
						handler	: function(){
							$.post('/{$toBackDoor}/costumeize/updateElement/',{ 
								costume : costume,
								element	: (cssElement) ? cssElement : 'HTML',
								data	: Ext.getCmp('property-grid').getSource()
							},function(data) {
								Ext.Msg.alert('Success!',cssElement+' Updated and Live');
								Ext.getCmp('style-editor').collapse();
							});
						}
					}], 
					id		: 'property-grid',
					store	: cssStore = new Ext.data.JsonStore({
						autoSave: false, 
					    //autoDestroy: true,
						id	: 'cssStore',
						proxy : new Ext.data.HttpProxy({
							api: {
						        read    : '/{$toBackDoor}/costumeize/getElement/',
						        create  : '/{$toBackDoor}/costumeize/createElement/',
						        update  : '/{$toBackDoor}/costumeize/updateElement/',
						        destroy : '/{$toBackDoor}/costumeize/destroyElement/'
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
				                var propGrid = Ext.getCmp('property-grid');
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
							// execute an XHR to send/commit data to the server, in callback do (if successful):
							
							// UGH! couldnt get the propertygrid & store to work right...
							// jquery to the rescue... 
							
			
							
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
				})]
			},{ 
				region	: 'center',
				iconCls	: 'x-icon-16x16-palette',
				layout	: 'fit',
				id		: 'theme-editor',
				autoScroll	: false,
				tbar	: [{
					text	: 'Refresh',
					iconCls	: 'x-icon-16x16-refresh',
					handler	: function(){
						document.getElementById('iframe').src = document.getElementById('iframe').src;
					}
				},'-','Choose Costume',new Ext.form.ComboBox({  
				    fieldLabel: 'Copy Costume',
				    id	: 'choose-themes',  
				    store: new Ext.data.JsonStore({  
					    autoLoad: true,
				    	url: '/{$toBackDoor}/costumeize/getThemes/?returnJson',
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
				}),'-',{
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
								    	url: '/{$toBackDoor}/costumeize/getThemes/?returnJson',
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
										$.post('/{$toBackDoor}/costumeize/newTheme/'+theme+'/'+copy,{},function(data) {
											Ext.Msg.alert('Success!',' New Costume has been Created!');
											win.close();
										});
									}
								}]

							}]
						}).show();
					}
				},'->',{
					text	: 'Open Advanced Editor',
					iconCls	: 'x-icon-16x16-page_white_paint',
					handler	: function(){
						x4.loadZyx('costumeize/editor');
					}

				},{
					text	: 'Import CSS',
					iconCls : 'x-icon-16x16-css',
					handler	: function(){
						x4.BFFrame({
							title	: 'Import CSS',
							src : "/{$toBackDoor}/{$Xtra}/importCss",
							
						}).show();

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

			win.doLayout();
			Ext.getCmp('choose-themes').setRawValue('{$www_costume}');
			Ext.getCmp('choose-themes').focus();
			
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
		
		function loadElement(element){
			cssElement = element;
			Ext.Msg.wait('Please Wait...','Loading Element: '+element);

			var pan = Ext.getCmp('style-editor');
			pan.expand();
			

			
			cssStore.load({
				params: {
					'style'		: costume,
					'element'	: element,
					'show_null'	: Ext.getCmp('show-null').getValue()
				},
				success: function(){
					Ext.Msg.hide();
					Ext.getCmp('element-chooser').close();
				},
				failure: function(){
					Ext.Msg.hide();
				}
			});
				
		}

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
					maximized : true,
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
				var loadEl = function(){ loadElement(button) };
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
