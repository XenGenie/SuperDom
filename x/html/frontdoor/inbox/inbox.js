/**
 * The Universal Mailbox
 * @author
 */
x4.direct('xInbox'); 

Ext.ns('x4.mail');
x4.mail = {
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
				defaultType	: 'fieldset',
				defferedRender: false,
				defaults	: {
					layout	: 'form',
					labelAlign	:	'top',
					msgTarget: 'side',
					frame	: true,
					defaultType	: 'textfield',
					defaults	: {
						anchor	: '100%'
					}
				},
				activeItem	: 0,
			    bbar: [{
			        id: 'card-prev',
			        text: '1',
			        iconCls	: 'x-icon-arrow_medium_left',
			        handler: cardNav.createDelegate(this, [-1]),
			        disabled: true
			    },'->',{
			        id: 'card-next',
			        text: '2',
			        iconAlign	: 'right',
			        iconCls	: 'x-icon-arrow_medium_right',
			        handler: cardNav.createDelegate(this, [1])
			    }],
			    items: [{
					title	: 'Step 1 of 2',
					id		: 'card-0',
					msgTarget: 'side',
					items	: [{
						fieldLabel	: 'Enter the Email Address you would like to make a box for',
						validateOnBlur: true,
						name: 'email',
						id	: 'inbox-new-email',
						vtype: 'email',
						allowBlank	: false,
						anchor: '95%',
						//value		: ume.user.email,
						listeners: {
							blur: function(t){
								Ext.getCmp('new-box-wizard-panel').getForm().load({params:{email: t.getValue()}});
								//ume.msg('Attemping to find server settings','Please wait...');
							}
						}
					}]
				},{
					title	: 'Step 2 of 2',
					id		: 'card-1',
					items :[{
						xtype	: 'fieldset',
						title	: 'Server Settings',
		            	layout: 'column',
		            	items: [{
		            		columnWidth: .6,
		            		layout: 'form',
		            		labelWidth: 75,
		            		msgTarget: 'side',
		            		items: [{
		            			xtype: 'textfield',
		            			anchor: '90%',
			    				fieldLabel: 'Server',
			    				allowBlank	: false,
			    				name: 'server'
		            		}]
		            	},{
		            		columnWidth: .3,
		            		layout: 'form',
		            		labelWidth: 50,
		            		msgTarget: 'side',
		    				
		            		items: [{
		            			xtype: 'textfield',
		            			msgTarget: 'side',
			    				anchor: '90%',
		            			fieldLabel: 'Port',
		            			allowBlank	: false,
		            			name: 'port'
		            		}]
		            	},{
			            	columnWidth: .1,
			            	layout: 'form', 
			            	labelAlign: 'top',
			            	items: [{
			            		fieldLabel: 'SSL',
								xtype: 'checkbox',
								name: 'ssl'
							}]
						}]
		            },{
		            	xtype	: 'fieldset',
		            	
		            	title	: 'Password - Leave Blank if You Always want to be Asked.',
		            	layout	: 'form',
		            	items	: [{
	    					xtype	: 'textfield',
	    					inputType	: 'password',
	    					hideLabel	: true,
	    					id		: 'inbox-new-wizard-password',
	    					name	: 'pass'
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
		            }*/,{
						xtype	: 'button',
						text: 'Save Mailbox',
						iconCls	: 'x-icon-box_add',
						layout: {
	                        type:'vbox',
	                        padding:'5',
	                        align:'stretch'
	                    },
						handler: function(){
							Ext.Msg.wait(x4.lang.wait,'Saving Box');
							// Hash the password before sending it raw!
							
							var hash = ume.util.php.base64_encode(Ext.getCmp('inbox-new-wizard-password').getValue());
							hash = hash + ume.util.php.base64_encode(ume.util.php.md5(Ext.util.Cookies.get('PHPSESSID')));  
							hash = ume.util.php.base64_encode(hash);
							
							Ext.getCmp('inbox-new-wizard-password').setValue(hash);
							Ext.getCmp('new-box-wizard-panel').getForm().submit({
								success: function(){
									Ext.Msg.hide();
									Ext.getCmp('new-email-win').close();
									Ext.getCmp('inbox-tree').getRootNode().reload();
								},
								failure:function(f,a){
									Ext.Msg.hide();
									Ext.Msg.alert('Failed',a.result.reason);
								}
							});
						},
						formBind: true
					}]
				}], 
				api: {
					// load		: $$.Email.loadSettings,
					// submit	: $$.Email.newAccount
				},
				listeners	: {
					beforeSubmit	: function(){
					
				}
				},
				// specify the order for the passed params    
		        paramOrder: ['email'],
		        baseParams: {email: null}
			};
			
			win = new Ext.Window({
				modal	: true,
				title	: 'Opening MailBox...',
				id		: 'new-email-win',
				iconCls	: 'x-icon-box_new',
				border	: false,
				width	: 400,
				height	: 300,
				layout	: 'fit',
				items	: [cardWizard]
			});
		}
		win.show(el,function(win){
			new Ext.KeyNav('new-box-wizard-panel', {
				"enter": function() { 
					cardNav.createDelegate(this, null)
				}
			});
		});
	},	
	Tree	: Ext.extend(Ext.tree.TreePanel,{
		region	: 'north',
		id		: 'inbox-tree-'+this.title,
		height	: 225,
		split	: true,
		// dataUrl	: '/inbox/index',
		rootVisible	: true,
		autoScroll	: true,
		useArrows	: true,
		loader : new Ext.tree.TreeLoader({
			autoLoad	: true,
			baseAttrs: {
				allowDrag: false,
				singleClickExpand : true
			},
			url	: '/inbox/getBoxes/?json',
			listeners: {
				load: function(t,n,r){
	
				}
			}
		}),
		initComponent	: function(){
			this.root	= {
				text		: this.title,
				draggable	: false,
				iconCls		: this.iconCls,
				expanded	: true,
				visible		: true,
				id			: this.rootId
			};
			x4.mail.Tree.superclass.initComponent.call(this);
		},
		listeners	: {
			contextMenu: function(n,e){
				var menu = new Ext.menu.Menu({
					id:'feeds-ctx',
					shadow: 'frame',
					items: [{
						text: 'Reload root',
						iconCls: 'x-icon-16x16-database_refresh',
						handler: function(){
							Ext.getCmp('inbox-tree').getRootNode().reload();
						}
					},'-',{
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
					}],
					listeners: {
						hide: function(){
							menu.destroy();
						}
					}
				});
				menu.showAt(e.getXY());
				e.preventDefault();
			}
		}
	}),
	/**
	 * A mail.Mailbox
	 * 	Label Tree
	 * 	Message List
	 * 	Tabular Email Reader
	 */
	Mailbox 		: Ext.extend(Ext.Panel, {
		layout	: 'border',
		initComponent: function() { 
		
			var mailTree = new x4.mail.Tree({
				title	: Ext.util.Cookies.get('user[username]'),
				rootId	: this.rootId
			}) ;
		
			email_store = new Ext.data.DirectStore({ 
				root		: 'data',
				storeId		: 'inbox-store-'+this.id,
				directFn	: $$.xInbox.getBox,
				totalProperty	: 'total',
				idProperty	:'Msgno',
				fields		: [{
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
				}],
				baseParams: {
	    			box		: this.title+'-INBOX',
	    			email	: this.rootId
	    		},
				paramOrder: ['box','email'],
				listeners: {
					beforeload: function(){
		
					},
					load	: function(s,r,o){
						// Load Again in 20 Seconds = 3x a Minute
						// s.reload().defer(20000);
					}
				}
			});
			
			
			mailTree.addListener('click', function(n){ 
				 
				email_store.setBaseParam('box',n.id);
				email_store.setBaseParam('email',n.parentNode.id);
				email_store.load({
					params	: {
						box : n.id,
						email	: n.parentNode.id
					}
				}); 
				
			});
			
			var inboxTree = 'inbox-tree-'+this.title;
			var inboxId = this.id;
			tabEmail = function(inbox,r){
				var email = new x4.mail.EmailTab({
					title	: Ext.util.Format.ellipsis(r.data.fromaddress, 25, true)+'~'+Ext.util.Format.ellipsis(r.data.Subject, 40, true),
					id		: r.id+'-email',
					mailbox	: inbox,
					iconCls	: 'x-icon-16x16-mail_dark_stuffed',
					closable: true,
				});
				var form = email.getForm()
				form.loadRecord(r);

				Ext.getCmp('inbox-email-tab-'+inbox).add(email);
				Ext.getCmp('inbox-email-tab-'+inbox).activate( r.id+'-email');

				Ext.getCmp(inboxId+'-save-btn').enable();

				//Ext.getCmp("inbox-email-wing").getForm().loadRecord(r);
				//ume.webgrams['email'].current_inbox_record = r;
				//$('#email-msg').html();

				// form.setValues({message	:});

				//
				var readPane = Ext.getCmp(r.id+'-email'+'-html-msg').getEl();
				//$('#'+readPane.id).html(msg);
				readPane.mask(x4.lang.wait+'<br/> Opening '+ r.get('Size')+' <hr/><i>'+r.get('fromaddress')+'</i><br/> <b>'+r.get('Subject')+'</b>');

				var node = Ext.getCmp(inboxTree).getSelectionModel().getSelectedNode();
				var box = (node) ? node.id : 'Inbox'; 

				Ext.Ajax.request({
					url	: '/inbox/getMsg/'+r.id+'/'+inbox.replace('tab-','')+'/Inbox',
					method	: 'POST',
					params	: {
					id		: r.id, 
					email	: inboxId.replace('tab-',''),
					box		: box
				},
				success	: function(m){
					m = Ext.util.JSON.decode(m.responseText);
					var msg = (m.msg.html) ? m.msg.html : m.msg.plain;

					form.setValues({
						message	: msg
					});

					var id = Ext.getCmp(r.id+'-email'+'-html-msg').getEl().id;
					$('#'+id).html(msg);
					$('#'+id).slideDown();
					$('#'+id).css({
						padding	: 10
					});
					$('#'+id+' a').click(function(){
						ume.os.createWebWin({
							src		: this.href,
							title	: this.innerHTML,
							id		: this.href,
						});
						return false;
					});

					ume.webgrams['email'].current_email_msg = msg;

					r.set('Unseen','');
					r.commit;
					//Ext.getCmp('email-msg-pan').getEl().unmask();
				},
				failure	: function(f,a){
					Ext.Msg.alert('Failed to Download Email',a.result.reason);
				}
				});
			};

			inboxId = this.id;
			this.defaults	= {
					border	: false
			};
			this.items = [{
				region: 'center',
				layout	: 'border',
				items	: [{
					region	: 'north', 
					iconCls	: 'x-icon-16x16-mouse',
					frame	: true,
					height	: 88,
					layout: {
					type:'hbox',
					padding:'5',
					align:'stretch'
				},
				defaults:{
					xtype	: 'button',
					margins:'0 10 0'},
					width	: 125,
					items	: [{
						text: 'New',
						iconCls: 'x-icon-16x16-mail_light_new_1',
						iconAlign	: 'bottom',
						tooltip: {text:'Click to Start Writing a New Email', title:'Compose An Email'},
						flex	: 1,
						handler: function(){ 
							//ume.os.open('email_composer');
							var email = new x4.mail.EmailTab({
								title	: 'New ',
								editor	: true,
								//id		: 'inbox-new-email'+inboxId,
								iconCls	: 'x-icon-16x16-mail_light_new_1',
								closable: true,
							});
							//var form = email.getForm()
							//form.loadRecord(r);
							Ext.getCmp('inbox-email-tab-'+inboxId).add(email);
							Ext.getCmp('inbox-email-tab-'+inboxId).activate(email);


						}
					},{
						text: 'Save',
						iconCls: 'x-icon-16x16-mail_light_down',
						id		: inboxId+'-save-btn',
						iconAlign	: 'bottom',
						tooltip: {text:'Click to Save this Email Your SaveBox', title:'Save Email & Attachments'},
						flex	: 1, 
						disabled	: true,
						handler: function(){

							//Ext.Msg.alert('');
						}
					},{
						text	:'Trash',
						flex	: 1,
						iconAlign	: 'bottom',
						iconCls: 'x-icon-16x16-mail_dark_new_2',
						iconCls	: 'x-icon-16x16-bin',
						disabled	: true
					}]
				},{
					xtype	: 'tabpanel',
					region	: 'center',
					enableTabScroll	: true,
					maxTabWidth	: 125,
					id	: 'inbox-email-tab-'+this.id,
					activeTab	: 0,
					items: [/**/]
				}]

			},{
				region	: 'west',
				layout	: 'border',
				collapsible	: true,
				split	: true,
				
				width	: 250,
				expanded	: true,
				items	: [mailTree,{
					xtype	: 'tabpanel',
					title	: 'Your Labels',
					region	: 'center',
					activeTab	: 0,
					items	: [email_box = new Ext.grid.GridPanel({
						id	: 'inbox-grid-'+this.id,
						title	: 'Inbox',
						iconCls	: 'x-icon-16x16-mailbox',
						region	: 'center',
						layout	: 'fit',
						loadMask: false,
						viewConfig: {
							forceFit: true,
							getRowClass: function(record, rowIndex, rp, ds){ // rp = rowParams
								if(record.data.Unseen == 'U'){
									return 'inbox-x-grid3-row-unseen';
								}
								return 'inbox-x-grid3-row-seen';
							}
						},

						stripeRows	: true,
						cm: new Ext.grid.ColumnModel({
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
						}),
						store: email_store,  
						sm: new Ext.grid.RowSelectionModel({
							singleSelect: true,
							listeners: {
								rowselect: function(sm,i,r){
									// Add A new Email Tab
									tabEmail(inboxId,r);
								}
							}
						}), 
						bbar: new Ext.PagingToolbar({
							pageSize: 10,
							store: email_store,
							displayInfo: true,
							displayMsg: 'Displaying emails {0} - {1} of {2}',
							emptyMsg: "No Emails to display"

						})
					})]
				}]
			}];
			x4.mail.Mailbox.superclass.initComponent.call(this);
		}
	}),
	/**
	 * Used to Read and Write Emails
	 */
	EmailTab	: Ext.extend(Ext.form.FormPanel, { 
		title	: 'New Email',
		layout	: 'border',
		api		: {
			load	: '/inbox/getMsg/?json',
			submit	: '/inbox/sendEmail/?json'
		},
		buttonAlign	: 'center',
		initComponent	: function(){
			var formId 	= this.id;
			var form 	= this;
			var mailbox = this.mailbox;
			var editor 	= (this.editor) ? true : false;
			
			function editing(edit,read){
				return (editor) ? edit : read;
			}

			this.buttons	= (!this.editor) ? [{
				text: 'Reply', 
				iconAlign	: 'bottom', 
				iconCls: 'x-icon-16x16-mail_light_left',
				handler: function(){
					// Replying creates a draft copy of the email recieved - minus the attachments.
					Ext.getCmp(formId).getForm().submit({
						url	: '/inbox/saveEmail/?json',
						success	: function(f,a){
							var oldEmail = f.getValues();
							var email = new x4.mail.EmailTab({
								title	: 'Re: '+oldEmail.Subject,
								iconCls	: 'x-icon-16x16-mail_light_stuffed',
								closable: true,
								editor	: true,
							});
							var form = email.getForm();
							form.loadRecord({
								url	: '/inbox/getMsg/'
							});
							Ext.getCmp('inbox-email-tab-'+mailbox).add(email);
							Ext.getCmp('inbox-email-tab-'+mailbox).activate(email.id);
						}
					});
				},
				tooltip: {text:'Click to Send a Reply', title:'Reply to Email'},
				// Menus can be built/referenced by using nested menu config objects
				flex	: 1,
			},{
				text: 'Forward',
				tooltip: {text:'Click to Forward this Email & Attachments', title:'Forward Email'},
				iconCls: 'x-icon-16x16-mail_light_right', 
				iconAlign	: 'bottom', 
				handler	: function(){
					// Forwarding creates a draft copy of the email recieved - with the attachments.
				},
				flex	: 1,
				tooltip: {text:'Click the Arrow to "Reply to All"', title:'Quick Reply'},
			}] : [{
				text	: 'Send',
				iconAlign	: 'bottom',
				id		: formId+'-btn-send',
				tooltip: {text:'Click to Send Email to Your OutBox', title:'Send this Email'},
				iconCls	: 'x-icon-16x16-mail_light_up',
				handler	: function(){
					// Sending Emails Saves the Emails and Markes them ready to be sent.


					Ext.getCmp(formId).getForm().submit({
						url			: '/inbox/sendEmail/?json', 
						waitMsg		: 'Please Wait',
						waitTitle	: 'Sending',
						success		: function(f,a){
						Ext.Msg.alert('Success!','Email Sent ~ '+a.result.time);
						Ext.getCmp(inboxId).close();
					}
					});
				}
			}];

			var date = new Date();
			date.setMilliseconds(0);
			date.setSeconds(0);
			date.setHours(0);
			date.setMinutes(0);

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
			
			this.items	= [{
				region		: 'east',
				width		: 200,  
				collapsed	: (!this.editor),
				xtype		: 'panel',
				title		: 'Attachments',
				iconCls		: 'x-icon-16x16-attachments',
				layout		: 'fit', 
				width		: 250,
				items		: [new Ext.ux.IFrameComponent({
					region	: 'center',
					width	: '100%',
					height	: '100%',
					id		: 'preview',
					iconCls	: 'x-icon-16x16-email_attach',
					style	: 'background-color: black; color: white;',
					url		: '/upload/deskDrop/?html&dir=Attachments'
				})]
			},{
				xtype	: 'panel',
				region	: 'center',
				layout	: 'fit',
				layout: {
					type	:	editing('fit','vbox'),
					padding	:	0,
					align	:	'stretch'
				},
				items	: [{
					xtype	: 'htmleditor',
					name	: editing('form[msg]','message'),
					hidden	: (!this.editor), 
					flex	: 0,
					listeners	: {
						activate	: function(he){
							// Gather Who the email was sent by and reply to it...
						}
					}
				},{
					xtype	: 'panel',
					hidden	: this.editor,
					flex	: (!this.editor) ? 1 : 0,
					layout	: 'fit',
					preventBodyReset: true ,
					frame	: true, 
					id		: formId+'-html-msg',
				}],
			},{
				layout	: 'column',
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
					items		: [new Ext.form.ComboBox({  
						emptyText	: 'From Address',
						hideLabel	: true,
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
						name		: editing('form[from]','fromaddress'),
						hiddenName	: editing('form[from]','fromaddress'),
						listeners: {
							beforeselect: function(cb,r,i){
							
							}
						}
					}),new Ext.form.ComboBox({  
						emptyText: 'To Address',
						hideLabel: true,
						id	: formId+'-email-to',
						//readOnly	: true,
						store: contacts_store,  
						valueField: 'id',  
						displayField: 'person',  
						mode: 'remote',  
						minChars : 0 ,
						allowBlank	: false,
						name		: editing('form[to]','toaddress'),
						hiddenName	: editing('form[to]','toaddress'), 
					}),{
						emptyText	: 'Subject',
						hideLabel	: true,
						fieldLabel	: 'Subject', 
						xtype	: 'textfield',
						name	: editing('form[subject]','Subject'),
					}]
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
						name		: editing('form[date]','Date'),
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
						name		: editing('form[cc]','ccaddress'),
						hiddenName	: editing('form[cc]','ccaddress')
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
						name	: editing('form[bcc]','bccaddress'),
						hiddenName	: editing('form[bcc]','bccaddress'), 
					})]
				}]	
			}];
			x4.mail.EmailTab.superclass.initComponent.call(this);
		}
	})  	
};