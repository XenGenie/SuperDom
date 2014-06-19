/*!
 * Ext JS Library 4.0
 * Copyright(c) 2006-2011 Sencha Inc.
 * licensing@sencha.com
 * http://www.sencha.com/license
 */

Ext.define('Ext.ux.desktop.StartMenu', {
    extend: 'Ext.panel.Panel',

    requires: [
        'Ext.menu.Menu',
        'Ext.toolbar.Toolbar',
        'Ext.ux.form.SearchField'
    ],
    
    ariaRole     : 'menu',
    
    cls          : 'x-menu ux-start-menu',
    
    defaultAlign : 'tl-tl',
    frame : false,
    iconCls      : 'user',
    
    floating     : true,
    
    shadow       : false,

    // We have to hardcode a width because the internal Menu cannot drive our width.
    // This is combined with changing the align property of the menu's layout from the
    // typical 'stretchmax' to 'stretch' which allows the the items to fill the menu
    // area.
    width  : 250,
    height : 305,
    initComponent: function() {
        var me = this, menu = me.menu;

        me.menu = new Ext.menu.Menu({
            cls      : 'ux-start-menu-body',
            border   : false,
            floating : false,
            title    : 'Everything Under the Rainbow',
            frame    : false, 
            iconCls  : 'x-icon-16x16-rainbow',
            items    : menu,
            tools   : [{
                type     : 'gear',
                tooltip  : 'Turn On Window Mode',
                menu : {
                    itmes : [{
                        xtype : 'checkbox',
                        text : 'Turn On Window Mode'
                    }]
                },
                callback : function(panel, tool, event) {
                    // show help here
                }
            }],
            tbar: [{
                hideLabel        : true,
                id              : 'app-search',
                xtype : 'searchfield',
                store         : Ext.create('Ext.data.Store', {
                    model: 'Post',
                    proxy: {
                        type: 'localstorage',
                        id  : 'app-searches'
                    },
                    listeners: {
                        
                    }
                }),
                // displayField  : 'state',
                // typeAhead     : true,
                // queryMode     : 'local',
                // triggerAction : 'all',
                emptyText        : '',
                selectOnFocus    : true,
                width            : '100%',
                indent           : true,
                dock             : 'south',
                enableKeyEvents  : true,
                
                onTrigger1Click : function(){ 

                    if (this.hasSearch) {
                        this.setValue('');
                        //me.store.clearFilter();
                        this.hasSearch = false;
                        this.triggerCell.item(0).setDisplayed(false);
                        this.updateLayout();

                        me.menu.removeAll();
                        for (var i = 0; i < me.original_menu.length; i++) {
                           me.menu.add(me.original_menu[i]);
                        };

                    }
                },
                listeners : {  
                    keyup : {
                        fn : function  (txt,e) { 
                            // Resusable search method 
                            this.hasSearch = true;
                            this.triggerCell.item(0).setDisplayed(true);

                            if(e.keyCode === e.ENTER){
                                $('#zyx-content').html('');
                                var m = me.menu.items.items[0];
                                $('#'+m.el.el.id+' span').click()
                                txt.setValue('');
                            }

                            function findMe(i,s){
                                return ( i.toLowerCase().indexOf(s.toLowerCase()) );
                            }

                            var find  = txt.getValue(), $results = []; 

                            me.menu.removeAll();

                            if(find != ''){
                                // Find Whole words first.
                                Ext.Array.each(me.allMenuItems,function  (item,index,all) {
                                    if(typeof this.text != "undefined"){
                                        search_this = this.text; 

                                        // Find Whole Words First...
                                        var look = findMe(search_this,find);

                                        if(look > -1){
                                            // Push it to the menu. 
                                            $results[this.text] = this; 
                                            // x4.log(search_this);
                                            me.menu.add(this); 
                                        }
                                    }
                                }); 

                                // Then Use other matches
                                Ext.Array.each(me.allMenuItems,function  (item,index,all) {
                                    if(typeof this.text != "undefined"){

                                        search_this = this.text; 

                                        // Look for any matching letters now...
                                        // Split this Up and look for other combos.
                                        // we need the result to match all letters., anywhere

                                        var look = Ext.Array.each(find.split(''),function  () { 
                                            if(findMe(search_this,this) == -1){
                                                return false;
                                            }
                                        });

                                        // Here is where we make individual letters bold.
                                        if(look === true && typeof $results[this.text] == 'undefined' ){  
                                            var letters = find.split(''), t = null, added = me.menu.add(this);  

                                            t = added.text; 
                                            t = t.split(''); 

                                            for (var i = t.length - 1; i >= 0; i--) {
                                                for (var l = 0; l < letters.length; l++) {
                                                    if(t[i] == letters[l].toLowerCase()){
                                                        t[i] = '<b><u>'+t[i]+'</u></b>'
                                                    }else if(t[i] == letters[l].toUpperCase()){ 
                                                        t[i] = '<b><u>'+t[i]+'</u></b>'
                                                    }else{
                                                        t[i] = '<i>'+t[i]+'</i>';
                                                    }
                                                }
                                            };

                                            t = t.join('');
                                            added.setText(t); 
                                        }
                                    }
                                }); 
                            }else{
                                for (var i = 0; i < me.original_menu.length; i++) {
                                   me.menu.add(me.original_menu[i]);
                                };
                            }


                        }
                    }
                }
            }]
        });
        me.menu.layout.align = 'stretch';





        me.frame = false;
        me.bodyStyle = 'background: transparent;';
 


        me.items = [me.menu];
        me.layout = 'fit';

        Ext.menu.Manager.register(me);
        me.callParent();
        // TODO - relay menu events

        me.toolbar = new Ext.toolbar.Toolbar(Ext.apply({
            dock      : 'left',
            cls       : 'ux-start-menu-toolbar',
            vertical  : true,
            // width  : 100,
            frame     : false,

            style     : 'background: rgba(0,0,0,.55)',
            listeners : {
                add: function(tb, c) {
                    c.on({
                        click: function() {
                            me.hide();
                        }
                    });
                }
            }
        }, me.toolConfig));

        me.toolbar.layout.align = 'stretch';
        me.addDocked(me.toolbar);

        // me.searchApps.layout.align = 'stretch';
        // me.addDocked(me.searchApps);

        window.addEventListener('keydown',function(e){
            // LISTEN TO SHORTCUTS
            if(e.ctrlKey && (e.keyCode == 192 || e.keyCode == 18 || e.keyCode == 91) || e.keyCode == 91){
                $('.ux-start-button span').click()   
            }
        })


        delete me.toolItems;
    },

    addMenuItem: function() {
        var cmp = this.menu;
        cmp.add.apply(cmp, arguments);
    },

    addToolItem: function() {
        var cmp = this.toolbar;
        cmp.add.apply(cmp, arguments);
    }
}); // StartMenu
