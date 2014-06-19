
<script src="/fileServer/js/ext/plugins~Ext.ux.form.DateTime.js"></script>
<!-- <table align="center" width="75%" id="admin-zone-panel">
	<tr>
		<th>
		<img src="{$ICON.48}/news.gif" align="absmiddle"/>
		Latest News of {$HTTP_HOST} <a href="#add" onclick="addNews(this)" style="float: right;"><img src="{$ICON.16}/newspaper_add.png" align="absmiddle"/>Add News</a></th>
	</tr>
	<tr>
		<td align="center">
			<div align="center">
				{foreach from=$list item=news}
					<div class="box" style="margin: 10px; padding: 10px; font-weight: none; font-size: 10px; float: left; width: 28%; height: 110px; overflow: auto;">
						<center>
							<h1>{$news.title}</h1>
							<b style='font-size: 8px'>{$news.date}</b>
						<a href="#edit:{$news.title}" onclick="addNews(this,'{$news.id}')" style="float: left" >
							<img src="{$ICON.16}/newspaper.png" align="absmiddle"/> Edit
						</a>
						<a href="#" onclick="removeArticle({$news.id})" style="float: right">
							<img src="{$ICON.16}/newspaper_delete.png" align="absmiddle"/>	Delete
						</a>
							<hr/>
						</center>
						{$news.content|strip_tags|truncate:250}
						
					</div>
				{/foreach}
			</div>
		</td>
	</tr>
