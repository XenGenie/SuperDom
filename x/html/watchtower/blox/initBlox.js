	Ext.onReady(function() {

		var blox = {
			buildBlox	: function(){
				x4.Window({
					width	: '75%',
					height	: 450,
					title	: 	'Build-A-Blox',
					iconCls	: 	'x-icon-16x16-bricks',
					 
					layout	: 'fit', 
					frame	: true,
					modal	: true, 
					id		: 'edit-blox-0',
					tbar	: ['','... Start Building your Blox by using a Foundation:','-',new Ext.form.ComboBox({  
					    fieldLabel: 'Copy Costume',
					    id	: 'choose-blox',  
					    store: new Ext.data.JsonStore({  
						    autoLoad: true,
					    	url: '/{$toBackDoor}/blox/read/?returnJson',
					    	root: 'data', 
					        fields : [{
						        name: 'id'
							},{
								name: 'name'
							}]  
					    }),  
					    valueField: 'id',  
					    displayField: 'name',
					      defaultValue	: 'Custom',
					    //hiddenName: 'active_id',  
					    mode: 'remote',  
					    minChars : 0 ,
						width:125,
						name	: 'form[blox_file]',
						hiddenName	: 'form[blox_file]',
						listeners: {
							select: function(cb,r,i){
								 //alert('You chose: '+r.data.name);
								 Ext.getCmp('blox-property-grid').getStore().load({
									// id	: r.data.id 
								 });
							}
						}
					}),'->',{
						iconAlign: 'bottom',
						iconCls: 'x-icon-32x32-archive',
						scale: 'large',
						 
						text	: 'Get More Blox'
						}],					
					items	: [new Ext.Panel({ 
						border	: false,
						layout	: 'fit',
						items	: [{ 
							xtype	: 'tabpanel',
							deferredRender	: false, 
							activeTab	: 0,
							items	: [new Ext.grid.PropertyGrid({
						        title	: 'The Properties',
						        id	: 'blox-property-grid',
						        iconCls	: 'x-icon-16x16-cog',
						        autoHeight: true,
						        propertyNames: {
						            label	: 'Label',
						            describe: 'Description'
						        },
						        source: {
							        label	:  '',
							        describe: ''

							    },
						        store	: new Ext.data.JsonStore({
									autoSave: true, 
									autoLoad	: true,
								    //autoDestroy: true,
									id	: 'blox-store',
									proxy : new Ext.data.HttpProxy({
										api: {
									        read    : '/{$toBackDoor}/blox/readProp/?returnJson',
									        create  : '/{$toBackDoor}/blox/create/?returnJson',
									        update  : '/{$toBackDoor}/blox/update/?returnJson',
									        destroy : '/{$toBackDoor}/blox/destroy/?returnJson'
									    }
									}),
								    //storeId: 'cssStore',
								    writer : new Ext.data.DataWriter({
								    	writeAllFields  : true,
								        encode: false   // <--- false causes data to be printed to jsonData config-property of Ext.Ajax#reqeust
								    }),
								    // reader configs 
								    baseParams: [
										'id'  
									],
									root: 'data',  
									listeners: {
										update: function(s,rec,op){
											alert(op);
										},
							            load: function(store, records, options){
											// get the property grid component
							                var propGrid = Ext.getCmp('blox-property-grid');
							                // make sure the property grid exists
							                if (propGrid) {
							                    // populate the property grid with store data
							                    propGrid.setSource(store.reader.jsonData.data);
												Ext.Msg.hide();	
												 				                     
							                }
							            }
							        }
								     
								}),
						        viewConfig : {
						            forceFit: true,
						            scrollOffset: 2 // the grid will never have scrollbars
						        }
						    }), {
								hideLabel	: true,
								anchor		: '100%',

						        iconCls	: 'x-icon-16x16-html',
								title		: 'Code & Content',
								xtype		: 'tinymce',
								anchor: "100% -50",
								id		: 'code',
								tinymceSettings: {
								 	theme: "advanced",
									script_url : '/bin/js/jq/tiny_mce/tiny_mce.js',
			                       

			                        plugins: "pagebreak,style,layer,table,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

			                        theme_advanced_buttons1: "code,|,newdocument,template,fullscreen,|,undo,redo,|,search,replace,|,cut,copy,paste,pastetext,pasteword,|,inserttime,insertdate,|,preview,print",
			                        
			                        theme_advanced_buttons2: "image,media,anchor,|,link,unlink,|,advhr,hr,|,bullist,numlist,|,outdent,indent,blockquote,sub,sup,|,attribs,|,cleanup,iespell",
			                        

			                        theme_advanced_buttons3: "charmap,pagebreak,nonbreaking,|,visualchars,visualaid,|,tablecontrols,|,insertlayer,moveforward,movebackward,absolute",
			                        
			                        theme_advanced_buttons4: "removeformat,styleprops,formatselect,fontselect,fontsizeselect,forecolor,backcolor,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,ltr,rtl",
			                        

			                        theme_advanced_toolbar_location: "bottom",

			                        theme_advanced_toolbar_align: "center",

			                        theme_advanced_statusbar_location: "top",

			                        extended_valid_elements: "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",

			                        //template_external_list_url: "example_template_list.js",

			                        accessibility_focus: false



			                    }
							},{

						        iconCls	: 'x-icon-16x16-eye',
								title	: 'Viewing Permissions'
							}]
						}] 			
					})]
				}).show();
			},
			win : x4.Window({
				width   : 400,
				height  : 300,
				title   : 	'Blox',
				iconCls : 	'x-icon-16x16-bricks',
				frame   : true,
				layout  : 'border',
				id      : 'blox-win',
				tbar: [{
					 text: 'Libraries',
					 iconAlign: 'bottom',
						iconCls: 'x-icon-32x32-library_bookmarked',
						scale: 'large',
						handler: function(){}

				},{
						text	: 'Build-a-Blox',
						iconAlign: 'bottom',
						iconCls: 'x-icon-32x32-new_archive',
						scale: 'large',
						handler	: function(){
							blox.buildBlox();
						}
					}],
				bbar	: new Ext.ux.StatusBar({
		            id: 'blox-statusbar',
		            statusAlign: 'right',
		            // defaults to use when the status is cleared:
		            defaultText: '<img src="{$ICON.16}/information.png" align="absmiddle" />   Drag and Drop the Blox to their desired location. <img src="{$ICON.16}/mouse.png" align="absmiddle" />  Double Click to Edit Them. ',
		            //defaultIconCls: 'default-icon',
		        
		            // values to set initially:
		           // text: 'Ready',
		           // iconCls: 'x-status-valid',

		            // any standard Toolbar items:
		            items: [  ]
		        }),
				items	: [{
					region: 'west',

				},{
					region: 'center',
				},{
					region: 'east',
					autoScroll: true,
					id	: 'blox-layout',
					bodyStyle	: 'background-color: #efefef',
					autoLoad	: {
						url	: '/{$toBackDoor}/{$Xtra}/dandd?html',
						scripts	: true,
					}
				} ]
			})

		}; 

		blox.win.show(document.body,function(win){
			win.maximize();			
		});
		
		
	});
	/*
	var win = x4.Window({
		maximized	: true,
		id	: 'blox-win',
		title	: "{$xphp_files['xBlox.php'].name}",
		iconCls	: 'x-icon-16x16-bricks',
		layout	: 'anchor',
		items	: [{
			anchor	: '100% 25%',
			layout	: 'border',
			items	: [{
				region	: 'north',
				title	: '<HEAD>',
				collapsed: true,
				//contentEl : 'head-blox' 
			},{
				title	: 'Face',
				region	: 'center',
				contentEl: 'face-blox'
			}],
		},{
			anchor	: '100% 10%',
			title	: 'neck',
			contentEl: 'neck-blox',
			height	: 75
		},{
			anchor	: '100% 55%',
			layout	: 'column',
			defaults	: {
				layout	: 'fit',
				ctCls	: 'connectedSortable' 
			},
			items	: [{
				columnWidth	: .20,
				title	: 'Left Arm',
				contentEl: 'left-blox',
			},{
				columnWidth	: .60,
				contentEl: 'torso-blox',
				title	: 'Torso'
			},{
				columnWidth	: .20,
				contentEl: 'right-blox',
				title	: 'Right Arm'
			}]
		},{
			anchor	: '100% 10%',
			title	: 'Footer',
			contentEl: 'foot-blox'
		}]
	});
	win.show(null,);
	*/	
	//$('#disabled-blox-containter').height($('#x-desktop').height() - $('#admin-toolbar').height()-75);	