{if !$uploaded}
 
<!--  iframe onload=" " name="log-frame" id="log-frame" style="display: none;" src="about:blank">

</iframe>

<table align="center" id="admin-zone-panel">
	<tr>
		<th>
			<form id="import-css-form" enctype="multipart/form-data" method="POST" target="log-frame" action="/{$toBackDoor}/{$Xtra}/importCss/?html">
			<button class="toolbar" style="float: right;">
				<img align="absmiddle" src="{$ICON.48}/applications.png">Import CSS File
			</button>
			Import CSS files into Costumez
			<input type="file" name="form[cssfile]" style="float: right" id="cssfile"/>
			<select name="form[www_costume]" style="float: right">
			{html_options options=$costume_options selected=$www_costume}
			</select>
			</form>
		</th>
	</tr>
	<tr>
		<td>
			
		</td>
	</tr>
</table -->
<script> 
	Ext.onReady(function(){
		var fp;
		var win = x4.Window({
			title	: 'Import CSS File',
			id		: 'import-css',
			modal	: true,
			iconCls	: 'x-icon-16x16-css_add',
			width	: 400,
			autoHeight: true,
			layout	: 'fit',
			items	: fp = new Ext.FormPanel({
				url: '/{$toBackDoor}/{$Xtra}/importCss',
		        fileUpload: true,
		        width: 400,
		        frame: true, 
		        autoHeight: true,
		        labelWidth: 150,
		        defaults: {
		            anchor: '95%',
		            allowBlank: false,
		            msgTarget: 'side'
		        },
		        items: [new Ext.form.ComboBox({  
			        fieldLabel	: 'Select Import Costume',
				    id	: 'import-choose-themes',  
				    store: new Ext.data.JsonStore({  
					    autoLoad: true,
				    	url: '/{$toBackDoor}/layout/getThemes/?json',
				    	root: 'data', 
				        fields : [{
					        name: 'id'
						},{
							name: 'name'
						}]  
				    }),  
				    hiddenValue	: '{$www_costume}',
				    valueField: 'id',  
				    displayField: 'name',
				    mode: 'remote',  
				    minChars : 0 , 
					hiddenName	: 'form[www_costume]', 
				}),{
		            xtype: 'fileuploadfield',
		            id: 'css-file',
		            emptyText: 'Upload a Stylesheet',
		            fieldLabel: 'Select a CSS File',
		            name: 'form[cssfile]',
		            buttonText: '',
		            buttonCfg: {
						iconCls	: 'x-icon-16x16-css_add',
		            }
		        }],
		        buttonAlign	: 'center',
		        buttons: [{
			        text	: 'Close',
			        iconCls	: 'x-icon-16x16-close',

		            iconAlign	: 'left',
			        handler	: function(){
		        		win.close();

			        },
		       },{
		            text: 'Reset',  
					iconCls	: 'x-icon-16x16-refresh',
		            iconAlign	: 'left',
		            handler: function(){
		                fp.getForm().reset();
		            }
		        },'->',{
		            text: 'Import',
		            iconAlign	: 'left',
					iconCls	: 'x-icon-16x16-css_go',
		            handler: function(){
			        	var file = Ext.getCmp('css-file').getValue();
			    		file = file.replace("C:\\fakepath\\","");
			    		if(file.lastIndexOf(".css")==-1) {
			    			alert("Please upload only .css extention files");
			    			return false;
			    		} 
			    		 fp.getForm().submit({ 
		                    waitMsg: 'Importing CSS File',
		                    success: function(f, o){ 
			                    
			                    var r = o.result;
		                        Ext.Msg.confirm(r.costume+' imported '+r.file.cssfile,'Would you like to Import another file?',function(btn){
			                        switch(btn){
			                        	case('no'):
				                        	win.close()
				                        break;
			                        	case('yes'):
			                        		 fp.getForm().reset();
				                        break;
			                        }

								});
		                    }
		                });
		            }
		        }]
		    })
		}).show(document.body,function(){
			Ext.Msg.hide()
		})
		
	});

/*
 * 
	$('#import-css-form').submit(function(){
		var yes = confirm('Are You Sure You Want to Import This File into the Costume?');
		if(!yes)
			return false;
		var file = $('#cssfile').attr('value');
		file = file.replace("C:\\fakepath\\","");
		if(file.lastIndexOf(".css")==-1) {
			alert("Please upload only .css extention files");
			return false;
		}
		
		$('#log-frame').css({
			color	: 'white',
			border	: 0,
			zIndex	: 900,
			position: 'absolute',
			width	: '70%',
			bottom	: '35%',
			left	: '15%',
			overflow	: 'hidden'
		});

		$('#dim-the-lights').fadeIn('slow');
		var gif = 'Importing ~ '+file+'<br/> <img src="/bin/images/loading/barbershop.gif"/><br/> Please Wait...';
		var hov = $('#hover-box').html(gif);
		
		$('#log-frame').fadeIn();
	});
 function logLoaded(frame){
	if( frame.src != 'about:blank'){ 
		alert('CSS File Imported');
		
	}
	$('#dim-the-lights').fadeOut();
	//$('#log-frame').fadeOut();	
} 
 */

</script>
{/if}