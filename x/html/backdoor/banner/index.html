<style> 
 
.x-form-file-wrap {
    position: relative;
    height: 22px;
}
.x-form-file-wrap .x-form-file {
	position: absolute;
	right: 0;
	-moz-opacity: 0;
	filter:alpha(opacity: 0);
	opacity: 0;
	z-index: 2;
    height: 22px;
}
.x-form-file-wrap .x-form-file-btn {
	position: absolute;
	right: 0;
	z-index: 1;
}
.x-form-file-wrap .x-form-file-text {
    position: absolute;
    left: 0;
    z-index: 3;
    color: #777;
}
</style>

<table width="100%" align="center" id="admin-zone-panel">
	<tr>
		<th>Banners | <a href="#" onclick="javascript: newLink();">Add New</a></th>
	</tr>
	<tr>
		<td id="banners">
			
		</td>
	</tr>
</table>

<script type="text/javascript">

	view = new Ext.DataView({
    itemSelector: 'div.thumb-wrap',
    style:'overflow:auto',
    multiSelect: true,
    id: 'banner-dv',
    store: new Ext.data.JsonStore({
        url: '/{$toBackDoor}/{$Xtra}/index/?returnJson',
        autoLoad: true,
        root: 'banners',
        id:'id',
        fields:[
            'id', 'url','title','target_path'
        ]
    }),
    {literal}
    tpl: new Ext.XTemplate(
        '<tpl for=".">',
        '<div class="thumb-wrap" id="{title}">',
        '<div class="thumb"><img src="/{$toBackDoor}/xphp/xBanner/{target_path}" class="thumb-img"></div>',
        '<span>{url} | <a href="{/literal}{$ME}{literal}/delete/{id}">Delete</a></span></div>',
        '</tpl>'
    )
    {/literal}
});
	
	var images = new Ext.Panel({
	    title:'Banners',
	    region:'center',
	    margins: '5 5 5 0',
	    layout:'fit',
	    renderTo: 'banners',
	    items: view
	});


	function newLink(){
		var win = new Ext.Window({
			title	 : 'Add a New Banner',
			id		: 'banner-win',
			width	: 500,
			autoHeight: true,
			items: new Ext.form.FormPanel({
				id		: 'banner-form',
				frame	: true,
				labelWidth: 50,
				layout	: 'form',
				method	: 'POST',
				 fileUpload: true,
				defaultType	: 'textfield',
				defaults	: {
					anchor	: '95%',
					allowBlank: false
				},
				items	: [{
		            xtype: 'fileuploadfield',
		            id: 'form-file',
		            emptyText: 'Select an image',
		            fieldLabel: 'Photo',
		            name: 'banner-photo',
		            buttonText: '',
		            buttonCfg: {
		                iconCls: 'x-icon-16x16-photo'
		            }
		        },{
					fieldLabel	: 'Title',
					name		: 'banner[title]'
				},{
					fieldLabel	: 'URL',
					name		: 'banner[url]',
					emptyText	: '{$HTTP_HOST}/'
				}],
				buttons	: [{
					text	: 'Save',
					bindForm: true,
					iconCls	: 'x-icon-16x16-disk',
					handler	: function(){
						Ext.Msg.wait('Saving banner','Please Wait...');
						Ext.getCmp('banner-form').getForm().submit({
							url		: '/{$toBackDoor}/{$Xtra}/add/?returnJson',
							success	: function(){
								Ext.Msg.alert('Success!','Banner Saved!');
								Ext.getCmp('banner-form').getForm().reset();
								// Reload Store, Close Window.
								Ext.getCmp('banner-win').close();
								view.getStore().load();
							},
							failure	: function(f,a){
								Ext.Msg.alert('Banner Did NOT Save!!',a.result.error);
							}
						});
					},
				}]
			})
		});
		win.show();
	}
</script>