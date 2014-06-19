<style>
	li green{
		background-color: #70D846;
		border: 1px solid #50c734;
	}
	 
	li yellow{
		background-color: #yellow;
		border: 1px solid #bbb555;
	}
</style>
{if $SUPERDOMX.version != $LATEST_VERSION}
	<script type="text/javascript">
	<!--
		window.location = '/{$toBackDoor}/{$Xtra}/updateXCore';
	//-->
	</script>
{/if}

{if $expired}
	<script> 
		window.location = "{$ME}";
	</script> 
{else}

	{if $remote_xphp_files['xUpdate.php']}
		{if $remote_xphp_files['xUpdate.php'].version != $xphp_files['xUpdate.php'].version}
			<script>
				window.location = "/{$toBackDoor}/{$Xtra}/updateXPhp/{$xphp_files['xUpdate.php'].file|base64_encode}";
			</script>
		{/if}
		{if $remote_xphp_files['xLayout.php'].version != $xphp_files['xLayout.php'].version}
			<script>
				window.location = "/{$toBackDoor}/{$Xtra}/updateXPhp/{$xphp_files['xLayout.php'].file|base64_encode}";
			</script>
		{/if}
	{/if}

	<script>
	var updates = new Array();
		i = 0;
		{foreach from=$remote_a_portal item=c key=file}
			{if $c != $a_portal.$file}
				updates[i] = {
					url 	:  "/{$toBackDoor}/{$Xtra}/updatePortal/{$file|base64_encode}/?json",
					img	:  "{$ICON.16}/brick.png",
					id	: "{$file|md5}",
					msg	: "{$file}"
				};
				i++;
			{/if}
		{/foreach}
	
		{if $sqlUpdates}
			{foreach from=$sqlUpdates item=update key=key}
				//updates[i] = {
				//	url	: "/{$toBackDoor}/{$Xtra}/upSql/{$key}",
				//	img 	: "{$ICON.16}/brick.png", 
				//	msg	: "{$update}"
				//};
				//i++;
			{/foreach}
		{/if}
	
		{foreach from=$blox item=c key=file}
			{if $c != $remote_blox.$file}
				updates[i] = {
					url	: "/{$toBackDoor}/{$Xtra}/updateBlox/{$file|base64_encode}/?json",
					id	: "{$file|md5}",
					img	: "{$ICON.16}/brick.png", 
					msg	: "{$file}"
				};
				i++;
			{/if}
		{/foreach}
	
		{foreach from=$costumez item=c key=key}
			{if $c.version != $remote_costumez.$key.version && $remote_costumez.$key.version}
				updates[i] = {
					url	: "/{$toBackDoor}/{$Xtra}/updateCostume/{$c.table_name}/?json",
					img	: "{$ICON.48}/onebit_08.png",
					id	: "{$c.title|md5}",
					msg	: "{$c.title} | {$remote_costumez.$key.version}"
				};
				i++;
			{/if}
		{/foreach}
	
		{foreach from=$xphp_files item=x key=key}
			{if $remote_xphp_files.$key.version != $x.version}
				updates[i] = {
					url : "/{$toBackDoor}/{$Xtra}/updateXPhp/{$x.file|base64_encode}/?json",
					img : "{$ICON.48}/{$x.icon}",
					id	: "{$x.file|md5}", 
					msg : "{$x.name} | {$remote_xphp_files.$key.version}"
				};
				i++;
			{/if}
		{/foreach}
	
		x = 0;
		var count = updates.length;
		function nextUpdate(){
			var win = Ext.getCmp('update-win');
			if(!win){
				var	pbar = new Ext.ProgressBar({
					id	: 'pro-bar', 
					text:'Initializing...'
			    });
			    
				win = new Ext.Window({
					title	: updates[x].msg+img,
					modal	: true,
					id		: 'update-win',
					closable: false,
					width	: 250,
					items	: [pbar]
				});	
			}
			
			if(x >= count && count){
				win.setTitle( 'Updates Complete! '+ "<img align='right' src='{$ICON.16}/check.png'/>");
				Ext.getCmp('pro-bar').updateProgress(1,'Reloading SuperDOMain...');

				location = '/@';
			}		
	
	
			if(updates[x]){
				var	img = "<img align='right' src='"+ updates[x].img +"'/>";
			}
			
			
			if(count > 0 ){
				win.show(updates[x].id);			
				win.setTitle( 'Update ' + (x+1) + ' of '+count+'...'+ img);
				Ext.getCmp('pro-bar').updateProgress( ((x+1)/count),updates[x].msg);
				document.getElementById('hidden-update').src = updates[x].url;
				$('#'+updates[x].id).hide();
			}else{
				Ext.Msg.alert('Updating Complete','You are running the latest software.');
			}
			
			x++;
		}
	
		Ext.onReady(function(){
			$('#iframe-jar').html('<iframe id="hidden-update" src="about:blank" onLoad="nextUpdate();"></iframe>');
			//nextUpdate();
		});
		
	
	</script>
	
	<div  style="display: none" id="iframe-jar">
		
	</div>
	
	<table align="center" width="90%" id="admin-zone-panel">
		<tr>
			<th colspan=3 valign="middle" >
				<table width="100%">
					<tr>
					
						<td width="100px" align="center">
								<a href="/{$toBackDoor}/{$Xtra}/updateXCore">
									<img src="{$ICON.64}/core.png" align='left'/>
								</a>  				
						</td>
						<td align="center" width="50%" style="color: {if $SUPERDOMX.version == $LATEST_VERSION}#00d91a{else}yellow{/if}" >
							
							
							<i>Last Updated</i>		
							<br/>
							<i>{$LAST_UPDATE}</i>			
						</td>
						<td align="center" width="50%" style="color: {if $SUPERDOMX.version == $LATEST_VERSION}#00d91a{else}yellow{/if}">
							Web Engine Core <img title="Running Version" src="{$ICON.16}/sprocket_dark.png" align="absmiddle" /> {$SUPERDOMX.version}
							
							<br/>
							SDX Server Core <img title="Server Version" src="{$ICON.16}/server.png" align="absmiddle" /> {$LATEST_VERSION}				
									
							
						</td>
						
					</tr>
					<tr>
						<td colspan=3 align="center">
							<ul>
								{foreach from=$remote_a_portal item=c key=file}
									{if $c != $a_portal.$file}
										<li id="{$file|md5}"><a href="/{$toBackDoor}/{$Xtra}/updatePortal/{$file|base64_encode}">
										<img align="right" src="{$ICON.16}/brick.png"/>
										<b><u>{$file}</u></b>
										Update</a>
										</li>
										<script>
											//window.location = "/{$toBackDoor}/{$Xtra}/updatePortal/{$file|base64_encode}";
										</script>
									{/if}
								{/foreach}
							</ul>
						</td>
					</tr>
				</table>
			</th>
		</tr>
		<tr>
			<th >
				<center>
				<button onclick="x4.loadZyx('/{$toBackDoor}/{$Xtra}/moreB','More Blox')">
					<img src="{$ICON.48}/onebit_18.png"  align="absmiddle" /> More Blox
				</button>
				</center>
			</th>
			<th width="33%">
				<center>
				<button onclick="x4.loadZyx('/{$toBackDoor}/{$Xtra}/moreZZ','More Costumez')">
				<img src="{$ICON.48}/Bucket.png"  align="absmiddle" /> More Costumez
				
				</button>
				</center>
			</th>
			<th width="33%">
				<center>
					<button onclick="x4.loadZyx('/{$toBackDoor}/{$Xtra}/moreX','More Xtensions')"> 
					<img src="{$ICON.48}/onebit_09.png" align="absmiddle"/> More Xtensions
					 
					</button>
				</center>
			</th>
			
		</tr>
		<tr >
			<td valign="top"  width="33%"> 
				<ul>
					{foreach from=$blox item=c key=file}
						{if $c != $remote_blox.$file}
							<li id="{$file|md5}">
								<b><u>{$file}</u></b>
								<a href="/{$toBackDoor}/{$Xtra}/updateBlox/{$file|base64_encode}">
									<img align="right" src="{$ICON.16}/brick.png"/>
								</a>
							</li>
						{/if}
					{/foreach}
				</ul>
			</td>
			<td valign="top"  width="33%">
				<ul>
					{foreach from=$costumez item=c key=key}
						{if $c.version != $remote_costumez.$key.version && $remote_costumez.$key.version}
						<li id="{$c.title|md5}">
							<span style="float: right; font-size: x-small; font-weight: bold; color: {if $c.version == $remote_costumez.$key.version}#70D846{else}red{/if}">
								{$c.version} V.S. {$remote_costumez.$key.version}  | 
								<a href="/{$toBackDoor}/{$Xtra}/updateCostume/{$c.table_name}">Update</a>
							</span>
							<b><u>{$c.title}</u></b>
							<br/>
							<span style="font-size: small">{$c.describe}</span>
						</li>
						{/if}
					{/foreach}
				</ul> 
			</td>
			<td valign="top" width="33%"> 
				<ul>
					{foreach from=$xphp_files item=x key=key}
						{if $remote_xphp_files.$key.version != $x.version}
							<li class="" id="{$x.file|md5}">
								<b><u>{$x.name}</u></b> |
								<a href="/{$toBackDoor}/{$Xtra}/updateXPhp/{$x.file|base64_encode}" style="float: right">
									<img src="{$ICON.48}/{$x.icon}" align="right"/>
								</a>
								<br/><span style="font-size: small">{$x.desc}</span>
								<hr/>								
								<span style="font-size: x-small; font-weight: bold; color: {if $x.version == $remote_xphp_files.$key.version}#70D846{else}red{/if}">{$x.version} V.S. {$remote_xphp_files.$key.version}</span>
							</li>
						{/if}
					{/foreach}
				</ul> 
			</td>
		</tr>
		
	</table>
{/if}