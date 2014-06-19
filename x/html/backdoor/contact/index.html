	<script type="text/javascript">
		Ext.onReady(function(){
			var store = new Ext.data.JsonStore({
				fields: ['id','name','email','subject','message','street','state','phone',{
					name: 'timestamp',
					type: 'date',
					dateFormat: 'timestamp'
				}],
				url		: '/{$toBackDoor}/{$Xtra}/index/?returnJson',
				root	: 'feedback'
			});

			var panel = x4.Window({
				maximized	: true,
				closeable: false,
				width	: '100%',
				title	: 'Contact/Feedback Emailer',
				iconCls	: 'x-icon-16x16-email',
				
				height	: $(document.body).height()-$('#shortcut-panel').outerHeight()-$('#neck-breadcrumbs').outerHeight()-50,
				layout: 'border',
				items: [{
					region	: 'west',
					width: '55%',
					layout	: 'fit',
					items: new Ext.grid.GridPanel({			
						title	: 'Viewing All Website Feedback',
						store: store,
						layout	: 'fit',
						id: 'feedback-grid',
						tools: [{
							id: 'refresh',
							handler: function(){
								Ext.getCmp('feedback-grid').getStore().reload();
							}
						}],
					    colModel: new Ext.grid.ColumnModel({
					        defaults: {
					            width: 120,
					            sortable: true
					        },
					        columns: [{
						        header: 'Name', 
						        dataIndex: 'name'
							},{
								header: 'Subject', 
								 
								dataIndex: 'subject'
							},
							{
								header: 'Message', 
								hidden: true,
								dataIndex: 'message'
							},{
								header: 'Email', 
								dataIndex: 'email'
							},{
								header: 'Street', 
								dataIndex: 'street'
							},{
								header: 'State', 
								dataIndex: 'state'
							},{
								header: 'phone', 
								dataIndex: 'phone'
							},{
								header: 'Time Contacted',
								width: 135,  
					            xtype: 'datecolumn',
					            format: 'D, M jS h:ia'
							}],
					    }),
					    sm: new Ext.grid.RowSelectionModel({
						    singleSelect:true,
						    listeners: {
								rowselect: function(sm,rowIndex,r){
							    	if(Ext.getCmp('reply_id').getValue() != r.data.id){
							    		var id = r.data.id;
							    		Ext.getCmp('reply_id').setValue(id); 
										Ext.getCmp('reply_to').setValue('"'+r.data.name+'" '+'<'+r.data.email+'>');
										Ext.getCmp('reply_subject').setValue('Re: '+r.data.subject);
										Ext.getCmp('reply_message').setValue('\n\rOn '+r.data.timestamp.format('D, M jS @ h:ia')+' '+r.data.name+' wrote: \n\r'+r.data.message.replace('\\r','>'));
									}
								}
						    }
						}),
						viewConfig:{
							forceFit: true
						},
				    	stripeRows: true // stripe alternate rows
			    	})
				},{
					region	: 'center',
					layout	: 'fit',
					width: 565,
					items	: new Ext.form.FormPanel({
						id	: 'reply-form',
						frame: true,
						url: '/{$toBackDoor}/{$Xtra}/sendEmail/?returnJson',
						layout	: 'form',
						title : 'Send an Reply',
						defaultType: 'textfield',
						defaults	: {
							anchor: '100%'
						},
						labelAlign: 'top',
						items	: [{
							fieldLabel: 'From',
							name	: 'from',
							id		: 'reply_from',
							xtype	: 'combo',
							lazyRender:true,
						    mode: 'local',
						    store: new Ext.data.ArrayStore({
						        id: 0,
						        fields: [
						            'myId',
						            'displayText'
						        ],
						        data: [ [1, '{$email}'] ]
						    }),
						    valueField: 'myId',
						    displayField: 'displayText'
						},{
							xtype	: 'hidden',
							id		: 'reply_id',
							name	: 'id'
						},{
							fieldLabel: 'Replying To',
							name	: 'reply_to',
							id		: 'reply_to'
						},{
							fieldLabel: 'Subject',
							name	: 'subject',
							id		: 'reply_subject'
						},{
							fieldLabel: 'Message',
							xtype	: 'textarea',
							height: 400,
							name	: 'message',
							id		: 'reply_message'
						}],
						buttons	: [{
							iconCls	: 'x-icon-16x16-email_go',
							text	: 'Send Reply',
							handler: function(){
								Ext.Msg.wait('Sending Email');
								Ext.getCmp('reply-form').getForm().submit({
									success: function(){
										Ext.getCmp('feedback-grid').getStore().reload();
										Ext.Msg.alert('Email Sent','Your reply has been Sent Successfully!');
										Ext.getCmp('reply-form').getForm().reset();
										
									},
									failure: function(){
										Ext.Msg.alert('Failed!');
									}
								});
							}
						}], 
					})
				}]
			}).show(null, function(win){
				//win.setHeight($(document.body).height()-($('#neck-breadcrumbs').outerHeight() + $('#moonmenu').outerHeight()));
			});
			
			// Check for messages ever 30 seconds
			Ext.TaskMgr.start({
			    run: function(){
					Ext.getCmp('feedback-grid').getStore().reload();
			    },
			    interval: 30000
			});
			
		});
	</script>