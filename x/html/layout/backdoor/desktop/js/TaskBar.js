/*!
 * Ext JS Library 4.0
 * Copyright(c) 2006-2011 Sencha Inc.
 * licensing@sencha.com
 * http://www.sencha.com/license
 */

/**
 * @class Ext.ux.desktop.TaskBar
 * @extends Ext.toolbar.Toolbar
 */
Ext.define('Ext.ux.desktop.TaskBar', {
    // This must be a toolbar. we rely on acquired toolbar classes and inherited toolbar methods for our
    // child items to instantiate and render correctly.
    extend: 'Ext.toolbar.Toolbar',

    requires: [
        'Ext.button.Button',
        'Ext.resizer.Splitter',
        'Ext.menu.Menu',
        'Ext.ux.desktop.StartMenu'
    ],

    alias : 'widget.taskbar',
    cls   : 'ux-taskbar',

    /**
     * @cfg {String} startBtnText
     * The text for the Start Button.
     */
    startBtnText: '',

    initComponent: function () {
        var me        = this;        
        me.startMenu  = new Ext.ux.desktop.StartMenu(me.startConfig);
        me.quickStart = new Ext.toolbar.Toolbar(me.getQuickStart());        
        me.windowBar  = new Ext.toolbar.Toolbar(me.getWindowBarConfig());        
        me.tray       = new Ext.toolbar.Toolbar(me.getTrayConfig());
        me.button     = {
            xtype   : 'button',
            cls     : 'ux-start-button',
            iconCls : 'x-icon-16x16-rainbow',
            scale   : 'small',
            menu    : me.startMenu,
            width   : 25,         
            menuAlign : 'tl-tl',
            listeners    : {
                click    : {
                    fn: function  () {
                        Ext.getCmp('app-search').focus();
                    }
                }
            }
            // text      : me.startBtnText
        };

        me.items      = [
            me.button,
            // me.quickStart,
            me.windowBar,
            me.tray
        ];

        me.autoShow = false;

        me.callParent();
    },

    afterLayout: function () {
        var me = this;
        me.callParent();
        me.windowBar.el.on('contextmenu', me.onButtonContextMenu, me);
    },

    /**
     * This method returns the configuration object for the Quick Start toolbar. A derived
     * class can override this method, call the base version to build the config and
     * then modify the returned object before returning it.
     */
    getQuickStart: function () {
        var me = this, ret = {
            minWidth: 20,
            width: Ext.themeName === 'neptune' ? 70 : 60,
            items: [],
            enableOverflow: true
        };

        Ext.each(this.quickStart, function (item) {
            ret.items.push({
                tooltip      : { text: item.name, align: 'tl-br' },
                tooltip      : item.name,
                overflowText : item.name,
                iconCls      : item.iconCls,
                module       : item.module,
                handler      : me.onQuickStartClick,
                scope        : me
            });
        });

        return ret;
    },

    /**
     * This method returns the configuration object for the Tray toolbar. A derived
     * class can override this method, call the base version to build the config and
     * then modify the returned object before returning it.
     */
    getTrayConfig: function () {
        var ret = {
            items: this.trayItems
        };
        delete this.trayItems;
        return ret;
    },

    getWindowBarConfig: function () {
        return {
            flex: 1,
            cls: 'ux-desktop-windowbar',
            items: [ '&#160;' ],
            layout: { overflowHandler: 'Scroller' }
        };
    },

    getWindowBtnFromEl: function (el) {
        var c = this.windowBar.getChildByElement(el);
        return c || null;
    },

    onQuickStartClick: function (btn) {
        var module = this.app.getModule(btn.module),
            window;

        if (module) {
            window = module.createWindow();
            window.show();
        }
    },
    
    onButtonContextMenu: function (e) {
        var me = this, t = e.getTarget(), btn = me.getWindowBtnFromEl(t);
        if (btn) {
            e.stopEvent();
            me.windowMenu.theWin = btn.win;
            me.windowMenu.showBy(t);
        }
    },

    onWindowBtnClick: function (btn) {
        var win = btn.win;

        if (win.minimized || win.hidden) {
            btn.disable();
            win.show(null, function() {
                btn.enable();
            });
        } else if (win.active) {
            btn.disable();
            win.on('hide', function() {
                btn.enable();
            }, null, {single: true});
            win.minimize();
        } else {
            win.toFront();
        }
    },

    addTaskButton: function(win) {
        var config = {
            iconCls      : win.iconCls,
            enableToggle : true,
            toggleGroup  : 'all',
            width        : 24,
            margins      : '0 2 0 3',
            cls: 'i_animate',
            text         : Ext.util.Format.ellipsis(win.title, 20),
            listeners    : {
                click : this.onWindowBtnClick,
                scope : this,
                mouseover : {
                    fn : function  (btn) {
                        btn.setSize({ width : btn.el.getTextWidth() + 30 });
                    }
                },
                mouseout : {
                    fn : function  (btn) {
                        setTimeout(function  () {
                            btn.setSize({ width : 24 });
                        },1777);
                    }
                }
            },
            win: win
        };

        var cmp = this.windowBar.add(config);
        cmp.toggle(true);
        return cmp;
    },

    removeTaskButton: function (btn) {
        var found, me = this;
        me.windowBar.items.each(function (item) {
            if (item === btn) {
                found = item;
            }
            return !found;
        });
        if (found) {
            me.windowBar.remove(found);
        }
        return found;
    },

    setActiveButton: function(btn) {
        if (btn) {
            btn.toggle(true);
        } else {
            this.windowBar.items.each(function (item) {
                if (item.isButton) {
                    item.toggle(false);
                }
            });
        }
    }
});

/**
 * @class Ext.ux.desktop.TrayClock
 * @extends Ext.toolbar.TextItem
 * This class displays a clock on the toolbar.
 */
Ext.define('Ext.ux.desktop.TrayClock', {
    extend: 'Ext.toolbar.TextItem',

    alias: 'widget.trayclock',

    cls: 'ux-desktop-trayclock',

    html: '&#160;',

    timeFormat: 'g:i:s A',

    tpl: '{time}',

    initComponent: function () {
        var me = this;

        me.callParent();

        if (typeof(me.tpl) == 'string') {
            me.tpl = new Ext.XTemplate(me.tpl);
        }
    },

    afterRender: function () {
        var me = this;
        Ext.Function.defer(me.updateTime, 100, me);
        me.callParent();
    },

    onDestroy: function () {
        var me = this;

        if (me.timer) {
            window.clearTimeout(me.timer);
            me.timer = null;
        }

        me.callParent();
    },

    updateTime: function () {
        var today  = new Date();
        var zodiac = ['&#9809;','&#9810;','&#9811;','&#9800;','&#9801;','&#9802;','&#9803;','&#9804;','&#9805;','&#9806;','&#9807;','&#9808;'];
        var trans  = ['20','19','20','20','21','21','23','23','23','23','22','21'];
        
        var sign   = (trans[today.getMonth()] >= today.getDate()) ? zodiac[today.getMonth()] 
                   : (today.getMonth()+1 <= 11) ? zodiac[today.getMonth()+1] : zodiac[0];

        var me     = this, month = Ext.Date.format(new Date(), "l, F jS"), time = Ext.Date.format(new Date(), me.timeFormat),
        
        text = me.tpl.apply({ time:  time + ' ' + sign+ ' ' + month });
        if (me.lastText != text) {
            me.setText(text);
            me.lastText = text;
        }
        me.timer = Ext.Function.defer(me.updateTime, 1000, me);
    }
});