</table> -->
<style>
#zyx-content{
background: rgb(240,183,161);
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2YwYjdhMSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjUwJSIgc3RvcC1jb2xvcj0iIzhjMzMxMCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjUxJSIgc3RvcC1jb2xvcj0iIzc1MjIwMSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNiZjZlNGUiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top,  rgba(240,183,161,1) 0%, rgba(140,51,16,1) 50%, rgba(117,34,1,1) 51%, rgba(191,110,78,1) 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(240,183,161,1)), color-stop(50%,rgba(140,51,16,1)), color-stop(51%,rgba(117,34,1,1)), color-stop(100%,rgba(191,110,78,1)));
background: -webkit-linear-gradient(top,  rgba(240,183,161,1) 0%,rgba(140,51,16,1) 50%,rgba(117,34,1,1) 51%,rgba(191,110,78,1) 100%);
background: -o-linear-gradient(top,  rgba(240,183,161,1) 0%,rgba(140,51,16,1) 50%,rgba(117,34,1,1) 51%,rgba(191,110,78,1) 100%);
background: -ms-linear-gradient(top,  rgba(240,183,161,1) 0%,rgba(140,51,16,1) 50%,rgba(117,34,1,1) 51%,rgba(191,110,78,1) 100%);
background: linear-gradient(top,  rgba(240,183,161,1) 0%,rgba(140,51,16,1) 50%,rgba(117,34,1,1) 51%,rgba(191,110,78,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f0b7a1', endColorstr='#bf6e4e',GradientType=0 );

}

</style>
<script type="text/javascript"><!--

Ext.apply(Ext.form.VTypes, {
    daterange : function(val, field) {
        var date = field.parseDate(val);

        if(!date){
            return false;
        }
        if (field.startDateField) {
            var start = Ext.getCmp(field.startDateField);
            if (!start.maxValue || (date.getTime() != start.maxValue.getTime())) {
                start.setMaxValue(date);
                start.validate();
            }
        }
        else if (field.endDateField) {
            var end = Ext.getCmp(field.endDateField);
            if (!end.minValue || (date.getTime() != end.minValue.getTime())) {
                end.setMinValue(date);
                end.validate();
            }
        }
        /*
         * Always return true since we're only using this vtype to set the
         * min/max allowed values (these are tested for after the vtype test)
         */
        return true;
    },

    password : function(val, field) {
        if (field.initialPassField) {
            var pwd = Ext.getCmp(field.initialPassField);
            return (val == pwd.getValue());
        }
        return true;
    },

    passwordText : 'Passwords do not match'
});

	Ext.onReady(function() {

		// create the Data Store
	    var store = new Ext.data.JsonStore({
			fields	: {$fields},
			remoteSort	: true,

		    pruneModifiedRecords: true,
			proxy	: new Ext.data.HttpProxy({
			    api: {
			        read    : '/{$toBackDoor}/{$Xtra}/read/?returnJson',
			        create  : '/{$toBackDoor}/{$Xtra}/add/?returnJson',
			        update  : '/{$toBackDoor}/{$Xtra}/update/?returnJson',
			        destroy : '/{$toBackDoor}/{$Xtra}/delete/?returnJson'
			    }
			}),
	        autoLoad: true,
	        root	: 'data', 
	        idProperty: 'id',
	        totalProperty: 'total',
		   
	        writer	: new Ext.data.JsonWriter({
		        
		    })
	    });
	    
	    {literal}
		var template = new Ext.XTemplate(
				'<tpl for=".">',
				'<div class="blog-post" id="blog_post_{id}"  >', 
				'<div class="paper">',
				'<div class="post-email" id=" {id} ">', 
					'<div style="float: right; border-left: 1px solid rgba(255,0,0,0.25); width: 55px; padding: 15px;">',
						'<button class="punch" style=" " title="Edit" ><img src="{$ICON.32}/new mail.png"/></button></br>',
						'<button class="punch" style="  " title="Copy"><img src="{$ICON.32}/music.png"/></button></br>', 
						'<button class="punch" style=" " title="Delete"><img src="{$ICON.32}/minus.png"/></button>', 
						
					'</div>',
					'<fieldset><legend style="width: 95%; border-bottom: 1px solid rgba(0,0,255,0.25); padding: 10px;">Day {day_in_chain} | {subject}</legend>', 
					'{title}</fieldset>',
					
					
				'</div>', 
				
						'<div class="post-stamp"><b>DAY</b><h1 style="font-size: 13px">{day_in_chain}</h1></div>',
						'<div style="float: left">{from_address}</div>',
						  
						 
						'<div class="post-subject">{date}</div>',
						 
						
						
					'</div>',  
				'</div>',
				'</tpl>'
			);
			{/literal}


		
		

	    // create the grid
	    var grid = new Ext.grid.GridPanel({
		    title	: 'Post Index',
	    	stateful: true,
			border	: false,
			//clicksToEdit : 1,
			frame	: false,
			loadMask: true,
			id		: 'blog-grid',
	        store: store,
	        region	: 'west',
	        width	: '45%',
	        collapsible	: true,
			split	: true,
			collapseMode: 'mini',
		    colModel: new Ext.grid.ColumnModel({
		        defaults: {
		            sortable: true,
		            editable	: true,
		            editor	: new Ext.form.TextField({
			             
				    })
		        },
		        columns: {$columns},
		    }),
		    viewConfig: {
		        forceFit: true,
		    },

		    sm: new Ext.grid.RowSelectionModel({
			    singleSelect:true
			}),
			 
			bbar: ['Date Range View','->','From: ',{
                name: 'enddt',
                id: 'enddt',
                vtype: 'daterange',
                xtype	: 'datefield',
                value	: new Date(),
                maxValue	: new Date(),
                startDateField: 'startdt' // id of the start date field
           	},'-','To: ',{
                name: 'startdt',
                id: 'startdt',
                vtype: 'daterange',
                xtype	: 'datefield',
                maxValue	: new Date(),
                endDateField: 'enddt' // id of the end date field
       		},'->',],
		    fbar: new Ext.PagingToolbar({
	            pageSize: 25,
	            store: store,
	            displayInfo: true,
	            displayMsg: {literal}'Displaying Posts {0} - {1} of {2}',{/literal}
	            emptyMsg: "No topics to display"
	        })
	    });

	    /**
		 * Dataview
		{include 
			file="~extjs/dataview.js" 
			var="grid" 
			template="template" 
			itemSelector = 'div.blog-post'
			store="store"}
	    
		 */
	    
		var win = x4.Window({
			id		: 'blog-win',
			title	: 'Blog',
			iconCls	: 'x-icon-16x16-book',
			layout	: 'fit',
			
	        items	: [{
				layout	: 'border',
				border	: false,
				
				items	: [grid,{
					region	: 'center',
					layout: {
                        type:'vbox',
                        padding: '10',

                        align:'stretch'

                    },
                    title		: 'Manage Posts',
                    width		: '10%',
                    defaults	: {
                    	xtype	: 'button',
                    	flex	: 1,
                    	margins	: '0 0 15 0'
                    },
                    items	: [{
    	                text	: 'Add New Post',
    	                iconCls	: 'x-icon-32x32-new_document',
    	                scale	: 'large',
    	                iconAlign: 'bottom',
    	                scope	: this,
    	                handler	: function(b,e){
    	                	x4.blog.addNews(b);
    	                }
    	            },{
    	                text	: 'Edit Post',
    	                iconCls	: 'x-icon-32x32-notebook',
    	                scale	: 'large',
    	                iconAlign: 'top',
    	                handler	: function(){
    		            	var sm = grid.getSelectionModel();
    	            		if(sm.hasSelection()){
    	            			var r = sm.getSelected();
    	            			x4.blog.addNews(r,r.id);
    	                	}else{
    		                	alert('Please Select a Post to Edit');

    		                }
    	                }
    	            },{
		            	text	: 'Trash Post',
		                iconCls	: 'x-icon-32x32-trash_full',
		                scale	: 'large',
		                iconAlign: 'top',
		                handler	: function(){
		                	var sm = grid.getSelectionModel();
    	            		if(sm.hasSelection()){
    	            			var r = sm.getSelected();
    	            			x4.blog.trash(r.id);
    	                	}else{
    		                	alert('Please Select a Post to Trash 1st');
    		                }
		                }
		            }]
				},{	
					region	: 'east',
					id		: 'blogDetailPanel',
					title	: 'Preview Post',
					iconCls	: 'x-icon-16x16-eye', 
					width	: '45%',
					bodyStyle: { 

						background: '#ffffff',
						padding: '7px'
					},
					plain	: true,
					html: 'Please select a book to see additional details.',
					 collapsible	: true,
						split	: true,
						collapseMode: 'mini',
				}],
				
			}]
			
		});

		// define a template to use for the detail view
		{literal}
		var bookTplMarkup = [
			'Title: <a href="/blog/article/{id}/{title}" target="_blank">{title}</a><br/>',
			'Author: {author}<br/>',
			'Date: {date}<br/>',
			'<blockquote>{content}</blockquote>'
		];
		{/literal}
			
		var bookTpl = new Ext.Template(bookTplMarkup);

		
		grid.getSelectionModel().on('rowselect', function(sm, rowIdx, r) {
			var detailPanel = Ext.getCmp('blogDetailPanel');
			bookTpl.overwrite(detailPanel.body, r.data);
		});
		
		win.show(document.body,function(w){
			w.maximize();
			store.load();
		});		
	});	

	 
	
	x4.blog	= {
		trash	: function(id,win){ 
			Ext.Msg.confirm('Trashing Post','Are you sure you want to trash this?',function(btn){
				if(btn === 'yes'){ 
					if(win){
						win.close();
					}
					Ext.Msg.wait('Deleting','Please wait...');
					Ext.Ajax.request({
					   url: '/{$toBackDoor}/blog/delete/'+id,
					   success: function(){
						   ume.msg('Success!','Blog Post has been Trashed');
						   Ext.Msg.hide(); 
							Ext.getCmp('blog-grid').getStore().reload();
							
					   },
					   //failure: otherFn,
					   /* headers: {
					       'my-header': 'foo'
					   }, */
					   //params: { foo: 'bar' }
					});	 
				}
			});  
		},
		addNews	: function(el,id) {
			var win;
			win = x4.Window({
				title	: 'News Article',
				iconCls	: 'x-icon-16x16-newspaper',
				width	: 555,
				height	: 450, 
				layout	: 'fit',
				modal	: true,
				items	: [new Ext.form.FormPanel({
					defaultType : 'textfield',
					id		: 'new-news-form',
					layout	: 'form',
					frame	: true,
					 items	: [{
						xtype		: 'panel', 
						layout		: 'column',
						defaults	: { 
		                	columnWidth	: 0.5,
							layout		: 'form',
							labelWidth	: 50,
							padding	: 5, 
						},
						items		: [{
							items	: [{
								anchor		: '100%',
								hideLabel	: true,
								xtype		: 'textfield',
								emptyText	: 'Blog Post Subject Title',
								allowEmpty	: false,
								name		: 'news[title]'
							}]
						},{
							items	: [{
								fieldLabel	: 'Publish',
								value		: new Date(),
								xtype		: 'xdatetime',
								name		: 'news[published]',
								format		: 'Y-m-d H-i-s'
							}]
						}]
					},{
						xtype		: 'hidden',
						name		: 'news[id]'
					}, {
						xtype		: 'hidden',
						name		: 'news[author]',
						value		: ume.user.username
					},{
						hideLabel	: true,
						xtype		: 'tinymce',
						anchor		: "100% -50",
						tinymceSettings: x4.tinymceSettings,
						name		: 'news[content]'
					}],
					buttonAlign		: 'center',
					buttons	: [{
						text	: 'Cancel',
						iconAlign	: 'top',
						iconCls	: 'x-icon-32x32-cancel_red_button',
						scale	: 'large',
						handler	: function(){
							win.close();
						}
					},{
						text	: 'Save', 
						iconAlign	: 'top',
						scale	: 'large',
						iconCls	: 'x-icon-32x32-clear_green_button',
						handler	: function(){
							
							Ext.getCmp('new-news-form').getForm().submit({
								url		: '/{$toBackDoor}/{$Xtra}/add/?returnJson',
								waitMsg	: 'Saving...',
								success	: function(){
									ume.msg('News Saved!','Success');
									win.close();
									Ext.getCmp('blog-grid').getStore().reload();
								}
							});
						}
					},{
						text	: 'Trash', 
						iconAlign	: 'top',
						scale	: 'large',
						disabled	: (id)?false:true,
						iconCls	: 'x-icon-32x32-trash_full',
						handler	: function(){ 
							x4.blog.trash(id,win);
						}
					}]
				})]
			}).show(el,function(){
				if(id){
					Ext.Msg.wait('Loading','Please wait...');
					Ext.getCmp('new-news-form').getForm().load({
						url		: '/{$toBackDoor}/{$Xtra}/edit/'+id+'/?returnJson',
						failure: function(form, action) {
					        Ext.Msg.alert("Load failed", action.result.errorMessage);
					    },
						success	: function(){
							Ext.Msg.hide(); 
						}
					});
				}
			})
		}
	} 
--></script>