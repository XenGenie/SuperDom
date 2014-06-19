<table align="center" width="75%" id="admin-zone-panel">
	<tr>
		<th>{$HTTP_HOST} Latest Newsletters <a href="#add" onclick="addNews(this)" style="float: right;"><img src="{$ICON.16}/newspaper_add.png" align="absmiddle"/>Add Newsletter</a></th>
	</tr>
	<tr>
		<td>
		{if $list}
			{foreach from=$list item=news}
				<fieldset>
					<center>
						<h1>{$news.title}</h1>
						<b>{$news.date}</b>
						<hr/>
					</center>
					{$news.content|strip_tags|truncate:250}
					<hr/>
					<a href="#edit:{$news.title}" onclick="addNews(this,'{$news.id}')" style="float: left" >
						<img src="{$ICON.16}/newspaper.png" align="absmiddle"/> Edit
					</a>
					<a href="#" onclick="removeArticle({$news.id})" style="float: right">
						<img src="{$ICON.16}/newspaper_delete.png" align="absmiddle"/>	Delete
					</a>
				</fieldset>
			{/foreach}
		{/if}
		</td>
	</tr>
</table>

<script type="text/javascript">
	function removeArticle(id){
		var q = confirm('Are You sure you want to delete this?');
		if(q){
			window.location = "/{$toBackDoor}/{$Xtra}/delete/"+id;
		}
	}

	function addNews(el,id){
		
		var win = new Ext.Window({
			title	: 'Newsletter',
			iconCls	: 'x-icon-16x16-newspaper',
			width	: 550,
			height	: 450,
			items	: [new Ext.form.FormPanel({
				defaultType : 'textfield',
				id		: 'new-news-form',
				layout	: 'form',
				frame	: true,
				items	: [{
					xtype		: 'hidden',
					name		: 'news[id]'
				},{
					xtype		: 'hidden',
					name		: 'news[sent]'
				},{
					fieldLabel	: 'Heading',
					anchor		: '100%',
					name		: 'news[title]'
				},{
					fieldLabel	: 'Date',
					value		: new Date(),
					xtype		: 'datefield',
					name		: 'news[date]'
				},{
					hideLabel	: true,
					xtype		: 'htmleditor',
					anchor		: '100%',
					name		: 'news[content]'
				}],
				buttonAlign		: 'center',
				buttons	: [{
					text	: 'Save',
					iconCls	: 'x-icon-16x16-disk',
					handler	: function(){
						Ext.Msg.wait('Saving','Please wait...');
						Ext.getCmp('new-news-form').getForm().submit({
							url		: '/{$toBackDoor}/{$Xtra}/add/?returnJson',
							success	: function(){
								Ext.Msg.alert('News Saved!','Success');
								window.location = '{$ME}';
							}
						});
					}
				},{
					text	: 'Send',
					iconCls	: 'x-icon-16x16-newspaper_go',
					handler	: function(){
						Ext.Msg.wait('Sending','Please wait...');
						Ext.getCmp('new-news-form').getForm().submit({
							url		: '/{$toBackDoor}/{$Xtra}/add/1/?returnJson',
							success	: function(){
								Ext.Msg.alert('Newsletter Sent!!','Success');
								win.close();
								window.location = '{$ME}';
							}
						});
					}
				}]
			})]
		}).show(el,function(){
			if(id){
				Ext.Msg.wait('Loading','Please wait...');
				Ext.getCmp('new-news-form').getForm().load({
					url		: '/{$toBackDoor}/{$Xtra}/edit/'+id+'/?returnJson',
					failure: function(form, action) {
				        Ext.Msg.alert("Load failed", action.result.errorMessage);
				    },
					success	: function(){
						Ext.Msg.hide(); 
					}
				});
			}
		});
	} 
</script>