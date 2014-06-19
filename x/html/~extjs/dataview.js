	var {$var} = new Ext.DataView({
        itemSelector	: {if $itemSelector}'{$itemSelector}'{else}'div.thumb-wrap'{/if},
        style			: 'overflow:auto',
        id				: '{$var}',
        layout			: 'fit',
        region			: 'center',
        multiSelect		: false,
        emptyText		: 'Empty',
        {if !$store}
        store: new Ext.data.JsonStore({
            url		: '/{$toBackDoor}/{$Xtra}/{$url}',
            method	: 'POST',
            autoLoad: true,
            root	: '{$root}',
            id		: 'id',
            fields: {$fields},
            listeners	: {
            	load	: function(){
            		// Drag and Drop to rearrange...
	            	$("#{$var}").sortable({
	        			//connectWith: '.connectedSortable',
	        			cursorAt: { cursor: 'crosshair', bottom: 25, right: 25 },
	        			opacity: 0.6,
	        			distance	: 30,
	        			helper: 'clone',
	        			cancel: '.ui-state-disabled',
	    				
	        			update: function(event, ui) {
	        				 var serial = $('#{$var}').sortable('serialize');
	        				 $.post('/{$toBackDoor}/{$Xtra}/updateOrder/?json&'+serial);
	        			}
	        		});
            	}
            	
            }
        }),
        {else}
        store	: {$store},
        {/if}
        tpl: {$template}
    });