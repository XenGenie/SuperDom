<link rel="stylesheet" type="text/css" href="{$REPO}/js/ext-3.2.1/examples/ux/statusbar/css/statusbar.css" /> 
<script src="{$REPO}/js/ext-3.2.1/examples/ux/statusbar/StatusBar.js"></script>
<script src="{$REPO}/js/ext-3.2.1/examples/ux/RowEditor.js"></script>     

<script src="{$REPO}/js/ext-3.2.1/examples/ux/BufferView.js"></script> 
    <link rel="stylesheet" type="text/css" href="{$REPO}/js/ext-3.2.1/examples/ux/css/RowEditor.css" /> 
<link rel="stylesheet" type="text/css" href="{$REPO}/js/ext-3.2.1/examples/ux/css/LockingGridView.css" /> 
<script type="text/javascript" src="{$REPO}/js/ext-3.2.1/examples/ux/LockingGridView.js"></script>
 
<script><!--
	Ext.ns('x4');
	x4.editCss = Ext.extend(Ext.Panel, {
		id		: 'css-editor',
		frame	: false,
		layout	: 'border',
		padding	: 0,
		initComponent: function() {
			this.store = new Ext.data.JsonStore({
				fields	: {$fields},
				remoteSort	: false,
		        autoLoad		: false,
		        root			: 'data', 
		        idProperty		: 'id',
		        totalProperty	: 'total',
			    //pruneModifiedRecords: true,
			    baseParams		: {
					costume		: null    
				},
				proxy	: new Ext.data.HttpProxy({
				    api: {
				        read    : '/{$toBackDoor}/{$Xtra}/css/read/?json',
				        create  : '/{$toBackDoor}/{$Xtra}/css/create/?json',
				        update  : '/{$toBackDoor}/{$Xtra}/css/update/?json',
				        destroy : '/{$toBackDoor}/{$Xtra}/css/destroy/?json'
				    }
				}),
		        writer	: new Ext.data.JsonWriter({
			        
			    }),
			    listeners	: {
				    update	: function(s,r,o){
						x4.editCss.ELEMENT = r.data['element'];
					
						for(i in r.data){
							if(r.data[i] && (i != 'element' && i != 'state' && i != 'id') ){
								x4.editCss.STYLE = i; 
								x4.editCss.VALUE = r.data[i];

								$.frameReady(function() {
									var el 	= parent.x4.editCss.ELEMENT,
										css		= parent.x4.editCss.STYLE,
										data 	= parent.x4.editCss.VALUE ;
									$(el).css(css,data);
									
								},
								  "top.style_iframe"
								);
							}
						}
				    },
				    load	: function(s,recs,opts){
				   
				    }
				}
		    });

			
			function updateElement(record){
				
			}
			
			function loadCostume(){
				// Check the toggles, the select box, and load the theme.
				var element 	= Ext.getCmp('choose-element').getValue();
				var costume 	= Ext.getCmp('adv-choose-themes').getValue();
				var costume_store 	= Ext.getCmp('css-editor-grid').getStore(); 

				costume_store.setBaseParam('costume',costume);
				
				costume_store.load({
					params : {
						costume : costume,
						element	: element
					}
				});
			}

			this.tbar	= ['Costume',new Ext.form.ComboBox({  
			    id	: 'adv-choose-themes',  
			    store: new Ext.data.JsonStore({  
				    autoLoad: true,
			    	url: '/{$toBackDoor}/costumeize/getThemes/?json',
			    	root: 'data', 
			        fields : [{
				        name: 'id'
					},{
						name: 'name'
					}]  
			    }),  
			    valueField: 'id',  
			    displayField: 'name',
			    mode: 'remote',  
			    minChars : 0 ,
				width:125,
				listeners: {
					select: function(cb,r,i){ 
						
						var src =  top.frontpage.window.location.href;
						src = src.replace('http://{$HTTP_HOST}/','');
						src = src.replace('?theme='+costume,'');
						src = (src == '') ? 'index' : src; 

						costume 	= cb.getValue();
						document.getElementById('style_iframe').src = '/'+src+'?theme='+costume;
						Ext.getCmp('choose-element').setValue();
						loadCostume();


						
					}
				}
			}),'-','Element',new Ext.form.ComboBox({  
			    id	: 'choose-element',  
			    store: new Ext.data.JsonStore({  
				    autoLoad: false,
			    	url: '/{$toBackDoor}/costumeize/getElements/?json',
			    	root: 'data', 
			        fields : [{
				        name: 'id'
					},{
						name: 'element'
					}]  
			    }),  
			    valueField: 'element',  
			    displayField: 'element',
			      
			    //hiddenName: 'active_id',  
			    mode: 'remote',  
			    minChars : 0 ,
				width:140,
				listeners: {
					select: function(cb,r,i){
						
						loadCostume();
					}
				}
			}),'->','-',{
				text	: 'Import CSS',
				iconCls : 'x-icon-16x16-css',
				handler	: function(btn){
					var win = x4.BFFrame({
						title	: btn.text,
						src		: "/{$toBackDoor}/{$Xtra}/importCss",
						iconCls	: 'x-icon-16x16-css'
					}); 
				}

			},'-',{
				text: 'Create New Costume',
				iconCls	: 'x-icon-16x16-new',
				handler	: function(){
					var win = x4.Window({
						title	: 'Creating a New Costume',
						iconCls	: 'x-icon-16x16-new',
						width	: 300,
						height	: 150,
						modal	: true,
						items	: [{
							xtype	: 'form',
							layout	: 'form',
							frame	: true,
							items	: [new Ext.form.ComboBox({  
							    fieldLabel: 'Copy Costume',
							    id	: 'copy-theme',  
							    store: new Ext.data.JsonStore({  
							    	url: '/{$toBackDoor}/costumeize/getThemes/?returnJson',
							    	root: 'data', 
							        fields : [{
								        name: 'id'
									},{
										name: 'name'
									}]  
							    }),  
							    valueField: 'id',  
							    displayField: 'name',
							    emptyText: 'Leave Blank for None',  
							    //hiddenName: 'active_id',  
							    mode: 'remote',  
							    minChars : 0  
							}),{
								fieldLabel: 'Label Costume',
								id		: 'label-theme',
								allowBlank: true,
								anchor	: '100%',
								xtype	: 'textfield'
							}],
							buttons	: [{
								text		: 'Create Costume',
								bindForm	: true,
								handler		: function(){
									var theme = Ext.getCmp('label-theme').getValue();
									var copy = Ext.getCmp('copy-theme').getValue();
									Ext.Msg.wait('Creating Costume','Please wait...');
									$.post('/{$toBackDoor}/costumeize/newTheme/'+theme+'/'+copy,{},function(data) {
										Ext.Msg.alert('Success!',' New Costume has been Created!');
										win.close();
									});
								}
							}]

						}]
					}).show();
				}
			}];

			var row_editor = new Ext.ux.grid.RowEditor({
		        saveText: 'Update'
		    });
			

			var column = new Ext.grid.ColumnModel({
			    defaults: {
			    width	: 100,
			    sortable: true,
			    editable: true,
			    editor	: new Ext.form.TextField({
			    	selectOnFocus	: true   
			    })
			},
			columns: {$columns}
			});
 
			var editor = new Ext.grid.EditorGridPanel({
				stateful		: true,
				region			: 'center',
				id				: 'css-editor-grid',
				loadMask		: true,
				clicksToEdit	: 'auto',
				store			: this.store,
				//plugins			: [row_editor],
			    colModel		: column,
			    viewConfig: {
			        forceFit	: false,
			        autoScroll	: true, 
			    },
			    view: new Ext.ux.grid.BufferView({
				    // custom row height
				    rowHeight: 34,
				    // render rows as they come into viewable area.
				    scrollDelay: false
			    }),
		        //view: new Ext.ux.grid.LockingGridView(),
			    sm: new Ext.grid.RowSelectionModel({
				    singleSelect:false 
				}),
				listeners: { 
			    	afterEdit: function(e){
						//e.record.commit();
						//updatedElement(e.record);
	            	}
				}
			});
			this.items	= [editor];	

			this.bbar = new Ext.ux.StatusBar({
			    id: 'css-editor-statusbar',
			    // defaults to use when the status is cleared:
			    defaultText: 'Click to Edit Element\'s Settings',
			    //defaultIconCls: 'default-icon',
			    // values to set initially:
			    //iconCls: 'x-icon-16x16-check',
			    // any standard Toolbar items:
			    items: ['-']
			});
			
			x4.editCss.superclass.initComponent.call(this);
		}
	});
	Ext.onReady(function(){

		Ext.state.Manager.setProvider(new Ext.state.CookieProvider({
		    expires: new Date( new Date().getTime() + (1000*60*60*24*365) ), //365 days from now
		}));

		costume = '{$www_costume}';
		
		var pan = x4.Window({
			title		: 'Advanced Costume Editor',
			id			: 'adv-editor',
			iconCls		: 'x-icon-16x16-page_white_paint',
			maximized	: true,
			layout		: 'border',
			items		: [new x4.editCss({
				region	: 'south',
				split	: true,
				height	: 200
			}),new Ext.ux.IFrameComponent({
				region	: 'center',
				border	: false,
				width	: '100%',
				height	: '100%',
				layout	: 'fit',
				title	: 'Click something that you would like to edit.',
				iconCls	: 'x-icon-mouse',
				name	: 'style_iframe',
				id		: 'style_iframe',
				style	: 'background-color: white',
				//onload	: 'loadFrame()',
				url	: '/'
			})]
		}).show(document.body,function(){
			Ext.getCmp('adv-choose-themes').getStore().load();

			
			Ext.getCmp('adv-choose-themes').setValue(costume);
			
			var costume_store 	= Ext.getCmp('css-editor-grid').getStore(); 

			costume_store.setBaseParam('costume',costume);			
			costume_store.load({
				params : {
					costume : costume
				}
			});
 
		});
	});
--></script>