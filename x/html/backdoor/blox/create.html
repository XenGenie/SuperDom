{if $save} 
	<script>
		var ext = parent.Ext;
		var blox = ext.getCmp('blox-layout');
		blox.getUpdater().refresh();

		var id = '{$id}';


		ext.getCmp('edit-blox-'+id).close();
		
		 var sb = ext.getCmp('blox-statusbar');
	     sb.setStatus({
	         text: '"{$form.name}" Successfully Updated', 
	         clear: true // auto-clear after a set interval
	     }); 

	     jQuery  = parent.jQuery;
	 	</script>
{else}
<script>
	jQuery  = parent.jQuery;

	$ = parent.$;
	
</script> 
	 <script type="text/javascript" src="/bin/js/jq/jquery.validate.js"></script>
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/base/jquery-ui.css" type="text/css" media="all" /> 
	<link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" /> 
			
<style>
	
	body{
		font-family	: verdana;
		font-size: 12px;
	}

	.form li{
		margin: 15px; 
		font-weight	: bold;
	}
</style>

<form method="POST" action="/{$toBackDoor}/{$Xtra}/create/{$id}/?html&save=1" onSubmit="return checkForm(this);" id="new-blox-form">
	
	<table align='center' width="80%">
		<tr>
			<td align="right">
				<label>
					Label <input type="text" name="form[name]" value="{$form.name}" class="required" />
				</label>
				<br/> 
				<label> 
					Describe <input type="textarea" value="{$form.describe}" name="form[describe]"/>
				</label>
			<hr/>
			<label>
				Choose System Blox File  
				<select name="form[blox_file]">
					<option></option>
					{html_options options=$blox_files selected=$form.blox_file}
				</select>
			</label>
			<br/>
			
			... Or Embed Custom Code
			<textarea name="form[blox_code]" rows="8" style="width: 90%">{$form.blox_code}</textarea>
			<button onclick="return blox.delBlox();">
				 Delete  <br/> <img src="{$ICON.32}/minus.png" align="absmiddle"/>
			</button>
			<button type="submit">
				 Save <br/> <img src="{$ICON.32}/record.png" align="absmiddle"/>
			</button>
			</td>
		</tr>
	</table>
	
	 
</form>
 
<script>
	
	
	var Ext = parent.Ext;


	Ext.onReady(function(){

		new Ext.TabPanel({
            applyTo: 'hello-tabs',
            autoTabs:true,
            activeTab:0,
            deferredRender:false,
            border:false
        });
		
	});
	
	var blox = {
		delBlox : function(){
			Ext.Msg.confirm('Delete Blox','Are you sure?');
			return false;
		}
	};
	parent.$("#new-blox-form").validate();
	function checkForm(e){
		return parent.$("#new-blox-form").validate();
	}
</script> 
{/if}