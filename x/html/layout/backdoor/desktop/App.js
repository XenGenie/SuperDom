{* This File is Templated. *}
Ext.define('MyDesktop.App', {
    extend: 'Ext.ux.desktop.App',

    requires: [
        'Ext.window.MessageBox',

        'Ext.ux.desktop.ShortcutModel',

        'MyDesktop.SystemStatus',
        'MyDesktop.VideoWindow',
        'MyDesktop.GridWindow',
        'MyDesktop.TabWindow',

//        'MyDesktop.Login',
        'MyDesktop.AccordionWindow',
        'MyDesktop.Notepad',
        'MyDesktop.BogusMenuModule',
        'MyDesktop.BogusModule',

//        'MyDesktop.Blockalanche',
        'MyDesktop.Settings',
        'MyDesktop.Axis'
    ],

    init: function() {
        // custom logic before getXYZ methods get called...

        this.callParent();
        
        
        
        History.pushState({
            url : location.pathname+location.hash,
            state : new Date().getTime()
        },'{$action}:{$method}',location.pathname/*+location.hash*/);

        // now ready...
        m = $('#dombar');
        m.css({ bottom : 0 }); // $(window).height() - $('#zyx-content').height()
        
        //m.center(null,'b');

        $('#dom-cuts').width($('#dom-cuts li').offset().width * $('#dom-cuts li').length);
        
        $('#dom-cuts').parent().show().end().center(true,'b').parent().hide().fadeIn(); 
    

        $('.loader').animate({
            opacity : 0
        },777,function  () {
            $('.loader').remove();
        })

        $cut = $('#dummy-drop-cut');
        $cut.droppable({
            accept      : "#zyx-content > div",
            drop : function  (e,ui) {
                // We drop the icon here. we should updated it to show that its on the bar...
                var icon = ui.draggable, id = icon.attr('id').split('-'); 
 
                var  id = icon.attr('id').split('-');
                $$.xWwwSetup.addIconToBar(id[id.length-1], function  () {

                    var li = $('<li/>')
                        .prependTo('#dom-cuts')
                        .addClass('i_animate')
                        .css({ float : 'left'})
                        .attr({ id   :  icon.attr('id') });

                    var a = $('<a/>').appendTo(li).attr({
                        'href' : '#/{$toBackDoor}/'+icon.find('a').attr('href')
                    });

                    var img = $('<img/>').appendTo(a).attr({
                        src : icon.find('img').attr('src')
                    }).addClass(icon.find('div').attr('class'));

                    icon.remove();
                }); 
            },
            over: function( event, ui ) {
                var d = $('#dummy-drop-cut');
                 
                $cut.boxShadow =  d.css('boxShadow'); 
                d.css({
                    height    : 100,
                    top       : -30,
                    opacity   : .9,
                    boxShadow : "0 0 25px rgb(56, 146, 211), inset 0px 10px 12px rgba(134,234,255,1),inset -5px 5px 10px rgba(0,0,0,.25)"
                });
            }, 
            out: function( event, ui ) {
                var d = $('#dummy-drop-cut');
                d.css({
                    height    : 70,
                    top       : 0,
                    boxShadow : $cut.boxShadow
                });
            } 
        });

        $trash = $('#trash-bin');

        $trash.hide().droppable({
            accept         : "#zyx-content > div, #dom-cuts > li",
            hoverClass     : "trash-bin-active", 
            // activeClass : "trash-bin-active", 
            drop: function( event, ui ) { 
                var icon = ui.draggable, id = icon.attr('id').split('-'); 
                //icon.draggable('destroy');

               
                $$.xWwwSetup.removeIcon(id[id.length-1], function  () {
                    icon.remove();
                    // $('#dombar').height( $('#dom-cuts').height() );
                    // $('#dom-cuts').center();
                    // $('#dombar').height( 0 );
                }); 

                $trash.css({
                    height    : 70,
                    top       : 0,
                    zIndex    : 0,
                    opacity    : 0,

                    boxShadow : $trash.boxShadow
                });

                $('#pad-lock').css({ 
                    display : 'inline-block',
                    opacity : 1,
                    zIndex  : 4
                });
            },
            over: function( event, ui ) {
                var t = $('#trash-bin');
                 
                $trash.boxShadow =  t.css('boxShadow'); 
                t.css({
                    height    : 100,
                    top       : -30,
                    opacity   : .5,
                    boxShadow : "0 0 25px rgb(56, 146, 211), inset 0px 10px 12px rgba(134,234,255,1),inset -5px 5px 10px rgba(0,0,0,.25)"
                });
            }, 
            out: function( event, ui ) {
                var t = $('#trash-bin');
                t.css({
                    height    : 70,
                    top       : 0,
                    boxShadow : $trash.boxShadow
                });
            } 
        });

        myDesktopApp.desktop.taskbar.startMenu.backupMenu = myDesktopApp.desktop.taskbar.startMenu.menu;

        // Align Start menu...
        $('.ux-start-menu').css({ left : 5, top : $('.ux-start-menu').css('top') - 5 });
        $('#dom-cuts').sortable({
            items       : "> li:not(.dontSort)",
            placeholder : "ui-dom-placeholder",
            axis        : "x",
            start       : function  (e,ui) {
                ui.helper.removeClass('i_animate');
                ui.helper.css({ top: 0, height: 70, zIndex : 4, opacity: .75, float: 'left'});
                $('#trash-bin').css({ 
                    display: 'inline-block',
                    opacity: 1,

                    zIndex : 5
                });
                $('#pad-lock').css({  
                    opacity: 0,
                    zIndex : 0
                });
                
            },
            stop : function  (e,ui) {
                ui.item.addClass('i_animate');
                ui.item.css({ bottom: 0});
                ui.item.attr({ style: '' })
                $$.xNavigation.updateIconOrder($('#dom-cuts').sortable('toArray'));

                $('#trash-bin').css({ opacity: 0,
                    zIndex : 0 });
                $('#pad-lock').css({ 
                    display: 'inline-block',
                    opacity: 1,
                    zIndex : 4
                });

               

            }
        });
    },

    getModules : function(){
        return [
            new MyDesktop.VideoWindow(),
            //new MyDesktop.Blockalanche(),
           // new MyDesktop.SystemStatus(),
            new MyDesktop.GridWindow(),
            new MyDesktop.Axis(),
           // new MyDesktop.TabWindow(),
            new MyDesktop.AccordionWindow(),
//            new MyDesktop.Login(),
            new MyDesktop.Notepad(),
            new MyDesktop.BogusMenuModule(),
            new MyDesktop.BogusModule()
        ];
    },

    getDesktopConfig: function () {
        var me = this, ret = me.callParent();

        // var AxisModel = Ext.define('AxisModel', {
        //     extend: 'Ext.data.Model',
        //     fields: [
        //        { name: 'id' },
        //        { name: 'title' },
        //        { name: 'icon' }
        //     ]
        // });


        x4.direct('xNavigation');

        var AxisModel = Ext.define('AxisModel', {
            extend: 'Ext.data.Model',
            fields: [
               { name: 'id' },
               { name: 'link' },
               { name: 'title' },
               { name: 'description' },
               { name: 'icon' },
               { name: 'top' },
               { name: 'left' }
            ]
        });

        me.store = Ext.create('Ext.data.Store', {
            model: 'AxisModel', 
            //id : 'zyx-content',
            autoLoad : false,
            proxy: {
                //type: 'ajax',
                //url: './navigation/getAxis/.json',
                type: 'direct',
                directFn: $$.xNavigation.getAxis,
                    //paramOrder: 'id' // Tells the proxy to pass the id as the first parameter to the remoting method.
                
                reader: {
                    type: 'json',
                    root: 'result'
                }
            },
            listeners : {
                load : {
                    fn : function  () {
                        $( "#zyx-content" ).sortable({
                          connectWith: ".connectDomCuts"
                        });
                        $( "#zyx-content").droppable({
                            tolerance: 'fit'
                        });

                        $( "#zyx-content > div" ).draggable({
                            snap        : true,
                            snapMode    : "outer",
                            grid        : [5,5],
                            containment : 'zyx-content',
                            revert      : 'invalid',
                            start       : function  (event, ui) {
                                // Show Trash  
                                //$(this).css({ zIndex : 9999999 }); 
                                $('#trash-bin').css({ 
                                    display: 'inline-block',
                                    opacity: 1
                                });


                                $('#pad-lock').css({  
                                    opacity: 0,
                                    zIndex : 0
                                });
                                

                                $('#dummy-drop-cut').css({ 
                                    display: 'inline-block',
                                    opacity: .5
                                }).addClass(ui.helper.find('div').attr('class')) 

                                
                                ui.helper.bind("click.prevent",
                                function(event) { event.preventDefault(); });
                            },
                            stop: function(event, ui) { 

                                setTimeout(function(){ ui.helper.unbind("click.prevent"); }, 300); 

                                $('#trash-bin').css({ opacity: 0 });
                                $('#pad-lock').css({ 
                                    display: 'inline-block',
                                    opacity: 1,
                                    zIndex : 4
                                });
                                $('#dummy-drop-cut').css({ 
                                    display: 'none',
                                    opacity: 0
                                }).removeClass(ui.helper.find('div').attr('class'));


                                $(this).css({ zIndex : 1 });

                                var id = $(this).attr('id').split('-');
                                id     = id[id.length-1]; 

                                $(this).draggable('option','revert','invalid'); 

                                $$.xNavigation.updateIconCords(id,$(this).css('left'),$(this).css('top'));

                            }
                        }).droppable({
                            greedy    : true, 
                            tolerance : 'intersect',
                            drop      : function(event,ui){
                                ui.draggable.draggable('option','revert',true);
 

                            }
                        });


                        // $( "#zyx-content > div" ).addClass('im_animated');

                        // Move the icons back to their saved positions.
                        $( "#zyx-content > div" ).each(function  () { 
                            if($(this)[0].getAttribute('top') > 0 && $(this)[0].getAttribute('left') > 0 ){
                                

                                $(this).css({
                                    position : 'absolute',
                                });
                                 $(this).center(true).center();

                                $(this).addClass('im_animated');

                                $(this).animate({
                                    top      : $(this)[0].getAttribute('top')*1,
                                    left     : $(this)[0].getAttribute('left')*1
                                }).removeClass('im_animated');
                                 // $( "#zyx-content > div" ).addClass('im_animated');
                                // alert($(this)[0].getAttribute('left'));
                            }
                        });

                    }
                }
            }
        });
        //me.store.load();

        return Ext.apply(ret, {
            //cls: 'ux-desktop-black',

            contextMenuItems: [
                { text: 'Change Settings', handler: me.onSettings, scope: me }
            ], 
            shortcuts: me.store,  

            wallpaper        : '/bin/images/bgs/full/future.jpg',
            wallpaperStretch : false
        });
    },

    // config for the start menu
    getStartConfig : function() {
        var me = this, ret = me.callParent();

        // return Ext.apply(ret, {
        //     title: 'Don Griffin',
        //     iconCls: 'user',
        //     height: 300,
        //     toolConfig: {
        //         width: 100,
        //         items: [
        //             {
        //                 text:'Settings',
        //                 iconCls:'settings',
        //                 handler: me.onSettings,
        //                 scope: me
        //             },
        //             '-',
        //             {
        //                 text:'Logout',
        //                 iconCls:'logout',
        //                 handler: me.onLogout,
        //                 scope: me
        //             }
        //         ]
        //     }
        // });

        // Ext.each(me.modules, function (module) {
        //     launcher = module.launcher;
        //     if (launcher) {
        //         launcher.handler = launcher.handler || Ext.bind(me.createWindow, me, [module]);
                
        //     }
        // });
        ret.original_menu = [];
        {foreach $admin_menu as $key => $item}
              
              ret.original_menu.push({
                text    : '{$item.area|ucfirst}',
                iconCls : 'x-icon-16x16-{$key}',
                handler : function() {
                    return false;
                },
                menu: {
                    items:[
                    {foreach $xtras as $x => $xtra}
                        {if $xtra.icon && $key == $xtra.see}
                        {
                            text          : '{$xtra.name}', 
                            iconCls       : 'x-icon-16x16-{$xtra.mini|replace:".png":""}',
                            id            : '{$xtra.name}',
                            scale         : 'large',
                            scope         : this,
                            windowId      : 'window-'+'{$xtra.name}',
                            handler       : function(){
                                location.hash = '#/{$toBackDoor}/{$xtra.link}';
                            }
                        },
                        {/if}
                    {/foreach}
                    ]
                }
            });

        {/foreach} 

        for (var i = 0; i <= ret.original_menu.length; i++) { 
            ret.menu.push(ret.original_menu[i]);  
        };


        ret.allMenuItems = [];
        {foreach $xtras as $x => $xtra}
            ret.allMenuItems.push({
                text          : '{$xtra.name}', 
                iconCls       : 'x-icon-16x16-{$xtra.mini|replace:".png":""}',
                // id            : '{$xtra.name}',
                scale         : 'large',
                scope         : this,
                windowId      : 'window-'+'{$xtra.name}',
                handler       : function(){
                    location.hash = '#/{$toBackDoor}/{$xtra.link}';
                }
            });
        {/foreach}
        

        return Ext.apply(ret, {
            // title: 'Welcome '+Ext.util.Cookies.get('user[username]'),
            // title   : '-> @pp Categories',
            // iconCls : 'x-icon-16x16-rainbow',
            header : false,
            toolConfig: {
                xtype    : 'menu',
                // width    : 125,
                // height   : 280,
                title : 'Top Ten',
                defaults : {
                
                },
                items: [ {foreach $top_ten as $x => $xtra} 
                {
                    tooltip          : '{$xtra.name}', 
                    iconCls       : 'x-icon-16x16-{$xtra.mini|replace:".png":""|strtolower|replace:" ": "_"}',
                    id            : 'top-ten-{$xtra.name}',
                    
                    scope         : this,
                    windowId      : 'window-'+'{$xtra.name}',
                    handler       : function(){
                        {*
                            // Remove the Map if found - causes weird bug that should be fixed.
                            // But if people are using the button menu, the tutorial should end anyway.
                        *}

                        if($('#zyx-content'))
                            $('#zyx-content').html('');
                        location.hash = '#/{$toBackDoor}/{$xtra.link}';
                    }
                },{/foreach}]
                
            }
        });

    },

    getTaskbarConfig: function () {
        var ret = this.callParent();

        return Ext.apply(ret, {
            quickStart: [
                /*{ name: 'Manage Axis', iconCls: 'x-icon-16x16-add_small', module: 'axis-win' },
                { name: 'Grid Window', iconCls: 'icon-grid', module: 'grid-win' }*/
            ],
            trayItems: [
                { xtype: 'trayclock', flex: 1 }
            ]
        });
    },

    onLogout: function () {
        Ext.Msg.confirm('Logout', 'Are you sure you want to logout?');
    },

    onSettings: function () {
        var dlg = new MyDesktop.Settings({
            desktop: this.desktop
        });
        dlg.show();
    }
});
