<link rel="stylesheet" type="text/css" href="/bin/js/ext-3.2.1/examples/ux/css/Spinner.css" />
<style>
	

#skeleton {
	background: white; 
	color : white;
	height : '100% '
}

#skeleton div{
	 
	margin : 0px 0px;
}

#skeleton #headband {
	background: #3b5998;
	height: 25px;
}

#skeleton #face {
	
	height: 100px;
}



</style>


<script type="text/javascript"><!--
	
	Ext.onReady(function() {


		var nav_tree = new Ext.tree.TreePanel({
				id		: 'navigation-tree',
				region 	: 'west',
				width : 200,
				title 	: 'Site Map', 
		  		buttonAlign	: 'center',
		  		iconCls	: 	'x-icon-16x16-sitemap_color',
				buttons	: [{
					iconAlign: 'bottom',
					iconCls: 'x-icon-32x32-network',
					scale: 'large', 
					text	: 'New Link',
					handler	: function(){
						var host = 'http://'+window.location.hostname+'/';
						var title = prompt('Name your Link');
						if(title != '' && title != null){
							var href = prompt('URL address ~ (Start with "/" or "http://"):',host + title.toLowerCase().replace(/ /gi,'+') );
							if(href != '' && href != 'null'){
							
								$.post('/{$toBackDoor}/{$Xtra}/save/?json',{
									form	: {
										href	: href,
										title	: title,
										parent	: xNav.PARENT_MENU,
									}
								},function(json){
									Ext.getCmp('navigation-tree').getRootNode().reload();
									xNav.loadMenu(xNav.PARENT_MENU);

									
								});
							}
						} 
						
					}
				}, { 
					iconAlign: 'bottom',
					iconCls: 'x-icon-32x32-minus',
					scale: 'large', 
					text	: 'Delete Link',
					handler	: function(){
						var n = Ext.getCmp('navigation-tree').getSelectionModel().getSelectedNode();
						if(n ){
							xNav.removeLink(n.id,n.text);
						}else{
							Ext.Msg.alert('Choose a link to delete 1st.','Link not selected. Nothing to Delete.');
						}




						
					}
				}],
				listeners	: {
					beforeClick	: function(node){
				
						Ext.getCmp('navi-link-href-text').setValue(node.attributes.link);
						return false;
					},
					click		: function(){
						return false;
					},
					dblClick	: function(node){
						xNav.editLink(node.id.replace('link-',''));
					},
				
					checkchange	: function (node,checked){
						$.post('/{$toBackDoor}/navigation/checked/?json',{
		        			id		: node.id.replace('link-',''),
		        			checked	: checked
		        		},function(data){ 
			        		
		        		});
					},

					 movenode : function(tree,node,oldParent,newParent,index){

						$.post('/{$toBackDoor}/navigation/dropLink/?json',{
		        			id		: node.id.replace('link-',''),
		        			parent	: newParent.id.replace('link-',''),
		        			weight 	: index
		        		},function(data){

		        			var weight = 0;
		        			var nodes = new Array();
		        			
			        		newParent.eachChild(function(n){
				        		nodes[weight++] = n.id.replace('link-','');
				        	});

			        		$.post('/{$toBackDoor}/navigation/updateOrder/?json',{
			        			nodes	: ume.util.serialize(nodes)
			        		},function(){
			        			
								//	xNav.loadMenu(xNav.PARENT_MENU);
				        	});
			        		
		        		});
				 
						/**
						var c = confirm("Moving "+node.text+" to "+newParent.text);
		        		if(c){
		        			
		        		}else {
		        			return false;
		        		}
						*/	

					}

				},
				useArrows       : true,
				autoScroll      : true,
				animate         : true,
				enableDD        : true,
				containerScroll : true,
				border          : false,
				rootVisible     : true,
				// auto create TreeLoader
				//dataUrl         : '/{$toBackDoor}/{$Xtra}/loadTree', 
				root            : {
					iconCls   : 'x-icon-16x16-world',
					expanded  : true,
					nodeType  : 'async',
					text      : '{$site_name}',
					draggable : false,
					id        : '0'
			    }
			});
		
		var skeleton = {
			buttons : {
				headband : {
					xtype   : 'button',
					text    : 'Headband',
					id      : 'headband', 
					iconCls : 'x-icon-16x16-hardhat',
					flex    : 1,
					handler : function(){
						x4.skeletonForm.items.itemAt(0).expand()
					}
                },
				face 	: {
					xtype   : 'button',
					text    : 'Face',
					id      : 'face', 
					iconCls : 'x-icon-16x16-hardhat',
					flex    : 1,
					handler : function(){
						x4.skeletonForm.items.itemAt(1).expand()
					}
				},
				neck 	: {
					xtype   : 'button',
					text    : 'neck',
					id      : 'neck', 
					iconCls : 'x-icon-16x16-contact_grey',
					flex    : 1,
					handler : function(){
						x4.skeletonForm.items.itemAt(2).expand()
					}

				},
				torso 	: {
					xtype:'button',
					margins:'0 5 0 5' ,
					text: 'Torso',
					iconCls : 'x-icon-16x16-heart',
					flex:3,
					handler : function(){
						x4.skeletonForm.items.itemAt(3).expand()
					}
				},
				arm 	: {
					xtype   : 'button',
					text    : 'Arm', 
					iconCls : 'x-icon-16x16-shield',
					flex    : 1,
					handler : function(){
						x4.skeletonForm.items.itemAt(4).expand()
					}
				},
				legs 	: {
					xtype   : 'button',
					text    : 'Legs',
					iconCls : 'x-icon-16x16-rosette',
					flex    : 1,
					handler : function(){
						x4.skeletonForm.items.itemAt(5).expand()
					}
				},
				feet 	: {
					xtype   : 'button',
					text    : 'Feet', 
					iconCls : 'x-icon-16x16-plugin',
					flex    : 1,
					handler : function(){
						x4.skeletonForm.items.itemAt(6).expand()
					}
				}
			},
			doLayout : function(){
				this.form = x4.skeletonForm;
				this.values = this.form.form.getFieldValues();
				this.renderTorso(	); 
			},
			renderTorso : function(){
				var bodyPan = Ext.getCmp('body-pan');

				function getSection(s,bodyPan){
					return (Ext.getCmp('body-'+s)) ? Ext.getCmp('body-'+s) : bodyPan.add({ id : 'body-'+s });
					}

					var upper = getSection('upper',bodyPan)	;
				var mid   = getSection('mid',bodyPan);
				var lower = getSection('lower',bodyPan)  ;
  
				var arm = {
					left : {
						 loc : this.values['left-arm-location'],
						 num : this.values['left-arms']
					},
					right : {
						 loc : this.values['right-arm-location'],
						 num : this.values['right-arms']
					}
				};

				var torso = {
					loc : this.values['torso-location'],
					num : this.values['torsos']
				}

				// if(torso.loc != 'upper' && arm.left.loc != 'upper' && arm.right.loc != 'upper')
				// 	bodyPan.remove(upper);
				// if(torso.loc != 'mid' && arm.left.loc != 'mid' && arm.right.loc != 'mid')
				// 	bodyPan.remove(mid);
				// if(torso.loc != 'lower' && arm.left.loc != 'lower' && arm.right.loc != 'lower')
				// 	bodyPan.remove(lower);

				function renderButtons(o){
					var section = Ext.getCmp(sec+'pan');
					var text = (sec = 'torso')? 'Heart ' : 'Arm ';
					var icon = (sec = 'torso')? 'heart' : 'sheild';
					for (var i = o.num; i > 0; i--) {
	    				section.add({
							xtype   :'button',
							text    : text+ ((i - (o.num+1)) * -1),
							margins : (i==o.num)?'':'0 0 0 5',
							iconCls : 'x-icon-16x16-'+icon,
							flex    : 1
	                    });
	    			}; 
	    			section.
	    			doLayout();
				}

				renderButtons(torso);
				renderButtons(arm.left);
				renderButtons(arm.right); 
			}
		};

		var win = x4.navigation = x4.Window({
			width     : 250,
			height    : 300,
			title     : 'Site Map',
			id        : 'site-map',
			iconCls   : 'x-icon-16x16-sitemap_color',
			frame     : true,
			layout    : 'border',
			maximized : true,
			tbar      : [{
				iconCls	: 'x-icon-16x16-eye',
				text	: 'Link Location: ',
				handler	: function(){ 
					var url = Ext.get('navi-link-href-text').getValue();
					if(url)
						window.open(url);
				}
			},{
				xtype    : 'textfield',
				id       : 'navi-link-href-text', 
				readOnly : true
			}], 
			items : [nav_tree, new Ext.TabPanel({
				region    : 'center',
				activeTab : 0, 
				defaults  : { autoScroll: true },
				items     : [{
						title   : 'Skeleton',
						iconCls : 'x-icon-16x16-sprocket_light',
						layout  : {
                            type:'hbox', 
                            frame : 0, 
                            border : 0,
                            align:'stretch'
                        },
                        
		                items 	: [new Ext.FormPanel({
		                	flex : 1,
							id       : 'skeleton-form',
							layout   :'accordion', 
							defaults : {
								layout : 'form',
								frame  :true
		                	},
			                items: [{
								title       : 'Headband',
								iconCls     : 'x-icon-16x16-hardhat',
								defaultType : 'checkbox',
					            items: [{
									xtype : 'panel',
									html  : 'The Headband is a Nice Decor Item that helps identify the Site immedietly. '
				                },{
									fieldLabel     : 'Equip Headband?',
									labelSeparator : '',
									checked        : true,
									boxLabel       : 'Equip',
									name           : 'headband',
									inputValue     : 1,
									handler        : function(b,chk){
					                	var h = Ext.getCmp('headband');
					                	var s = x4.skeleton;
					                	if(b.getValue())
					                		s.insert(0,{
												xtype   : 'button',
												text    : 'Headband',
												id      : 'headband', 
												iconCls : 'x-icon-16x16-hardhat',
												flex    :1
				                            });
					                	else
				                		s.remove(h); 
					                	s.doLayout();
									}
					            }]
			                },{
								title       : 'Face',
								iconCls     : 'x-icon-16x16-emoticon_smile',
								defaultType : 'checkbox', // each item will be a radio button 
								frame 		: true,
								border 		: 0,
								items       : [{
									xtype                   : 'spinnerfield',
									fieldLabel              : 'Faces',
									name                    : 'faces',
									minValue                : 0,
									maxValue                : 10,
									allowDecimals           : false,
									decimalPrecision        : 0,
									incrementValue          : 1,
									alternateIncrementValue : 1,
									accelerate              : true,
									value : 1,
									listeners               : {
										spin	: function(f,c){ 
											var face = Ext.getCmp('face-pan');
											var fi    = this.getValue();
											var s = x4.skeleton;
					            			if(fi){
						            			if(!face){
						            				face = s.insert((Ext.getCmp('headband'))?1:0,{
						            					layout: {
															type   :'hbox',  
															align  :'stretch'
							                            }, 
							                            id : 'face-pan',
							                            flex : 2
						            				}); 
						            				s.doLayout();
						            				 
						            			}else{
						            				face.removeAll();
						            			}
						            			for (var i = fi; i > 0; i--) {
						            				face.add({
														xtype   :'button',
														text    : 'Face '+ ((i - (fi+1)) * -1),
														margins : (i==fi)?'':'0 0 0 5',
														iconCls : 'x-icon-16x16-emoticon_smile',
														flex    :1
						                            });
						            			}; 
						            			face.doLayout();
					            			}else{
					            				s.remove(face);
					            			}
					            			s.doLayout();
						            	},
						            	blur : function(){
						            		this.spin();
						            	}
					            	}
					            },{
				                	xtype : 'panel',
				                	html : 'The Headband is a Nice Decor Item that helps identify the Site immedietly. '
				                }]
			                },{
								title       : 'Neck',
								iconCls     : 'x-icon-16x16-contact_grey' ,
								defaultType : 'checkbox', // each item will be a radio button 
								 
								items       : [ {
									fieldLabel     : 'Enable Neck',
									labelSeparator : '',
									checked        : true,
									boxLabel       : 'Enable',
									name           : 'neck',
									inputValue     : 1,
									handler        : function(b,chk){
					                	var h = Ext.getCmp('neck');
					                	var s = x4.skeleton;
					                	var i = ((Ext.getCmp('face-pan')) ? 1 : 0) + ((Ext.getCmp('headband')) ? 1 : 0);
					                	if(b.getValue())
					                		s.insert(i,{
												xtype   : 'button',
												text    : 'Neck',
												id      : 'neck', 
												iconCls : 'x-icon-16x16-contact_grey',
												flex    :1
				                            });
					                	else
				                		s.remove(h); 
					                	s.doLayout();
									}
					            },{
									xtype : 'panel',
									html  : 'The Headband is a Nice Decor Item that helps identify the Site immedietly. '
				                }]
			                },{
								title       : 'Torso',
								iconCls     : 'x-icon-16x16-heart' ,
								defaults : {

									//hideLabel: true
								},
								items :[{
											xtype                   : 'spinnerfield',
											fieldLabel              : 'Torsos',
											name                    : 'torsos',
											minValue                : 0,
											maxValue                : 5,
											allowDecimals           : false,
											decimalPrecision        : 0,
											incrementValue          : 1,
											alternateIncrementValue : 1,
											accelerate              : true,
											value : 1,
											listeners               : {
												spin	: function(f,c){ 
													var cmp = Ext.getCmp('torso-pan');
													var fi    = this.getValue();
													var s = x4.skeleton;
													var i = ((Ext.getCmp('left-arm-pan'))?1:0);
													var loc = x4.skeletonForm.form.getFieldValues()['torso-location'];
							            			if(fi){
								            			if(!cmp){
								            				cmp = Ext.getCmp('body-'+loc).insert(i,{
								            					layout: {
																	type   :'hbox',  
																	align  :'stretch'
									                            }, 
									                            id : 'torso-pan',
									                            flex : 1
								            				}); 
								            				s.doLayout(); 
								            			}else{
								            				cmp.removeAll();
								            			}
								            			var text = (fi<=10)?'Heart ':'';
								            			var m = (fi<=10)?5:1;
								            			for (var i = fi; i > 0; i--) {
								            				cmp.add({
																xtype   :'button',
																text    : text+ ((i - (fi+1)) * -1),
																margins : (i==fi)?'':'0 0 0 '+m,
																iconCls : 'x-icon-16x16-heart',
																flex    :1
								                            });
								            			}; 
								            			cmp.doLayout();
							            			}else{
							            				s.remove(cmp);
							            			}
							            			s.doLayout();
								            	},
								            	blur : function(){
								            		this.spin();
								            	}
							            	}
							            },{
							                fieldLabel: 'Location',
							                boxLabel: 'Upper',
							                name: 'torso-location',
							                inputValue: 'upper'
							            }, {
							            	checked: true,
							                fieldLabel: '',
							                labelSeparator: '',
							                boxLabel: 'Mid',
							               	name: 'torso-location',
							                inputValue: 'mid'
							            }, {
							                fieldLabel: '',
							                labelSeparator: '',
							                boxLabel: 'Lower',
							                name: 'torso-location',
							                inputValue: 'lower'
							            }],
							            defaultType: 'radio' 
			                },{
								title       : 'Arms',
								iconCls     : 'x-icon-16x16-shield' ,
								layout:'column',
					            items:[{
					                columnWidth:.5,
					                layout: 'form',
					                labelAlign : 'top',
					                items: [{
							            xtype:'fieldset',
							            checkboxToggle:true,
							            title: 'Left Arm',
							            autoHeight:true, 
							            defaultType: 'textfield',
							            collapsed: false,
							            checked : true,
							            items :[{
											xtype                   : 'spinnerfield',
											fieldLabel              : 'Left Arms',
											name                    : 'left-arms',
											minValue                : 0,
											maxValue                : 5,
											allowDecimals           : false,
											decimalPrecision        : 0,
											incrementValue          : 1,
											alternateIncrementValue : 1,
											accelerate              : true,
											value : 1,
											listeners               : {
												spin	: function(f,c){ 
													skeleton.doLayout();
								            	} 
							            	}
							            },{
							                fieldLabel: 'Location',
							                boxLabel: 'Upper',
							                name: 'left-arm-location',
							                inputValue: 'upper'
							            }, {
							            	checked: true,
							                fieldLabel: '',
							                labelSeparator: '',
							                boxLabel: 'Mid',
							               	name: 'left-arm-location',
							                inputValue: 'mid'
							            }, {
							                fieldLabel: '',
							                labelSeparator: '',
							                boxLabel: 'Lower',
							                name: 'left-arm-location',
							                inputValue: 'lower'
							            }],
							            defaultType: 'radio' 
							        }]
					            },{
									columnWidth :.5,
									layout      : 'form',
									labelAlign  : 'top',
									items       : [{
										xtype          :'fieldset',
										checkboxToggle :true,
										title          : 'Right Arm',
										autoHeight     :true, 
										defaultType    : 'textfield',
										collapsed      : false,
										checked        : true,
										items          :[{
											xtype                   : 'spinnerfield',
											fieldLabel              : 'Right Arms',
											name                    : 'right-arms',
											minValue                : 0,
											maxValue                : 5,
											allowDecimals           : false,
											decimalPrecision        : 0,
											incrementValue          : 1,
											alternateIncrementValue : 1,
											accelerate              : true,
											value : 1,
											listeners               : {
												spin	: function(f,c){ 
													var cmp = Ext.getCmp('right-arm-pan');
													var fi    = this.getValue();
													var s = x4.skeleton;
													var i = ((Ext.getCmp('body-upper'))?1:0) +
														((Ext.getCmp('body-mid'))?1:0) +
														((Ext.getCmp('body-lower'))?1:0);
							            			if(fi){
								            			if(!cmp){
								            				cmp = Ext.getCmp('body-pan').insert(i,{
								            					layout: {
																	type   :'hbox',  
																	align  :'stretch'
									                            }, 
									                            id : 'right-arm-pan',
									                            flex : 1
								            				}); 
								            				s.doLayout(); 
								            			}else{
								            				cmp.removeAll();
								            			}
								            			var text = (fi<=10)?'Arm ':'';
								            			var m = (fi<=10)?5:1;
								            			for (var i = fi; i > 0; i--) {
								            				cmp.add({
																xtype   :'button',
																text    : text+ ((i - (fi+1)) * -1),
																margins : (i==fi)?'':'0 0 0 '+m,
																iconCls : 'x-icon-16x16-shield',
																flex    :1
								                            });
								            			}; 
								            			cmp.doLayout();
							            			}else{
							            				s.remove(cmp);
							            			}
							            			s.doLayout();
								            	},
								            	blur : function(){
								            		this.spin();
								            	}
							            	}
							            },{
							                fieldLabel: 'Location',
							                boxLabel: 'Upper',
							                name: 'right-arm-location',
							                inputValue: 'upper'
							            }, {
							            	checked: true,
							                fieldLabel: '',
							                labelSeparator: '',
							                boxLabel: 'Mid',
							               	name: 'right-arm-location',
							                inputValue: 'mid'
							            }, {
							                fieldLabel: '',
							                labelSeparator: '',
							                boxLabel: 'Lower',
							                name: 'right-arm-location',
							                inputValue: 'lower'
							            }],
							            defaultType: 'radio' 
							        }]
					            }]
			                },{
								title       : 'Legs',
								iconCls     : 'x-icon-16x16-rosette' ,
								items       : [{
									xtype                   : 'spinnerfield',
									fieldLabel              : 'Faces',
									name                    : 'faces',
									minValue                : 0,
									maxValue                : 10,
									allowDecimals           : false,
									decimalPrecision        : 0,
									incrementValue          : 1,
									alternateIncrementValue : 1,
									accelerate              : true,
									value : 1,
									listeners               : {
										spin	: function(f,c){ 
											var cmp = Ext.getCmp('legs-pan');
											var fi    = this.getValue();
											var s = x4.skeleton;
											var i = ((Ext.getCmp('headband'))?1:0) +
												((Ext.getCmp('face-pan'))?1:0) +
												((Ext.getCmp('neck'))?1:0) +
												((Ext.getCmp('body-pan'))?1:0 );
					            			if(fi){
						            			if(!cmp){
						            				cmp = s.insert(i,{
						            					layout: {
															type   :'hbox',  
															align  :'stretch'
							                            }, 
							                            id : 'legs-pan',
							                            flex : 2
						            				}); 
						            				s.doLayout();
						            				 
						            			}else{
						            				cmp.removeAll();
						            			}
						            			for (var i = fi; i > 0; i--) {
						            				cmp.add({
														xtype   :'button',
														text    : 'Leg '+ ((i - (fi+1)) * -1),
														margins : (i==fi)?'':'0 0 0 5',
														iconCls : 'x-icon-16x16-rosette',
														flex    :1
						                            });
						            			}; 
						            			cmp.doLayout();
					            			}else{
					            				s.remove(cmp);
					            			}
					            			s.doLayout();
						            	},
						            	blur : function(){
						            		this.spin();
						            	}
					            	}
					            },{
				                	xtype : 'panel',
				                	html : 'The Headband is a Nice Decor Item that helps identify the Site immedietly. '
				                }]
			                },{
			                	title : 'Feet',
			                	iconCls : 'x-icon-16x16-plugin' ,
			                	items       : [{
									xtype                   : 'spinnerfield',
									fieldLabel              : 'Feet',
									name                    : 'feet',
									minValue                : 0,
									maxValue                : 20,
									allowDecimals           : false,
									decimalPrecision        : 0,
									incrementValue          : 1,
									alternateIncrementValue : 1,
									accelerate              : true,
									value : 1,
									listeners               : {
										spin	: function(f,c){ 
											var cmp = Ext.getCmp('feet-pan');
											var fi    = this.getValue();
											var s = x4.skeleton;
											var i = ((Ext.getCmp('headband'))?1:0) +
												((Ext.getCmp('face-pan'))?1:0) +
												((Ext.getCmp('neck'))?1:0) +
												((Ext.getCmp('body-pan'))?1:0 )+
												((Ext.getCmp('legs-pan'))?1:0 );
					            			if(fi){
						            			if(!cmp){
						            				cmp = s.insert(i,{
						            					layout: {
															type   :'hbox',  
															align  :'stretch'
							                            }, 
							                            id : 'feet-pan',
							                            flex : 1
						            				}); 
						            				s.doLayout();
						            				 
						            			}else{
						            				cmp.removeAll();
						            			}
						            			var text = (fi<=10)?'Foot ':'';
						            			var m = (fi<=10)?5:1;
						            			for (var i = fi; i > 0; i--) {
						            				cmp.add({
														xtype   :'button',
														text    : text+ ((i - (fi+1)) * -1),
														margins : (i==fi)?'':'0 0 0 '+m,
														iconCls : 'x-icon-16x16-plugin',
														flex    :1
						                            });
						            			}; 
						            			cmp.doLayout();
					            			}else{
					            				s.remove(cmp);
					            			}
					            			s.doLayout();
						            	},
						            	blur : function(){
						            		this.spin();
						            	}
					            	}
					            }]
			                }]
		                }),{
		                	flex 	: 2,
		                	tbar	: [{
								iconCls  : 'x-icon-16x16-bigkey',
								text     : 'Save Skeleton Key:',
								readOnly : true,
								handler  : function(){ 
									 
								}
							},{
								xtype    : 'textfield',
								id       : 'navi-link-skel-key', 
								width    : '100%',  
								readOnly : true
							}],   
		                	layout: {
								type    :'vbox',
								padding :'5',
								align   :'stretch',
								border  : 0,
								frame	: 0
                            },
                            id 	: 'skeleton',
                            defaults:{ margins:'0 0 5 0',
	                            layout: { 
	                            	align   :'stretch',
									border  : 0,
									frame	: 0
	                            }
	                        },
                            items:[skeleton.buttons.headband,{ 
                                layout: {
									type   :'hbox',  
									frame 	: 0, 
	                            	border 	: 0,
									align  :'stretch'
	                            }, 
	                            id : 'face-pan',
	                            frame 	: 0, 
	                            border 	: 0,
                            	items : [skeleton.buttons.face],
	                            flex:2
                            },skeleton.buttons.neck,{
                            	layout: {
	                                type:'vbox', 
	                                align:'stretch'
	                            }, 
	                            frame : 0,
	                            border : 0,
	                            id : 'body-pan',
	                            defaults : {
	                            	layout: {
		                                type:'hbox', 
		                                align:'stretch'
		                            }, 
		                            frame : 0,
		                            border : 0,
		                            flex : 1
	                            },
                            	items : [{
                            		id : 'body-upper'
                            	},{
		                            id : 'body-mid',
	                            	items : [
	                            		skeleton.buttons.arm,
	                            		skeleton.buttons.torso,
	                            		skeleton.buttons.arm
	                            	],
		                            flex:1
	                            },{
                            		id : 'body-lower'
                            	}],
	                            flex:3
                            },{ 
                                layout: {
									type   :'hbox',  
									frame 	: 0, 
	                            	border 	: 0,
									align  :'stretch'
	                            }, 
	                            id : 'legs-pan',
	                            frame 	: 0, 
	                            border 	: 0,
                            	items : [skeleton.buttons.legs],
	                            flex:2
                            },{ 
                                layout: {
									type   :'hbox',  
									frame 	: 0, 
	                            	border 	: 0,
									align  :'stretch'
	                            }, 
	                            id : 'feet-pan',
	                            frame 	: 0, 
	                            border 	: 0,
                            	items : [skeleton.buttons.feet],
	                            flex:2
                            },]

		                }]
		            },{
		                title: 'Muscle',
	                	iconCls	: 	'x-icon-16x16-brick',
		                autoLoad:'ajax1.htm'
		            },{
		                title: 'Skin',
		                 iconCls	: 	'x-icon-16x16-palette',
		                autoLoad: { url: 'ajax2.htm', params: 'foo=bar&wtf=1' }
		            },{
		                title: 'Brain', 
		                 iconCls	: 	'x-icon-16x16-computer',
		                html: "I am tab 4's content. I also have an event listener attached."
		            },{
		                title: 'Disabled Tab',
		                disabled:true,
		                html: "Can't see me cause I'm disabled"
		            }
		        ]
		    })]
		});

		// win.show(document.body,function(){
		//  	x4.skeleton = Ext.getCmp('skeleton');
		//  	x4.skeletonForm = Ext.getCmp('skeleton-form');
		// });
		
		
	});
