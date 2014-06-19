
<script>
Ext.onReady(function(){
	x4.direct('xTreasurer');
	var paypalForm;
	var win = x4.Window({
		title	: 'PayPal Treasurer',
		iconCls	: 'x-icon-16x16-creditcards',
		id		: 'treasurer-paypal-win',
		width	: 400,
		modal	: true,
		autoHeight	: true,
		items	: [paypalForm = new Ext.FormPanel({
			layout	: 'form',
			frame	: true,
			 // configs for BasicForm
	        api: {
	            // The server-side method to call for load() requests
	            load: $$.xTreasurer.loadPaypal,
	            // The server-side must mark the submit handler as a 'formHandler'
	            submit: $$.xTreasurer.submit
	        },
			items	: [{
				xtype		: 'textfield',
				vtype		: 'email',
				allowBlank	: false,
				fieldLabel	: 'Set PayPal Email',
				anchor		: '100%',
				name		: 'PAYPAL_EMAIL'
			}],
			buttonAlign		: 'center',
			buttons	: [{
				text		: 'Save',
				iconCls		: 'x-icon-16x16-disk',
				iconAlign	: 'top',
				handler		: function(){
					paypalForm.getForm().submit({
						waitMsg	: 'Saving Paypal Email',
						waitTitle	: 'Saving Paypal Email',
						success	: function(){
							Ext.Msg.alert('Success!','Paypal Email Has been Saved!');
							win.close();
						},
						failure	: function(f,a){
							Ext.Msg.alert('Failed!',a.message);
						}
					});
				}
			}]
		})]
	}).show(null, function(){
		paypalForm.getForm().load();
	});
});

</script>