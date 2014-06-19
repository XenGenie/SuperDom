<table align="center" width="90%" id="admin-zone-panel" >
	<tr>
		<th>Your Content</th>
	</tr>
	<tr>
		<td id='content-editor' valign="top">
		
		</td>
	</tr>
</table>
<script>
	function openContent(id,el){
		Ext.QuickTips.init();  // enable tooltips
		new Ext.Window({
		    title		: 'New Page',
		    renderTo	: 'content-editor',
		    autoWidth	: true,
		    height		: 500,
		    width		: '90%',
		    frame		: true,
		    layout		: 'fit',
			listeners	: {
				render	: function(){
					Ext.getCmp('content-form').getForm().load({
						url		: '/{$toBackDoor}/{$Xtra}/edit/{$page.id}/?returnJson',
					});
				}
			},
		    items		: new Ext.form.FormPanel({
			    url		: '/{$toBackDoor}/{$Xtra}/add/?returnJson',
			    id		: 'content-form',
				defaultType: 'textfield',
				defaults: {
					allowBlank	: false
				},
				items	: [{
					xtype	: 'hidden',
					name	: 'page[id]',
					//value	: '{$page.id}'
				},{
					fieldLabel: 'Page Url',
					name		: 'page[url]',
					//value		: '{$page.url}',
					emptyText	: '{$HTTP_HOST}/',
					width		: 300
				},{
					fieldLabel	: 'Page Title',
					name		: 'page[title]',
					//value		: '{$page.title}',
					width		: 300, 
				},{
					hideLabel 	: true,
					autoWidth	: true,
					height		: 400,
					width		: '100%',
					xtype		: 'htmleditor',
					anchor		: '100%',
			
					id			: 'page-content', 
					name		: 'page[content]'
				}],
				buttons: [{
					text: 'Save Page',
					bindForm: true,
					handler	: function(){
						Ext.getCmp('content-form').getForm().submit({
							success	: function(){
								Ext.Msg.alert('Save Successful!','Content has been created');
								Ext.getCmp('content-form').getForm().reset();
							},
							failure	: function(){
								Ext.Msg.alert('Save Successful!');
							},
						});
					}
				}]
			})
		}).show();
	};
</script>