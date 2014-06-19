
<link rel="stylesheet" href="http://bin.xtiv.net/js/jq/jquery-checkbox/jquery.checkbox.css" />
<link rel="stylesheet" href="http://bin.xtiv.net/js/jq/jquery-checkbox/jquery.safari-checkbox.css" /> 

<script type="text/javascript" src="http://bin.xtiv.net/js/jq/jquery-checkbox/jquery.checkbox.min.js"></script>
 
<script type="text/javascript">
$(document).ready(function() {
	$('input:checkbox').checkbox({
		empty: 'http://bin.xtiv.net/js/jq/jquery-checkbox/empty.png'
	});

	$('input[safari]:checkbox').checkbox({
		cls:'jquery-safari-checkbox'
	});
		
});
</script>

<table id="xphp_local" id="admin-zone-panel" align="center" width="100%">
	<td align="center">
		<form action="{$ME}" method="POST">
		<div align="center">
			<table class="box">
				<tr>
					<th width="50px">
						Xtension
					</th>
					<th>
						On/Off
					</th>
					<th>
						Front Door		
					</th>
					<th>
						Back Door
					</th>
				</tr>
		{foreach from=$xphp_local item=file}
			{if $file.icon}
			<tr>
				<td   align="center">
					<h1>{$file.name}</h1>
				</td>
				<td align="center" >
					<label title="{$file.desc}">
						<img src="{$ICON.48}/{$file.icon}" title="{$file.name}"/>
						<br/>
						<input onclick="$('.{$file.name|replace:' ':''}').attr('disabled', $(this).attr('checked') ? true : false)" type="checkbox" {if $CFG[$file.name] != 'off'}checked{/if} name="form[{$file.name}]" value="on"/>
					</label>
				</td>
				<td align="right"  >
					{foreach from=$file.front_doors item=f_name}
						<label title="">
							{$f_name}
							<input class="{$file.name|replace:' ':''}" type="checkbox" safari=1 name="form[{$f_name}]" checked value="on"/>
						</label><br/>
					{/foreach}
				</td>
				<td align="right"  >
					{foreach from=$file.back_doors item=f_name}
						<label title="">
							{$f_name}
							<input class="{$file.name|replace:' ':''}" type="checkbox" safari=1 name="form[{$f_name}]" checked value="on"/>
						</label>
						<br/>
					{/foreach}
				</td>
			</tr>
			{/if}
		{/foreach}
		
				
			
		</table>
		</div>
		</form>		
	</td>
</table>

<script type="text/javascript">
	Ext.onReady(function(){
		
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
	});
</script>