--></script>

<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/themes/smoothness/jquery-ui.css" type="text/css" />
<style type="text/css">
	#sortable { 
		list-style-type: none; 
		margin: 0; padding: 0; 
	
	}
	
	#sortable input, #sortable button {
	 float: right;
	 padding: 2px;
	}
	
	#sortable li{ 
		margin: 0 3px 3px 3px; 
		padding: 0.4em; padding-left: 1.5em; 
		font-size: 1.4em; height: 18px; 
		cursor: move;
		
	}
	
	#sortable li span { 
		position: absolute; margin-left: -1.3em; 
	}
	
	</style>
	<script type="text/javascript">
		var updateOrder = function(area){
			var serial = $('#sortable').sortable('serialize');
			 $('#zyx-content-update').load('/{$toBackDoor}/navigation/updateOrder/?'+serial);
		};
		
	$(function() {
		$("#sortable").sortable({
			update: function(event, ui) {
				updateOrder('left');
			}
		});
		
		//$("#sortable").disableSelection();

		$("#new-link").click(function(){
			var host = 'http://'+window.location.hostname+'/';
			var href = prompt('Enter URL ~ (Start with "/" or "http://"):',host);
			if(href != '' && href != 'null'){
				var title = prompt('Link Title');
				if(title != '' && title != null){
					$.post('/{$toBackDoor}/{$Xtra}/save/?json',{
						form	: {
							href	: href,
							title	: title,
							parent	: xNav.PARENT_MENU,
						}
					},function(json){
						xNav.loadMenu(xNav.PARENT_MENU);
					});
				}
			} 
		});

		xNav = {
			PARENT_MENU : 0,
			loadMenu: function(id,post,fn){
				var fn = fn;
				$('#nav-list').load('/{$toBackDoor}/{$Xtra}/menu/'+id+'?html',post,function(json){
					$("#sortable").sortable({
						update: function(event, ui) {
							updateOrder('left');
						}
					});
					if(fn){
						fn();
					}
				});	
			},
			subLink	: function(id,name){
				xNav.loadMenu(id,{},function(){
					location = '#';
					var link = '<a href="#" id="parent-'+id+'">/'+name+'</a>';
					
					link = $('#goto-parent').html()+link; 
					$('#goto-parent').html(link);
					$('#goto-parent a').click(function(){
						xNav.PARENT_MENU = this.id.replace('parent-','');
						var click = this;
						xNav.loadMenu(xNav.PARENT_MENU,{},function(){
							var el = $(click).next();
							function hideNext(el){
								if(el.html()){
									el.hide();
									hideNext(el.next());
								}
							}
							hideNext(el);
						});
					});

					xNav.PARENT_MENU = id;
				});
				
			},
			removeLink	: function(id,title){
				var yes = confirm('Are you Sure you want to Delete the Link: "'+title+'" ?');
				if(yes){
					$('#item_'+id).fadeOut('slow');
					$.post('/{$toBackDoor}/{$Xtra}/delete/'+id.replace('link-','')+'/?json',{},function(){
						xNav.loadMenu(xNav.PARENT_MENU);

						Ext.getCmp('navigation-tree').getRootNode().reload();
					});
				}
			},
			editLink	: function(id){
				var win = new Ext.Window({
					title	: 'Edit Link',
					iconCls	: 'x-icon-16x16-link_edit',
					modal	: true,
					width	: 400,
					autoHeight	: true,
					items	: [{
						xtype	: 'form',
						id		: 'edit-menu-link',
						defaultType	: 'textfield',
						frame	: true,
						labelWidth	: 50,
						defaults	: {
							anchor	: '95%'
						},
						items	: [{
							fieldLabel	: 'Title',
							name		: 'form[title]'
						},{
							fieldLabel	: 'URL',
							name		: 'form[href]'
						}],
						buttonAlign	: 'center',
						buttons	: [{
							iconAlign: 'top',
							//iconCls: 'x-icon-32x32-network',
							scale: 'large', 
							text	: 'Save',

							iconCls	: 'x-icon-32x32-record_button',
							handler	: function(){
								Ext.Msg.wait('Saving','Please Wait...');
								Ext.getCmp('edit-menu-link').getForm().submit({
									url	: '/{$toBackDoor}/{$Xtra}/save/'+id+'/?json',
									success	: function(){ 
										Ext.getCmp('navigation-tree').getRootNode().reload();
										win.close();
										Ext.Msg.hide(); 
										 
									}
								});
							}
						}] 
					}]
				}).show(null,function(){
					Ext.getCmp('edit-menu-link').getForm().load({
						url	: '/{$toBackDoor}/{$Xtra}/load/'+id+'/?json',
					});
				});
			}
		};
	});
	</script>
<!-- 
<table align='center' width='50%' id='admin-zone-panel'>
	<tr>
		<th colspan=3>
			<button class="sdx-toolbar" id="new-link">
				<img src="{$ICON.48}/browser.png" align="absmiddle"/>
				New Link
			</button>
			
			<img src="{$ICON.48}/fullscreen.png" align="absmiddle"/>
			Click and Drag to Arrange the Navigation
			<img src="{$ICON.16}/mouse.png" align="absmiddle"/>
			<br/>
			<span id="crumbs">
				<div id="goto-parent" />
					<a href="#navigation" id="parent-0"> Main </a>
				</div> 
			</span>  
		</th>
	</tr>
	<tr>
		<td>
			<div id="nav-list">
				{*include file="/{$toBackDoor}/{$Xtra}/menu.html"*}
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div id="zyx-content-update" align="center">
			</div>
		</td>	
	</tr>
</table>
<script>

 -->
 
			
</script>
<script type="text/javascript" src="/fileServer/js/jq/jquery.qrcode.min.js"></script> 
<script type="text/javascript" src="/fileServer/js/jq/qrcode.js"></script> 
<script type="text/javascript">{include file="{$Door}/{$Xtra}/initNavPanel.js"}</script>