	var {$var} = new Ext.Window({
		layout	: 'fit', 
		id		: '{$var}-id',
		height	: $(document.body).height()-$('#shortcut-panel').outerHeight()-$('#neck-breadcrumbs').outerHeight()-40,
		title	: "{$title}",
		iconCls	: '{$iconCls}',
		layout	: 'border',
		closable: false,
		tbar	: {if $tbar}{$tbar}{else}null{/if},
		items	: {$items},
		width	: $(window).width()*1, 
		y		: 0,
		height	: $(window).height()-115
	}).show();