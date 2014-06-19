<table align="center" width="75%" id="admin-zone-panel">
	<tr>
		<th>
		<img src="{$ICON.48}/news.gif" align="absmiddle"/>
		Syndicating RSS for {$HTTP_HOST} <a onclick="addFeed(this)" style="float: right;"><img src="{$ICON.16}/newspaper_add.png" align="absmiddle"/>Add RSS Feed</a></th>
	</tr>
	<tr>
		<td align="center">
			<div align="center">
				{foreach from=$feeds item=feed}
					<div class="box" style="margin: 10px; padding: 10px; font-weight: none; font-size: 10px; float: left; width: 28%; height: 110px; overflow: auto;">
						<center>
							<h1>{$feed.title}</h1>
							<b style='font-size: 8px'>{$feed.date}</b>
						<a href="#edit:{$feed.title}" onclick="addFeed(this,'{$news.id}')" style="float: left" >
							<img src="{$ICON.16}/newspaper.png" align="absmiddle"/> Edit
						</a>
						<a href="#" onclick="removeArticle({$feed.id})" style="float: right">
							<img src="{$ICON.16}/newspaper_delete.png" align="absmiddle"/>	Delete
						</a>
							<hr/>
						</center>
						{$feed.content|strip_tags|truncate:250}
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

	function addFeed(el,id){
		
		x4.Window({
			title	: 'RSS Feed',
			iconCls	: 'x-icon-16x16-feed',
			width	: 350,
			height	: 200,
			layout	: 'fit',
			items	: [new Ext.form.FormPanel({
				defaultType : 'textfield',
				id		: 'new-feed-form',
				layout	: 'form',
				frame	: true,
				labelWidth	: 75,
				items	: [{
					xtype		: 'hidden',
					name		: 'feed[id]'
				},{
					fieldLabel	: 'Title',
					anchor		: '100%',
					name		: 'feed[title]'
				},{
					fieldLabel	: 'RSS URL ~ http://...',
					anchor		: '100%',
					name		: 'feed[link]'
				},{
					fieldLabel	: 'Website Link',
					anchor		: '100%',
					name		: 'feed[url]'
				}],
				buttonAlign		: 'center',
				buttons	: [{
					text	: 'Save',
					iconCls	: 'x-icon-16x16-newspaper_go',
					handler	: function(){
						Ext.Msg.wait('Saving','Please wait...');
						Ext.getCmp('new-feed-form').getForm().submit({
							url		: '/{$toBackDoor}/{$Xtra}/add/?returnJson',
							success	: function(){
								Ext.Msg.alert('Feed Saved!','Success');
								x4.loadZyx('rss');
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