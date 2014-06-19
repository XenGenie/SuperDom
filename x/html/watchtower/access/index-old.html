<style>
	#x-desktop{
		overflow-y: auto;
	}
	body	{
		color	: white;
	
	}
</style>
<form action="{$ME}" method="POST">
	<table id="admin-zone-panel" class="box" align="center" width="100%">
		<tr>
			<th>
				<h1>
					<a href="{$ME}">
						<u>{$membership.profileDesc}</u>
					</a>
				</h1>
				Access Permissions<br/>
				<button onclick="window.location = '/{$toBackDoor}/{$Xtra}/permit'" class="x-icon-48x48-check" style="padding-left: 50px; font-weight: bold; height: 50px; background-repeat: no-repeat; color: #fafafa; text-shadow: #fff 0px 0px 3px; float: right; border: 2px solid #0085ab">
					<b>Done</b>
				</button>
			</th>
		</tr>
		<tr>
			<td align="center">
				<div align="center" >
					<table width="100%">
						<tr>
							<td valign="top" width="150px" style="font-size: small;">
								<fieldset>
									<legend>About Managing Access</legend>
									Turn On the xtensions you would like to give access to.
									<br/>
									
									
								</fieldset>
								<fieldset>
									<legend>
										<h1>Access Groups</h1>
									</legend>
									<ul>
										<li>
											<a href="/{$toBackDoor}/access"> Anonymous Users </a>
										</li>
										{if $memberships}
											{foreach from=$memberships item=ms}
												<li> <a href="/{$toBackDoor}/membership/permit/{$ms.id}">{$ms.profileDesc}</a></li>
											{/foreach}
										{/if}
									</ul>
								</fieldset>
								
							</td> 
							<td >
								<table align="center">
									<tr>
										<th width="50px" class="box" align="center">
											<center>
											Xtension<br/>
											<img src="{$ICON.48}/node(1).gif" align="absmiddle"/></center>
										</th>
										<th  class="box">
											<center>
												<a href="#Turn On All" onclick="var j = $('input:checkbox:not([safari])'); j.attr('checked', false);    j.each( function(){ this.onclick() }); j.attr('checked', true);	cleanHistory();">On</a>
												/
												<a href="#Turn All Off" <a href="#Turn On All" onclick="var j = $('input:checkbox:not([safari])'); j.attr('checked', true);    j.each( function(){ this.onclick() }); j.attr('checked', false);  cleanHistory()">Off</a>
												<br/><img src="{$ICON.48}/check.png"  align="absmiddle"/>
											</center>
										</th> 
										<th  class="box">
											<center>
											 
											<a href="#Open/Close All Front Doors"  onclick="var j = $('input:checkbox[front]'); j.each( function(){ this.onclick() }); j.attr('checked', FDOOR ); FDOOR = (FDOOR) ? false : true; cleanHistory()  ">Front Doors</a>
											<br/>
											<img src="{$ICON.48}/browser.png"  align="absmiddle"/>
											<center>		
										</th>
										{if $membership.id}
										<th  class="box">
											<center>
											
											<a href="#Open/Close All Front Doors"  onclick="var j = $('input:checkbox[back]'); j.each( function(){ this.onclick() }); j.attr('checked', BDOOR ); BDOOR = (BDOOR) ? false : true; cleanHistory()">Back Doors</a>
											<br/>
											<img src="{$ICON.48}/burning.png"  align="absmiddle"/>
											</center>
										</th>
										{/if}
									</tr>
								{foreach from=$xphp_local item=file}
									<tr>
										<td align="center">
										{if $file.icon}
										<img src="{$ICON.48}/{$file.icon}" title="{$file.name}"/>
										{/if}
											
											<h1>{$file.name}</h1> 
										</td>
										<td align="center" >
											<label title="{$file.desc}" class="click">
												<input class="xtend-on-off" onClick="xtendClick(this); $('.{$file.file|replace:'.':'_'}').attr('disabled', $(this).attr('checked') ? true : false);"  type="checkbox" {if $file.open == 1}checked{/if} name="{$file.name}" id="{$file.file}" value="on"/>
											</label>
										</td>
										
										<td align="right"  >
											{foreach from=$file.front_doors item=f}
												<label title="" class="click">
													{$f['room']}
													<input front=1 onclick="xtendCheck(this,'{$file.file|replace:'.php':''}','front','{$f['room']}');"  class="{$file.file|replace:'.':'_'}" type="checkbox" safari=1 name="{$f['room']}" {if $file.open!= 1}disabled{/if}  {if $f['open'] == 1}checked{/if}/>
												</label><br/>
											{/foreach}
										</td>
										{if $membership.id}
										<td align="right"  > 
											{foreach from=$file.back_doors item=f}
												<label title="" class="click">
													{$f['room']}
													<input back=1 onclick="xtendCheck(this,'{$file.file|replace:'.php':''}','back','{$f['room']}');" class="{$file.file|replace:'.':'_'}" type="checkbox" safari=1 name="{$f['room']}" {if $file.open != 1}disabled{/if} {if $f['open'] == 1}checked{/if}/>
												</label>
												<br/>
											{/foreach}
										</td>
										{/if}
									</tr>
								{/foreach}
								</table>		
							</td>
							<td width="150px" style="font-size: xx-small" align="left">
								<div id="ajax-update-box" style="width: 150px; position:  fixed; top: 20%; text-align: right" >
								Current Actions<hr/>
								</div> 
							</td>
						</tr>
					</table>
					
				</div>
					
					
			</td>
		</tr>
	</table>
