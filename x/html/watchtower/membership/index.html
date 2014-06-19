<table id="admin-zone-panel" align="center" width="50%">
	<tr>
		<th>
		<button onclick="newPlan(this);" style="float: right; " >
			<img src="{$ICON.16}/hcards_add.png" align="absmiddle"/>
			<br/>Create Membership Subscription
		</button>
		<img src="{$ICON.48}/{$xphp_files['xMembership.php'].icon}" align="absmiddle"/>
		Memberships 
		<form>
		
		</form>
		</th>
	</tr>
	<tr>
		<td>
		{if $memberships}
			{foreach from=$memberships item=membership}
				<fieldset>
					<legend><a href="/{$toBackDoor}/{$Xtra}/permit/{$membership.id}">Manage Permissions</a> | {$membership.profileDesc} | {$membership.amount} - Every {$membership.billingFrequency} {$membership.billingPeriod} for {$membership.totalBillingCycles} Cycles </legend>
					<a href="#edit" onclick="newPlan(this,{$membership.id})">Edit</a> | <a href="/{$toBackDoor}/{$Xtra}/remove/{$membership.id}">Remove</a> 
				</fieldset>
			{/foreach}
		{/if}
		</td>
	</tr>
</table>

<script type="text/javascript">
function newPlan(el,id){
	var win = x4.Window({
		title	: 'Membership Subscription Plan',
		id		: 'membership-win',
		iconCls	: 'x-icon-16x16-hcards_edit',
		width	: 500,
		modal	: true,
		autoHeight: true,
		layout	: 'fit',
		items: new Ext.form.FormPanel({
			id		: 'plan-form',
			frame	: true,
			labelWidth: 75,
			autoHeight: true,
			layout	: 'form',
			url		: '/{$toBackDoor}/{$Xtra}/add/?returnJson',
			method	: 'POST',
			defaultType	: 'textfield',
			defaults	: {
				anchor	: '100%',
				allowBlank: false
			},
			items	: [{
				name	: 'id',
				xtype	: 'hidden'
			},{
				fieldLabel	: 'Plan Title',
				blankText	: 'Enter a Title for This Subscription Plan',
				emptyText	: 'Gold Package',
				msgTarget	: 'side',
				anchor		: '-20',
				name		: 'profileTitle'
			},{
				fieldLabel	: 'Describe',
				hideLabel	: true,
				blankText	: 'Give a Brief Explanation of this Subscription Plan',
				emptyText	: 'Access to Exclusive Content',
				name		: 'profileDesc',
				xtype		: 'textarea'
			},{
				xtype	: 'fieldset',
				title	: 'Subscription Plan',
				iconCls	: 'x-icon-16x16-money',
				items	: [{
					xtype: 'radiogroup',
		            fieldLabel	: 'Period',
		            hideLabel	: true,
		            itemCls: 'x-check-group-alt',
		            columns: 3,
		            vertical: true,
		            anchor	: '100%',
		            name: 'billingPeriod',
		            items: [
						{ boxLabel: 'Day(s)', 		name: 'billingPeriod', inputValue: 'day'},
						{ boxLabel: 'Once (None)', 	name: 'billingPeriod', inputValue: 'none'},
						{ boxLabel: 'Week(s)', 		name: 'billingPeriod', inputValue: 'week'},
						{ boxLabel: 'SemiMonth(s)',	name: 'billingPeriod', inputValue: 'semimonth'},
						{ boxLabel: 'Month(s)', 	name: 'billingPeriod', inputValue: 'month'},
						{ boxLabel: 'Year(s)', 		name: 'billingPeriod', inputValue: 'year'}

		            ]
				},{
					layout	: 'column',
					defaults: {
						layout	: 'form',
						labelAlign	: 'top',
						columnWidth	: .33,
					},
					items	: [{
						items	: [{
							fieldLabel	: 'Bill Amount',
							xtype		: 'numberfield',
							name		: 'amount',
							emptyText	: '0.00',
							allowBlank	: false,
							anchor		: '-5',
							blankText	: 'Please Enter an Amount'
							//value: '$' 
						}]
					},{
						items	: [{
							fieldLabel	: 'Every',
							name		: 'billingFrequency',
							xtype		: 'spinnerfield',
			            	minValue	: 1,
			            	maxValue	: 31,
			            	allowDecimals: false,
			            	decimalPrecision: 1,
			            	incrementValue: 1,
			            	value	: 30,
			            	alternateIncrementValue: 2,
			            	accelerate: true,
							allowBlank: false,
							anchor	: '-5'
							
						}]
					},{
						
						items	: [{
							fieldLabel	: 'Total # of Cycles',
							anchor	: '100%',
							name		: 'totalBillingCycles',
							xtype: 'spinnerfield',
							value	: 12,
			            	minValue: 0,
			            	allowDecimals: false,
			            	incrementValue: 1,
			            	alternateIncrementValue: 2,
			            	accelerate: true,
							allowBlank: false
						}]
					}]
				}],
				
			}],
			buttonAlign	: 'center',
			buttons	: [{
				text	: 'Add Membership Plan',
				iconAlign	: 'top',
				bindForm: true,
				iconCls	: 'x-icon-16x16-hcards_add',
				handler	: function(){
					Ext.getCmp('plan-form').getForm().submit({
						waitMsg	: 'Saving Link',
						waitTitle: 'Please Wait...',
						success	: function(){
							Ext.Msg.alert('Success!','Plan Saved!');
							Ext.getCmp('plan-form').getForm().reset();
							// Reload Store, Close Window.
							Ext.getCmp('membership-win').close();
							window.location='{$ME}';
						},
						failure	: function(f,a){
							//Ext.Msg.alert('Plan Did NOT Save!!',a.result.error);
						},
					});
				},
			}]
		})
	});
	win.show(el,function(){
		if(id){
			Ext.getCmp('plan-form').getForm().load({
				url		: '/{$toBackDoor}/{$Xtra}/load/'+id
			}); 
		}
	});
	
}
</script>
  
<link rel="stylesheet" type="text/css" href="http://bin.xtiv.net/js/ext/examples/ux/css/Spinner.css" />     