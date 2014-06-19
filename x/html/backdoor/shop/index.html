{include file="/index.html"}
<script>
	Ext.onReady(function(){
	
		/**
		 * Inventory Dataview
		 */
		 var inventory_url = "/{$toBackDoor}/{$Xtra}/inventory?json";
			 
		 	inventory_store = new Ext.data.JsonStore({
		        url		: inventory_url,
		        autoLoad	: true,
		        method	: 'POST',
		        root	: 'data',
		        idProperty	: 'id',
		        fields	: {$inventory_attr}
		    }); 
		    
			var template = new Ext.XTemplate(
					'<tpl for=".">',
					'<div class="drip-email" id="{literal}drip_{id}{/literal}"  >',
					
					'<div class="postcard">',
					'<div class="post-email" id="{literal}drip_email_{id}{/literal}">', 
						'<div style="float: right; border-left: 1px solid rgba(255,0,0,0.25); width: 55px; padding: 15px;">',
							'<button class="punch" style=" " title="Edit" ><img src="{$ICON.32}/new mail.png"/></button></br>',
							'<button class="punch" style="  " title="Copy"><img src="{$ICON.32}/music.png"/></button></br>', 
							'<button class="punch" style=" " title="Delete"><img src="{$ICON.32}/minus.png"/></button>', 
							
						'</div>',
						'<fieldset><legend style="width: 95%; border-bottom: 1px solid rgba(0,0,255,0.25); padding: 10px;">{literal}Day {day_in_chain} | {subject}{/literal}</legend>', 
						'{literal}{email_content}{/literal}</fieldset>',
						
						
					'</div>', 
					
							'<div class="post-stamp"><b>DAY</b><h1 style="font-size: 13px">{literal}{day_in_chain}{/literal}</h1></div>',
							'<div style="float: left">{literal}{from_address}{/literal}</div>',
							  
							 
							'<div class="post-subject">{literal}{subject}{/literal}</div>',
							 
							
							
						'</div>',  
					'</div>',
					'</tpl>'
				);
		{include 
			file="~extjs/dataview.js" 
			var="inventory" 
			template="template"
			root="data"
			url="inventory_url" 
			fields=$inventory_attr
			itemSelector = 'div.inventory-item'
			store="inventory_store"}
		/**
			End Inventory Dataview
		**/

		var _shop_cat_tree = new Ext.tree.TreePanel({
			id		: 'shop-cat-tree',
			region 	: 'west',
			width 	: '25%',
			title 	: 'Tags', 
			buttonAlign	: 'center',
			iconCls	: 	'x-icon-16x16-sitemap_color',
			buttons	: [{
				iconAlign: 'bottom',
				iconCls: 'x-icon-32x32-network',
				scale: 'large', 
				text	: 'New Link',
				handler	: function(){
					var host = 'http://'+window.location.hostname+'/';
					var title = prompt('Name your Link');
					if(title != '' && title != null){
						var href = prompt('URL address ~ (Start with "/" or "http://"):',host + title.toLowerCase().replace(/ /gi,'+') );
						if(href != '' && href != 'null'){
						
							$.post('/{$toBackDoor}/{$Xtra}/save/?json',{
								form	: {
									href	: href,
									title	: title,
									parent	: xNav.PARENT_MENU,
								}
							},function(json){
								Ext.getCmp('navigation-tree').getRootNode().reload();
								xNav.loadMenu(xNav.PARENT_MENU);

								
							});
						}
					} 
					
				}
			}, { 
				iconAlign: 'bottom',
				iconCls: 'x-icon-32x32-minus',
				scale: 'large', 
				text	: 'Delete Link',
				handler	: function(){
					var n = Ext.getCmp('navigation-tree').getSelectionModel().getSelectedNode();
					if(n ){
						xNav.removeLink(n.id,n.text);
					}else{
						Ext.Msg.alert('Choose a link to delete 1st.','Link not selected. Nothing to Delete.');
					}
				}
			}],
			listeners	: {
				beforeClick	: function(node){
			
					Ext.getCmp('navi-link-href-text').setValue(node.attributes.link);
					return false;
				},
				click		: function(){
					return false;
				},
				dblClick	: function(node){
					xNav.editLink(node.id.replace('link-',''));
				},
			
				checkchange	: function (node,checked){
					$.post('/{$toBackDoor}/navigation/checked/?json',{
		    			id		: node.id.replace('link-',''),
		    			checked	: checked
		    		},function(data){ 
		        		
		    		});
				},

				 movenode : function(tree,node,oldParent,newParent,index){

					$.post('/{$toBackDoor}/navigation/dropLink/?json',{
		    			id		: node.id.replace('link-',''),
		    			parent	: newParent.id.replace('link-',''),
		    			weight 	: index
		    		},function(data){

		    			var weight = 0;
		    			var nodes = new Array();
		    			
		        		newParent.eachChild(function(n){
			        		nodes[weight++] = n.id.replace('link-','');
			        	});

		        		$.post('/{$toBackDoor}/navigation/updateOrder/?json',{
		        			nodes	: ume.util.serialize(nodes)
		        		},function(){
		        			
							//	xNav.loadMenu(xNav.PARENT_MENU);
			        	});
		        		
		    		});
			 
					/**
					var c = confirm("Moving "+node.text+" to "+newParent.text);
		    		if(c){
		    			
		    		}else {
		    			return false;
		    		}
					*/	

				}

			},
			useArrows       : true,
			
			autoScroll      : true,
			animate         : true,
			enableDD        : true,
			containerScroll : true,
			border          : false,
			rootVisible     : true,
			// auto create TreeLoader
			dataUrl         : '/{$toBackDoor}/{$Xtra}/loadTree', 
			root            : {
				iconCls   : 'x-icon-16x16-world',
				expanded  : true,
				nodeType  : 'async',
				text      : '{$site_name} Shop',
				draggable : false,
				id        : '0'
		    }
		});

		var inventory = {
			layout : 'border',
			items : [{
				region : 'center',
				title : "Items"
			},{
				region : 'east',
				width : '25%',
				title : "Item"
			},_shop_cat_tree]
		};
		

		


		
		var win = x4.Window({
			title	: 'Shop',
			iconCls	: 'x-icon-16x16-basket',
			layout	: 'border',
			items	: [{
				region	: 'west',
				width	: 150,
				height	: 100,
				frame	: true,
				layout: {
        	        type:'vbox',
	                align:'stretch'
                },
            	collapseMode	: 'mini', 
                defaults	: {
                    xtype	: 'button',
                    flex	: 1,

    	            padding:'5',
                    scale	: 'large',
                    iconAlign	: 'top'
                },
				items	: [{
					text	: 'Inventory',
					iconCls	: 'x-icon-32x32-splash_green'
				},{
					text	: 'Order(v)s',
					iconCls	: 'x-icon-32x32-cash'
				},{
					text	: 'Custom\'ers',
					iconCls	: 'x-icon-32x32-smiley_star'
				},{
					text	: 'Settings',
					iconCls	: 'x-icon-32x32-generalpreferences'
				}]
			},{
				region	: 'center',
				xtype	: 'tabpanel',
				activeTab	: 0,
				defaults: {
					layout	: 'border',
				},
				items	: [{
					title	: 'Store Front',
					layout	: 'fit',
					autoLoad	: {
						url	: '/{$toBackDoor}/{$Xtra}/brick/?html'
					},
					iconCls	: 'x-icon-16x16-cart'
				},{
					title	: 'Inventory',
					iconCls	: 'x-icon-16x16-box', 
					layout	: 'border',
					items	: [{
						region	: 'south',
						width	: 150,
						height	: 100,
						frame	: true,
						layout: {
		        	        type:'hbox',
			                align:'stretch'
		                },
		            	collapseMode	: 'mini', 
		                defaults	: {
		                    xtype	: 'button',
		                    flex	: 1,
		                    margin	:'5',
		                    scale	: 'large',
		                    iconAlign	: 'left'
		                },
						items	: [{
							text	: 'New Category',
							iconCls	: 'x-icon-32x32-splash_green'
						},{
							text	: 'Add New Item',
							iconCls	: 'x-icon-32x32-splash_green'
						},{
							text	: 'Track Sales',
							iconCls	: 'x-icon-32x32-smiley_star'
						},{
							text	: 'Discontinue Item',
							iconCls	: 'x-icon-32x32-generalpreferences'
						}]
					},{
						region	: 'center',
						layout	: 'fit',
						items	: [inventory]
					}]
				},{
					title	: 'Order(v)s',
					iconCls	: 'x-icon-16x16-lorry',
					items	: [{
						region	: 'south',
						width	: 150,
						height	: 100,
						frame	: true,
						layout: {
		        	        type:'hbox',
			                align:'stretch'
		                },
		            	collapseMode	: 'mini', 
		                defaults	: {
		                    xtype	: 'button',
		                    flex	: 1,

		                    margin:'5',
		                    scale	: 'large',
		                    iconAlign	: 'left'
		                },
						items	: [{
							text	: 'Incoming',
							iconCls	: 'x-icon-32x32-splash_green'
						},{
							text	: 'Outgoing',
							iconCls	: 'x-icon-32x32-smiley_star'
						},{
							text	: 'Canceled',
							iconCls	: 'x-icon-32x32-generalpreferences'
						},{
							text	: 'Completed',
							iconCls	: 'x-icon-32x32-generalpreferences'
						}]
					},{
						region	: 'center',
					}]
				},{
					title	: 'Custom\'ers',
					iconCls	: 'x-icon-16x16-star',
					items	: [{
						region	: 'south',
						width	: 150,
						height	: 100,
						frame	: true,
						layout: {
		        	        type:'hbox',
			                align:'stretch'
		                },
		            	collapseMode	: 'mini', 
		                defaults	: {
		                    xtype	: 'button',
		                    flex	: 1,

		                    margin:'5',
		                    scale	: 'large',
		                    iconAlign	: 'left'
		                },
						items	: [{
							text	: 'Add Item',
							iconCls	: 'x-icon-32x32-splash_green'
						},{
							text	: 'Track Sales',
							iconCls	: 'x-icon-32x32-smiley_star'
						},{
							text	: 'Discontinue Item',
							iconCls	: 'x-icon-32x32-generalpreferences'
						}]
					},{
						region	: 'center',
					}]
				},{
					title	: 'Settings',
					iconCls	: 'x-icon-16x16-cog',
					items	: [{
						region	: 'south',
						width	: 150,
						height	: 100,
						frame	: true,
						layout: {
		        	        type:'hbox',
			                align:'stretch'
		                },
		            	collapseMode	: 'mini', 
		                defaults	: {
		                    xtype	: 'button',
		                    flex	: 1, 
		    	            margin	:'5',
		                    scale	: 'large',
		                    iconAlign	: 'left'
		                },
						items	: [{
							text	: 'Add New Item',
							iconCls	: 'x-icon-32x32-splash_green'
						},{
							text	: 'Track Sales',
							iconCls	: 'x-icon-32x32-smiley_star'
						},{
							text	: 'Discontinue Item',
							iconCls	: 'x-icon-32x32-generalpreferences'
						}]
					},{
						region	: 'center',
						layout	: 'fit',
						items	: [new Ext.form.FormPanel({
							

						})]
					}]
				}]
			}]
		});
		win.show(document.body,function(win){
			win.maximize();
		});
	});
</script>