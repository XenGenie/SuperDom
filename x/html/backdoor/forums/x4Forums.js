Ext.ns('x4');
x4.Forums = Ext.extend(Ext.Panel, {
	getIcon		: function(icon,align,ext){
		var ext = (ext) ? ext : 'png';
		var align = (align) ? align : 'absmiddle';
		return "<img src='{$ICON.16}/"+icon+"."+ext+"' align='"+align+"' />";
	},
	initComponent: function() {
		var bookTplMarkup = [
                 	'<h1>{category} : {title}</h1><hr/>',
                 	'{html}<hr/>',
                 	'Author: {user_id}<br/>',
                 	'{datetime}<br/>',
                 ];

        var newspaper = new Ext.Template(bookTplMarkup); 
		
        
        
	
		this.layout = 'border';
		this.plain	= true;
		this.frame	= false;
		this.border	= false;
		this.tbar = [{
    		text : 'New Topic',
    		id	: 'new-topic-btn',
    		iconAlign: 'top',
    		iconCls: 'x-icon-16x16-user_comment',
    		handler		: function(){
    			x4.doAction(function(){
    				this.os.open('new-topic-win')
    			})
    		}
    	}];
		this.items = [new Ext.tree.TreePanel({
			region:'west',
			title	: 'Navigate Forums',
			iconCls	: 'x-icon-mouse',
			cls		: 'metal',
			tools	: [{
				id	: 'refresh',
				handler: function(){
					Ext.getCmp('forum-tree').getRootNode().reload();
				}
			}],
			animate		: false,
	        useArrows	: true,
	        autoScroll	: true,
	    	singleClickExpand: true,
			layout	: 'fit',
			id		:'forum-tree',
            collapsible: true,
			collapseMode: 'mini',
            split	:true,
            width	: 220,
            minWidth: 220,
            listeners	: {
				click	: function(node,ev){
					if(node.leaf){
						var store = Ext.getCmp('forum-topics').store; 
						store.setBaseParam('id', node.id);
						store.load();
						
						var hogforums = this.getIcon('home_grey')+'<a style="color: white" href="#" onmousedown="var store = Ext.getCmp(\'forum-topics\').store; store.setBaseParam(\'id\', \'latest\'); store.load(); Ext.getCmp(\'topics-panel\').setTitle(\'All Latest Topics\')">[Forum Portal]</a>';
						Ext.getCmp('topics-panel').setTitle(hogforums +' ~ '+ node.parentNode.text +' ~ '+ node.text);
						try {
							//var pageTracker = _gat._getTracker("UA-16219956-1");
							///pageTracker._setDomainName(".HalloftheGods.com");
							//pageTracker._trackPageview("/forums/"+ node.parentNode.text+"/"+node.text);
						} catch(err) {}
					}
				},
				contextMenu: function(n,e){
		        	var menu = new Ext.menu.Menu({
			             id:'ispace-ctx',
			             shadow: 'frame',
			             items: [{
			                 text: 'Reload root',
			                 iconCls: 'x-icon-16x16-database_refresh',
			                 handler: function(){
			            		Ext.getCmp('upload-tree').getRootNode().reload();
			                 }
			             },{ 
			            	 text:'Reload Dir',
			            	 iconCls: 'x-icon-16x16-refresh',
			            	 handler: function(){
			            	 	n.parentNode.reload()
			             	 }
			             }/*,{
			            	 text:'Expand',
			            	 iconCls: '',
			            	 handler: n.expand
			             },{
			            	 text:'Expand All',
			            	 iconCls: '',
			            	 handler: n.expandAll
			             }*/],
			             listeners: {
			            	hide: function(){
			            	 	menu.destroy();
			             	}
			             }
			            	 
			         });
			         menu.showAt(e.getXY());
			         e.preventDefault();
		        },
			},
            loader: new Ext.tree.TreeLoader({
	            //directFn: $$.Forums.getForumTree,
            	dataUrl: '/{$toBackDoor}/forums/tree',
            	listeners: {
	        		load: function(t,n,r){
		            	var store = Ext.getCmp('forum-topics').store; 
						store.setBaseParam('id', 'latest');
						store.load();
						Ext.getCmp('topics-panel').setTitle('All Latest Topics');
					}
	        	}
            }),
            rootVisible:false,
            lines:false,
            autoScroll:true,
            root: {
            	id: 'root',
	            text: 'ForUms',
	            iconCls: 'x-icon-drive_web',
	            allowDrag:false,
	            editable: false,
	            allowDrop:false
	        },
	        buttonAlign: 'center',
	        
        }),{
	    	region	: 'center',
	    	layout	: 'border',
	    	autoScroll: true,
	    	items	: [{
	    		region  : 'north',
	    		title	: 'All Latest Topics',
				id		: 'topics-panel'
	    	},{
	    		region: 'south',
	    		autoHeight: true,
	    		id		: 'describe-forum',
	    		html	: 'Welcome to the  ForUms! Get yourself acquainted, you\'ll be back for more.'
	    	},new Ext.DataView({
				id: 'forum-topics',
				region: 'center',
				autoScroll: true,
				loadingText: 'Loading Topics, Please Wait ...',
				itemSelector: 'table.forum-row',
				multiSelect: true,
				layout: 'fit',
				emptyText: 'Forum Empty',
				
				store: {
					xtype: 'directstore',
	    			//directFn: $$.Forums.getTopics,
					storeId: 'ForumTopicsStore',
					idProperty:'id',
					fields: [{
						name: 'topic_title'
					},{
						name: 'topic_author'
					},{ 
						name: 'id'
					},{
						name: 'topic_timestamp'
					},{
						name: 'topic_views'
					},{
						name: 'topic_replies'
					},{
						name: 'topic_category'
					},{
						name: 'topic_icon'
					},{
						name: 'last_poster'
					},{
						name: 'topic_color'
					}],
					baseParams: {
						id		: 'latest',
						start	: 0,
						limit	: 10
					},
					paramOrder: 'id|start|limit',
					root:'data',
					remoteSort: true,
					listeners: {
						load: function(s, records){
							// Create Tooltips...
							s.each(function(r){
								var tip = Ext.getCmp('topic-tip-'+r.get('id'));
								if(tip){
									tip.destroy();	
								}
								new Ext.ToolTip({
									target		: 'topic-link-'+r.get('id'), 
									id			: 'topic-tip-'+r.get('id'),
									autoWidth	: true,
									autoLoad	: {
										url: '/+/tpl/topic/preview/?topic='+r.get('id')
									},
									title		: r.get('topic_author')+' ~ '+r.get('topic_title'),
									autoHide	: true,
									dismissDelay: 3500,
									showDelay	: 10,
									hideDelay	: 0,
									closable	: true
								});
							});
						},
						beforeLoad: function(s, records){
							
						}
					}
				},
				tpl: new Ext.XTemplate(
					'<tpl for=".">',
					'<table cellpadding="1" cellspacing="0"  class="forum-row" width="100%" id="topic-link-{id}" align="center" onMouseOver="this.style.backgroundColor = \'{topic_color}\'" onMouseOut="this.style.backgroundColor = \'transparent\'">',
					'<tr>',
					'<td style="padding: 0 5px 0 5px" width="25">{topic_icon}</td>',
					'<td align="left" style="padding: 1px 5px 1px 0; font-size: 11px;" ><span style="font-size: 9px;">{topic_category} |</span><b>{topic_title}</b> <br/><span style="float:right;font-size: 9px;"><b>{last_poster}</b> '+this.getIcon('comments_reply')+'</span><span style="font-size: 9px; padding-left: 5px;">'+this.getIcon('pencil')+' <b>{topic_author}</b></span>',
					'</td><td width="25" style="text-align: center;padding-left: 5px; font-size: 8px" >'+this.getIcon('user_comment')+'<br/><b> {topic_replies}</b>',
					'</td><td width="25" style="text-align: center;font-size: 8px">'+this.getIcon('eye')+'<br/><b> {topic_views}</b>',
					'</td></tr></table>',
					'</tpl>'
				),
				listeners: {
	    			contextmenu : function(){
	    				this.msg('HHAHAHA','OVer ehre!');
	    			},
					click:function(dv,index,htmlnode,event){
	    				var r 	 = dv.getRecord(htmlnode);
	    				var id 	 = r.get('id');
	    				var tabs = Ext.getCmp('tab-portal');
	    				var tab  = Ext.getCmp('topic'+id);
	    				if(!tab){
	    					tab = new Topic({
		    					id			: 'topic-'+id,
		    					closable	: true,
		    					iconCls		: 'x-icon-script',
		    					title 		: Ext.util.Format.ellipsis(r.get('topic_category') +' > '+ r.get('topic_title'),35,true),
		    					fulltitle	: r.get('topic_category') +' > '+ r.get('topic_title'),
		    					autoScroll	: true,
		    					autoLoad	: {
		    						url 	: '/+/tpl/topic/index/?topic='+id,
		    						scripts		: true
		    					}	    					 
		    				});
	    					tabs.add(tab);
	    				}
	    				tabs.activate('topic-'+id);
	    				
	    			}
	    		} 
	    	})],
			bbar: new Ext.PagingToolbar({
	            pageSize: 10,
	            store: 'ForumTopicsStore',
	            displayInfo: true,
	            style: 'color: white',
	            displayMsg: 'Topics Displaying {0} - {1}  of {2}',
	            emptyMsg: "No Topics to Display",
	            plugins: new Ext.ux.ProgressBarPager()//new Ext.ux.SlidingPager()
	        })
	    }];
        x4.Forums.superclass.initComponent.call(this);
    }
});