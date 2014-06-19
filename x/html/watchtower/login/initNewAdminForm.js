MyDesktop.newAdmin = Ext.define('MyDesktop.newAdmin', {
	extend   : 'Ext.ux.desktop.Module',
	requires : [
		'Ext.tab.Panel'
	],
	
	id       :'newAdmin-win',

	path     : null,
	
	init     : function(){
	    // this.launcher = {
	    //     text: 'supportTicket',
	    //     iconCls:'tabs'
	    // };

		x4.direct('xLogin');

		var path  = $('#no-desktop');
		this.path = path.clone();
		path.remove();


		$('.contact').center();

	},

	createWindow : function(el){ 
		var desktop = myDesktopApp.getDesktop();
		var win     = desktop.getWindow('newAdmin-win');

	    if(!win){
	        win = desktop.createWindow({        
	        	//id : 'supportTicket-win',
	        	title : '{$LANG.LOGIN.CREATE_ADMIN}',
	        	width : $(window).width()/2,
	        	height : $(window).height()/2,
	        	layout : 'fit',
				items : x4.newAdmin
	        });
	    }
	    return win;
	},


	returnForm : function(area,field) {
		switch (area){
			default:
				return this.returnNewAdminForm(area);
			break;
		}
	},

	returnNewAdminForm : function (type){
		return Ext.create('Ext.form.FormPanel',{
			layout	: 'form',
			frame	: true,
			items	: [{
				xtype	: 'fieldset',
				title	: 'Credentials',
				layout	: 'form',
				defaultType: 'textfield',
				labelAlign: 'right',
				defaults	: { 
					anchor	: '100%',
				},
				items	: [{
					vtype	: 'email',
					fieldLabel: ' <img align="right" src="{$ICON.16}/email.png"> Email',
				},{
					fieldLabel: ' <img align="right" src="{$ICON.16}/user.png"> Username',
				},{
					inputType	: 'password',
					fieldLabel: ' <img align="right" src="{$ICON.16}/key.png"> Password',
				},{
					fieldLabel: ' <img align="right" src="{$ICON.16}/lock.png"> Confirm',
					inputType	: 'password',
				}]		
			},{
				xtype       : 'fieldset',
				title       : 'Notification Email',
				defaultType : 'textfield',
				labelAlign  : 'right',
				items	: [{
					height	: 200,
					anchor	: '100%',
					xtype	: 'textarea',
					value	: 'This message is to inform you that your Admin Account has been enabled.'
						+''
						+'Login at http://{$HTTP_HOST}/{$toBackDoor}/ using the following information:'
						+'--------------------------'
						+'Username: $username		'
						+'Password: $password		'		
						+'--------------------------'		
						+'~ Thank You. Please keep this record secure.',
					hideLabel: true
				}]
			}],
			buttons	: [{
				text      : 'Grant Administration Access',
				iconAlign : 'right',
				iconCls   : 'x-icon-32x32-lock',
				scale     : 'large'
			}]
		})
	}
}); 

Ext.onReady(function() {
	x4.newAdmin = new MyDesktop.newAdmin();

	x4.newAdminPanel = Ext.create('Ext.tab.Panel', {
		
		layout	: 'fit',
		width     : '100%',
		height    : '100%',
		bodyStyle : 'background: transparent',
		items     : [{
			title : 'Wizard',
			iconCls : 'x-icon-16x16-wand',
			layout 	: 'fit',
			bodyStyle : 'background: transparent',
			html    : x4.newAdmin.path.html()
		},{
			layout  : 'border',
			title   : 'Manual Access',
			iconCls : 'x-icon-16x16-key',
			items   : [x4.newAdmin.form = x4.newAdmin.returnForm()],
			buttons : [{
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
		        	var form = x4.newAdmin.form.getForm();
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


	// set up contact form link
		$('.contact .action').click(function(e){
			$('.contact').addClass('flip');
			e.preventDefault();
		});
		$('.contact .edit-submit').click(function(e){
			$('.contact').removeClass('flip');
			// just for effect we'll update the content
			e.preventDefault();
		});

		$('#new-admin').center().center();
});
// var d = myDesktopApp.getDesktop(), me = new MyDesktop.supportTicket(); 
// d.restoreWindow(me.createWindow());