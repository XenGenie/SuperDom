<style>
	#page_data{
		background-repeat: repeat-x;
	}

	.x-tab-strip-inner {
		padding: 5px;
	}

	#files .thumb-wrap{
		border	: 1px solid #ddd;
		width	: auto;
		float	: left;
		text-align: center;
		 
	}
	
	#files .thumb-img{
		border	: 1px inset #000;
		background-color: #fafafa;
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
	 	margin: 5px;
	}
	
	#files .thumb-wrap div{
		padding : 5px;
		margin	: 2px;
		
		font-size: x-small;
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px; 
	}

	#files .x-view-selected .thumb{
		background:#8db2e3;
	}

	.thumb-wrap{
		border	: 1px solid #000;
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px;
		float	: left;
		width	: 30% 
	}
	
	.thumb-wrap div{
		padding : 5px;
		margin	: 2px;
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px; 
	}
	
	.thumb-div-id{
		display: none;
	}
	
	.thumb-div-program_title{
		font-weight: bold; 
		height: 16px;
		display: block;
		font-size:  small;
		overflow: hidden;
		padding-left: 20px;
		
	}
	
	.thumb-div-url a{
		font-weight: bold;
		background-image: url({$ICON.16}/world.png);
		background-repeat: no-repeat;
		height: 16px;
		display: block;
		font-size: x-small;
		overflow: hidden;
		padding-left: 20px;
		 
	}
	
	.thumb-div-content{
		font-size: xx-small;
		overflow: auto;
		height: 50px;
		padding: 5px;
		margin: 2px;
		width: 95%; 
		
		border	: 1px solid #ddd;
		
		background-color: #eee;
	}
	
	.thumb-div-headline:hover{
		background-color: white; 
	}
	
	.thumb-div-headline{
		overflow: auto;
		margin: 2px;
		height: 20px;
		text-align: center;

		border-bottom	: 1px solid #ddd;
		padding: 5px;
		margin: 2px;
		width: 95%;
		font-size: x-small;
	}

	.select:hover{
		border: 1px outset #00d8ff;
		border-color: #00c4ff;
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px;
		background-color: #f7f7f7;
	}
	
	.select{ 
		background-image: url(/bin/images/bgs/strip/skybluegradround-cthru.png);
		margin: 0.5%;  
		width: 32%; 
		float: left;
		border: 1px inset #00d8ff; 
		font-size: x-small;
	}
	
	.file-select{
		background-color: #EFEFEF;
		margin: 0.5%;  
		 
		float: left;
		border: 1px solid #ccc; 
		font-size: x-small;
	}
 
</style>
<table align="center" id='admin-zone-panel' width="100%">
	<tr>
		<th>
			<img src="{$ICON.48}/{$xphp_files['xContent.php'].icon}" align="absmiddle"/> List of Content
			<button style="float: right;" onclick="openContent(this);">
			<img src="{$ICON.16}/page_add.png" align="absmiddle"/>
			New Page Content</button>
		</th>
	</tr>
	<tr>
		<td><!-- 
			{foreach from=$content item=page}
			<div class="select click optin-pages" onclick="openContent(this,'{$page.id}','{$page.url}')" >					
				<img title="{$page.headline}" align="left" onclick="openContent(this,'{$page.id}','{$page.url}')" src="libs/phpThumb/phpThumb.php?src=/bin/images/icons/256x256/Web-page.png&h=64&f=png&q=100" class="click" />
				<div style="float: right;">
				 a href="#" onclick="openContent(this,'{$page.id}','{$page.url}')">
					<img src="{$ICON.16}/script_edit.png" title="Edit"/>
				</a  
				
				<a href="/{$page.url}" target="_BLANK">
					<img src="{$ICON.16}/eye.png" title="Live View"/>
				</a> 
				<a href="#" onclick="removeArticle({$page.id},'{$page.url}')">
					<img src="{$ICON.16}/remove.png" title="Delete"/>
				</a>
				</div> 
				<h2>{$page.url}</h2>
				<hr/>
				<span style="font-size: x-small">{$page.title}</span>
			</div>
			{/foreach}
		--></td>
	</tr>
