	<script type="text/javascript" ><!--
	Ext.onReady(function(){
		Ext.state.Manager.setProvider(new Ext.state.CookieProvider({
		    expires: new Date(new Date().getTime()+(1000*60*60*24*365)), //365 days from now
		}));
		
		function newQWin(id){
				Ext.Msg.wait('Loading Editor','Please Wait...');
				var win = x4.Window({
					id		: 'new-quote-win',
					iconCls	: 'x-icon-16x16-comment_reply',
					title	: 'Quote Editor',
					modal	: true,
					width	: 800,  
					height	: 500,
					layout	: 'fit',
					autoScroll: true,
					tools	: [{
						id	: 'gear',
						handler: function(){
							Ext.Msg.prompt(
								'Default Quotes By:',
								'Enter the default name that should be used.',
								function(btn, text){
									if(btn=='ok'){
										$.post( 
											'/{$toBackDoor}/{$Xtra}/config', 
											{ 
												config_option: 'default_quotes_by', 
												config_value: text 
											},
											function(){
												var go = confirm('The page must fresh to complete changes. Do it Now?');
												if(go){
													window.location = '{$ME}'
												}
										}); 
									}

								},
								this,false,'{$default_quotes_by}'
							);
						}
					}],
					items: new Ext.form.FormPanel({
						frame		: true,
						layout		: 'form',
						labelWidth	: 75,
						labelAlign	: 'top',
						id			: 'new-quote-form',
						defaultType	: 'fieldset',
						buttonAlign : 'left',
						autoScroll: true,
						defaults	: {
							anchor	: '95%',
						},
						buttons		: [{
							text	: 'Close',
							iconCls	: 'x-icon-16x16-remove',
							handler	: function(){
								Ext.getCmp('new-quote-win').close()
							}
						},'->',{
							text	: 'Save',
							iconCls	: 'x-icon-16x16-disk',
							handler	: function(){
								Ext.Msg.wait('Please Wait...','Saving');
								Ext.getCmp('new-quote-form').getForm().submit({
									url		: '/{$toBackDoor}/{$Xtra}/add/?returnJson',
									method	: 'post',
									success	: function(){
										Ext.Msg.show({
											title:'Save Successful!',
											msg: 'Would you like to add another one?',
											buttons: Ext.Msg.YESNO,
											fn: function(btn){
												if(btn == 'yes'){
													Ext.getCmp('new-quote-form').getForm().reset();		   
												}else{
													Ext.getCmp('new-quote-win').close();
												}
										   },
										   icon: Ext.MessageBox.QUESTION
										});
										Ext.getCmp('quote-grid').getStore().reload();												
									},
									failure	: function(f,a){
										Ext.Msg.alert('Failed!',a.result.error);
									}
									
								});
							}
						}],
						items	: [{
							xtype	: 'hidden',
							name	: 'q[id]'
						},{
							xtype	: 'hidden',
							name	: 'q[views]'
						},{
							xtype	: 'hidden',
							name	: 'q[favorited]'
						},{
							xtype	: 'hidden',
							name	: 'q[last_modified]'
						},{
							defaultType	: 'textfield',
							defaults	: {
								anchor	: '95%'
							},
							items: [{
								fieldLabel: 'Quote',
								xtype	: 'htmleditor',
								height	: 250,
								name	: 'q[quote]'
							},{
								fieldLabel: 'By',
								name	: 'q[author]',
								value	: '{$default_quotes_by}'
							}]
						},{
							title		: 'Tags: Seperate, with, commas, etc.',
							defaultType	: 'fieldset',
							collapsed	: false,
							collapsible	: true,
							items		: [{
								title: 'Category',
								defaults	: {
									anchor	: '100%',
									hideLabel: true
								},
								items	: [{
									xtype	: 'textfield',
									name	: 'q[category]'
								}/*,{
									xtype	: 'checkboxgroup',
									
									items	: [{
										boxLabel: 'Pro', name: 'q[emo_place]'
									},{
										boxLabel: '&Omega', name: 'q[emo_place]'
									},{
										boxLabel: 'Con', name: 'q[emo_place]'
									}]
									    											
								}*/]
							},{
								title: 'Tags',
								defaults	: {
									anchor	: '100%',
									hideLabel: true
								},
								items	: [{
									xtype	: 'textfield',
									name	: 'q[tags]'
								}/*,{
									xtype	: 'radiogroup',
									
									items	: [{
										boxLabel: 'Pro', name: 'q[emo_thing]'
									},{
										boxLabel: '&Omega', name: 'q[emo_thing]'
									},{
										boxLabel: 'Con', name: 'q[emo_thing]'
									}]
									
									    											
								}*/]
							},{
								title: 'Maturity',
								defaults	: {
									anchor	: '100%',
									hideLabel: true
								},
								items	: [{
									xtype	: 'textfield',
									name	: 'q[maturity]' 
								}/*,{
									xtype	: 'checkboxgroup', 
									items	: [{
										boxLabel: 'Pro', name: 'q[emo_person]'
									},{
										boxLabel: '&Omega', name: 'q[emo_person]'
									},{
										boxLabel: 'Con', name: 'q[emo_person]'
									}]
									    											
								}*/]
							}]
						}]
					})
				}); 
				
				win.show(null,function(win){
					if(id){
						win.maximize();
						Ext.Msg.wait('Loading Quote...');
						Ext.getCmp('new-quote-form').getForm().load({
							url	: '/{$toBackDoor}/{$Xtra}/edit/'+id+'/?json',
							success	: function(){
								Ext.Msg.hide();
							},
							failure	: function(){
								Ext.Msg.alert('Failed to Load Quote');
							}
						});
					}else{
						Ext.Msg.hide();
					}
					
				});
			}
			
			var list = new Ext.Panel({
				
				frame	: false,
				layout	: 'fit',
				//maximized	: true, 
				//height	: $(document.body).height()-$('#shortcut-panel').outerHeight()-$('#neck-breadcrumbs').outerHeight()-70,
				//renderTo: 'zyx-content',
				tbar	: [{
					text: '   Add New Quote',
					iconAlign: 'top',
					iconCls: 'x-icon-48x48-comments_add',
					scale: 'large',
					handler: function(){
						newQWin();
					}
				},'->',{
					text	: 'Delete Quote',
					iconAlign: 'top',
					iconCls	: 'x-icon-48x48-comments_delete',
					scale: 'large',
					handler: function(){
						var r = Ext.getCmp('quote-grid').getSelectionModel().getSelected();
						if(!r){
							alert('Please Choose a Quote First.');
						}else{
							
							Ext.Msg.show({
								msg	: 'Click "YES" to Delete <hr/>"'+r.data.quote+'"',
								title	: 'THIS CAN NOT BE UNDONE!',
								buttons: Ext.Msg.YESNOCANCEL,
								fn: function(btn){
									if(btn == 'yes'){
										//Ext.getCmp('quote-grid').getStore().remove(r);
								 		
								 		var s = Ext.getCmp('quote-grid').getStore();
										s.remove(r);
										s.save();
								 		s.reload();
										//Ext.Msg.wait('Please Wait...','Deleting');
										
									}
								}, 
  								icon: Ext.MessageBox.WARNING
							});
							
						}
						
					}
						 
				}],
				items	: [new Ext.grid.EditorGridPanel({
					stateful: true,
					border	: false,
					clicksToEdit : 1,
					frame	: false,
					loadMask: true,
					id		: 'quote-grid',
					store	: store = new Ext.data.JsonStore({
						fields	: {$fields},
						remoteSort	: true,

					    pruneModifiedRecords: true,
						proxy	: new Ext.data.HttpProxy({
						    api: {
						        read    : '/{$toBackDoor}/{$Xtra}/read/?returnJson',
						        create  : '/{$toBackDoor}/{$Xtra}/add/?returnJson',
						        update  : '/{$toBackDoor}/{$Xtra}/update/?returnJson',
						        destroy : '/{$toBackDoor}/{$Xtra}/delete/?returnJson'
						    }
						}),
				        autoLoad: true,
				        root	: 'data', 
				        idProperty: 'id',
				        totalProperty: 'total',
					   
				        writer	: new Ext.data.JsonWriter({
					        
					    })
				    }),
				    colModel: new Ext.grid.ColumnModel({
				        defaults: {
				            sortable: true,
				            editable	: true,
				            editor	: new Ext.form.TextField({
					             
						    })
				        },
				        columns: {$columns},
				    }),
				    viewConfig: {
				        forceFit: true,
				    },
				    sm: new Ext.grid.RowSelectionModel({
					    singleSelect:true
					}),
					listeners: {
				    	afterEdit: function(e){
				    		e.record.commit();
		            	},
		            	dblclick:  function(sm, row, rec) {
		                	var rec = Ext.getCmp('quote-grid').getSelectionModel().getSelected();
		                	Ext.Msg.wait('Please Wait','Loading Quote Editor');
		                	newQWin(rec.data.id);
		                }
					}, 
				    bbar	: new Ext.PagingToolbar({
			            pageSize: 25,
			            store: store,
			            displayInfo: true,
			            displayMsg: {literal}'Displaying Quotes {0} - {1} of {2}',{/literal}
			            emptyMsg: "No quotes to display"
			        })
				})]
			});
			var win = x4.Window({
				title	: 'Quote List',
				id		: 'quotes',
				maximized: true,
				layout	: 'fit',
				items	: list

			}).show(null,function(win){
				//win.setHeight($(document.body).height()-$('#admin-toolbar').outerHeight());
				
			});
		});
	--></script>