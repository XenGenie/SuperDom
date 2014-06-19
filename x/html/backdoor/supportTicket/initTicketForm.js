required = "";
MyDesktop.supportTicket = Ext.define('MyDesktop.supportTicket', {
	extend   : 'Ext.ux.desktop.Module',
	requires : [
	    'Ext.tab.Panel'
	],

	id:'supportTicket-win',

	init : function(){
	    // this.launcher = {
	    //     text: 'supportTicket',
	    //     iconCls:'tabs'
	    // };

		x4.direct('xSupportTicket');

		Ext.regModel('Component', {
		    fields: [
		        'myId',   //numeric value is the key
		        'myText' //the text value is the value
		    ]
		});

		var imgs = $('#support-ticket-icons img');
		$('#support-ticket-icons').css({
			position : 'absolute',
			width    : imgs.width() * imgs.length + 5,
			height   : imgs.height() * imgs.length + 5 
		}).center();

	},

	createWindow : function(el){ 
		var desktop = myDesktopApp.getDesktop();
		var win     = desktop.getWindow('supportTicket-win');

	    if(!win){
	        win = desktop.createWindow({        
	        	//id : 'supportTicket-win',
	        	title : 'Sub',
	        	width : $(window).width()/2,
	        	height : $(window).height()/2,
	        	layout : 'fit',
				items : x4.supportTicketPanel
	        });
	    }
	    return win;
	},

	returnStore : function (method) {
		return new Ext.data.JsonStore({
		    // store configs
			autoLoad : true,
			storeId  : method+'-id',
			proxy    : {
				type   : 'ajax',
				url    : './{$Xtra}/rpc/ticket.'+method+'.getAll//.json',	
				reader : {
					type       : 'json',
					root       : 'data',
					idProperty : 'id'
		        }
		    },
		    //alternatively, a Ext.data.Model name can be given (see Ext.data.Store for an example)
		    fields: ['id','value']
		}); 
	},

	returnForm : function(area,field) {
		

		var F           = this.returnForm;
		var returnStore = function (method) {
			return new Ext.data.JsonStore({
			    // store configs
				autoLoad : true,
				storeId  : method+'-id',
				proxy    : {
					type   : 'ajax',
					url    : './{$Xtra}/rpc/ticket.'+method+'.getAll//.json',	
					reader : {
						type       : 'json',
						root       : 'data',
						idProperty : 'id'
			        }
			    },
			    //alternatively, a Ext.data.Model name can be given (see Ext.data.Store for an example)
			    fields: ['id','value']
			}); 
		};

		switch (area){
			case('summary'):
			break;
			case('user'):
				return [F('reporter'),F('cc')];
			break;
			case('details'):
				return F(field);
			break;
			case('keywords'):
				return {
					xtype      :'textfield',
					fieldLabel : 'Keywords',
					allowBlank : true,
					name       : 'ticket[attr][keywords]',
					// emptyText      : 'Enter One-Word Keys Points'
                };
			break;
			case('reporter'):
				return {
					xtype      : 'textfield',
					fieldLabel : 'Reporter',
					allowBlank : false,
					readOnly   : true,
					name       : 'ticket[attr][reporter]',
					// anchor     : '100%',
					value      : '{$USER.username}@{$HTTP_HOST}'
		        };
			break;
			case('cc'):
				return {
					xtype             :'textfield',
					fieldLabel        : 'Cc',
					afterLabelTextTpl : required,
					allowBlank        : true,
					name              : 'ticket[attr][cc]',
					vtype             :'email',
					value             : '{$USER.email}'
                };
			break;
			case('title'):
				return {
					fieldLabel : 'Ticket Summary',
					name       : 'ticket[summary]',
					allowBlank : false,
					xtype      : 'textfield',
					emptyText  : 'Enter a Summary of your Ticket...'
	            };
			break;
			case('description'):
				return {
					xtype      : 'textarea',
					name       : 'ticket[description]',
					fieldLabel : 'Description',
					allowBlank : false,
					flex       : 1,
					grow 		: true,
					align      : 'strech',
					layout     : 'fit',
					anchor     : '95%',
					emptyText  : 'Enter a description...'
			    };
			break;
			case('milestone'):
				return {
					xtype        : 'combobox',
					fieldLabel   : 'MileStone',
					name         : 'ticket[attr][milestone]',
					valueField   : 'value',
					displayField : 'value',
					typeAhead    : true,
					allowBlank   : false,	
					value        : 'Lilliput Steps',
					store        : returnStore('milestone'),
					emptyText    : 'MileStone???'
                };
			break;
			case('priority'):
				return {
					xtype        : 'combobox',
					fieldLabel   : 'Priority',
					name         : 'ticket[attr][priority]',
					valueField   : 'value',
					displayField : 'value',
					value        : 'minor',
					typeAhead    : true,
					store        : returnStore('priority'),
					emptyText    : 'Priority'
		        };
			break;
			case('component'):
				return {
					xtype        : 'combobox',
					fieldLabel   : 'Component',
					name         : 'ticket[attr][component]',
					valueField   : 'valueField',
					displayField : 'value',
					typeAhead    : true,
					allowBlank   : false,
					value 		 : 'xCore',
					store        : returnStore('component'),
					emptyText    : 'What does this relate to???'
                };
			break;

			default:
				return this.returnSupportTicketForm(area);
			break;
		}
	},

	returnTree : function (){
		var ticket_store = Ext.create('Ext.data.TreeStore', {
			root  : { 
				expanded : true 
			},	
			autoLoad : false,
			proxy : {
				type       : 'direct',
				directFn   : $$.xSupportTicket.treeStore,
				paramOrder : ['node']
	        }
	    });

		return Ext.create('Ext.tree.Panel', {
			store       : ticket_store,
			layout      : 'fit',
			region      : 'west',
			bodyPadding : 0,
			title       : 'Tickets Submitted',
			width       : 200,
			collapsed   : true,
			collapsible : true,
			rootVisible : true
		});
	},

	returnSupportTicketForm : function (type){
		var F = this.returnForm;
		this.ticket_form = Ext.create('Ext.form.FormPanel',{
			// title       : returnType(type).title,
			// iconCls     : returnType(type).iconCls,
			// / // id          : 'multiColumnForm',
			
			title     : 'Submit a Ticket',
			iconCls   : 'x-icon-16x16-ticket',
			frame       : false,
			bodyPadding : '5 5 0',
			layout      : 'border',
			region      : 'center',
			defaults 	: {
				bodyPadding : '5 5 0'
			},
			// bodyStyle   : 'background: transparent',
		    api: {
		        // The server-side method to call for load() requests
				load   : $$.xSupportTicket.loadTicket,
				// The server-side must mark the submit handler as a 'formHandler'
				submit : $$.xSupportTicket.createSupportTicket
		    },
			// fieldDefaults  : {
			//     labelAlign : 'top',
			//     msgTarget  : 'side'
		    // },
			items :[{
				region      : 'north',
				collapsible : false,
				collapsed   : false,
				//iconCls     : 'x-icon-16x16-vcard',
				// title       : 'Report By/To',
		    	items	: [{
					xtype    : 'container',
					anchor   : '100%',
					layout   : 'hbox',
					defaults : {
		            	defaults : {
		            		anchor     :'95%'		            		
		            	}
		            },
		            items:[{
						xtype  : 'container',
						flex   : 1,
						layout : 'anchor',
						items  : [F('reporter')]
		            },{
						xtype  : 'container',
						flex   : 1,
						layout : 'anchor',
						defaults : {
							labelAlign : 'side',
							anchor     : '95%'
						},
						bodyPadding : '5 5 0',
						items  : [F('cc')]
					}]
		        }],
		    	layout  : 'form'
		    },{
				region      : 'east',
				layout 		: 'form',
				labelAlign  : 'top',
				iconCls 	: 'x-icon-16x16-information',
				defaults 	: {
					labelAlign  : 'top'
				},
				items       : [F('milestone'),F('priority'),F('component')],
				layout      : 'form',
				width 		: 200,
				collapsible : true,
				collapsed   : true,
				title       : 'Details',
				frame       : true
		    },{
		    	region 	: 'center',
		    	layout  : 'form',
		    	defaults : {
		    		labelAlign : 'top'
		    	},
		    	items	: [{
					xtype    : 'container',
					anchor   : '100%',
					layout   : 'hbox',
					defaults : {
		            	defaults : {
		            		anchor     :'95%',
							labelAlign : 'top'	        
		            	}
		            },
		            items:[{
						xtype  : 'container',
						flex   : 1,
						layout : 'anchor',
						items  : [F('title')]
		            },{
						xtype  : 'container',
						flex   : 1,
						layout : 'anchor',
						defaults : {
							labelAlign : 'top',
							anchor     : '100%'
						},
						bodyPadding : '5 5 0',
						items  : [F('keywords')]
					}]
		        },F('description')]
		    }]
		});
		return this.ticket_form;
	}
}); 

