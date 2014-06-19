<style>	
	.buyme {
		background-image	: url(/bin/images/bgs/strip/nav-bg.png);
		background-repeat: repeat-x; 
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px;
		color		: #444;
		font-size	: 9px;
		font-weight	: none;
		width		: 240px; 
		height		: 100px; 
		float 		: left;
		margin		: 20px;
		padding		: 10px;
		cursor		: help;
	}
</style>
Addons | More X
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
			Dress Your DOMain into many CostumeZ!<br/>			
		</th>
	</tr>
	<tr>
		<td align="center"> 
			<table align="center">
				<tr>
					<td align="center">
					{foreach from=$xtends item=x key=key}
						{if !$xphp_files.$key.version || $installed} 
						<div class="box buyme" style="" align="left" onmouseover="fadeInDesc(this);" id="{$x.name|md5}">
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
						
						{if $x.icon}
							<img src="{$ICON.48}/{$x.icon}" align="right"  style="margin: -35px 0px 0px -15px; position: absolute; z-index: 1; "/>
						{/if}
							<img style="z-index: 1; margin: -5px 0px 0px -20px; position: absolute;" src="{$phpThumb}&src={$ICON.48}/splash_{$tag}.png&fltr[]=wmt|{$price}|{$size}|T|{$color}|FREESCPT.TTF|100|0|10"/>
						<h1 >{$x.name}</h1>
						
							<div class="buyme-desc" id="desc-{$x.name|md5}" style="display: none; clear: both; width: 100%;">
								<center>
								{if $x.price == "$?" || $xphp_files.$key.version == $x.version}
									<input class="paypalbutton"  type="button" value="Donate"/>
								{else if !$x.price}
									<input style="margin-left: 25px" class="" type="button" value="Install" onclick="installMe('{$key|base64_encode}','{$x.name|md5}','{$x.name}')"/>
								{else}
									{$x.button}
								{/if}
									<input class="x-icon-16x16-information" style="float: right" type="button" value="More Info"/>
								</center>
								{$x.website}
								{$x.desc}
								
							</div>
						</div>
						{/if}
					{/foreach}
					</table>
					</td>
				</tr>			
		</td>
	</tr>
</table>
<script>
	function fadeInDesc(el){
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

	function installMe(base64,md5,name){
		$('#dim-the-lights').fadeIn('slow');
		var gif = 'Installing<br/> <img src="/bin/images/loading/barbershop.gif"/><br/> Please Wait...';
		var hov = $('#hover-box').html(gif);
		$.post('/{$toBackDoor}/update/updateXPhp/'+base64+'/?json',{},function(){
			var iframe = gif + "<iframe style='display: none;' name='tmp_frame' id='tmp-frame' onload=\"loadMenu(this,'"+name+"','"+md5+"');\" src='/{$toBackDoor}/'></iframe>";
			$('#hover-box').html(iframe);
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
	
	
</script>