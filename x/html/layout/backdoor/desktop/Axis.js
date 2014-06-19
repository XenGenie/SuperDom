/*!
 * Ext JS Library 4.0
 * Copyright(c) 2006-2011 Sencha Inc.
 * licensing@sencha.com
 * http://www.sencha.com/license
 */

Ext.define('MyDesktop.Axis', {
    extend: 'Ext.window.Window',

    uses: [
        'Ext.tree.Panel',
        'Ext.tree.View',
        'Ext.form.field.Checkbox',
        'Ext.layout.container.Anchor',
        'Ext.layout.container.Border',
    ],


    id:'axis-win',

    layout : 'anchor',
    title  : 'Manage @xis',
    modal  : true,
    width  : 640,
    height : 480,
    border : false,

    initComponent: function () {
        this.callParent();
        
    },

    createWindow : function(){

        var me = this;

        // me.selected = me.desktop.getWallpaper();
        // me.stretch = me.desktop.wallpaper.stretch;

        me.preview = Ext.create('widget.wallpaper');
        me.preview.setWallpaper(me.selected);
        me.tree = me.createTree();

        me.buttons = [
            { text: 'OK', handler: me.onOK, scope: me },
            { text: 'Cancel', handler: me.close, scope: me }
        ];

        me.items = [];
        //me.callParent();


        var desktop = this.app.getDesktop();
        var win = desktop.getWindow('axis-win');
        if(!win){
            win = desktop.createWindow({
                width     : 500,
                height    : 500,
                id        : 'axis-win',
                maximized : true,
                title     : 'Manage Axis',
                iconCls   : 'x-icon-16x16-add_small',
                anchor    : '0 -30',
                border    : false,
                layout    : 'border',
                items     : [
                    this.tree,
                    {
                        xtype: 'panel',
                        title: 'Preview',
                        region: 'center',
                        layout: 'border',
                        items: [ this.preview]
                    }
                ]
            })
        }
        return win;
    },

    createTree : function() {
        var me = this;

        function child (img) {
            return { img: img, text: me.getTextOfWallpaper(img), iconCls: '', leaf: true };
        }

        var tree = new Ext.tree.Panel({
            title       : 'Category',
            rootVisible : false,
            lines       : false,
            autoScroll  : true,
            width       : 175,
            region      : 'east',
            split       : true,
            minWidth    : 100,
            listeners   : {
                afterrender: { fn: this.setInitialSelection, delay: 100 },
                select: this.onSelect,
                scope: this
            },
            store: new Ext.data.TreeStore({
                model: 'MyDesktop.WallpaperModel',
                root: {
                    text:'Wallpaper',
                    expanded: true,
                    children:[
                        //{ text: "None", iconCls: '', leaf: true },
                        child('blue-green-dome-horizon.jpg'),
                        child('Blue-Sencha.jpg'),
                        child('Dark-Sencha.jpg'),
                        child('Wood-Sencha.jpg'),
                        child('blue.jpg'),
                        child('desk.jpg'),
                        child('desktop.jpg'),
                        child('desktop2.jpg'),
                        child('sky.jpg')
                    ]
                }
            })
        });

        return tree;
    },

    getTextOfWallpaper: function (path) {
        var text = path, slash = path.lastIndexOf('/');
        if (slash >= 0) {
            text = text.substring(slash+1);
        }
        var dot = text.lastIndexOf('.');
        text = Ext.String.capitalize(text.substring(0, dot));
        text = text.replace(/[-]/g, ' ');
        return text;
    },

    onOK: function () {
        var me = this;
        if (me.selected) {
            me.desktop.setWallpaper(me.selected, me.stretch);
        }
        me.destroy();
    },

    onSelect: function (tree, record) {
        var me = this;

        if (record.data.img) {
            me.selected = '/x/html/layout/backdoor/desktop/wallpapers/' + record.data.img;
        } else {
            me.selected = Ext.BLANK_IMAGE_URL;
        }

        me.preview.setWallpaper(me.selected);
    },

    setInitialSelection: function () {
        
    }
});