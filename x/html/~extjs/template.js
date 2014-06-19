var {$var} = new Ext.XTemplate(
	'<tpl for=".">',
	{include file="~extjs/xtmp_{$tmp}.html" fields=$fields}
	,'</tpl>'
);