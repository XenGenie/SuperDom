<style>
<!--
	.thumb-div-id{
		display: none;
	}
	.thumb-div-url64{
		display: none;
	}
	
	.select:hover{
		border: 1px outset #ccc;
		border-color: #00c4ff;
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px;
		background-color: #f7f7f7;
	}
	.select{
		background-image: url(/bin/images/bgs/strip/lightblue&white-bottom2top.png);
		margin: 0.5%;
		cursor: move;   
		width: 23%;  
		float: left;
		border: 1px inset #ccc; 
		font-size: x-small;
	}

	.select button:hover{
		background-image: url(/bin/images/bgs/strip/blue_white.jpg);
	}
	
-->
</style>
<table width="60%" align="center" id="admin-zone-panel">
	<tr>
		<th>
		<button onclick="javascript: newLink();" style="float: right">
			<img src="{$ICON.16}/world_add.png"/>Add New
		</button>
		
		<img src='{$ICON.48}/onebit_19.png'align="absmiddle"/>
		Links
		</th>
	</tr>
	 
</table>

<script type="text/javascript">
	function saveLink(){
		Ext.Msg.wait('Saving Link','Please Wait...');
		Ext.getCmp('link-form').getForm().submit({
			success	: function(){
				Ext.Msg.alert('Success!','Link Saved!');
				Ext.getCmp('link-form').getForm().reset();
				// Reload Store, Close Window.
				Ext.getCmp('link-win').close();

				page_data.getStore().load();
			},
			failure	: function(f,a){
				Ext.Msg.alert('Link Did NOT Save!!',a.result.error);
			}
		});
	};
	function newLink(){
		var win = new Ext.Window({
			title	 : 'Add a New Link',
			iconCls	: 'x-icon-16x16-world_link',
			id		: 'link-win',
			width	: 500,
			height	: 125,
			modal	: true,
			items: new Ext.form.FormPanel({
				id		: 'link-form',
				frame	: true,
				labelWidth: 50,
				layout	: 'form',
				url		: '/{$toBackDoor}/{$Xtra}/add/?returnJson',
				method	: 'POST',
				defaultType	: 'textfield',
				defaults	: {
					anchor	: '95%',
					allowBlank: false
				},
				items	: [{
					name	: 'link[id]',
					xtype	: 'hidden'
				},{
					fieldLabel	: 'Title',
					name		: 'link[title]'
				},{
					fieldLabel	: 'URL',
					name		: 'link[url]',
					emptyText	: 'http://www.fulldomain.com',
					value: 'http://' 
				}],
				buttons	: [{
					text	: 'save',
					iconCls	: 'x-icon-16x16-world_add',
					bindForm: true,
					iconCls	: 'x-icon-16x16-disk',
					enableKeyEvents: true,
					listeners	: {
						keyup : function(tf,e){
							if(e.getKey() != 13){
								 										
							}else{
								saveLink();
							}
						}
					},
					handler	: saveLink,
				}]
			})
		});
		win.show();
	}
	var template = new Ext.XTemplate(
			'<tpl for=".">',
				'<div class="thumb-wrap select" id="{literal}node_{id}{/literal}">',
				'<div class="thumb">',
				
				'<center>',
				'<img src="{$phpThumb}w=200&src=http://www.umeos.com/os/api/shrink/{literal}{url64}{/literal}/.png" align="absmiddle" class="thumb-img"/>',
				'<h1>{literal}{url}{/literal}</h1></center>',
	
				
				'<button onclick="openContent(this,{literal}{id}{/literal},\'{literal}{url}{/literal}\')" style="padding: 5px; float: right;">',
				'<img src="{$ICON.16}/page_edit.png" title="Edit" align="absmiddle"/> Edit',
				'</button>',
				'<button class="del-button" onclick="xMagnet.deleteMagnet({literal}{id}{/literal},\'{literal}{url}{/literal}\')" style="padding: 5px; float: right;display: none">',
				'<img src="{$ICON.16}/remove.png" title="Delete" align="absmiddle"/> Delete',
				'</button>',
				'<button onclick="window.open(\'{literal}{url}{/literal}\')" style="padding: 5px;">',
				'<img src="{$ICON.16}/world.png" title="Visit" align="absmiddle"/> Visit',
				'</button>',
				'</div>',
				 
				{foreach from=$nodes item=node}
				{if $node == 'url'}
					
				{else if $node == 'id'}
	
				{else}
					'<div class="thumb-div-{$node}">{literal}{{/literal}{$node}{literal}}{/literal}</div>',
				{/if}
				{/foreach}
				'</div>',
				'</div>'
			,'</tpl>'
		);

	/**
	 * Dataview
	 */
	{include 
		file="~extjs/dataview.js" 
		var="page_data" 
		template="template"
		root="links"
		url="index/?returnJson" 
		fields=$fields}
	
	Ext.onReady(function(){
		var optin_panel = new Ext.Panel({ 
			id		: 'data-view-panel',
			//iconCls	: 'x-icon-16x16-page_world',
			//title	: 'Magnets',
			height	: $(document.body).height()-$('#admin-toolbar').outerHeight()-100,
			//iconCls	: 'x-icon-16x16-page_world',
			//title	: 'Content Pages',
			//closable: false,
			plain	: true,
			frame	: false,
			border	: false, 
			//tbar	: tbar,
			x		: 0,
			y		: 0,
			layout	: 'fit',
			bodyStyle	: 'background-color: transparent',
			items	: page_data
		}).render('zyx-content');

		page_data.getStore().load();
	});
	
</script>