</form>	
<script type="text/javascript"><!--<!--
	var FDOOR = true;
	var BDOOR = false;
	function cleanHistory(){
			setTimeout(function(){ $('#ajax-update-box').fadeOut(); $('#ajax-update-box').html('Currect Actions<hr/>');},5000);  
	}
	function xtendClick(e){
		$.post("/{$toBackDoor}/{$Xtra}/setPermit/{$membership_id}",{
			xtension	: e.id.replace('.php',''), 
			open		: $(e).attr('checked') ? 0 : 1
		},function(data){
			 data = $.parseJSON(data);
			 var on = (data.open == 1) ? 'On' : 'Off';
			 $('#ajax-update-box').fadeIn();
			 var img = '';//"<img src='{$ICON.16}/delete.png' align='right' />";
			 var html = $('#ajax-update-box').html()+'<div style="margin-top: 5px;" width="100%"  id="'+data.time+'" onclick="$(this).fadeOut()">'+img+data.xtension+' '+on+'</div>';
			 $('#ajax-update-box').html(html);
			 setTimeout(function(){
				 $('#'+data.time).fadeOut()
			},1200);
		});
	}

	function xtendCheck(e,x,door,room){ 

		$.post("/{$toBackDoor}/{$Xtra}/setPerm/{$membership_id}",{
			xtension	: x,
			door		: door, 
			room 		: room, 
			open		: $(e).attr('checked') ? 0 : 1
		},function(data){
			data = $.parseJSON(data);
			 var on = (data.open == 1) ? 'On' : 'Off';
			 $('#ajax-update-box').fadeIn();
			 var img = '';//"<img src='{$ICON.16}/delete.png' align='right' />";
			 var html = $('#ajax-update-box').html()+'<div style="margin-top: 5px;" width="100%" id="'+data.time+'"onclick="$(this).fadeOut()">'+img+data.xtension+':'+data.door+':'+data.room+':'+' '+on+'</div>';
			 $('#ajax-update-box').html(html);
			 setTimeout(function(){
				 $('#'+data.time).fadeOut();
			},750);
		});
 
		
	} 

	Ext.onReady(function(){
		/*
		
		
		new Ext.Panel({
			title	: 'Manage your website xtensions',
			height	: $(document.body).height()-$('#shortcut-panel').outerHeight()-$('#neck-breadcrumbs').outerHeight()-40,
			renderTo: 'zyx-content',		
			layout	: 'border',
			items	: [{
				width	: '40%',
				region	: 'east',
				title	: 'Currently Installed',
				layout	: 'fit' 
			},{
				width	: '20%',
				region	: 'center',
				title	: 'Action',
				layout	: {
					type:'vbox',
		            padding:'5',
		            align:'stretch'
				},
		        defaults:{
			        margins:'0 0 5 0'
		        },
		        items:[{
		            xtype:'button',
		            text: 'Install',
		            iconAlign: 'top',
		            iconCls	: 'x-icon-48x48-onebit_08',
		            scale: 'large',
		            flex:1
		        },{
		            xtype:'button',
		            text: 'Remove',
		            iconCls	: 'x-icon-48x48-onebit_29',
		            iconAlign: 'top',
		            scale: 'large',
		            flex:1
		        }]
			},{
				width	: '40%',
				region	: 'west',
				title	: 'Installable',
				autoScroll: true,
				items	: new Ext.grid.GridPanel({			
					cm: new Ext.grid.ColumnModel([
                       'Icon','Name','Description'
                    ]),
					store: new Ext.data.JsonStore({
						data: [{$xphp_local_json}]
					}),
					viewConfig:{
						forceFit: true
					},
			    	stripeRows: true // stripe alternate rows
		    	})
			}]
		});
		
		*/
	}); 
--></script>
<link rel="stylesheet" href="/bin/js/jq/jquery-checkbox/jquery.checkbox.css" />
<link rel="stylesheet" href="/bin/js/jq/jquery-checkbox/jquery.safari-checkbox.css" />  
 
<script type="text/javascript">
$(document).ready(function() {
	$('.xtend-on-off').checkbox({
		empty: 'http://bin.xtiv.net/js/jq/jquery-checkbox/empty.png'
	});

	$('input[safari]:checkbox').checkbox({
		cls:'jquery-safari-checkbox'
	});
		
});
</script>