
<script type="text/javascript" src="/bin/js/ext/ext-3.3.1/examples/ux/ProgressBarPager.js"></script>

<script type="text/javascript"  ><!--
	
	Ext.ns('x4.forums');
	
	if(!$$.xForums){
		x4.direct('xForums');
	}

	{include file="{$toBackDoor}/forums/x4Topic.js"}

	{literal}
	x4.forums.Renderers = {
	    topic : function(value, p, record){
	        return String.format(
	                '<div class="topic"><b>{0}</b> ~ <span class="author">{1}</span></div>',
	                value, record.data.topic_author, record.id, record.data.forum_id);
	    },

	    lastPost : function(value, p, r){
	        return String.format('<span class="post-date">{0}</span><br/>by {1}', value.dateFormat('M j, Y, g:i a'), r.data['last_poster']);
	    }
	};
	{/literal}
	// The data store for topics
	x4.forums.TopicStore = function(){
		x4.forums.TopicStore.superclass.constructor.call(this, {
	        //autoLoad	: true,
	        baseParams: {
				id		: 'latest',
				start	: 0,
				limit	: 10
			},
	        proxy: new Ext.data.DirectProxy({
		        directFn	: $$.xForums.getTopics,
				paramOrder: 'id|start|limit',
	            //url: 'http://'+location.hostname+'/forums/topics/.php'
	        }),
	        remoteSort: true,
	        reader: new Ext.data.JsonReader({
	        	root	: 'data',
	            totalProperty: 'total',
	            id: 'id'
	        }, [{
				name	: 'topic_title'
			},{
				name	: 'topic_author'
			},{ 
				name	: 'id'
			},{
				name	: 'topic_timestamp'
			},{
				name	: 'topic_views'
			},{
				name	: 'topic_replies',
				type: 'int'
			},{
				name	: 'topic_category'
			},{
				name	: 'topic_icon'
			},{
				 name: 'last_post',
				 mapping: 'last_post',
				 type: 'date',
				 dateFormat: 'timestamp'
			},{
				name	: 'last_poster'
			},{
				name	: 'topic_color'
			},{
				name	: 'excerpt'
			}])
	    });

	    this.setDefaultSort('last_post', 'desc');
	};

	Ext.extend(x4.forums.TopicStore, Ext.data.Store, {
	    loadForum : function(forumId){
	        this.baseParams = {
	            forumId: forumId
	        };
	        this.load({
	            params: {
	                start:0,
	                limit:25
	            }
	        });
	    }
	});
	
	x4.forums.Tree = Ext.extend(Ext.tree.TreePanel,{
		initComponent	: function(){
			var tp = this.tp = this;
			var te = this.treeEditor = new Ext.tree.TreeEditor(tp, {
				allowBlank	: false,
		        blankText	: 'Please Label this Forum',
		        emptyText	: 'New Forum',
		        iconCls 	: 'x-icon-16x16-folder_add' 
			}, {
		        selectOnFocus:true,
		        listeners: {
		    		complete: function(te,v,o){
						if(o != v && v != '' ){
			    			var node 		= te.editNode; 
							var parent_id 	= node.parentNode.id;					        						
							$$.xForums.newForum(
								v,
								parent_id.replace('forum-',''),
								node.id.replace('forum-',''),
		    					function(r){
			    					if(r.success){
			    						node.setText(r.text);
			    						//on.node.click(n);
			    						node.parentNode.reload(function(){
			    							try{
			    								var node = tp.getNodeById('forum-'+r.id);
			    								node.expand();
			    								tp.getSelectionModel().select(node);
			    								//clickDir(node);
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
			        			}
			        		);
		    			}else{
		    				//t.editNode.remove();
							//Ext.Msg.alert('Failed Creating Folder ','Label must not be empty');
			    		}
		    		}
		    	}
		    });

			 
		    
			
			this.tbar	= [{
	        	iconCls		: 'x-icon-16x16-comments_add',
	        	iconAlign	: 'top',
	        	text		: 'New Forum', 
	        	id			: 'new-forum-btn',
	        	scope	: this,
	        	handler: this.newForum = function(){
					node = tp.getSelectionModel().getSelectedNode();
	
		    		if(!node){
		    			Ext.Msg.alert('Invalid Location','Please Select a Forum to add to');
			    		return false;
				    }
	
		    		node.expand(true,true,function(node){
		    			node  = node.appendChild(new Ext.tree.TreeNode({
			                text: '',
			                leaf: false,
			                iconCls:'x-icon-16x16-folder_modernist_add',
			                editable  : true,
			                allowDrag : true
			            }));
			            tp.getSelectionModel().select(node);					            	
		            	te.editNode = node;
		            	te.startEdit(node.ui.textNode);
			    	});
				}
			}];
			this.tools	= [{
				id	: 'refresh',
				scope	: this,
				handler: function(){
					//Ext.getCmp('forum-tree').getRootNode().reload();
					tp.getRootNode().reload();
				}
			}];
			x4.forums.Tree.superclass.initComponent.call(this);
		},
		region		:'west',
		title		: 'Forum Navigation',
		iconCls		: 'x-icon-16x16-mouse', 
		animate		: true,
        useArrows	: true,
        autoScroll	: true,
    	singleClickExpand: true,
		layout	: 'fit',
		id		:'forum-tree',
        collapsible	: true,
        expandable	: true,
		collapseMode: 'mini',
        split	: true,
        width	: 220,
        minWidth: 220,
        //ddGroup		: 'forum-organizerDD',
	    border		: false,
	    baseAttrs: {
    		allowDrag	: true,
    		allowDrrop	: true,
    		singleClickExpand : true
    	},
        listeners	: {
			click	: function(node,ev){
				if(node.leaf){
					var store = Ext.getCmp('forum-topics').store; 
					store.setBaseParam('id', node.id);
					store.load();
					try {
						// var hogforums = this.getIcon('home_grey')+'<a style="color: white" href="#" onmousedown="var store = Ext.getCmp(\'forum-topics\').store; store.setBaseParam(\'id\', \'latest\'); store.load(); Ext.getCmp(\'topics-panel\').setTitle(\'All Latest Topics\')">[Forum Portal]</a>';
						// Ext.getCmp('topics-panel').setTitle(hogforums +' ~ '+ node.parentNode.text +' ~ '+ node.text);
						//var pageTracker = _gat._getTracker("UA-16219956-1");
						///pageTracker._setDomainName(".HalloftheGods.com");
						//pageTracker._trackPageview("/forums/"+ node.parentNode.text+"/"+node.text);
					} catch(err) {}
				}
			}
		},
        loader: new Ext.tree.TreeLoader({
            directFn: $$.xForums.tree,
           	autoLoad	: true,
        	//dataUrl: '/{$toBackDoor}/forums/tree',
        	listeners: {
        		load: function(t,n,r){
	            	//var store = Ext.getCmp('forum-topics').store; 
					//store.setBaseParam('id', 'latest');
					//store.load();
					//Ext.getCmp('topics-panel').setTitle('All Latest Topics');
				}
        	}
        }),
        rootVisible	: true,
        lines:false,
        autoScroll:true,

	    enableDD	: true,
        root: {
        	id: 'forum-root',
            text: location.host+' Forums',
            iconCls: 'x-icon-16x16-comments',
            allowDrag	:true,
            editable	: false,
            allowDrop	: true,
            autoLoad	: true,
            expanded	: true,
        },
        buttonAlign: 'center',
        listeners	: {
            nodeDrop		: function(de){
            	DROP  = de;
            	var node = de.dropNode;

            	// Lets Weigh these contents.
            	var el = node.parentNode.getUI().getEl();
            	//alert(el.id);
            	
            	//alert('Dropped Node '+.text);

            },
        	beforemovenode : function(tree,node,oldParent,newParent,index){
	    		if(newParent != oldParent) {
	    			var data = node.id.replace('forum-','');
					var drop = newParent.id.replace('forum-','');
        			var c = confirm("Moving "+node.text+" to "+newParent.text);
	        		if(c){
	        			$$.xForums.moveNode(data,drop,function(data){
	        				if(data.success == 1){
		        				//alert('File Move Successful');	
		        			}
		        		});	  
	        		}else {
	        			return false;
	        		}	
	    		}
	    	},
		}
    });

	
	x4.forums.Tabs = Ext.extend(Ext.TabPanel, {
		activeTab		: 0,
		deferredRender	: false,
		initComponent	: function(){
			this.forumTree = new x4.forums.Tree();
			//tp.load();
			this.forumTree.addListener('contextMenu', function(n,e){
				//alert(n.text);
				
				
				
				var forumDetails;
				
	        	var menu = new Ext.menu.Menu({ 
		             shadow: 'frame',
		             items: [{
			             text	: 'Forum Properties',
			             iconCls	: 'x-icon-16x16-comments_reply',
			             handler	: function(){
			             	var win = x4.Window({
				             	title	: 'Forum Editor | '+n.text,
				             	modal	: true,
				             	iconCls	: 'x-icon-16x16-comments_reply',
				             	id		: 'forum-edit-'+n.id,
				             	items	: [forumDetails = new Ext.form.FormPanel({
						        	api		: {
					            		load	: $$.xForums.loadDetails,
					            		submit	: $$.xForums.saveDetails
					            	},
					            	paramOrder	: 'id',
					            	layout	: 'form',
					            	frame	: true,
					            	labelAlign	: 'top',
					            	items	: [{
						             	name	: 'id',
						             	xtype	: 'hidden',
						            },{
							            layout	: 'column',
							            defaults	: {
							            	columnWidth	: .5,
							            	layout	: 'form'
							           	},
							            items	: [{
								            items	: [{
								             	fieldLabel : 'Forum Title',
								             	xtype	: 'textfield',
								             	name	: 'text',
								             	anchor	: '100%'
								            }]
								        },{
									        items	: [{
									            xtype	: 'textfield',
									            fieldLabel	: 'Forum Icon',
									            name		: 'iconCls',
									            listeners	: {
									            	blur	: function(tf){
								            			Ext.getCmp('save-forum-btn').setIconClass('x-icon-16x16-'+tf.getValue());
								            		}
									            }
									        }]
									    }]
							        },{
						             	fieldLabel : 'Quick Description/Tip',
						             	xtype	: 'textfield',
						             	name	: 'qtip',
						             	anchor	: '100%'
						            },{
						             	fieldLabel : 'Forum Details / Rules',
						             	xtype	: 'textarea',
						             	name	: 'rules',
						             	anchor	: '100%'
						            }],
						       	 	autoHeight	: true
					           	})],
					            buttonAlign	: 'center',
					            buttons	: [{
						            text	: 'Save Forum',
						            id		: 'save-forum-btn',
						            iconAlign	: 'top',
						            iconCls	: 'x-icon-16x16-comments_add',
						            handler	: function(){
					            		forumDetails.getForm().submit({
						            		success	: function(){
					            				win.close();
					            				n.parentNode.reload();
						            		},
						            		failure	: function(r){
							            		Ext.Msg.alert('Failed!',r.error);
								            }
						            	});
						            }
						        }],
				             	width	: 420,
			             	});
			             	win.show(null,function(){
			             		forumDetails.getForm().load({
				             		params	: {
				             			id : n.id
				             		}
				             	});
				            });
			             }

			         },{
				         text	: 'Add Sub-Forum',
				         handler	: function(){
			        	 	Ext.getCmp('forum-tree').newForum(n);
				         },
				     	 iconCls		: 'x-icon-16x16-comments_add',
				     },'-',{ 
		            	 text:'Reload Forum',
		            	 iconCls: 'x-icon-16x16-refresh',
		            	 handler: function( ){ 
		            	 	n.reload()
		             	 }
		             },{
		                 text: 'Reload root',
		                 iconCls: 'x-icon-16x16-database_refresh',
		                 handler: function(){
		            		Ext.getCmp('forum-tree').getRootNode().reload();
		                 }
		             },'-',{ 
		            	 text:'Delete Forum',
		            	 iconCls: 'x-icon-16x16-remove',
		            	 handler: function( ){ 
			        		Ext.Msg.show({
								msg 	: 'Are You Sure? This Can NOT be Undone!<br/><b>'+n.text+'</b>',
							   	title	: 'Delete Forum!?',
							   	buttons: Ext.Msg.YESNOCANCEL,
							   	width	: 325,
							   	fn: function(btn){
									if(btn == 'yes'){
										Ext.Msg.wait('Please Wait...','Deleting ~ '+n.text);
										$$.xForums.deleteForum(n.id,function(data){
											Ext.Msg.alert('Success','Forum <b>"'+n.text+'"</b> has been Deleted, all sub topics & forums have floated up.');
											Ext.getCmp('forum-tree').getRootNode().reload();
										});
								   	}
								}, 
							   icon: Ext.MessageBox.ERROR
							});
		             	 }
		             },/*,{
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
	        });
			
			this.forumTopics = new Ext.DataView({
				id				: 'forum-topics',
				region			: 'center',
				autoScroll		: true,
				loadingText		: 'Loading Topics, Please Wait ...',
				itemSelector	: 'table.forum-row',
				multiSelect		: true,
				layout			: 'fit',
				emptyText		: 'Forum Empty',
				store			: {
					xtype		: 'directstore',
					//autoLoad	: true,
					directFn	: $$.xForums.getTopics,
					storeId		: 'ForumTopicsStore',
					idProperty	:'id',
					fields		: [{
						name	: 'topic_title'
					},{
						name	: 'topic_author'
					},{ 
						name	: 'id'
					},{
						name	: 'topic_timestamp'
					},{
						name	: 'topic_views'
					},{
						name	: 'topic_replies'
					},{
						name	: 'topic_category'
					},{
						name	: 'topic_icon'
					},{
						name	: 'last_poster'
					},{
						name	: 'topic_color'
					}],
					baseParams	: {
						id		: 'latest',
						start	: 0,
						limit	: 10
					},
					paramOrder	: 'id|start|limit',
					root		: 'data',
					remoteSort	: true,
					listeners	: {
						load: function(s, records){
							// Create Tooltips...
							/*
								if(s.length){
									s.each(function(r){
										var tip = Ext.getCmp('topic-tip-'+r.get('id'));
										if(tip){
											tip.destroy();	
										}
										new Ext.ToolTip({
											target		: 'topic-link-'+r.get('id'), 
											id			: 'topic-tip-'+r.get('id'),
											autoWidth	: true,
											autoLoad	: {
												url: '/+/tpl/topic/preview/?topic='+r.get('id')
											},
											title		: r.get('topic_author')+' ~ '+r.get('topic_title'),
											autoHide	: true,
											dismissDelay: 3500,
											showDelay	: 10,
											hideDelay	: 0,
											closable	: true
										});
									});
								}
							*/
							
						},
						beforeLoad: function(s, records){
							
						}
					}
				}, 
				{literal}
				tpl : new Ext.XTemplate(
					'<tpl for=".">',
					'<table cellpadding="1" cellspacing="0"  class="forum-row" width="100%" id="topic-link-{id}" align="center" onMouseOver="this.style.backgroundColor = \'{topic_color}\'" onMouseOut="this.style.backgroundColor = \'transparent\'">',
					'<tr>',
					'<td style="padding: 0 5px 0 5px" width="25">{topic_icon}</td>',
					'<td align="left" style="padding: 1px 5px 1px 0; font-size: 11px;" ><span style="font-size: 9px;">{topic_category} |</span><b>{topic_title}</b> <br/><span style="float:right;font-size: 9px;"><b>{last_poster}</b>  </span><span style="font-size: 9px; padding-left: 5px;"> <b>{topic_author}</b></span>',
					'</td><td width="25" style="text-align: center;padding-left: 5px; font-size: 8px" > <br/><b> {topic_replies}</b>',
					'</td><td width="25" style="text-align: center;font-size: 8px"><img src=""/><br/><b> {topic_views}</b>',
					'</td></tr></table>',
					'</tpl>'
				),
				{/literal}
				
				listeners: {
					contextmenu : function(){
						this.msg('HHAHAHA','OVer ehre!');
					},
					click:function(dv,index,htmlnode,event){
						var r 	 = dv.getRecord(htmlnode);
						var id 	 = r.get('id');
						var tabs = Ext.getCmp('tab-portal');
						var tab  = Ext.getCmp('topic'+id);
						if(!tab){
							tab = new x4.Topic({
		    					id			: 'topic-'+id,
		    					closable	: true,
		    					iconCls		: 'x-icon-script',
		    					title 		: Ext.util.Format.ellipsis(r.get('topic_category') +' > '+ r.get('topic_title'),35,true),
		    					fulltitle	: r.get('topic_category') +' > '+ r.get('topic_title'),
		    					autoScroll	: true,
		    					autoLoad	: {
		    						url 	: '/forums/topic/'+id,
		    						scripts		: true
		    					},	    
								listeners	: {
			    					afterrender	: function(){
	
	
				    					tabs.activate(tab);	
	
			    					}
			    				}						 
		    				});
							tabs.add(tab);
						} 
					}
				} 
			});

			var ds = x4.forums.ds = new x4.forums.TopicStore();
			ds.load();
		    var cm = new Ext.grid.ColumnModel([{
		           id: 'topic',
		           header: "Topic",
		           dataIndex: 'topic_title', 
		           renderer: x4.forums.Renderers.topic
		        },{
		           header: "Author",
		           dataIndex: 'topic_author', 
		           hidden: true
		        },{
		           header: "Replies",
		           dataIndex: 'topic_replies',
		           width: 20,
		           align: 'right'
		        },{
		           id: 'last',
		           header: "Last Post",
		           dataIndex: 'last_post', 
		           renderer: x4.forums.Renderers.lastPost
		        }]);

		    cm.defaultSortable = true;
		    
		    function toggleDetails(btn, pressed){
		        var view = Ext.getCmp('topic-grid').getView();
		        view.showPreview = pressed;
		        view.refresh();
		    }

		    function togglePreview(btn, pressed){
		        var preview = Ext.getCmp('preview');
		        preview[pressed ? 'show' : 'hide']();
		        preview.ownerCt.doLayout();
		    }
			this.items	= [{
				title	: 'Index',
				layout	: 'border',
				iconCls	: 'x-icon-16x16-information',
				items	: [this.forumTree,{
					title	: 'Topics',
					iconCls	: 'x-icon-16x16-eye',
					region	: 'center',
					layout	: 'fit',
					border	: false,
					items	: [new Ext.grid.GridPanel({
                        region:'center',
                        id:'topic-grid',
                        border	: false,
                        store: ds,
                        cm: cm,
                        sm:new Ext.grid.RowSelectionModel({
                            singleSelect:true,
                            
                            listeners: {
                            	rowselect		: function(sm,i,r){
		                        	//var r 	 = dv.getRecord(htmlnode);
		    						var id 	 = r.get('id');
		    						var tabs = x4.forums.live;
		    						var tab  = Ext.getCmp('topic'+id);
		    						if(!tab){

		    							var bbar = new Ext.Toolbar({ 
			    							height	: 40,
		    		    					items	: [{
		    		    						text	: 'First Post',
		    		    						iconCls	: 'x-icon-16x16-arrow_medium_up',
		    		    						iconAlign: 'top',
		    		    						//id		: 'top-btn-'+topic_id,
		    		    						handler	: function(b,e){
		    		    							//var id = b.getId().replace('btn-','');
		    		    							Ext.get(id).dom.scrollIntoView();
		    		    						}
		    		    					},'-',{
		    		    						text	: 'Last Post',
		    		    						iconCls	: 'x-icon-16x16-arrow_medium_down',
		    		    						iconAlign: 'top', 
		    		    						handler	: function(b,e){
		    		    							//var id = b.getId().replace('btn-','');
		    		    							Ext.get(id).dom.scrollIntoView();
		    		    						}
		    		    					},'->',{
		    		    						xtype	: 'textfield',
		    		    						//id		: 'quick-reply-'+topic_id,
		    		    						width	: (x4.v.w()*.40),
		    		    						emptyText: 'Type a quick reply here. When your done Press "ENTER"',
		    		    						listeners: {
		    		    							afterrender: function(t){
		    		    				                setTimeout(function(){
		    		    				                    t.focus();
		    		    				                },750);
		    		    				            },
		    		    							specialkey: function(field, e){
		    		    								// e.HOME, e.END, e.PAGE_UP, e.PAGE_DOWN,
		    		    								// e.TAB, e.ESC, arrow keys: e.LEFT, e.RIGHT, e.UP, e.DOWN
		    		    								if (e.getKey() == e.ENTER) {
		    		    									quickReply(field);
		    		    								}
		    		    							}
		    		    						}
		    		    					},{
		    		    						text: 'Quickness',
		    		    						iconCls: 'x-icon-16x16-comment_new_2', 
		    		    						iconAlign: 'top',
		    		    						handler	: function(b,e){
		    		    							 quickReply('quick-reply-'+id)
		    		    						}
		    		    							
		    		    					},'-',{
		    		    						text : 'Full Reply',
		    		    						iconCls: 'x-icon-16x16-comment_add',
		    		    						//id	: 'new-reply-btn-'+topic_id,
		    		    						iconAlign: 'top',
		    		    						handler	: function(){
		    		    							x4.doAction(function(){
		    		    								new Ext.Window({
		    		    									title : 'Post a Reply',
		    		    									iconCls: 'x-icon-comment',
		    		    									id	  : 'new-reply-win',
		    		    									modal : true,
		    		    									width : 550,
		    		    									height: 350,
		    		    									maximized: true,
		    		    									layout: 'fit',
		    		    									items : new Ext.form.FormPanel({
		    		    										frame	: true,
		    		    										id		: 'new-reply-form', 
		    		    										layout	: 'form',
		    		    										api : {
		    		    											submit : $$.Forums.saveReply
		    		    										},
		    		    										baseParams: {
		    		    											topic_id: topic_id
		    		    										},
		    		    										items: [{
		    		    											xtype: 'fieldset',
		    		    											title: 'Give your reply a title/subject? (Optional)',
		    		    											items: [{
		    		    												hideLabel: true,
		    		    												xtype: 'textfield',
		    		    												name: 'title',
		    		    												id	: 'reply-title',
		    		    												anchor: '100%'
		    		    											}]
		    		    										},{
		    		    											xtype: 'htmleditor',
		    		    											anchor: '100% -75',
		    		    											layout	: 'fit',
		    		    											name: 'html',
		    		    											id	: 'reply-html',
		    		    											hideLabel: true
		    		    										}]
		    		    									}),
		    		    									buttonAlign: 'center',
		    		    									buttons : [{
		    		    										text: 'Post Reply',
		    		    										iconAlign: 'top',
		    		    										iconCls: 'x-icon-comment_add',
		    		    										handler	: function(){
		    		    											Ext.getCmp('new-reply-form').getForm().submit({
		    		    												waitMsg	: x4.lang.wait,
		    		    												waitTitle: sys.getIcon('user_comment')+'Posting Reply',
		    		    												success	: function(f,a){
		    		    													sys.msg('Post Success!','Your Reply has been Posted');	
		    		    													Ext.getCmp('new-reply-win').close();
		    		    													Ext.Msg.hide();
		    		    													Ext.getCmp('topic-'+a.result.data.topic_id).getUpdater().refresh(function(){
		    		    														Ext.get('post-'+a.result.data.post_id).dom.scrollIntoView();
		    		    													});
		    		    												}
		    		    											});
		    		    										}
		    		    									}]
		    		    								}).show(function(){
		    		    									Ext.getCmp('reply-title').focus();
		    		    								});
		    		    							});
		    		    						}
		    		    					}]	
		    		    				});
			    						
		    							tab = new x4.Topic({
		    		    					id			: 'topic-'+id,
		    		    					closable	: true,
		    		    					layout	: 'fit',
		    		    					iconCls		: 'x-icon-16x16-script',
		    		    					title 		: Ext.util.Format.ellipsis(r.get('topic_category') +' > '+ r.get('topic_title'),35,true),
		    		    					fulltitle	: r.get('topic_category') +' > '+ r.get('topic_title'),
		    		    					autoScroll	: true,
		    		    					autoLoad	: {
		    		    						url 	: '/forums/topic/'+id+'?html',
		    		    						scripts		: true
		    		    					},
		    		    					bbar : bbar 	 
		    		    				});
		    							tabs.add(tab);
		    						} 

			    					tabs.activate(tab);	
                        		},
                                selectionchange	: function(sel){
                                    var rec = sel.getSelected();
                                    if(rec){
                                        //Ext.getCmp('preview').body.update('<b><u>' + rec.get('title') + '</u></b><br /><br />Post details here.');
                                    }
                                }
                            }
                        }),
                        trackMouseOver:false,
                        loadMask: { msg:'Loading Topics...'},
                        viewConfig: {
                            forceFit		: true,
                            enableRowBody	: true,
                            showPreview		: true,
                            getRowClass 	: function(record, rowIndex, p, ds){
                                if(this.showPreview){
                                    p.body = '<p>'+record.data.excerpt+'</p>';
                                    return 'x-grid3-row-expanded';
                                }
                                return 'x-grid3-row-collapsed';
                            }
                        },
                        tbar:[
                            {
                                text:'New Topic',
                                iconAlign	: 'top',
                                iconCls: 'x-icon-16x16-comment_new_2', 
                                handler:function(){
                                	x4.forums.newTopic()
                                }
                            },
                            '-'/*
                            ,
                            {
                                pressed: true,
                                enableToggle:true,
                                text:'Preview Pane',
                                tooltip: { title:'Preview Pane',text:'Show or hide the Preview Pane'},
                                iconCls: 'preview',
                                toggleHandler: togglePreview
                            }
                            */,
                            ' ',
                            {
                                pressed: true,
                                enableToggle:true,
                                text:'Summary',
                                tooltip: { title:'Post Summary',text:'View a short summary of each post in the list'},
                                iconCls: 'x-icon-16x16-comment_reply',
                                iconAlign	: 'top',
                                toggleHandler: toggleDetails
                            }
                        ],
                        bbar: new Ext.PagingToolbar({
                            pageSize: 25,
                            store: ds,
                            displayInfo: true,
                            {literal}
                            displayMsg: 'Displaying topics {0} - {1} of {2}',
                            {/literal}
                            emptyMsg: "No topics to display"
                        })
                    })]
				},{
					region	: 'east',
					collapsed	: true,
					title	: 'Statistics',
					width	: 200,
					iconCls	: 'x-icon-16x16-chart_pie',
				},{
					region	: 'south',
					title	: 'Activity',
				//	height	: 150,
				}]
			}];
			x4.forums.Tabs.superclass.initComponent.call(this);
		}
	});

	x4.forums.newTopic = function(){
		var saveTopic = function(publish){
			Ext.getCmp('new-topic').getForm().submit({
				waitMsg		: ume.getIcon('hourglass','right')+'Please Wait...',
				waitTitle	: ume.getIcon('disk')+'Saving Post', 
				params		: {
					publish	: publish
				},
				success: function(f,a){			
					Ext.getCmp('new-topic-win').close();
					if(Ext.getCmp('forum-topics')){
						Ext.getCmp('forum-topics').store.reload();	
					
						Ext.Msg.show({
							title:'Your Topic has been Saved!',
							msg: 'Would you like to view it now?',
							buttons: Ext.Msg.YESNO,
							fn: function(btn){
								if(btn == 'yes'){
									var r 	 = a.result.data;
				    				var id 	 = r.topic_id;
				    				var tabs = x4.forums.live;
				    				var tab  = Ext.getCmp('topic'+id);
				    				if(!tab){
				    					tab = new x4.Topic({
					    					id			: 'topic-'+id,
					    					closable	: true,
					    					iconCls		: 'x-icon-script',
					    					title 		: Ext.util.Format.ellipsis(r.category +' > '+ r.title,35,true),
					    					fulltitle	: r.category +' > '+ r.title,
					    					autoScroll	: true,
					    					autoLoad	: {
					    						url 	: '/forums/topic/'+id+'/?html',
					    						scripts		: true
					    					},
					    					listeners	: {
						    					afterrender	: function(){


							    					tabs.activate(tab);	

						    					}
						    				}	    					 
					    				});
					    				
				    					tabs.add(tab);
				    				}
								}
							},
							icon: Ext.MessageBox.QUESTION
						});
					}
				},
				failure: function(form, action){
		            switch(action.failureType){
		            	case(Ext.form.Action.CONNECT_FAILURE):
		            		Ext.Msg.alert('Error',
		        				'Status:'+action.response.status+': '+
		                        action.response.statusText
		            		);
		            	break;
		            	case(Ext.form.Action.SERVER_INVALID):
		            		// server responded with success = false
		                    Ext.Msg.alert('Invalid', action.result.errormsg);
		            	break;
		            	case(Ext.form.Action.CLIENT_INVALID):
		            		Ext.Msg.alert('The Form has Errors','Please Correct and Try again');
		            	break;
		            	case(Ext.form.Action.LOAD_FAILURE):
		                break;
		            }
		        }
	
			});
		}
		/**
		 * NEW TOPIC WINDOW
		 */
		var store = null;
		var desktop = MyDesktop.getDesktop();
	    var win = x4.Window({
			title	: 'Write a New Topic',
			id		: 'new-topic-win', 
			 iconCls: 'x-icon-16x16-comment_edit', 
			modal	: true,
			maximized	: true,
			height	: 350,
			width	: 600,
			layout	: 'fit',
			items	: [new Ext.form.FormPanel({
				id		: 'new-topic',
				api		: {
					load : $$.xForums.loadTopic,
					submit: $$.xForums.saveTopic
				},
				xtype	: 'form',
				layout	: 'form',
				padding : 5,
				frame	: true,
				baseParams: {
					publish : false
				},
				defaults: {
					defaults: {
						anchor: '100%',
						allowBlank: false
					}
				},
				items	: [{
					xtype: 'hidden',
					name: 'id'
				},{
					xtype: 'hidden',
					name: 'topic_id'
				},{
					layout	: 'column',
					lableAlign: 'top',
					items	: [{
						columnWidth: .7,
						layout  : 'form',
						items	: [{
							xtype	: 'textfield',
							fieldLabel: 'Topic Title',
							id		: 'new-topic-title',
							name	: 'title',
							anchor: '95%'
						}]
					},{
						columnWidth: .3,
						layout  : 'form',
						labelWidth: 75,
                        items	: [{
                        	xtype: 'combo',
                            fieldLabel: 'Forum',
                            anchor: '95%',
                            id	: 'forum-category',
                            name: 'category',
                            store: store = new Ext.data.JsonStore({
                                storeId: 'ForumCategoriesStore', 
                                url: '/forums/categories/?json',
                                autoLoad: true,
                                fields : [{ 
                                    name: 'id'
                                },{ 
                                    name: 'text'
                                }]
                            }),
                            shadow: true,
                            selectOnFocus: true,
                            emptyText: 'Type a Category/Tag',
                            displayField: 'text',
                            valueField: 'id'
                        }]
                    }]
				},{
                    xtype: "tinymce",
                    id			: 'new-topic-mce',
                    hideLabel	: true, 
                    allowBlank	: false,
                    msgTarget	: 'under',
                    invalidText	: 'TEST!',
                    labelSeparator: '',
                    name		: 'html',

					anchor: "100% -50",
                    
                    tinymceSettings: {

						script_url : '/bin/js/jq/tiny_mce/tiny_mce.js',
                        theme: "advanced",

                        plugins: "pagebreak,style,layer,table,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

                        theme_advanced_buttons1: "newdocument,template,fullscreen,|,undo,redo,|,search,replace,|,cut,copy,paste,pastetext,pasteword,|,inserttime,insertdate,|,preview,print",
                        
                        theme_advanced_buttons2: "image,media,anchor,|,link,unlink,|,advhr,hr,|,bullist,numlist,|,outdent,indent,blockquote,sub,sup,|,attribs,code,|,cleanup,iespell",
                        

                        theme_advanced_buttons3: "charmap,pagebreak,nonbreaking,|,visualchars,visualaid,|,tablecontrols,|,insertlayer,moveforward,movebackward,absolute",
                        
                        theme_advanced_buttons4: "removeformat,styleprops,formatselect,fontselect,fontsizeselect,forecolor,backcolor,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,ltr,rtl",
                        

                        theme_advanced_toolbar_location	: "bottom",

                        theme_advanced_toolbar_align	: "center",

                        theme_advanced_statusbar_location: "top",

                        extended_valid_elements: "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",

                        template_external_list_url: "example_template_list.js",

                        accessibility_focus: false



                    }

                }],
				//buttonAlign: 'center',
				buttonAlign: 'center',
				buttons : [{
					text : 'Close',
					iconCls: 'x-icon-16x16-cancel',
					iconAlign: 'top',
					handler: function(){
						Ext.Msg.show({
							title: 'Closing New Topic',
							msg: 'Would you like to save as draft?',
							buttons: Ext.Msg.YESNOCANCEL,
							fn: function(btn){
								switch(btn){
									case('yes'):
										saveTopic(false);
									break;
									case('no'):
										Ext.getCmp('new-topic-win').close();
									break;
								}
							}
						});
					}
				},{
					text : 'Save as Draft',
					iconCls: 'x-icon-16x16-disk',
					iconAlign: 'top',
					formBind: true,
					handler: function(){
						saveTopic(false);
					}
				},{
					text 	: 'Publish Post',
					iconCls	: 'x-icon-16x16-newspaper_go',
					iconAlign: 'top',
					formBind: true,
					handler	: function(){
						saveTopic(true);
					}
				}]
			})]
		});
	    win.show(/*'new-topic-btn'*/null,function(win){
			win.hide();
			//win.maximize();
			win.show();
			win.getEl().fadeIn();
			Ext.Msg.hide();
			Ext.getCmp('new-topic-title').focus();
			var n = Ext.getCmp('forum-tree').getSelectionModel().getSelectedNode();
			if(n){
				Ext.getCmp('forum-category').setValue(n.text);
			}
			Ext.getCmp('new-topic').getForm().load({
				//waitMsg: x4.lang.wait,
				//waitTitle: ume.getIcon('magnifier')+'Looking for Drafts'
			});
		});
		store.load();
	};
	
--></script>


<script type="text/javascript">
	Ext.onReady(function(){
		var win = x4.Window({
			title	: 'Forums',
			iconCls	: 'x-icon-16x16-chart_organisation',
			id		: 'forum-admin',
			width	: $(window).width()*.75, 
			height	: $(window).height()*.75,
			layout	: 'border',
			 
			items	: [x4.forums.live = new x4.forums.Tabs({ 
				region	: 'center',
				id : 'forum-tabs', 
				deferredRender	: false 
			})]
		});
		win.show(null,function(win){
			win.maximize();
		})
	});
</script>