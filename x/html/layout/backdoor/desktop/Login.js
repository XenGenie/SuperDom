/*!
 * Login JS Window
 * Ext JS Library 4.0
 * Copyright(c) 2006-2011 Sencha Inc.
 * licensing@sencha.com
 * http://www.sencha.com/license
 */

Ext.define('MyDesktop.Login', {
    extend: 'Ext.ux.desktop.Module',

    requires: [
        'Ext.tab.Panel'
    ],

    id:'login-win',

    init : function(){
        this.launcher = {
            text: 'Login',
            iconCls:'tabs'
        };
 
    },
 
    createWindow : function(){  
        function login (){
            Ext.getCmp('login-form').getForm().submit(
            {
               // waitMsg     : 'Please Wait...', 
                //waitTitle   : 'Authenticating...', 
                failure     : function(fp,a){
                    action = a;
                    Ext.Msg.show({
                        title   :'Login Failed!',
                        msg     : (a.result.error) ? a.result.error : a.result.msg,
                        buttons : Ext.Msg.OK,  
                        icon    : Ext.MessageBox.ERROR
                    }); 
                },
                success : function(fp,a){ 
                    var r = a.result;
                    if(r.IS_USER && r.IS_ADMIN){ 
                        Ext.Msg.wait(' ','Welcome '+ Ext.util.Cookies.get('user[username]')+'!',{
                            interval    : 50,
                            increment   : 1,
                            text        : 'Opening SuperDom ~ '
                        });
                        
                        // Lets load the admin bar again here...
                        $('#dom-cuts').load('./ #dom-cuts li');
                    }else{
                        Ext.Msg.wait(' ','Credentials Entered!',{
                            interval    : 50,
                            increment   : 1,
                            text        : 'Creating Super Admin'
                        });
                    }
                    // Ext.getCmp('login-win').hide();


                    // we probably have a process waiting... we should push this to the History...
                     
                    if("{$after_login}"==="/{$toBackDoor}/"){
                        {if $SUPER_ADMIN === false}
                            Ext.getCmp('login-win').destroy();
                            //Ext.Msg.alert('{$LANG.LOGIN.ADMIN_CREATED}','{$LANG.LOGIN.LOGIN_TITLE}');
                            Ext.Msg.hide();

                            History.pushState({
                                url : location.pathname
                            },'Welcome to SuperDom',location.pathname);
                        {else}
                            Ext.getCmp('zyx-content').getStore().load({
                                callback: function(records, operation, success) {
                                    // the operation object
                                    // contains all of the details of the load operation
                                    Ext.getCmp('login-win').close();
                                    Ext.Msg.hide();
                                }
                            });
                        {/if}

                    }else{ 
                        Ext.getCmp('login-win').close();
                        Ext.Msg.hide();
                         
                        History.pushState({
                            state : new Date().getTime(),
                            url : location.pathname
                        },'{$HTML.HEAD.TITLE}',location.pathname);
                    } 
                }
            });
        }

        var form = new Ext.form.FormPanel({
            layout      : 'form',
            region      : 'center',
            id          : 'login-form',
            url         : "./.json",
            defaultType : 'textfield',
            labelWidth  : 20,
            border      : 0,
            frame       : true,
            padding     : 5,
            autoWidth: true,
            autoHeight: true,
            layout: 'form',
            defaults    : {
                labelSeparator  : ' ',
                msgTarget       : 'side',
                enableKeyEvents : true,
                labelAlign      : 'right',
                labelWidth      : 20,
                listeners       : {
                    keydown : function(field,e){ 
                        HELLO = field;
                        if(e.getKey() == e.ENTER){
                            login();
                        }
                    }
                },
                padding : 0,
            },
            monitorValid : true,
            items   : [{
                //hideLabel : true,
                anchor      : '-55',
                fieldLabel  : '<img src="{$ICON.16}user.png" align="right"/>',
                blankValue  : 'Username',
                labelWidth  : 20,
                allowBlank  : false,
                minLength   : 4,
                autoFocus   : true,
                id          : 'username',
                name        : 'login[username]',
                blankText   : 'Please Enter your Username'
            },{
                fieldLabel  : '<img src="{$ICON.16}key.png" align="right"/>',
                //hideLabel : true,
                anchor      : '-50',
                allowBlank  : false,
                labelWidth  : 20,
                minLength   : 6,
                inputType   : 'password',
                blankValue  : 'password',
                name        : 'login[password]',
                blankText   : 'Please Enter your Password'
            } {if $SUPER_ADMIN === false}
            {* FRESH INSTALL *}
            ,{
                fieldLabel  : '<img src="{$ICON.16}key_go.png" align="right"/>',
                //hideLabel : true,
                anchor      : '-20',
                allowBlank  : false,
                minLength   : 6,
                inputType   : 'password',
                blankValue  : 'password',
                name        : 'login[confirm]',
                id          : 'login-confirm',
                blankText   : 'Please confirm your password',
                allowBlank: false,
                /**
                 * Custom validator implementation - checks that the value matches what was entered into
                 * the password1 field.
                 */
                validator: function(value) {
                    var password1 = this.previousSibling();
                    return (value === password1.getValue()) ? true : 'Passwords do not match.'
                }
            },{
                fieldLabel  : '<img src="{$ICON.16}mailbox.png" align="right"/>',
                //hideLabel : true,
                anchor      : '-20',
                allowBlank  : false,
                minLength   : 6,
                inputType   : 'textfield',
                vtype       : 'email',
                name        : 'login[email]',
                blankText   : 'Please Enter your Email Address'
            }
            {/if}],
            listeners   : {
                validitychange  : function(fp,bool,e){
                    var pan = Ext.getCmp('login-btn-area');
                    if(bool){
                        pan.expand();
                    }else{
                        pan.collapse(); 
                    } 
                }
            }
        });

        var desktop = myDesktopApp.getDesktop();
        var win = desktop.getWindow('login-win');
        if(!win){
            win = desktop.createWindow({
                {if $SUPER_ADMIN === false}
                title   : '{$LANG.LOGIN.CREATE_ADMIN}',
                iconCls : 'x-icon-16x16-shield_chevrons',  
                {else}
                title   : '{$LANG.LOGIN.LOGIN_TITLE}',
                iconCls : 'x-icon-16x16-lock',  
                {/if}
                
                id      : 'login-win',
                closable    : false, 
                maximizable : false,
                minimizable : false,
                autoWidth: true,
                autoHeight: true,
                modal   : true,
                layout  : 'border', 
               width   : {if $SUPER_ADMIN === false}500{else}400{/if},
                border  : 0,
               height  : {if $SUPER_ADMIN === false}225{else}130{/if},
                defaults    : {
                    border  : 0,
                },

                items   : [form ,{
                    region       : 'east',
                    id           : 'login-btn-area',
                    split        : true,
                    frame        : true,
                    width        : 125, 
                    border       : 0,
                    collapseMode : 'mini',
                    collapsed    : true,
                    layout       : {
                        type    :'vbox',
                        padding :'5',
                        align   :'stretch'
                    },
                    items   : [{
                        text      : '{$LANG.LOGIN.LOGIN_BTN}',
                        iconAlign : 'left',
                        scale     : 'large',
                        iconCls   : 'x-icon-32x32-lock_open',
                        xtype     : 'button',
                        flex      : 1,
                        handler   : function(){
                            login();
                        }
                    }]
                }]
            });
        }
        return win;
    }
});