Ext.onReady(function() {
	x4.supportTicket = new MyDesktop.supportTicket();

	x4.supportTicketPanel = Ext.create('Ext.panel.Panel', {
		id        : 'support-ticket-panel',
		layout    : 'fit',
		width     : '100%',
		height    : '100%',
		bodyStyle : 'background: transparent',
		items     : [{
			layout: 'border',
			items : [x4.supportTicket.returnForm(),x4.supportTicket.returnTree()],
			
			buttons: [{
				height : 40,
				iconCls : 'x-icon-16x16-pencil_delete.png',
		        text: 'Reset',
		        //glyph : 62,
		        handler: function() {
		            x4.supportTicket.ticket_form.getForm().reset();
		        }
		    },{
				text    : 'Submit Ticket',
				height  : 40,
				iconCls : 'x-icon-16x16-ticket_add',
				flex    : 1,
				handler : function() {
		        	var form = x4.supportTicket.ticket_form.getForm();
		            if(form.isValid()){	                	
						form.submit({
							waitMsg   : 'Please Wait...',
							waitTitle : 'Creating New Ticket',
							success   : function(form, action) {
								RESULT = action.result;
							   Ext.Msg.alert('Success', 'Your ticket has been submitted. ');
							   form.reset();
							},
							failure: function(form, action) {
								RE = action;
							    Ext.Msg.alert('Failed', action.message);
							}
						});
		            }
		        }
		    }]
		}],
		renderTo  : x4.activeArea[0]
	});
});
// var d = myDesktopApp.getDesktop(), me = new MyDesktop.supportTicket(); 
// d.restoreWindow(me.createWindow());