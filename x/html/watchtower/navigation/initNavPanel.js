MyDesktop.navPanel = Ext.define('MyDesktop.navPanel', {
	extend   : 'Ext.ux.desktop.Module',
	requires : [
		'Ext.tab.Panel'
	],
	
	id       :'navPanel-win',

	path     : null,
	init : function  () {
		this.panel = Ext.create('Ext.panel.Panel', {  
			width  : '100%',
			height : '100%',
			layout : 'border', 
			items  : [this.tree = this.returnTree(),{
				region : 'center',
				layout : 'fit',
				title : 'New Area',
				items : [Ext.create('Ext.tab.Panel', {
					layout : 'fit',
					items : [{
						title : 'Properties',
						layout : 'border',
						items : [{
							title  : 'QR Code',
							region : 'east', 
							width  : 255,
							layout : 'fit',
							html   : '<div id="qrcode"></div>'
						},{
							region      : 'center',
						},{
							region      : 'north',
							xtype       : 'form',
							layout      : 'form',
							defaultType : 'textfield',
							defaults : {
								padding : '0 5px 0 5px'
							},
							items : [{
								fieldLabel : 'Link',
								emptyText : window.location.origin,
								listeners : {
									change : {
										fn : function  (t,n,o) {
											$('#qrcode').html('');
											$('#qrcode').qrcode({
												render	: "table", 
												text	: window.location.origin+'/'+n
											}).html($('#qrcode').html()+window.location.origin+'/'+n);	
										}
									}
								}
							},{
								fieldLabel : 'Title'
							},{
								fieldLabel : 'Template'
							},{
								fieldLabel : 'Costume'
							}]
						}]
					},{
						title : 'Blox'
					},{
						title : 'Placement'
					},{
						title : 'Preview'
					}]
				})]

			}],
			renderTo  : x4.activeArea[0]
		});
	},
	returnTree : function(){
		var store = Ext.create('Ext.data.TreeStore', {
			root  : { 
				expanded : true,
				visible  : false,
				text     : window.location.origin+'/'
			},	
			rootVisible : false,
			autoLoad    : false,
			proxy       : {
				type        : 'direct',
				directFn    : $$.xNavigation.tree,
				paramOrder  : ['node'],
				extraParams : {
					crud : 'read'
				}
	        }
	    });

		return Ext.create('Ext.tree.Panel', {
			store        : store,
			
            viewConfig: {
                plugins: {
                    ptype: 'treeviewdragdrop',
                    containerScroll: true
                }
            },
			layout       : 'fit',
			region       : 'west',
			bodyPadding  : 0,
			title        : 'Navigation',
			iconCls      : 'x-icon-16x16-blueprint-3',
			width        : 200,
			collapsed    : false,
			collapsible  : true,
			collapseMode : 'mini',
			rootVisible  : true,
			buttons : [{
				xtype   :'button',
				text    : '<img src="{$ICON.48}blueprint5.png"   ><br/> {$LANG.XNAVIGATION.NEW}',
				flex    : 1,
				iconAlign : 'top', 
				scope   : this,
				handler : this.newBlueprint
            },{
				xtype   :'button',
				text    : '<img src="{$ICON.48}blueprint sticky.png" align="absmiddle" ><br/>{$LANG.XBLOX.BTN7} ',
				flex    : 1,
				scope   : this,
				handler : this.saveBlueprint
            }],
			listeners : {
				itemclick : function( record, item, index, e, eOpts ){
		            item.appendChild({
		                text: 'Hi! I am a leaf',
		                leaf: false
		            });
           		
                //some node in the tree was clicked
                //you have now access to the node record and the tree view
                // record.get('id')
      //           x4.bloxPanel.blueprint_form.getForm().load({
			   //      params: {
			   //      	crud : 'read',
			   //          a : {
			   //           	id : record.get('id')
			   //          }
			   //      },
			   //      success : function(f,result){ 
			   //      	$('.blox-body').html(JSON.parse(result.result.data.blueprint_body));
						// x4.bloxPanel.applyDragEvents($('.blox-body div'));
			   //      }
			   //  });
                //now you have all the information about the node
                //Node id
                //Node Text
                //Parent Node
                //Is the node a leaf?
                //No of child nodes
                //......................
                //go do some real world processing
            	}
            }
		});
	}
});

Ext.onReady(function() {
	x4.navPanel = new MyDesktop.navPanel();    
});