</table>

<script type="text/javascript">
{include 
	file="~extjs/template.js" 
	var="template"
	tmp="node"
	nodes=$nodes}

/**
 * Dataview
 */
{include 
	file="~extjs/dataview.js" 
	var="page_data" 
	template="template"
	root="data"
	url="jsonPages" 
	fields=$fields}

page_data.getStore().load();
	Ext.onReady(function(){

		var tbar = [{
			text: 'Add New',
			iconAlign: 'top',
			iconCls: 'x-icon-16x16-page_add',
			scope: this,
			handler: function(){
				openContent();
			}
		}];
		
		/**
		 * Template for Dataview
		 */
		
		
		var content_panel = new Ext.Panel({ 
			id		: 'data-view-panel',
			frame	: true,
			height	: $(window).height()-200,
			//iconCls	: 'x-icon-16x16-page_world',
			//title	: 'Content Pages',
			closable: false,
			plain	: true,
			frame	: false,
			border	: false, 
			//tbar	: tbar,
			x		: 0,
			y		: 0,
			layout	: 'fit',
			bodyStyle	: 'background-color: transparent',
			items	: page_data
		});
		content_panel.render('zyx-content');
		//show(null,function(win){
		//	win.setHeight($(document.body).height()-$('#neck-breadcrumbs').outerHeight()-$('#moonmenu').outerHeight());
		//	page_data.getStore().load();
		//});
		
	});

	function removeArticle(id){
		var q = confirm('Are You sure you want to delete this?');
		if(q){
			window.location = "/{$toBackDoor}/{$Xtra}/delete/"+id;
		}
	}

	function openContent(el,id,url,hidden){

		var tiny = Ext.apply(x4.tinymceSettings,{
			theme_advanced_buttons2 : x4.tinymceSettings.theme_advanced_buttons2 + ',|,formatselect,fontselect,fontsizeselect,forecolor,backcolor'
		});
		
		var win = x4.Window({
			title	: 'Content Editor | '+url,
			iconCls	: 'x-icon-16x16-page_edit',
			id		: 'content-editor-'+id,
			maximized: true,
			autoScroll: false,
			layout	: 'fit',
			items	: [new Ext.form.FormPanel({ 
				id		: 'new-content-form'+id,
				layout	: 'border',
				frame	: true,
				items	: [{
					region	: 'north',
					layout	: 'form',
					labelAlign: 'left',
					xtype	: 'panel',
					labelWidth: 125,
					defaultType	: 'textfield',
					autoHeight	: true,
					padding	: 5,
					height	: 100,
					id			: 'page-url'+id,
					//title		: 'http://{$HTTP_HOST}/'+'{if $page.url}{$page.url}{else}index{/if}',
					//iconCls		: 'x-icon-16x16-world_link',
					layout		: 'form',
					items		: [{
						xtype	: 'hidden',
						name	: 'page[id]',
						//value	: '{$page.id}'
					},{
						fieldLabel	: 'Content Title',
						name		: 'page[title]',
						//value		: '{$page.title}',
						anchor		: '100%',
					},{
						name		: 'page[url]',
						xtype		: 'textfield',
						emptyText	: '',
						id			: 'content-page-url-'+id,
						allowBlank	: 'false',
						blankText	: 'Please Enter a Valid URL for this Content',
						anchor		: '100%',
						fieldLabel	: 'Content URL Alias',
						enableKeyEvents: true,
						listeners	: {
							keyup : function(tf,e){
								if(e.getKey() != 13){
									var tmp = 'http://{$HTTP_HOST}/<b><u>';
									var clean = tf.getValue().replace(/ /gi,'+');
									Ext.getCmp('content-jar-'+id).setTitle(tmp+clean+'</u></b>');
									tf.setValue(clean); 										
								}else{
									//xMagnet.createMagnet(newForm);
								}
							}
						}
					}]
				},{
					title		: 'http://{$HTTP_HOST}/'+'{if $page.url}{$page.url}{else}index{/if}',
					iconCls		: 'x-icon-16x16-world_link',
					region		: 'center',
					layout		: 'fit',
					xtype		: 'panel', 
					id			: 'content-jar-'+id,
					items		: [{
						width		: '100%',
						xtype		: 'tinymce',
						anchor		: "100% -50",
						tinymceSettings:  {
						 	theme: "advanced",
							script_url : '/bin/js/jq/tiny_mce/tiny_mce.js',
							
					        plugins: "pagebreak,style,layer,table,advhr,advimage,fullscreen,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

					        theme_advanced_buttons1: "fullscreen,|,preview,print,|,cleanup,|,copy,cut,paste,pasteword,|,nonbreaking,|,undo,redo,|,search,replace,iespell",
					        
					        theme_advanced_buttons3: "code,|,link,unlink,|,anchor,|,bullist,numlist,outdent,indent,|,emotions,|,insertdate,inserttime,|,hr,advhr,pagebreak,|,charmap,media,image",
					        
							//visualchars,nonbreaking,
					        theme_advanced_buttons4: "template,|,visualaid,visualchars,|,attribs,|,insertlayer,absolute,moveforward,movebackward,|,tablecontrols",
					        
					        theme_advanced_buttons2: "styleprops,|,ltr,rtl,|,blockquote,|,justifyleft,justifycenter,justifyright,justifyfull,|,removeformat,|,sub,sup,|,bold,italic,underline,strikethrough,|,formatselect,fontselect,fontsizeselect,forecolor,backcolor",
					        

					        theme_advanced_toolbar_location: "bottom",

					        theme_advanced_toolbar_align: "left",

					        theme_advanced_statusbar_location: "top",
					        valid_elements : '*[*]',
					        remove_script_host : false,
					        extended_valid_elements: "*[*]",
					        relative_urls : false,
					        convert_urls : false,

					        //template_external_list_url: "example_template_list.js", 
					        accessibility_focus: false 


					    } ,
						id			: 'page-content-'+id, 
						name		: 'page[content]'
					}]

									
				}],
				buttonAlign		: 'center',
				buttons	: [{
					text	: 'Cancel',
					iconCls	: 'x-icon-16x16-page_error',
					iconAlign	: 'top',
					scope	: this,
					handler	: function(){
						win.close();
					}
				},{
					text	: 'Save',
					iconAlign	: 'top',
					iconCls	: 'x-icon-16x16-page_save',
					handler	: function(){
						Ext.Msg.wait('Saving','Please wait...');
						Ext.getCmp('new-content-form'+id).getForm().submit({
							url		: '/{$toBackDoor}/{$Xtra}/add/?returnJson',
							success	: function(f,a){
								Ext.Msg.alert('Success','Content has been Saved!');

					   			
					   			win.close();
							}
						});
					}
				}]
			})]
		}).show(el,function(){
			if(id){
				Ext.Msg.wait('Loading','Please wait...');
				Ext.getCmp('new-content-form'+id).getForm().load({
					url		: '/{$toBackDoor}/{$Xtra}/edit/'+id+'/?returnJson',
					failure: function(form, action) {
				        Ext.Msg.alert("Load failed", action.result.errorMessage);
				    },
					success	: function(){
						Ext.Msg.hide();  
			   			var tmp = 'http://{$HTTP_HOST}/<b><u>';
						var clean = Ext.getCmp('content-page-url-'+id).getValue().replace(/ /gi,'+');
						Ext.getCmp('content-jar-'+id).setTitle(tmp+clean+'</u></b>');
						  
					}
				});
			}
		});
	} 
</script>