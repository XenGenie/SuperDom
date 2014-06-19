/**
 * The Universal Mailbox
 * @author
 */
// For Smarty! {literal}
	x4.direct('xInbox'); 
	Ext.ns('x4');
	x4.xMailbox = {
		win 		: false,
		init 		: function(cfg) {
			// @var cfg object containing EZ UI config options for the application as a whole...
			Ext.apply(this, cfg);
			// MAIL PANEL Panels.
			this.mailPanel = new x4.xMailbox.MailboxTab({
				iconCls		: 'x-icon-16x16-mailbox', 
				region		: 'center',
				border		: false,
			});

			this.mycontacts = new this.MyContacts({
				region		: 'east',
				title		: 'Contacts',
				width		: 200,
				border		: false,
				collapseMode: 'mini',
			}); 
			
			cfg.title 		= (cfg.title) 	? cfg.title : 'Mailbox@' + location.host;
			cfg.iconCls 	= (cfg.iconCls) ? cfg.iconCls : 'x-icon-16x16-mailbox';
			cfg.layout 	= 'border';
			cfg.items 		= [this.mailPanel,this.mycontacts];
			cfg.listeners	= {
				afterrender	: this.loadMailboxes,
				close		: function(){
					x4.xMailbox.win = false;
				
				}
			};
			 
			// Begin the App with an X Window!
			this.win 		= cfg;
			
			return this.win;
		},
		MyTabs		: Ext.extend(Ext.TabPanel,{
			activeTab		: 0,
			initComponent	: function(){
				x4.xMailbox.MyTabs.superclass.initComponent.call(this);
			}
		}),
		MyContacts	: Ext.extend(Ext.Panel,{
			collapsible		: true,
			initComponent	: function(){
				
				x4.xMailbox.MyContacts.superclass.initComponent.call(this);
			}
		}),
		MailTree	: Ext.extend(Ext.tree.TreePanel,{
			region		: 'south', 
			height		: 150,
			split		: true,
			//collapsible	: true,
			//collapseMode: 'mini',
			expandable	: true,
			rootVisible	: false,
			autoScroll	: true,
			useArrows	: true,
			initComponent	: function(){	
				var tp = this;
				/*
				var te = this.treeEditor = new Ext.tree.TreeEditor(tp, {
					allowBlank	: false,
			        blankText	: 'Enter a Label',
			        emptyText	: 'New Label',
			        iconCls 	: 'x-icon-16x16-tag' 
				}, {
			        selectOnFocus:true,
			        listeners: {
						beforestartedit	: function(e,el,v){
							// Strip those numbers!)
							v = v.split('>)');
							v = v[1];
							e.setValue(v);
						},
			    		complete: function(te,v,o){
							if(o != v && v != '' ){
				    			var node 		= te.editNode; 
								var parent_id 	= node.parentNode.id;					        						
								$$.xInbox.nameLabelForum(
									v,
									parent_id,
									node.id,
			    					function(r){
				    					if(r.success){
				    						node.setText(r.text);
				    						//on.node.click(n);
				    						node.parentNode.reload(function(){
				    							try{
				    								//var node = tp.getNodeById('forum-'+r.id);
				    								//node.expand();
				    								//tp.getSelectionModel().select(node);
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
			    });*/
				this.loader 	= new Ext.tree.TreeLoader({
					autoLoad	: true,
					baseAttrs: {
						allowDrag: false,
						singleClickExpand : true
					},
					directFn	: $$.xInbox.getBoxes,
					listeners: {
						beforeload	: function(t){
							tp.mask = new Ext.LoadMask(tp.getEl(),{ msg	: 'Connecting to Box...'});
							tp.mask.show();
						},
						load: function(t,n,r){
							tp.mask.hide();
						}
					}
				});
				this.root	= {
					text		: this.title,
					draggable	: false,
					iconCls		: this.iconCls,
					expanded	: true,
					visible		: false,
					id			: 'root'
				};
				x4.xMailbox.MailTree.superclass.initComponent.call(this);
			},
			listeners	: {
				click	: function(n){ 
					var email = (n.parentNode.id == 'root') ? n.id : n.parentNode.id;  
				
					if(n.id == 'inbox-new'){
						x4.xMailbox.createNewBox();
						return false;
					}
					
					/*email_store.setBaseParam('box',n.id);
					email_store.setBaseParam('email',n.parentNode.id);
					email_store.load({
						params	: {
							box : n.id,
							email	: n.parentNode.id
						}
					}); */
	
				var store = new x4.xMailbox.EmailStore({
					directFn	: $$.xInbox.getBox,
					autoLoad	: true,
					root			: 'data',
					totalProperty	: 'total',
					idProperty		: 'Msgno',
					fields			: [{
						name	: 'id',
					},{
						name	: 'Recent',
					},{
						name	: 'Unseen',
					},{
						name: 'Subject' 
					},{
						name: 'fromaddress' 
					},{
						name: 'toaddress' 
					},{
						name: 'reply_toaddress' 
					},{
						name: 'Date',
						type: 'date',
						dateFormat: 'D, j M Y H:i:s O'
					},{
						name: 'Size',
						convert: Ext.util.Format.fileSize
					},{
						name: 'Msgno'
					},{
						name: 'email_box'
					},{
						name: 'message'
					}],
					paramOrder	: ['box','email'],
					baseParams	: {
						email	: email,
						box		: n.id
					}
				});
				
				// Add A new LabelTab!
				var al = x4.xMailbox.activeLabel = Ext.getCmp(n.id);
				if(!al) {
					var src = n.getUI().getIconEl().src;
					al = x4.xMailbox.activeLabel = new x4.xMailbox.LabelTab({
						title	: "<img src='"+src+"'> "+n.text,
						closable: true,
						id		: n.id,
						layout	: 'fit',
						//iconCls	: 'x-icon-16x16-'+n.getUI().getIconEl().src.split('.')[0],
						store	: store
					});
					//al.setIconClass();
					
				}
				var mb = x4.xMailbox.mailPanel;
				mb.labelsPanel.add(al);
				mb.labelsPanel.activate(al);
				mb.labelsPanel.doLayout();
				//al.doLayout();
				//store.reload();
			},
				contextMenu: function(n,e){
					var menu = new Ext.menu.Menu({
						id:'feeds-ctx',
						shadow: 'frame',
						items: [{
							text: 'Reload root',
							iconCls: 'x-icon-16x16-database_refresh',
							handler: function(){
								x4.xMailbox.mailPanel.mailTree.getRootNode().reload();
							}
						}/*,'-',{
							text	: 'Delete Box',
							iconCls	: 'x-icon-16x16-remmove',
							handler	: function(){
								Ext.Msg.show({
									msg 	: 'Delete Box '+n.text,
									title	: 'Are You Sure?',
									buttons	: Ext.Msg.YESNO,
									fn		: function(btn){
										if(btn == 'yes'){
											Ext.Ajax.request({
												url		: '/inbox/deleteBox/?json',
												success	: function(){
													Ext.getCmp('inbox-tree').getRootNode().reload();
												},
												failure	: function(f,a){
													Ext.Msg.show({
														title	: 'Failed!',
														msg		: a.result.error,
														icon	: Ext.MessageBox.ERROR
													});
												},
												params	: {
													id	: n.id
												}
											});
										}
									}, 
									icon: Ext.MessageBox.WARNING
								});
							}
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
				
			},
		}),
		EmailStore 	: Ext.extend(Ext.data.DirectStore,{
			initComponent	: function(){
				x4.xMailbox.EmailStore.superclass.initComponent.call(this);
			},
			paramOrder	: ['box','email'],
			root			: 'data',
			totalProperty	: 'total',
			idProperty		: 'Msgno',
			fields			: [{
				name	: 'Recent',
			},{
				name	: 'Unseen',
			},{
				name: 'Subject' 
			},{
				name: 'fromaddress' 
			},{
				name: 'toaddress' 
			},{
				name: 'reply_toaddress' 
			},{
				name: 'Date',
				type: 'date',
				dateFormat: 'D, j M Y H:i:s O'
			},{
				name: 'Size',
				convert: Ext.util.Format.fileSize
			},{
				name: 'Msgno'
			},{
				name: 'email_box'
			},{
				name: 'message'
			}],
			listeners	: {
				beforeload: function(){
	
				},
				load	: function(s,r,o){
					// Load Again in 20 Seconds = 3x a Minute
					 
				}
			}
		}),
		MailboxTab 		: Ext.extend(Ext.Panel, {
			layout	: 'border',
			initComponent: function() {			
				// The Mailbox Tree
				this.mailTree = new x4.xMailbox.MailTree({
					rootId	: this.rootId
				}) ;				
				
				// Email Tabs Panel
				this.emailTabs = new Ext.TabPanel({
					region			: 'center',
					enableTabScroll	: true,
					maxTabWidth		: 125,
					activeTab		: 0,
					border			: false,
					items			: [/**/],
					listeners		: {
						tabchange	: function(tp){
							if(tp.items.length < 1){
								x4.xMailbox.mailPanel.mailboxIndex.expand();
								x4.xMailbox.mycontacts.expand(); 
							}
						}
					}
				})
				
				var inboxId = this.id;
				this.defaults	= {
					border	: false
				};
				
				this.labelsPanel = new Ext.TabPanel({
					region			: 'center',
					border			: false,
					enableTabScroll	: true,
					deferredRender	: false,
					activeTab		: 0,
					maxTabWidth		: 50,

			        plain:true,
					items			: []
				});
				//this.labelsPanel.getEl().mask('Select A Label');
				
				this.mailboxIndex = new Ext.Panel({
					region		: 'west',
					layout		: 'border', 
					collapseMode: 'mini',
					border		: false,
					split		: true,
					width		: 250,
					expanded	: true,
					items		: [{
						region	: 'north',
						autoHeight	: true,
						border	: false,
						buttonsAlign	: 'center',
						buttons			: [{
							text: 'Write Email',
							iconCls: 'x-icon-16x16-pencil',
							iconAlign	: 'bottom',
							tooltip: { text:'Click to Start Writing a New Email', title:'Compose An Email'},
							flex	: 1,
							handler: function(){ 
								//ume.os.open('email_composer');
								var email = new x4.xMailbox.EmailTab({
									title	: 'New Email',
									editor	: true,
									//id		: 'inbox-new-email'+inboxId,
									iconCls	: 'x-icon-16x16-mail_light_new_1',
									closable: true,
								});
								//var form = email.getForm()
								//form.loadRecord(r);
								x4.xMailbox.mailPanel.emailTabs.add(email);
								x4.xMailbox.mailPanel.emailTabs.activate(email);
								x4.xMailbox.mailPanel.mailboxIndex.collapse();
								x4.xMailbox.mycontacts.collapse(); 
							}
						},{
							text: 'Save Email',
							iconCls: 'x-icon-16x16-disk',
							id		: 'inbox-save-btn',
							iconAlign	: 'bottom',
							tooltip: { text:'Click to Save this Email Your SaveBox', title:'Save Email & Attachments'},
							flex	: .75, 
							disabled	: true,
							handler: function(){
								//Ext.Msg.alert('');
							}
						},{
							text	:'Trash Email',
							flex	: .5,
							id		: 'inbox-trash-email-btn',
							disabled	: true,
							iconAlign	: 'bottom',
							iconCls: 'x-icon-16x16-mail_dark_new_2',
							iconCls	: 'x-icon-16x16-bin',
							handler	: function(){
								function askToDelete() {
									Ext.Msg.show({
										msg 	: "Are You Sure You Want to Delete this Email?<br><input type='checkbox' onclick='x4.xMailbox.dontAskDelete = this' /> Don't Ask Again",
										title	: 'Deleteing Email<hr/><b><u>'+email.data.Subject+'</u></b> from <b><i>'+email.data.fromaddress+'</i></b>',
										buttons	: Ext.Msg.YESNO,
										fn		: function(btn){
											x4.xMailbox.dontAskValue = btn;
											if(btn == 'yes'){
												$$.xInbox.deleteMsg(email.data.Msgno,x4.xMailbox.mailPanel.labelsPanel.getActiveTab().id,function(r){
													x4.xMailbox.mailPanel.labelsPanel.getActiveTab().getStore().reload();
													Ext.Msg.alert(r.title,r.msg);
												});
											}else {
												
											}
										}, 
										icon: Ext.MessageBox.WARNING
									});
								};
								var email = x4.xMailbox.activeEmail;
								if(!x4.xMailbox.dontAskDelete) {
									askToDelete();
								}else {
									if(x4.xMailbox.dontAskDelete.checked){
										switch( x4.xMailbox.dontAskValue ) {
											case('yes'):
												$$.xInbox.deleteMsg(email.id,x4.xMailbox.mailPanel.id,function(r){
													Ext.Msg.alert(r.alert);
													x4.xMailbox.mailPanel.labelsPanel.getActiveTab().getStore().reload();
													
												});			
											break;
											case('no'):
												Ext.getCmp('inbox-trash-email-btn').disable();
											break;
										}
									}else{
										askToDelete();
									}
								}
							}
						}],
					},
		     		   this.mailTree,
		     		   this.labelsPanel
		     		]
				});
				
				this.items = [this.emailTabs,this.mailboxIndex];
				x4.xMailbox.MailboxTab.superclass.initComponent.call(this);
			}
		}),
		/**
		 * A mail.Mailbox
		 * 	Label Tree
		 * 	Message List
		 * 	Tabular Email Reader
		 */
		LabelTab 	: Ext.extend(Ext.grid.GridPanel,{
			layout	: 'fit', 
			loadMask: 'Retrieving Messages...',
			listeners	: {
				dblclick : function(){
	
					x4.xMailbox.mailPanel.mailboxIndex.collapse();
					x4.xMailbox.mycontacts.collapse();
				}
			},
			initComponent	: function(){
				this.tabTip	= this.id;
				this.bbar = new Ext.PagingToolbar({
					pageSize: 10,
					store: this.store,
					displayInfo: false,
					//displayMsg: 'Displaying emails {0} - {1} of {2}',
					emptyMsg: "No Emails to display"
				});
				this.cm = new Ext.grid.ColumnModel({
					columns: [{
						header: "Read", 
						width: 20, 
						dataIndex: 'Unseen',
						renderer	: function(text){
						return (text == 'U') ? x4.getIcon('mail_light') : x4.getIcon('mail_dark_stuffed') 
					}
					},{
						header: "From", 
						width: 150, 
						dataIndex: 'fromaddress'
					},{
						header: "Subject", 
						width: 200, 
						dataIndex: 'Subject'
					},{
						dataIndex: "Size",
						header: "Size",
						width: 50, 
						hidden: true
					},{
						header		: "Date", 
						width		: 75, 
						dataIndex	: 'Date',
						sortable	: true, 
						hidden		: true,
						xtype		:"datecolumn",
						format		: "D, h:ia n/j/y"
					}],
					defaults:{
						menuDisabled:false,
						sortable: true 
					}
				});
				var gp = this; 
				this.sm = new Ext.grid.RowSelectionModel({
					singleSelect: true,
					listeners: {
						rowselect: function(sm,i,r){
							// Add A new Email Tab
							x4.xMailbox.activeEmail = r;
							var emailaddress = gp.getStore().baseParams.email; 
							gp.openEmail(gp.id,emailaddress,r);
							Ext.getCmp('inbox-trash-email-btn').enable();
						}
					}
				});
				x4.xMailbox.LabelTab.superclass.initComponent.call(this); 
			},
			openEmail	: function(inboxId,address,r){
				var data = r.data;
				// Create Our Email Tab.
				var email = new x4.xMailbox.EmailTab({
					title	: Ext.util.Format.ellipsis(r.data.fromaddress, 10, true)+'~'+Ext.util.Format.ellipsis(r.data.Subject, 15, true),
					id		: r.id+'-email',
					iconCls	: 'x-icon-16x16-mail_light_stuffed',
					closable: true,
					editor	: (r.email_box == 'outbox' || r.email_box == 'savebox'),
				});
		
				// Add The Email to the View Panel
				x4.xMailbox.mailPanel.emailTabs.add(email);
				x4.xMailbox.mailPanel.emailTabs.activate(email);
				
				// Load the Current Record into it.
				var form = email.getForm();
				form.loadRecord(r);
		 
				form.setValues({
					message	: r.get('message')
				});
				
				email.msgPan.getEl().update(r.get('message'));
				
				if(r.get('message') == '') {
					var readPane = email.msgPan.getEl();
					readPane.mask('<i>'+r.get('fromaddress')+'</i>'
						+'<br/>'+ r.get('Size')
						+'<hr/>'
						+'<center><i>'+r.get('toaddress')+'</i>'
						+'<br/>'
						+'<b>'+r.get('Subject')+'</b></center>'
						+x4.lang.wait 
					);
					
					var mailbox = address.replace('inbox-','');
					var label;
					label = inboxId.replace(mailbox+'-','');
					label = inboxId.replace('-'+mailbox,'');
					
					$$.xInbox.readMsg(r.data.Msgno,mailbox,label,function(m){
						readPane.unmask();
						//m = Ext.util.JSON.decode(m.responseText);
						var msg = (m.msg.html) ? m.msg.html : m.msg.plain;
						email.msgPan.getEl().update(msg);
						form.setValues({
							message	: msg
						});
			
						r.set('Unseen','');
						r.commit;
						
						$('#'+form.id+' a').click(function(){
							// Open Links...
							x4.Window({
								title		: this.innerHTML,
								id			: this.href,
								maximized	: true,
								layout		: 'fit',
								iconCls		: 'x-icon-16x16-world',
								items		: [new Ext.ux.IFrameComponent({
									url		: this.href,
									width	: '100%',
									height	: '100%',
								})]
							}).show();
							return false;
						});
						 
					});
				}
			},
			//title	: 'Inbox', 
			iconCls	: 'x-icon-16x16-mailbox',
			layout	: 'fit',
			loadMask: true,
			viewConfig: {
				forceFit: true,
				getRowClass: function(record, rowIndex, rp, ds){ // rp = rowParams
					if(record.data.Unseen == 'U'){
						return 'inbox-x-grid3-row-unseen';
					}
					return 'inbox-x-grid3-row-seen';
				}
			},
			stripeRows	: true
		}),

		/**
		 * Used to Read and Write Emails
		 */
		EmailTab	: Ext.extend(Ext.form.FormPanel, { 
			title	: 'New Email',
			layout	: 'border',
			frame		: true,
			border	: false,
			api		: {
				load	: '/inbox/readMsg/?json',
				submit	: '/inbox/sendEmail/?json'
			},
			buttonAlign	: 'center',
			listeners	: {
				dblclick: function(){
					x4.xMailbox.mailPanel.mailboxIndex.collapse();
					x4.xMailbox.mycontacts.collapse();
				}
			},
			initComponent	: function(){
				var formId 	= this.id;
				var form 	= this;
				var mailbox = this.mailbox;
				var editor 	= (this.editor) ? true : false;
				function editing(edit,read){
					return (editor) ? edit : read;
				}
				
				this.msgPan = new Ext.Container({
					 autoEl: 'div',
					 layout	: 'fit',
					 baseCls	: 'x-plain',
					 paddin		: 10,
					 autoScroll	: true,
					 unstyled: true,
				});
				
				this.htmleditor = new Ext.ux.TinyMCE({
					region	: 'center',
					hidden	: (!this.editor),
					layout	: 'fit',
					baseCls	: 'x-plain',
					unstyled: true,
					name	: 'message',
					enableFont			: this.editor,
					enableAlignments 	: this.editor,
					enableColors		: this.editor,
					enableFont			: this.editor,
					enableFontSize		: this.editor,
					enableFormat		: this.editor,
					enableLinks			: this.editor,
					enableLists			: this.editor,
					//enableSourceEdit	: this.editor,
					//tbar	: [],
					flex	: 1,
					anchor: "100% -50",
                    
                    tinymceSettings: {

						script_url : '/bin/js/jq/tiny_mce/tiny_mce.js',
                        theme: "advanced",

                        plugins: "pagebreak,style,layer,table,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

                        theme_advanced_buttons1: "newdocument,template,fullscreen,|,undo,redo,|,search,replace,|,cut,copy,paste,pastetext,pasteword,|,inserttime,insertdate,|,preview,print",
                        
                        theme_advanced_buttons2: "image,media,anchor,|,link,unlink,|,advhr,hr,|,bullist,numlist,|,outdent,indent,blockquote,sub,sup,|,attribs,code,|,cleanup,iespell",
                        

                        theme_advanced_buttons3: "charmap,pagebreak,nonbreaking,|,visualchars,visualaid,|,tablecontrols,|,insertlayer,moveforward,movebackward,absolute",
                        
                        theme_advanced_buttons4: "removeformat,styleprops,formatselect,fontselect,fontsizeselect,forecolor,backcolor,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,ltr,rtl",
                        

                        theme_advanced_toolbar_location: "top",

                        theme_advanced_toolbar_align: "left",

                        theme_advanced_statusbar_location: "bottom",

                        extended_valid_elements: "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",

                        //template_external_list_url: "example_template_list.js",

                        accessibility_focus: false



                    },
					listeners	: {
						activate	: function(he){
							// Gather Who the email was sent by and reply to it...
						}
					},
				}); 
				
				this.buttons	= (!this.editor) ? [{
					text		: 'Reply', 
					iconAlign	: 'bottom', 
					iconCls		: 'x-icon-16x16-mail_light_left',
					handler		: function(){
						Ext.Msg.wait('Plase Wait...', 'Loading Reply'); 
						// We need this form's content!
						oEmail = form.getForm().getValues();
						
						// Replying creates a draft copy of the email recieved - minus the attachments.
						 
						var email = new x4.xMailbox.EmailTab({
							iconCls	: 'x-icon-16x16-mail_light_left',
							title	: 'Re: ' + oEmail.Subject,
							closable: true,
							editor	: true,
						});
						 
						/*var toAll = oEmail.toaddress.split(',');
						if(toAll.length > 1){
							delete(toAll[0]);
							toAll = toAll.join(',');
						}*/
						
						// email.getForm().setValues(oEmail);
						
						email.getForm().setValues({ 
							toaddress	: oEmail.fromaddress,
							ccaddress	: oEmail.toaddress,
							Subject		: oEmail.Subject,
							message		: 'On '+ oEmail.Date + ' ' + oEmail.fromaddress + ' wrote: '
								+'<blockquote>'+oEmail.message+'</blockquote>',
							Date : new Date() 
						});
						
						x4.xMailbox.mailPanel.emailTabs.add(email);
						x4.xMailbox.mailPanel.emailTabs.activate(email.id);
						
						x4.xMailbox.mailPanel.mailboxIndex.collapse();
						x4.xMailbox.mycontacts.collapse();
						Ext.Msg.hide();
						email.htmleditor.focus();
					},
					tooltip		: { text:'Click to Send a Reply', title:'Reply to Email'},
					// Menus can be built/referenced by using nested menu config objects
					flex		: 1,
				},{
					text	: 'Star',
					tooltip		: { 
						text	: 'Click to Star this Email Important', 
						title	: 'Star Email',
						disabled	: true,
					},
					handler	: function(){
						
					},
					iconCls: 'x-icon-16x16-star_full', 
					iconAlign	: 'bottom',
					
				},{
					text: 'Forward',
					disabled	: true,
					tooltip		: { 
						text	: 'Click to Forward this Email & Attachments', 
						title	: 'Forward Email'
					},
					iconCls: 'x-icon-16x16-mail_light_right', 
					iconAlign	: 'bottom', 
					handler	: function(){
						// Forwarding creates a draft copy of the email recieved - with the attachments.
					},
					flex	: 1,
				}] : [{
					text	: 'Send',
					iconAlign	: 'bottom',
					id		: formId+'-btn-send',
					tooltip: { text:'Click to Send Email to Your OutBox', title:'Send this Email'},
					iconCls	: 'x-icon-16x16-mail_light_up',
					handler	: function(){
						// Sending Emails Saves the Emails and Markes them ready to be sent.
						form.getForm().submit({
							url			: '/inbox/sendEmail/?json', 
							waitMsg		: 'Please Wait',
							waitTitle	: 'Sending',
							success		: function(f,a){
								Ext.Msg.alert('Success!','Email Sent ~ '+a.result.time);
								Ext.getCmp(formId).close();
							}
						});
					}
				}];

				var date = new Date();
				date.setMilliseconds(0);
				date.setSeconds(0);
				date.setHours(0);
				date.setMinutes(0);
				
				var uniqueTime = new Date().getTime();

				var contacts_store = new Ext.data.JsonStore({  
				    //autoLoad: true,
					url: '/inbox/getContacts/?json',
					root: 'data', 
				    fields : [{
				        name: 'id'
					},{
						name: 'person'
					}]  
				});
			
				this.items	= [ this.htmleditor , (!this.editor) ? new Ext.Panel({ 
					region	: 'center',
					layout	: 'fit',
					bodyStyle	: 'background: white; padding: 5px',
					items	: [this.msgPan]
				}) : {} ,{
					region		: 'east',
					width		: 200,  
					collapsed	: (!this.editor),
					xtype		: 'panel',
					title		: 'Attachments',
					iconCls		: 'x-icon-16x16-attach',
					layout		: 'fit', 
					width		: 250,
					items		: [new Ext.ux.IFrameComponent({
						region	: 'center',
						width	: '100%',
						height	: '100%', 
						iconCls	: 'x-icon-16x16-email_attach', 
						url		: '/upload/deskDrop/?html&dir=Attachments&time='+uniqueTime,
						listeners	: {
							afterrender	: function(el){ 
							}
						}
					})]
				},{
					layout	: 'column',
					title	: 'Address Details',
					iconCls		: 'x-icon-16x16-lorry',
					//collapsible	: true,
					collapsed	: (!this.editor),
					// expandable: true,
					region	: 'south',
					autoHeight	: true,
					xtype	: 'panel',
					padding	: 0,
					margins	: 0,
					defaults	: {
						layout		: 'form',
						labelAlign	: 'top',
						frame	: true, 
						defaultType	: 'textfield'
					},
					items	: [{
						columnWidth	: .55,
						labelAlign	: 'left',
						labelWidth	: 30,
						defaults	: {
							anchor	: '98%',
						},
						items		: [{
							xtype	: 'hidden',
							value	: uniqueTime,
							name	: 'timestamp'
						},new Ext.form.ComboBox({  
							emptyText: 'To',
							hideLabel: true,
							id	: formId+'-email-to',
							//readOnly	: true,
							store: contacts_store,  
							valueField: 'id',  
							displayField: 'person',  
							mode: 'remote',  
							minChars : 0 ,
							allowBlank	: false,
							name		: 'toaddress',
							hiddenName	: 'toaddress', 
						}),{
							emptyText	: 'Subject',
							hideLabel	: true,
							fieldLabel	: 'Subject', 
							xtype	: 'textfield',
							name	: 'Subject',
						},new Ext.form.ComboBox({  
							emptyText	: 'From',
							hideLabel	: true,
							value		: Ext.util.Cookies.get('user[email]'),
							store		: new Ext.data.JsonStore({  
								//autoLoad: true,
								url: '/inbox/getMailboxes/?json',
								root: 'data', 
								fields : [{
									name: 'id'
								},{
									name: 'server_username'
								}]  
							}),  
							valueField: 'id',  
							displayField: 'server_username',  
							mode: 'remote',  
							minChars 	: 0 ,
							allowBlank	: false, 
							name		: 'fromaddress',
							hiddenName	: 'fromaddress',
							listeners: {
								beforeselect: function(cb,r,i){
								
								}
							}
						})]
					},{
						columnWidth	: .45,
						labelAlign	: 'left',
						labelWidth	: 30,
						defaults	: {
							anchor	: '100%'
						},
						items		: [{
							empty		: 'Time Stamp',
							emptyText	: 'Set When this should Go Out',
							xtype		: 'datefield',
							format		: "D, h:ia n/j/y",
							minValue	: date,
							hideLabel	: true,
							value		: new Date(),
							name		: 'Date',
						},new Ext.form.ComboBox({  
							emptyText: 'Carbon Copy',
							hideLabel: true,
							store		: contacts_store,    
							valueField	: 'id',  
							displayField: 'person',  
							mode		: 'remote',  
							minChars 	: 0 ,
							allowBlank	: true,
							anchor		: '95%',
							name		: 'ccaddress',
							hiddenName	: 'ccaddress',
						}),new Ext.form.ComboBox({  
							emptyText: 'Blind Carbon Copy',
							hideLabel: true, 
							store: contacts_store,  
							valueField: 'id',  
							displayField: 'person',  
							mode: 'remote',  
							minChars : 0 ,
							allowBlank	: true,
							anchor	: '95%',
							name	: 'bccaddress',
							hiddenName	: 'bccaddress', 
						})]
					}]	
				}];
				x4.xMailbox.EmailTab.superclass.initComponent.call(this);
			}
		}) ,
		createNewBox	: function(el){
			var win = Ext.getCmp('inbox-new-box-win');
			if(!win){
				var cardNav = function(incr){
				    var f = Ext.getCmp('new-box-wizard-panel')
					var l = f.getLayout();
				    var i = l.activeItem.id.split('card-')[1];
				    if(Ext.getCmp('inbox-new-email').isValid()){
				    	var next = parseInt(i, 10) + incr;
					    
				    	l.setActiveItem(next);
		
					    Ext.getCmp('card-prev').setDisabled(next==0);
					    Ext.getCmp('card-next').setDisabled(next==1);
				    }
				};
		
				/*
				 * ================  CardLayout config (Wizard)  =======================
				 */
				var cardWizard = {
				    id		:'new-box-wizard-panel',
				    xtype	: 'form',
					frame	: true,
					border	: false,
					layout	: 'card',
					//defaultType	: 'fieldset',
					defferedRender: false,
					defaults	: {
						layout	: 'form',
						labelAlign	:	'left',
						labelWidth	: 25,
						msgTarget: 'side',
						frame	: true,
						defaultType	: 'textfield',
						defaults	: {
							anchor	: '-5'
						}
					},
					activeItem	: 0,
				    buttonAlign	: 'center',
					buttons: [{
				        id: 'card-prev',
				        text: 'User',
				        iconCls	: 'x-icon-16x16-user',
				        handler: cardNav.createDelegate(this, [-1]),
				        disabled: true
				    },{
				        id: 'card-next',
				        text: 'Server',
				        formBind	: true,
				        iconAlign	: 'right',
				        iconCls	: 'x-icon-16x16-server',
				        handler: cardNav.createDelegate(this, [1])
				    }],
				    items: [{
						//title	: 'Step 1 of 2',
						id		: 'card-0',
						msgTarget: 'side',
						items	: [{
							xtype	: 'fieldset',
			            	iconCls	: 'x-icon-16x16-mail_light',
			            	title	: 'Email Address',
							layout	: 'form',
			            	items	: [{
								validateOnBlur: true,
								name: 'email',
								id	: 'inbox-new-email',
								vtype: 'email',
								xtype		: 'textfield',
								emptyText	: 'you@email.com',
								allowBlank	: false,
								hideLabel	: true,
								anchor: '100%',
								//value		: ume.user.email,
								listeners: {
									blur: function(t){
										Ext.getCmp('new-box-wizard-panel').getForm().load({ params:{ email: t.getValue()}});
										//ume.msg('Attemping to find server settings','Please wait...');
									}
								}
							}],
						},{
			            	xtype	: 'fieldset',
			            	iconCls	: 'x-icon-16x16-key',

							id	: 'inbox-new-password',
			            	title	: 'Password',
			            	layout	: 'form',
			            	items	: [{
		    					xtype	: 'textfield',
		    					inputType	: 'password',
		    					hideLabel	: true,
								allowBlank	: false,
		    					anchor: '100%',
		    					id		: 'inbox-new-wizard-password',
		    					name	: 'pass'
		    				}]
			            }]
					},{
						//title	: 'Step 2 of 2',
						id		: 'card-1',
						layout	: 'form',
						items :[{
							xtype	: 'fieldset',
							title	: 'eMail Server Connection',
							iconCls	: 'x-icon-16x16-server_link',
			            	layout: 'column',
			            	defaults	: {
								
							},
			            	items: [{
			            		columnWidth: .55,
			            		layout: 'form',
			            		labelWidth	: 35,
			            		msgTarget: 'side',
			            		labelAlign: 'left',
			            		items: [{
			            			xtype: 'textfield',
			            			anchor: '90%',
				    				fieldLabel: 'Server',
				    				allowBlank	: false,
				    				name: 'server'
			            		}]
			            	},{
			            		columnWidth: .25,
			            		layout: 'form',
			            		labelWidth	: 25,
			            		msgTarget: 'side',
			            		labelAlign: 'left',
			            		items: [{
			            			xtype: 'textfield',
			            			msgTarget: 'side',
				    				anchor: '90%',
			            			fieldLabel: 'Port',
			            			allowBlank	: false,
			            			name: 'port'
			            		}]
			            	},{
				            	columnWidth: .2,
				            	layout: 'form', 
				            	labelWidth	: 25,
				            	labelAlign: 'left',
				            	items: [{
				            		fieldLabel: 'SSL',
									xtype: 'checkbox',
									name: 'ssl'
								}]
							}]
			            }/*,{
			            	layout: 'form',
			            	xtype	: 'fieldset', 
			            	title	: 'Connection Type',
			            	items:[{
			            		xtype:'radiogroup',
				            	name: 'type', 
				            	labelAlign: 'left',
				            	defaults:{
		            				xtype: 'radio'
		            			},
				            	items: [{
				            		fieldLabel:'IMAP',
				            		
				            		name: 'imap',
				            		checked: true,
				            		value: 'imap'
				            	},{
				            		fieldLabel:'POP3',
				            		name: 'imap',
				            		value: 'pop'
				            	}]
				            }]
			            }*/],
			            buttonAlign	: 'center',
			            buttons	: [{
							xtype	: 'button',
							align	: 'strech',
							text: 'Open eMailBox',
							iconCls	: 'x-icon-16x16-box_new',
							iconAlign	: 'top',
							layout: {
		                        type:'vbox',
		                        padding:'5',
		                        align:'stretch'
		                    },
							handler: function(){
								Ext.Msg.wait(x4.lang.wait,'Saving eMailBox');
								// Hash the password before sending it raw!
								
								var hash 	= ume.util.php.base64_encode(Ext.getCmp('inbox-new-wizard-password').getValue());
								hash 		= hash + ume.util.php.base64_encode(ume.util.php.md5(Ext.util.Cookies.get('PHPSESSID')));  
								hash 		= ume.util.php.base64_encode(hash);
								
								Ext.getCmp('inbox-new-wizard-password').setValue(hash);
								Ext.getCmp('new-box-wizard-panel').getForm().submit({
									success: function(data){
									alert(data.success);
										Ext.Msg.hide();
										//Ext.getCmp('new-email-win').close();
										// Add The New Box to the Panel! 
										x4.xMailbox.loadMailboxes(true);
										// Ext.getCmp('inbox-tree').getRootNode().reload();
									},
									failure:function(f,a){
										Ext.Msg.hide();
										Ext.Msg.alert('Failed',a.result.reason);
									}
								});
							},
							formBind: true
						}],
					}], 
					api: {
						load	: $$.xInbox.loadSettings,
						submit	: $$.xInbox.newAccount
					},
					listeners	: {
						beforeSubmit	: function(){
						
						}
					},
					// specify the order for the passed params    
			        paramOrder: ['email'],
			        baseParams: { email: null }
				};
				
				win = new Ext.Window({
					modal	: true,
					title	: 'Open eMailBox',
					id		: 'new-email-win',
					iconCls	: 'x-icon-16x16-box_locked',
					border	: false,
					height	: 225,
					width	: 350,
					layout	: 'fit',
					//closeAction	: 'hide',
					items	: [cardWizard]
				});
			}
			win.show(el,function(win){
				new Ext.KeyNav('new-box-wizard-panel', {
					"enter": function() { 
						cardNav.createDelegate(this, null)
					}
				});
				
				(function(){
					Ext.getCmp('inbox-new-email').focus();
				}).defer(500);
				
			});
		},
		loadMailboxes	: function(activate){
			$$.xInbox.getBoxes('root',function(boxes){
				//var boxes = Ext.util.JSON.decode(r.responseText);
				var tabs = x4.xMailbox.mailPanel.labelsPanel;
				for(i in boxes){
					var id 		= boxes[i].id;
					var iconCls = boxes[i].iconCls;
					if(id && id != 'inbox-new'){
						
						var store = new x4.xMailbox.EmailStore({
							directFn	: $$.xInbox.getBox,
							autoLoad	: true,
							root			: 'data',
							totalProperty	: 'total',
							idProperty		: 'Msgno',
							fields			: [{
								name	: 'id',
							},{
								name	: 'Recent',
							},{
								name	: 'Unseen',
							},{
								name: 'Subject' 
							},{
								name: 'fromaddress' 
							},{
								name: 'toaddress' 
							},{
								name: 'reply_toaddress' 
							},{
								name: 'Date',
								type: 'date',
								dateFormat: 'D, j M Y H:i:s O'
							},{
								name: 'Size',
								convert: Ext.util.Format.fileSize
							},{
								name: 'Msgno'
							},{
								name: 'email_box'
							},{
								name: 'message'
							}],
							paramOrder	: ['box','email'],
							baseParams	: {
								email	: id,
								box		: 'inbox'
							}
						});
						
						// Add A new LabelTab!
						var tab = x4.xMailbox.activeLabel = Ext.getCmp(id);
						
						if(!tab) {
							//var src = n.getUI().getIconEl().src;
							var title 	= id.replace('inbox-','').split('@')[0];
								title	= (title == 'pm') ? Ext.util.Cookies.get('user[username]') : title ;
							
							tab = x4.xMailbox.activeLabel = new x4.xMailbox.LabelTab({
								title	: Ext.util.Format.ellipsis(title,13),
								// closable: true,
								id		: id,
								layout	: 'fit',
								iconCls	: iconCls,
								//iconCls	: 'x-icon-16x16-'+n.getUI().getIconEl().src.split('.')[0],
								store	: store
							});
							//al.setIconClass();
							
							/*tab = new x4.xMailbox.MailboxTab({
								title		: id.replace('inbox-',''),
								id			: 'mailbox-'+id,
			    				rootId		: id,
								closable	: true,
								iconCls		: iconCls,
								listeners	: {
									beforeclose	: function(){
										//return confirm();
										Ext.Msg.show({
											msg 	: "Are You Sure You Want to Disconnect This Mailbox?",
											title	: 'Closing emailBox',
											buttons	: Ext.Msg.YESNO,
											fn		: function(btn){
												if(btn == 'yes'){
													return true
												}else {
													return false
												}
											}, 
											icon: Ext.MessageBox.WARNING
										});
									},
									close		: function(tab){
										$$.xInbox.deleteBox(tab.id);
									}
								},
							});*/
							tabs.add(tab);
							if(activate == true){
								tabs.activate(tab);
							}else {
								tabs.activate(0);
							}
						}
					};
				}
			});
		}
	};
	
	
	
x4.mail = {
	readBoxes	: function(){
		Ext.Ajax.request({
			url	: '/inbox/getBoxes/?json',
			params	: {
				node	: 'root'
			},
			success	: function(r){
				var boxes = Ext.util.JSON.decode(r.responseText);
				var tabs = Ext.getCmp('inbox-box-tabs');
				for(i in boxes){
					var id 		= boxes[i].id;
					var iconCls = boxes[i].iconCls;
					if(id){
						var tab = new x4.xMailbox.MailboxTab({
							title		: id.replace('inbox-',''),
							id			: 'tab-'+id,
		    				rootId		: id,
							closable	: true,
							iconCls		: iconCls,
							listeners	: {
								beforeclose	: function(){
									return confirm("Are You Sure You Want to Disconnect This Mailbox?");
								},
								close		: function(tab){
									$$.xInbox.deleteBox(tab.id);
								}
							},
						});
						tabs.add(tab);
					};
				}
			}
		});
	}
};

//For Smarty! {/literal}
