Ext.ns('x4.Mail');

var contacts_store = new Ext.data.JsonStore({  
    autoLoad: true,
	url: '/inbox/getContacts/?json',
	root: 'data', 
    fields : [{
        name: 'id'
	},{
		name: 'person'
	}]  
});

x4.mail = {
	Inbox 		: Ext.extend(Ext.Panel, {
		layout	: 'border',
		initComponent: function() { 
			var email_store = new Ext.data.DirectStore({
	    		autoLoad	: true,
				root:'data',
	    		storeId	: 'inbox-store-'+this.id,
	    		directFn: $$.Inbox.getBox,
	    		totalProperty	: 'total',
	    		idProperty:'Msgno',
	    		fields: [{
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
	    				// Load Again in 15 Seonds - 3x a Minute
	    				(function(){
	    					s.reload();
	    				}).defer(20000);
	    				// Ext.getCmp('inbox-grid').getSelectionModel().selectFirstRow();
	    				// var view = Ext.getCmp('inbox-grid').getView();
	    			}
	    		}
	    	});
			
			var inboxTree = 'inbox-tree-'+this.title;
			var inboxId = this.id;
			tabEmail = function(inbox,r){
				var email = new x4.mail.EmailTab({
					title	: Ext.util.Format.ellipsis(r.data.fromaddress, 25, true)+'~'+Ext.util.Format.ellipsis(r.data.Subject, 40, true),
					id		: r.id+'-email',
					mailbox	: inbox,
					iconCls	: 'x-icon-mail_dark_stuffed',
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
					iconCls	: 'x-icon-mouse',
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
		    			iconCls: 'x-icon-mail_light_new_1',
		    			iconAlign	: 'bottom',
		    			tooltip: {text:'Click to Start Writing a New Email', title:'Compose An Email'},
		    			flex	: 1,
		    			handler: function(){ 
			        		//ume.os.open('email_composer');
			        	
				        	var email = new x4.mail.EmailTab({
								title	: 'New ',
								editor	: true,
								//id		: 'inbox-new-email'+inboxId,
								iconCls	: 'x-icon-mail_light_new_1',
								closable: true,
							});
							//var form = email.getForm()
							//form.loadRecord(r);
						
							
							
							Ext.getCmp('inbox-email-tab-'+inboxId).add(email);
			        	

							Ext.getCmp('inbox-email-tab-'+inboxId).activate(email);
							
			        	
			        	}
		    		},{
		    			text: 'Save',
		    			iconCls: 'x-icon-mail_light_down',
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
		    			iconCls: 'x-icon-mail_dark_new_2',
		    			iconCls	: 'x-icon-bin',
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
				region	: 'east',
				title	: 'Contacts',
				frame	: true,
				width	: 200,
				items	: [new Ext.DataView({
					
				})],
			},{
				region	: 'west',
				layout	: 'border',
		        collapsible	: true,
		        split	: true,
		        title	: 'Your Labels',
				width	: 250,
		        expanded	: true,
				items	: [new Ext.tree.TreePanel({
					region	: 'north',
					height	: 225,
					split	: true,
					id		: 'inbox-tree-'+this.title,
					//dataUrl	: '/inbox/index',
					rootVisible	: true,
			        autoScroll	: true,
			        userArrows	: true,
				    root	: {
				        //nodeType: 'async',
				        text		: this.title,
				        draggable	: false,
				        iconCls		: this.iconCls,
				        expanded	: true,
				        visible		: true,
				        id			: this.rootId
				    },
				    loader: new Ext.tree.TreeLoader({
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
				    listeners	: {
				    	click: function(n){ 
				    		email_store.setBaseParam('box',n.id);
							email_store.setBaseParam('email',n.parentNode.id);
							email_store.load({
								params	: {
									box : n.id,
									email	: n.parentNode.id
								}
							}); 
						},
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
				        }
				    }
				}),{
					xtype	: 'tabpanel',
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
				            		return (text == 'U') ? ume.getIcon('mail_light') : ume.getIcon('mail_dark_stuffed') 
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
				                header: "Date", 
				                width: 75, 
				                dataIndex: 'Date',
				                sortable: true, 
				        		hidden: true,
				                xtype:"datecolumn",
				                format:"D, h:ia n/j/y"
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
						
						})/*, 
						bbar: new Ext.PagingToolbar({
							pageSize: 10,
							store: email_store,
							displayInfo: true,
							displayMsg: 'Displaying emails {0} - {1} of {2}',
							emptyMsg: "No Emails to display"
							
						})*/
				    })]
				}]
			}];
			x4.mail.Inbox.superclass.initComponent.call(this);
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
			var mailbox 	= this.mailbox;
			var editor 	= (this.editor) ? true : false;
	    	
	    	function editing(edit,read){
	    		return (editor) ? edit : read;
	    	}
			
	    	this.buttons	= (!this.editor) ? [{
		        text: 'Reply', 
		        iconAlign	: 'bottom', 
		        iconCls: 'x-icon-mail_light_left',
		        handler: function(){
	    			// Replying creates a draft copy of the email recieved - minus the attachments.
	    			Ext.getCmp(formId).getForm().submit({
	    				url	: '/inbox/saveEmail/?json',
	    				success	: function(f,a){
	    					var oldEmail = f.getValues();
		        			var email = new x4.mail.EmailTab({
		    					title	: 'Re: '+oldEmail.Subject,
		    					iconCls	: 'x-icon-mail_light_stuffed',
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
				iconCls: 'x-icon-mail_light_right', 
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
				iconCls	: 'x-icon-mail_light_up',
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
			
			this.items	= [{
				region		: 'east',
				width		: 200,  
				collapsed	: (!this.editor),
	        	xtype		: 'panel',
	        	title		: 'Attachments',
	        	iconCls		: 'x-icon-attachments',
	        	layout		: 'fit', 
	        	width		: 250,
	        	items		: [new Ext.ux.IFrameComponent({
					region	: 'center',
					width	: '100%',
					height	: '100%',
					id		: 'preview',
					iconCls	: 'x-icon-email_attach',
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
					    emptyText: 'From Address',
					    hideLabel: true,
					    //id	: 'email-from',
					    //readOnly	: true,
					    store: new Ext.data.JsonStore({  
						    autoLoad: true,
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
					    //hiddenName: 'active_id',  
					    mode: 'remote',  
					    minChars 	: 0 ,
					    allowBlank	: false, 
						name		: editing('form[from]','fromaddress'),
						hiddenName	: editing('form[from]','fromaddress'), 
						//value		: Ext.util.Cookies.get('user[email]'),
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
	    				empty	: 'Time Stamp',
	    				emptyText	: 'Set When this should Go Out',
	    				xtype	: 'datefield',
	    				format:"D, h:ia n/j/y",
	    				minValue	: date,

					    hideLabel: true,
	    				value		: new Date(),
	    				name	: editing('form[date]','Date'),
	    			},new Ext.form.ComboBox({  
					    emptyText: 'Carbon Copy',
					    hideLabel: true,
					    //id	: 'email-cc',
					    //readOnly	: true,
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
					    //id	: 'email-bcc',
					    //readOnly	: true,
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



os.inbox = function(){};
os.inbox.prototype = {
	createWindow: function(){
    	var desktop = MyDesktop.getDesktop();
        var win = desktop.getWindow('inbox');
        if(!win){
        	win = desktop.createWindow({
        		title	: 'Universal MailBox',
        		iconCls	: 'x-icon-umsg',
        		id		: 'inbox',
        		width	: $(window).width()*.8,
        		height	: $(window).height()*.8,
        		layout	: 'border',
        		listeners: {
        			beforeshow: function(){ 
	    				//Ext.getCmp('tree').collapse();
	        			/*email_store.load({
	        				params:{box: 'INBOX'}
	        			});*/
        			}
        		},
        		tbar	: [{
        			text	: 'Open eMail Box',
        			iconCls	: 'x-icon-box_locked',
        			iconAlign	: 'top',
        			handler	: this.createNewBox
        		},'-',{
        			text	: 'Check Mail',
        			iconAlign	: 'top',
        			tooltip: {text:'Ques all MailBoxes and Emails in OutBox', title	:'Sends & Recieves Emails'},
        			iconCls	: 'x-icon-mailbox',
        			handler	: function(){
        				// 
        				
        			}
        		}],
        		 bbar: new Ext.ux.StatusBar({
    	            id: 'inbox-statusbar',

    	            // defaults to use when the status is cleared:
    	            defaultText: 'Default status text',
    	            //defaultIconCls: 'default-icon',
    	        
    	            // values to set initially:
    	            text: 'Ready',
    	            iconCls: 'x-status-valid',

    	            // any standard Toolbar items:
    	            items: ['->']
    	        }),
        		items	: [{
        			xtype	: 'tabpanel',
        			deferredRender	: false,
        			id		: 'inbox-box-tabs',
        			region	: 'center',
        			activeTab	: 0,
        			items	: [new x4.mail.Inbox({
        				iconCls	: 'x-icon-umsg',
        				id		: 'inbox-pm-tab',
        				rootId	: 'inbox-pm',
						closeable	: false,
            			title	: window.location.hostname+'/inbox/'+Ext.util.Cookies.get('user[username]')
            		})]
        		}],
        	});
        	
        	Ext.Ajax.request({
        		url	: '/inbox/getBoxes/?json',
        		params	: {
        			node	: 'root'
        		},
        		success	: function(r){
        			var boxes = Ext.util.JSON.decode(r.responseText);
        			var tabs = Ext.getCmp('inbox-box-tabs');
        			for(i in boxes){
        				var id = boxes[i].id;
        				var iconCls = boxes[i].iconCls;
        				if(id){
        					var tab = new x4.mail.Inbox({
        						title	: id.replace('inbox-',''),
        						id		: 'tab-'+id,
                				rootId	: id,
        						closeable	: true,
        						iconCls	: iconCls,
        						listeners	: {
        							beforeclose	: function(){
        								return confirm("Are You Sure You Want to Disconnect Fomrom this Mailbox?");
        							}
        						},
        					});
        					tabs.add(tab);
        					
        				};
        			}
        		}
        	});
        	
        }
        win.show(null,function(){
        	win.hide();
        	win.maximize()
        	win.show();
        	win.getEl().fadeIn({ duration: 1 });
        });
	},
	mailBox		: function(){
		return new x4.mail.Inbox(cfg);
	},
    movePreview : function(m, pressed){
        if(!m){ // cycle if not a menu item click
            var readMenu = Ext.menu.MenuMgr.get('reading-menu');
            readMenu.render();
            var items = readMenu.items.items;
            var t = items[0], b = items[1], l = items[2], r = items[3], h = items[4];
            if(t.checked){
                b.setChecked(true);
            }else if(b.checked){
                l.setChecked(true);
            }else if(l.checked){
                r.setChecked(true);
            }else if(r.checked){
                h.setChecked(true);
            }else if(h.checked){
                t.setChecked(true);
            }
            return;
        }
        if(pressed){
            Ext.getCmp('inbox-msg-pan').destroy();
            var preview = this.msgPan();
            var right = Ext.getCmp('right-preview');
            var left = Ext.getCmp('left-preview');
            var bot = Ext.getCmp('bottom-preview');
            var north = Ext.getCmp('north-preview');
            
            var btn = Ext.getCmp('inbox-grid').getTopToolbar().items.get(0);
            switch(m.text){
	            case 'Top':
	                right.hide();
	                bot.hide();
	                left.hide();
	                north.add(preview);
	                north.show();
	                north.ownerCt.doLayout();
	                btn.setIconClass('x-icon-preview_bottom');
	                
	                var r = ume.webgrams['inbox'].current_email_record;
			 		Ext.getCmp("inbox-email-wing").getForm().loadRecord(r);
			 		$('#email-msg').html(ume.webgrams['inbox'].current_email_msg);
	                
                break;    
            	case 'Bottom':
                    right.hide();
                    north.hide();
                    left.hide();
                    bot.add(preview);
                    bot.show();
                    bot.ownerCt.doLayout();
                    btn.setIconClass('x-icon-preview_bottom');
                    
                    var r = ume.webgrams['inbox'].current_email_record;
			 		Ext.getCmp("inbox-email-wing").getForm().loadRecord(r);
			 		$('#email-msg').html(ume.webgrams['inbox'].current_email_msg);
                    
                    break;
            	case 'Left':
                    bot.hide();
                    north.hide();
                    right.hide();
                    left.add(preview);
                    left.show();
                    left.ownerCt.doLayout();
                    btn.setIconClass('x-icon-preview-left');
                    
                    
			 		var r = ume.webgrams['inbox'].current_email_record;
			 		Ext.getCmp("inbox-email-wing").getForm().loadRecord(r);
			 		$('#email-msg').html(ume.webgrams['inbox'].current_email_msg);
                    
                    break;
            	case 'Right':
                    bot.hide();
                    north.hide();
                    left.hide();
                    right.add(preview);
                    right.show();
                    right.ownerCt.doLayout();
                    btn.setIconClass('x-icon-preview-right');
                    
                    
			 		var r = ume.webgrams['inbox'].current_email_record;
			 		Ext.getCmp("inbox-email-wing").getForm().loadRecord(r);
			 		$('#email-msg').html(ume.webgrams['inbox'].current_email_msg);
                    
                    break;
                case 'Hide':
                    bot.hide();
                    left.hide();
                    right.hide();
                    north.hide();
                    bot.ownerCt.doLayout();
                    btn.setIconClass('x-icon-preview-hide');
                    break;
            }
        }
    },
	nodeClick	: function(n,email_store){
		switch(n.id) {
			case('inbox-new'):
				this.createNewBox();
			break;
			case('inbox-PM'):
				
			break;
			default	:
				var limit = $('#inbox-grid').height() / 25 ;
				
				function setPassword(email_pass){
					email_pass.getEl().mask('Encrypting Password...');			
					var hash = ume.util.php.base64_encode(Ext.getCmp('email-password').getValue());
					hash = hash + ume.util.php.base64_encode(ume.util.php.md5(Ext.util.Cookies.get('PHPSESSID')));  
					hash = ume.util.php.base64_encode(hash);
					Ext.getCmp('email-password').setValue(hash);
					email_pass.getEl().mask('Logging In...');
					Ext.getCmp('email-pass-form').getForm().submit({
						success: function(){
							Ext.util.Cookies.set('hasInbox',true);	
							email.launch(n);
							email_pass.close();
							email_pass.getEl().unmask();
							
						},
						failure: function(){
							filesys.hi('Connection Failed','Unable To Login');
							Ext.getCmp('email-password').setValue(null);
							email_pass.getEl().unmask();
						}
					});
				}
				
				/*$$.Email.hasPass(function(r){
					switch(r.hasPass){
						case(false):
							var email_pass = new Ext.Window({
								title: 'Please enter your password for email: ',
								width: 300,
								modal: true,
								items: new Ext.FormPanel({
									id: 'email-pass-form',
									frame: true,
									items:[{
										fieldLabel: 'Password',
										xtype: 'textfield',
										id: 'email-password',
										name: 'pass',
										inputType: 'password'
									}],
									buttonAlign: 'center',
									modal: true,
									buttons: [{
										text: 'Login to Email',
										handler: function(){
											setPassword(email_pass);
										}
									}],
									api: {
										submit: $$.Email.setPassword
									}
								}) 
							}).show();
							new Ext.KeyNav('email-pass-form', {
									"enter": function() { setPassword(email_pass);}
							});
							return false;
						break;
						case(true):
							//email.reqPass(n);
						break;
					}
				});
				*/
				
			break;
		}
	},
	createNewBox	: function(el){
		var win = Ext.getCmp('inbox-new-box-win');
		if(!win){
			
			// This is a fake CardLayout navigation function.  A real implementation would
			// likely be more sophisticated, with logic to validate navigation flow.  It will
			// be assigned next as the handling function for the buttons in the CardLayout example.
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
			    id:'new-box-wizard-panel',
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
								ume.msg('Attemping to find server settings','Please wait...');
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
					load: $$.Email.loadSettings,
					submit: $$.Email.newAccount
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
			
			//ume.os.open('email_composer');
			
		});
		
	}
};

try{
    ume.webgrams['inbox'] = new os.inbox();
}catch(e){
    alert(e);
}