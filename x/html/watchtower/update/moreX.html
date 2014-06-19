<style>	
	.buyme {
		background-repeat: repeat-x; 
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px;
		color		: #004;
		font-size	: 9px;
		font-weight	: none;
		width		: 250px; 
		height		: 75px; 
		float 		: left; 
		margin		: 40px 0 0 1%;
		padding		: 10px;
		cursor		: help;
	}
</style> 
<div id="moreX-apps" style="text-align: center;">
	<ul style="text-align" id="moreX-tabs">
	CATEGORY: 
		{foreach from=$admin_menu item=mod key=key}
			{if $key}
				<li class="halfmoon click" style="display: inline-block; float: none; -moz-border-radius: 100px 100px 0px 0px; -webkit-border-radius:  100px 100px 0px 0px; padding: 0px 10px 0px 0px;"> 
					<a href="#moreX-area-{$key}" rel="{$key}" class="halfmoon-a" onmouseover="$('#{$key}').fadeIn();"> 
						<img align="right" src="{$phpThumb}h=80&q=100&zc=1&src={$ICON.A}/{$key}.png"/>
						<br/>{$key|ucfirst}<br/>
					</a>			
				</li> 
			{/if}
		{/foreach}
	</ul>
	
	<div id="moreX-apps">
		{foreach from=$admin_menu item=mod key=area}
			<div id="moreX-area-{$area}">
				{foreach from=$xtends item=x key=key}
					{if $area == $x.see && (!$xphp_files.$key.version || $installed)} 
					<div class="box buyme" style="" style="float: both; display: inline-block" onmouseover="x4.fadeInDesc(this);" id="{$x.name|md5}">
						{if $x.see ==  'system'} 
							{assign var=tag value='violet'}
							{assign var=color value='2c0022'}
						{else if $x.see == 'design'} 
							{assign var=tag value='blue'}
							{assign var=color value='01022e'} 
						{else if $x.see == 'medium'} 
							{assign var=tag value='green1'}
							{assign var=color value='002200'}
						{else if $x.see == 'assembly'}  
							{assign var=tag value='orange'}
							{assign var=color value='220000'}
						{/if}
						
						{if $xphp_files.$key.version == $x.version}
							{assign var=price value=' IN'}
							{assign var=size value=25}	
						{else  if !$xphp_files.$key.version}
							{if $x.price}
								{assign var=price value=$x.price}
								{assign var=size value=23}	
							{else}
								{assign var=price value='FREE'}
								{assign var=size value=18}	
							{/if}
						{/if}
					
						{if $x.icon != ''}
							<img src="{$ICON.48}/{$x.icon}" align="left"  style="margin: -35px 0px 0px 0px; z-index: 1; "/>
						{/if}
						<center>
							<h1>
							{$x.name}
							</h1>
						</center>
						<div class="buyme-desc" id="desc-{$x.name|md5}" style="display: none; clear: both; width: 100%;">
						
							<img align="right" style="position: absolute; margin: -50px 0 0 0px" src="{$phpThumb}&src={$ICON.48}/splash_{$tag}.png&fltr[]=wmt|{$price}|{$size}|T|{$color}|FREESCPT.TTF|100|0|10"/>
							{$x.website}
							{$x.desc}
							<center> 
							
							{assign var="isInstalled" value=($xphp_files.$key.version == $x.version)}
							
							{if $isInstalled}
								{assign var="install" value='Reinstall'}	
							{else}
								{assign var="install" value='Install'}
							{/if}
							
							{if !$x.price || $isInstalled}
							<!-- FREE Click To Install - Donate Also Available... || OR show these buttons if its already installed.  -->
								<input 
									type="button" 
									value="{$install}" 
									onclick="javascript: x4.installMe('{$area|base64_encode}','{$x.file|base64_encode}','{$x.name}')"/>
								<input class="paypalbutton"  type="button" value="Donate"/>
							{else if $x.price == "$?"}
							<!-- Donate To Install  -->
								<input class="paypalbutton"  type="button" value="Donate to {$install}"/>
							{else}
							<!-- Buy To Install  -->
								{$x.button}
							{/if}
								<br/>
								<a href="#"><img src="{$ICON.16}/information.png" align="absmiddle"/></a>
								<a href="#"><img src="{$ICON.16}/world.png" align="absmiddle"/></a>
							</center>
							
						</div>
					</div>
					{/if}
				{/foreach}
			</div>
		{/foreach}
	</div>
</div>	
	<!--
<table id="admin-zone-panel">
	<tr>
		<th>
			<div style="float: right">
				Category<select>
				{html_options options=$cats}
				</select> |
				Search <input type="text"/>
			</div>
			<img src="{$ICON.48}/onebit_09.png" align="absmiddle" />
			Enhance Your DOMain with Super-Xtensions!<br/>			
		</th>
	</tr>
	<tr>
		<td align="center"> 
			<table align="center">
				<tr>
					<td align="center" id="moreX-tabs">
					
					</td>
				</tr>		
			</table>	
		</td>
	</tr>
</table>
--><script>
	x4.fadeInDesc = function(el){
		$('.buyme-desc').each(function(i,node){
			if(node.id.replace('desc-','') != el.id){
				$(node).fadeOut('slow');
				$(node).parent().css('background-color','transparent');
			}else{
				$(node).fadeIn();
				$(node).parent().css('background-color','#30c9fd');
			}
		});
	}

	x4.installMe = function (base64,base64file,name){
		var link = this;
		//var gif = 'Installing <br/> <img src="/bin/images/loading/barbershop.gif"/><br/> Please Wait...';
		//var hov = $('#hover-box').html(gif);

		Ext.Msg.wait('Installing','Please Wait');
		
		$('#dim-the-lights').fadeIn('slow');
		
		$.post('/{$toBackDoor}/update/updateXPhp/'+base64file+'?json',{},function(){
			//$('#hover-box').html('Installation<hr/>Completed Successfully!');
			
			//$(link).parent().fadeIn('slow');
			$.post('/{$toBackDoor}/update/syncDb/?json',{},function(){
				//$('#dim-the-lights').click();
				Ext.Msg.alert('Done!');
			});
		});
		
	}

	function loadMenu(iframe,name,md5){
		var menu = top.tmp_frame.$('#moonmenu-jar').html();
		$('#moonmenu-jar').html(menu);
		$('#dim-the-lights').click();
		var html = $('#'+md5).html().replace('<h1>'+name+'<h1/>','<h1>'+name+' Installed</h1>');
		$('#'+md5).html(html);
		setTimeout(function(){
			$('#'+md5).fadeOut('slow');
		},800);
	}


	function moreInfo(){
		$('#dim-the-lights').fadeIn('slow');
		$('#hover-box').load('');
	}
	$('#moreX-apps').tabs();
	
</script>