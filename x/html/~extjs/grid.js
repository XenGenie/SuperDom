var {$var} = new Ext.grid.EditorGridPanel({
	region	: '{$region}',
	title	: '{$title}',
	id		: '{$var}-grid',
	layout	: 'fit', 
	store	: {$store},
    frame	: false,
    colModel: new Ext.grid.ColumnModel({
        defaults: {
            sortable: true,
            editable: true
        },
        columns: {$columns}	
    }),
    viewConfig: {
        forceFit: true     
    },
    sm: new Ext.grid.RowSelectionModel({
    	singleSelect:true
    })
});