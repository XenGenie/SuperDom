<table align="center" width="75%" id="admin-zone-panel">
	<tr>
		<th>
		<img src="{$ICON.48}/news.gif" align="absmiddle"/>
		Latest News of {$HTTP_HOST} <a href="#add" onclick="addNews(this)" style="float: right;"><img src="{$ICON.16}/newspaper_add.png" align="absmiddle"/>Add News</a></th>
	</tr>
	<tr>
		<td align="center">
			<div align="center">
				{foreach from=$list item=news}
					<div class="box" style="margin: 10px; padding: 10px; font-weight: none; font-size: 10px; float: left; width: 28%; height: 110px; overflow: auto;">
						<center>
							<h1>{$news.title}</h1>
							<b style='font-size: 8px'>{$news.date}</b>
						<a href="#edit:{$news.title}" onclick="addNews(this,'{$news.id}')" style="float: left" >
							<img src="{$ICON.16}/newspaper.png" align="absmiddle"/> Edit
						</a>
						<a href="#" onclick="removeArticle({$news.id})" style="float: right">
							<img src="{$ICON.16}/newspaper_delete.png" align="absmiddle"/>	Delete
						</a>
							<hr/>
						</center>
						{$news.content|strip_tags|truncate:250}
						
					</div>
				{/foreach}
			</div>
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
		
		new Ext.Window({
			title	: 'News Article',
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
					iconCls	: 'x-icon-16x16-newspaper_go',
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