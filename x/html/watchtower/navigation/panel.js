
x4.siteMap = Ext.extend(Ext.Panel, {
	id		: 'sitemap',
	frame	: false,
	layout	: 'border',
	padding	: 0,
	tbar	: [{
		text	: 'Back',
		iconAlign: 'top',
		iconCls	: 'x-icon-16x16-arrow_state_blue_left',
	},{
		text	: 'Forth',
		disabled	: true,
		iconAlign: 'top',
		iconCls	: 'x-icon-16x16-arrow_state_blue_right',
	},{
		xtype	: 'textfield',
		width	: 550,
		id		: 'upload-location-bar',
		selectOnFocus: true,
		submitValue: false
	},{
		text	: 'Download',
		iconAlign: 'top',
		iconCls	: 'x-icon-16x16-world_link',
		id		: 'upload-download-btn',
		handler	: function(){
			location = Ext.getCmp('upload-location-bar').getValue();
		}
	}],
	loadStore	: function(cfg){
		this.JsonStore.load(cfg);
	},
	initComponent: function() {
		
		var clickDir = function(n){	   
			 
			// Lets store the path for our history!
			var uf = Ext.getCmp('upload-btn-panel');
			if(n.getDepth()>0){
				Ext.getCmp('upload-upload-btn').enable();
				uf.getEl().unmask();
				var loc = (n.parentNode.depth > 0) ? n.parentNode.text+'/'+n.text : n.text ;
				//Ext.getCmp('uploadify-dir').setValue(loc);
				//Ext.getCmp('uploadify-dir-id').setValue(n.id.replace('dir-',''));
				
				var loc_bar = Ext.getCmp('upload-location-bar');
				Ext.getCmp('upload-download-btn').disable();
				loc_bar.setValue(n.text+'/');
				var child = n;
				for(i=0;i<=n.getDepth();i++){
					
					if(child.parentNode){
						child = child.parentNode ;
						if(child.getDepth() > 0) {
							var get = loc_bar.getValue(); 
							loc_bar.setValue(child.text+'/'+get );	
						}
						 	
					}
				}
				
	        }else{
	        	Ext.getCmp('upload-upload-btn').disable();
	        	uf.getEl().mask('<img src="/bin/images/icons/16x16/arrow_large_down_outline.png" align="absmiddle" />  Choose a Folder to Upload to');
			}
			
			
			Ext.getCmp('file_data').getStore().load({
				params : {
					dir	: n.id.replace('dir-','')
				}
	    	});
			
			
			
			$.post('/{$toBackDoor}/upload/stats/',{
				id	: n.id.replace('dir-','')
			},function(r){
				r = Ext.util.JSON.decode(r);
	 			store_stats.loadData(r);
	 			
	 			var size = 0;
	 			Ext.each(r,function(o){
	 				size = size + o.bytes;
	 			});
	 			
	 			Ext.getCmp('stat-pie').setTitle('Total Size: '+Ext.util.Format.fileSize(size) );
	 		});
			
		};
	
	/**
		 * Template for Dataview
		 */
	  this.file_template = new Ext.XTemplate(
		'<tpl for=".">',
		'<div class="thumb-wrap file-select" id="file-{id}">',
		'<div class="thumb">',
		'<img title="{file_name}" src="/{$toBackDoor}/upload/thumb/{id}/?" class="thumb-img">',
		'<br/><span class="file-name">{file_name}.{file_ext}</span>',
		'</div>', 
		'</div>',
		'</tpl>'
	  );

	   
	  
	  var ge = this.te = new Ext.tree.TreeEditor(this.tree = new Ext.tree.TreePanel({
	  		region	: 'center',
			iconCls	: 'x-icon-16x16-drive_web',
			id		: 'sitemap-'+this.id+'-tree',
			width	: 225,
			xtype	: 'treepanel',
			split	: true,
			useArrows	: true,
		    autoScroll	: true,
		    animate		: true,
		    enableDD	: true,
		    containerScroll: true,
			ddGroup		: 'organizerDD',
		    border		: false,
		    baseAttrs: {
        		allowDrag: false,
        		singleClickExpand : true
        	},
		    root: {
		        nodeType	: 'async',
		        text		: window.location.hostname,
		        iconCls		: 'x-icon-16x16-upload',
		        expanded	: true,
		        collapsible	: false,
		        draggable	: false,
		        allowDrag	: false,
		        editable	: false,
		        allowDrop	: true,
		        id			: 'dir-0'
		    },
		    loader: new Ext.tree.TreeLoader({
		    	// auto create TreeLoader
			    dataUrl: '/{$toBackDoor}/upload/tree',
	        	baseAttrs: {
	        		singleClickExpand : true
	        	}
		    }),
		    listeners: {
	        	click: clickDir,
	        	contextMenu: function(n,e){
		        	var menu = new Ext.menu.Menu({
			             id:'ispace-ctx',
			             shadow: 'frame',
			             items: [{
		            	 	text: 'Reload',
					    	iconCls: 'x-icon-16x16-database_refresh',
			                handler: function(){
			           			Ext.getCmp('upload-tree').getRootNode().reload();
			                }
			             },{
			            	 text:'Reload Dir',
			            	 iconCls: 'x-icon-16x16-refresh',
			            	 handler: function(){
			            	 	n.parentNode.reload()
			             	 }
			             }/*,{
			            	 text:'Expand',
			            	 iconCls: '',
			            	 handler: n.expand
			             },{
			            	 text:'Expand All',
			            	 iconCls: '',
			            	 handler: n.expandAll
			             }*/],
			             listeners: {
			            	hide: function(){
			            	 	menu.destroy();
			             	}
			             }
			            	 
			         });
			         menu.showAt(e.getXY());
			         e.preventDefault();
		        },
	        	load: function(n){
	        		if(n.id == 'dir-0'){
	        			Ext.getCmp('upload-btn-panel').getEl().mask('<img src="/bin/images/icons/16x16/arrow_large_down_outline.png" align="absmiddle" />  Choose A Folder to Upload to');
			        }
	        	},
	        	dragdrop: function(tp,tn, dd, e){ 
	        		
	        	},
	        	beforemovenode : function(tree,node,oldParent,newParent,index){
	        		if(newParent != oldParent) {
	        			var c = confirm("Moving "+node.text+" to "+newParent.text);
		        		if(c){
		        			$.post('/{$toBackDoor}/upload/dropFolder/',{
			        			data: node.id.replace('dir-',''),
			        			drop: newParent.id.replace('dir-','')
			        		},function(data){
			        			if(data == 1){
			        				//alert('File Move Successful');	
			        			}
			        		});
		        		}else {
		        			return false;
		        		}	
	        		}
	        	},
	        	beforecollapsenode: function(n){
	        		if(n.getDepth()>1)
	        			n.getUI().getIconEl().src = '/bin/images/icons/16x16/folder_modernist.png';
	        	},
	        	beforeexpandnode: function(n){
	        		
	        		if(n.getDepth()>1){
	        			n.getUI().getIconEl().src = '/bin/images/icons/16x16/folder_modernist_opened.png';
	        		}
	        	},
		    },
		    bbar	: [/*{
				text	: 'Restore',
				iconCls	: 'x-icon-16x16-page_white_get',
				menu	: {
					splitButton	: true,
					items	: [{
						text	: 'Restore Selected',
						iconCls	: 'x-icon-16x16-page_white',
					},{
						text	: 'Restore All',
						iconCls	: 'x-icon-16x16-page_white_stack',
					}] 
				}
			},*/]
	  }), {
			allowBlank:false,
	        blankText:'Please Label this Folder',
	        emptyText:'New Folder',
	        iconCls : 'x-icon-16x16-folder_add' 
		}, {
	        selectOnFocus:true,
	        listeners: {
	    		complete: function(t,v,o){
		
					if(o != v && v != '' ){
		    			var node 		= t.editNode; 
						var parent_id 	= node.parentNode.id;					        						
						$.post("/{$toBackDoor}/upload/newFolder/?returnJson",{ 
							text		: v, 
							parent_id	: parent_id.replace('dir-',''),
							node_id		: node.id.replace('dir-','')
	    				},function(data){
	        				var r = Ext.util.JSON.decode(data);
	        				r = r.node;
	    					if(r.success){
	    						node.setText(r.text);
	    						//on.node.click(n);
	    						node.parentNode.reload(function(){
	    							try{
	    								var tree = Ext.getCmp('upload-tree');
	    								var node = tree.getNodeById('dir-'+r.id);
	    								node.expand();
	    								
	    								tree.getSelectionModel().select(node);
	    								clickDir(node);
	    								//on.node.click(node);
	    								//ume.msg(ume.getIcon('folder_modernist_up')+r.name+' Created','Ready for Uploading!');
	    								//Ext.getCmp('infinite-tab-'+r.id).setTitle(r.name);
	    							}catch(e){
		    							alert(e)
		    						}
	    						});			    						
	        				}else{
	        					node.setText(o);
	        					Ext.Msg.alert('Failed Creating Folder ',r.reason);
	        				}
	        			});
	    			}else{
	    				//t.editNode.remove();
						//Ext.Msg.alert('Failed Creating Folder ','Label must not be empty');
		    		}
	    		}
	    	}
	    });
		
	  var tabpanel = this.tabpanel = new Ext.TabPanel({
			region	: 'center',
			border	: false,
			id		: 'folder-tabs',
			xtype	: 'tabpanel',
			tabPosition: 'bottom',
			deferredRender	: false,
			activeTab	: 0,
			defaults	: {
				autoScroll	: true,
			},
			items	: [{
				title	: 'Folder Contents',
				id		: 'files',
				iconCls	: 'x-icon-16x16-chart_organisation',
				items	: [view = new Ext.DataView({
			        itemSelector: 'div.thumb-wrap',
			        style	:'overflow:auto',
			        id		: 'file_data',
			        layout	: 'fit',
			        region	: 'center',
			        emptyText	: 'Empty',
			        multiSelect: true,
			        plugins: new Ext.DataView.DragSelector({
				        dragSafe:true
				    }),
				    listeners	: {
				    	afterrender: function(){
							new ImageDragZone(Ext.getCmp('file_data'), {
						 		containerScroll:true,
					        	ddGroup: 'organizerDD'
						    });
			    		},
			    		
			    		contextmenu: function(dv,i,n,e){
							s = dv.getSelectedRecords();
							if(s.length > 1 ){
								
								// Check for Ext Types!
								// if music, create playlist
								var json = '';
								for(i=0;i<s.length;i++){
									json += (json == '') ? '' : ',';
									json += s[i].get('id');
								}
								json = '['+json+']';
								//alert(json);
								// if documents, create pdf
								// if pictures, create slideshow
								// if video, create playlist
								var down = [{
									text: 'Download Options',
									menu: {
										items: [{ 
											text: 'Compressed Package',
											iconCls: 'x-icon-16x16-package_green'
										},{
											text	: 'As Playlist',
											iconCls: 'x-icon-16x16-page_white_cd',
											handler: function(){
												window.location = '/playlist/'+json;
											}
										},{
											text	: 'View Slideshow',
											iconCls: 'x-icon-16x16-photos'
										},{
											text	: 'As Playlist',
											iconCls: 'x-icon-16x16-tv'
										}]
									}
								}];
							}else{
								r = dv.getRecord(n);
								down = {
						             id:'dwn',
						             iconCls:'x-icon-lightning',
						             text:'Download '+r.get('fullname'),
						             scope: this,
						             handler:function(){
						                 window.location = "/download/"+r.get('id');
						             }
						         };
							}
							
							/*restore = (nid == 'trash')?[{
							 text:'Restore',
			                 iconCls:'x-icon-page_refresh',
			                 handler: filesys.restore
							}]:{
				                 text:'Remove',
				                 iconCls:'x-icon-delete',
				                 scope: this,
				                 handler: filesys.delFile
				            };*/
							
							menu = null; 
							menu = new Ext.menu.Menu({
								id:'feeds-ctx',
					            shadow: 'frame',
					            items: [down,'-',{
									text:'Remove',
									iconCls:'x-icon-delete',
									scope: this,
									handler: function(){
					            		$$.xUpload.delFile();
					            	}
					            }],
					             listeners: {
					            	hide: function(){
					            	 	menu.destroy();
					             	}
					             }
					            	 
					         });
					         menu.showAt(e.getXY());
					         e.preventDefault();
						},
			    		
			    		dblclick: function(dv,i,node,e){
			    			var r = dv.getRecord(node);
			    			var file = r.data;
			    			
			    			var link = 'http://'+window.location.hostname+"/upload/download/"+file.id+"/"+file.file_name+"."+file.file_ext;
			    			
				    		var win = new Ext.Window({
					    		title	: file.file_name+'.'+file.file_ext,
					    		modal	: true,
					    		layout	: 'fit',
					    		width	: 700,
					    		height	: 450,
					    		
					    		items	: [{
					    			xtype	: 'tabpanel',
					    			activeTab	: 0,
					    			items	: [{
							    		title	: 'Preview',
							    		iconCls	: 'x-icon-16x16-page_white',
							    		autoScroll: true,
							    		html	: '<center><img title="{file_name}" src="/{$toBackDoor}/upload/thumb/'+file.id+'/?h=270&zc=0" class="thumb-img"></center>',
							    		buttonAlign	: 'center',
							    		buttons	: [{
							    			text	: 'Download',
							    			iconCls	: 'x-icon-16x16-download',
							    			handler	: function(){
							    				window.location.href = "/upload/download/"+file.id
							    			}
							    		}]
							    	},{
							    		title	: 'Details',
							    		iconCls	: 'x-icon-16x16-document_letter_marked',
							    		xtype	: 'form',
							    		region	: 'center',
							    		layout	: 'form',
							    		frame	: true,
							    		defaultType		: 'textfield',
							    		defaults		: {
							    			anchor	: '97%'
							    		},
							    		items			: [{
								    		fieldLabel	: 'Download Link',
								    		selectOnFocus	 : true,
								    		value		: link
								    	},{
								    		fieldLabel	: 'Name',
								    		value		: file.file_name 
								    	},{
								    		fieldLabel	: 'Extension',
								    		value		: file.file_ext
								    	},{
								    		fieldLabel	: 'Size',
								    		value		: Ext.util.Format.fileSize(file.file_size)
								    	},{
								    		fieldLabel	: 'Host Farm',
								    		value		: file.file_farm 
								    	},{
								    		fieldLabel	: 'MD5',
								    		value		: file.file_md5
								    	},{
								    		fieldLabel	: 'Raw File',
								    		selectOnFocus	 : true,
								    		//value		: 'http://'+file.farm+'/^/';
								    	}]	
							    	},{
							    		title	: 'Permissions',
							    		iconCls	: 'x-icon-16x16-lock'
							    	}]
					    		}]
					    	}).show();

					    },
				    	click : function(dv,i,node,e){
			    			var r = dv.getRecord(node);
			    			var file = r.data;
			    			var url = 'http://'+window.location.hostname+"/upload/download/"+file.id+"/"+file.file_name.replace(' ','+')+"."+file.file_ext;
			    			Ext.getCmp('upload-location-bar').setValue(url);
			    			Ext.getCmp('upload-download-btn').enable();
							
			    		}

				    },
			        store: this.JsonStore = new Ext.data.JsonStore({
				        autoLoad	: true,
			            url		: '/{$toBackDoor}/upload/jsonFiles/?returnJson',
			            method	: 'POST',
			            root	: 'data',
			            id		: 'id',
			            fields	: ["file_ext","file_name","file_md5","file_parent","file_path","id","file_size","file_farm"],
			            baseParams:{
				            dir	: null
					    },
					    listeners	: {
						    load	: function(){
						    	
						    }

						}
			        }),
			        tpl: this.file_template
			    })]
			},{
                title: 'Folder Stats',
                iconCls: 'x-icon-16x16-chart_pie',
                layout: 'fit',
                autoScroll	: false,
                items:[{
                	 title: 'Total Size in Bytes by Type',
                	 id: 'stat-pie',
                     layout: 'fit',
                     items: pieChart = new Ext.chart.PieChart({
                 		store: store_stats = new Ext.data.JsonStore({
                 		    root: '',  
                 		    fields: [{name: 'type', convert: Ext.util.Format.uppercase}, {name: 'bytes'}]
                 		}),
                 		url:'/bin/js/ext-3.2.1/resources/charts.swf',
                 		dataField: 'bytes',
                         categoryField: 'type', // <-- this is very important!!,
                 		 extraStyle:
                          {
                              legend:
                              {
                                  display: 'bottom',
                                  padding: 5,
                                  font:
                                  {
                                      family: 'Tahoma',
                                      size: 13
                                  }
                              }
                      	}
                 	})
                }],
            	listeners:{
	        		show:function(){
						var n = Ext.getCmp('upload-tree').getSelectionModel().getSelectedNode();
						n = (n) ? n.id.replace('dir-','') : 0;
						$.post('/{$toBackDoor}/upload/stats/',{
							id	: n
						},function(r){
							r = Ext.util.JSON.decode(r);
				 			store_stats.loadData(r);
				 			
				 			var size = 0;
				 			Ext.each(r,function(o){
				 				size = size + o.bytes;
				 			});					 			
				 			Ext.getCmp('stat-pie').setTitle('Total Size: '+Ext.util.Format.fileSize(size) );
				 		});
	        		}
	        	}
        	},{
				title	: 'Share Folder',
				iconCls	: 'x-icon-16x16-eye',
				layout	: 'form',
				disabled	: true,
				defaultType	: 'fieldset',
				defaults	: {
					labelAlign	: 'top',
					layout		: 'form'
				},
				items	: [{
					title	: 'Choose the Default View for this Folder',
					items	: [{
						
					}]
				},{
					title	: 'Choose a Custom Folder Thumbnail',
					items	: [{
						
					}]
				},{
					title	: 'Choose a Custome Folder Icon',
					items	: [{
						
					}]
				}]
			},{
				title	: 'Customize Folder',
				iconCls	: 'x-icon-16x16-palette',
				layout	: 'form',
				defaultType	: 'fieldset',
				disabled	: true,
				defaults	: {
					labelAlign	: 'top',
					layout		: 'form'
				},
				items	: [{
					title	: 'Choose the Default View for this Folder',
					items	: [{
						
					}]
				},{
					title	: 'Choose a Custom Folder Thumbnail',
					items	: [{
						
					}]
				},{
					title	: 'Choose a Custome Folder Icon',
					items	: [{
						
					}]
				}]
			}]
		});
	  	
		   
	  this.items	= [{
		  	region	: 'center',
		  	collapsible	: true,
		  	expandable	: true,
		  	collapseMode: 'mini',
		  	width	: 225,
		  	split	: true,
		  	layout	: 'border',
		  	border	: false,
		  	defaults	: {
		  		border	: false
	  		},
		  	items	: [this.tree]
	  	}];	
		x4.siteMap.superclass.initComponent.call(this);
	}
});


