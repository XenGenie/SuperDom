if (typeof self != 'undefined') {
    //Browser
    if (typeof os == 'undefined') os = {PLATFORM: 'browser'};
    else os.PLATFORM = 'browser';
} else if (typeof _player != 'undefined'){
    //Director
    if (typeof _global.os != "object") _global.os = {PLATFORM: 'director'};
    else _global.os.PLATFORM = 'director';
} else {
    throw new Error("UMEOS does not support your platform");
}
 
os.init = function(){};
//JSAN.use("fileServer/js/x4/lang"); 
os.init.prototype = {
    init   : function(){			
		 
    },
    direct: function(load){
    	try{
    		JSAN.use('me/js/api/'+load);
    		//$$.APIDesc.enableBuffer = 0;
    		Ext.Direct.addProvider($$.APIDesc);
    	}catch(e){alert(e)
    	}
    },
    restart: function(btn){
    	Ext.Msg.show({
    		title	: ume.getIcon('arrow_rotate_anticlockwise')+'Restarting',
    		msg		: 'Are You Sure?',
    		buttons	: Ext.Msg.YESNO,
    		fn		: function(btn){
				if(btn == 'yes'){
					Ext.Msg.alert(x4.lang.wait,ume.getIcon('refresh')+'Restarting');
					window.location.reload(true);
				}	
    		},
    		animEl	: btn.id,
    		icon	: Ext.MessageBox.WARNING
		});
    },
    logoff: function(btn){
    	Ext.Msg.show({
    		title	: ume.getIcon('door')+'Are You Leaving?',
    		msg		: 'To Log Out, Click "YES". To Restart, Click "No"',
    		buttons	: Ext.Msg.YESNOCANCEL,
    		fn		: function(btn){
				if(btn == 'yes'){
					Ext.Msg.wait(x4.lang.wait,ume.getIcon('door_out')+'Logging Out');
					ume.msg(x4.greeting(),'Have Fun!');
					Ext.util.Cookies.clear('user[hash]');
					window.location = '/os/api/logoff/';
				}else if(btn == 'no'){
					Ext.Msg.wait(x4.lang.wait,ume.getIcon('door_in')+'Restarting');
					window.location = '/';
				}	
    		},
    		animEl	: (btn) ? btn.id : null,
    		icon	: Ext.MessageBox.QUESTION
		});
    },
    //lang: lang.en,
	user: {
    	hash		: Ext.util.Cookies.get('user[hash]'), 
		email		: Ext.util.Cookies.get('user[email]'),
		username	: Ext.util.Cookies.get('user[username]'),
		id			: Ext.util.Cookies.get('user[id]')
    },    
    isUser  : function(){
    	var get 	= ume.Cookies.get;
    	var hash 	= ume.util.php.base64_decode(get('user[hash]'));
    	var md5 	= ume.util.php.md5( get('user[email]') + hash +get('user[id]') );
    	return (get('user[secret]') === ume.util.php.sha1(md5)) ? true : false;
    },
    disabledAccess: function(){
    	return (this.isUser) ? false : true;
    },
    setUser	: function(user){
    	ume.user = user;
    	
    	var expire = new Date();
    	expire.setFullYear( expire.getFullYear() , expire.getMonth()+1, expire.getDay() );
    	
    	var set = ume.Cookies.set;
    	expire = (user.remember) ? expire : null;
    	
    	set('user[id]',			user.id, expire);
		set('user[hash]', 		ume.util.php.base64_encode(user.hash), expire); 
		set('user[email]', 		user.email, expire);
		set('user[username]', 	user.username, expire);
		set('user[secret]', 	user.secret, expire);
		set('user[name_nick]', 	user.name_nick, expire);
		set('user[name_unique]', 	user.name_unique, expire); 
		
    },
    showAccountWin : function(){
		var win = Ext.getCmp('account-win');
		if(!win){
			win = new Ext.Window({
				title : 'Account of '+ume.user.email,
				widht : 300,
				autoHeight: true,
				items : new UserAccount()
			});
		}
		win.show();
	}, 
    getIcon : function(i,a,e){
        e = (e)?e:'png';
        a = (a)?a:'absmiddle';
	   return "<img src='./me/images/icons/"+ i +"."+ e +"' align='"+ a +"'> ";
    },
    getThumb : function(i,s,a,e){
		e = (e)?e:'png';
		a = (a)?a:'right';
	   return '<img align="'+a+'" style="margin: 5" src="./os/php/inc/phpThumb/phpThumb.php?f=png&q=100&src=../../../img/icons/'+i+'.'+e+'&w='+s+'" />';
    },
    msg		: function(title,formats,duration){
    	duration = (duration) ? duration : 2;
    	var msgCt;
        function createBox(t, s){
            return ['<div class="msg" >',
                    '<div class="x-box-tl"><div class="x-box-tr"><div class="x-box-tc"></div></div></div>',
                    '<div class="x-box-ml"><div class="x-box-mr"><div class="x-box-mc"><h3>', t, '</h3>', s, '</div></div></div>',
                    '<div class="x-box-bl"><div class="x-box-br"><div class="x-box-bc"></div></div></div>',
                    '</div>'].join('');
        }
        if(!msgCt){
            msgCt = Ext.DomHelper.insertFirst(document.body, {id:'msg-div'}, true);
        }
        // msgCt.alignTo(document, 'b-b');
        var s = String.format.apply(String, Array.prototype.slice.call(arguments, 1));
        var m = Ext.DomHelper.append(msgCt, {html:createBox(title, s)}, true);
        m.fadeIn('slow').pause(2).ghost("b", {remove:true});
    },
    resetKey :function(email){
    	var L = this.lang.login.newkey;
		Ext.Msg.prompt(ume.getIcon('key_go')+L.create, ume.getIcon('email')+'Please Verify Your Email Address:', function(btn, email){
		    if (btn == 'ok'){
		    	Ext.Msg.wait(ume.getIcon('key')+' Emailing Secret Word...');
				if(!$$.Umeos){
					ume.direct('Umeos');
				}
		    	$$.Umeos.forgotKey(email,function(r){
					Ext.Msg.hide();
					if(r.success || r.err_num === 1){
						ume.msg(ume.getIcon('email_go')+'Emailed Secret Word','Please check your Inbox... or Spam Box.');
							ume.sendKeyCode(email,r);
					}else{
						Ext.Msg.alert('Password Retrieval Failed!','Error: '+r.error,function(){
							ume.sendKeyCode(email,r);
						});
					}
				});
		    }
		},this,false,email);
    },
    sendKeyCode : function(email,r){
    	Ext.Msg.prompt(ume.getIcon('keyboard')+ 'Copy/Paste Secret Word Here',ume.getIcon('email_go')+'Emailed Secret Word to: '+email, function(btn, key){
			if (btn == 'ok'){
				Ext.Msg.wait('Authenticating...');
				key = key.replace(" ","");
		    	$$.Umeos.newKey(key,function(r){
		    		Ext.Msg.hide();
					if(r.success){
							function getPassword(){
								try{
									Ext.Msg.getDialog().body.child('input').dom.type='password';	
								}catch(err){}
								
								Ext.Msg.prompt(ume.getIcon('lock_open')+' Unlock '+r.email, ume.getIcon('key')+'Enter Custom PassKey', function(btn, newkey){
									if (btn == 'ok'){
										Ext.Msg.wait('Creating Custom PassKey...');
								    	if(newkey.length >= 6){
								    		var hash = ume.util.php.base64_encode(r.email + newkey);  
								        	hash = ume.util.php.md5(hash);
								        	hash = ume.util.php.sha1(hash);
								        	$$.Umeos.saveKey(hash,function(){
								        		Ext.Msg.hide();
								        		Ext.Msg.alert(ume.getIcon('lock')+'Your New PassKey has Been Made','Use Your New PassKey to Access Your Universe');
								        	});	
								    	}else{
								    		Ext.Msg.alert('Passkey to Small','Passkey must be at least 6 Characters',getPassword);
								    		
								    	}
								    }
									try{
										Ext.Msg.getDialog().body.child('input').dom.type='text';	
									}catch(err){}
									
								});
							}
							getPassword();
					}else{
						Ext.Msg.alert('Key Retrieval Failed!','Error: '+r.error,function(){
							ume.resetKey();
						});
					}
				});
		    }
		});
    },
    util    : {
    	phpThumb: function(cfg){
    		Ext.apply(this, cfg);
    		this.zc 	= (this.zc == 0)? 0 : 1;
    		this.src 	= (!this.src) 	? '' : this.src;
    		this.w 		= (!this.w)		? '': '&w='+this.w;
    		this.h 		= (!this.h)		? '': '&h='+this.h;
    		// Returns phpThumb src for img tags.
    		// SRC must be absolute source or relative to dir.
    		var sphere = '';
    		if(cfg.sphere){
    			sphere = "&f=png&fltr[]=mask|masks/planet.png";
    		}else if(cfg.rounded){
    			sphere = "&f=png&fltr[]=mask|masks/rounded.png";
    		}
    		
    		return  '/os/php/inc/phpThumb/phpThumb.php?q=100'+this.w+'&h='+this.h+'&f=png&zc='+this.zc+sphere+'&src='+this.src;
    	},
    	

    	serialize : function ( mixed_value ) {
		    var _getType = function( inp ) {
		        var type = typeof inp, match;
		        var key;
		        if (type == 'object' && !inp) {
		            return 'null';
		        }
		        if (type == "object") {
		            if (!inp.constructor) {
		                return 'object';
		            }
		            var cons = inp.constructor.toString();
		            match = cons.match(/(\w+)\(/);
		            if (match) {
		                cons = match[1].toLowerCase();
		            }
		            var types = ["boolean", "number", "string", "array"];
		            for (key in types) {
		                if (cons == types[key]) {
		                    type = types[key];
		                    break;
		                }
		            }
		        }
		        return type;
		    };
		    var type = _getType(mixed_value);
		    var val, ktype = '';
		    
		    switch (type) {
		        case "function": 
		            val = ""; 
		            break;
		        case "undefined":
		            val = "N";
		            break;
		        case "boolean":
		            val = "b:" + (mixed_value ? "1" : "0");
		            break;
		        case "number":
		            val = (Math.round(mixed_value) == mixed_value ? "i" : "d") + ":" + mixed_value;
		            break;
		        case "string":
		            val = "s:" + mixed_value.length + ":\"" + mixed_value + "\"";
		            break;
		        case "array":
		        case "object":
		            val = "a";
		            var count = 0;
		            var vals = "";
		            var okey;
		            var key;
		            for (key in mixed_value) {
		                ktype = _getType(mixed_value[key]);
		                if (ktype == "function") { 
		                    continue; 
		                }
		                
		                okey = (key.match(/^[0-9]+$/) ? parseInt(key, 10) : key);
		                vals += this.serialize(okey) +
		                		this.serialize(mixed_value[key]);
		                count++;
		            }
		            val += ":" + count + ":{" + vals + "}";
		            break;
		    }
		    if (type != "object" && type != "array") {
		      val += ";";
		  }
		    return val;
		},
		
    	
        php : function(){
    		/**
    		 * Concatenates the values of a variable into an easily readable string
    		 * by Matt Hackett [scriptnode.com]
    		 * @param {Object} x The variable to debug
    		 * @param {Number} max The maximum number of recursions allowed (keep low, around 5 for HTML elements to prevent errors) [default: 10]
    		 * @param {String} sep The separator to use between [default: a single space ' ']
    		 * @param {Number} l The current level deep (amount of recursion). Do not use this parameter: it's for the function's own use
    		 */
    		function print_r(x, max, sep, l) {

    			l = l || 0;
    			max = max || 10;
    			sep = sep || ' ';

    			if (l > max) {
    				return "[WARNING: Too much recursion]\n";
    			}

    			var
    				i,
    				r = '',
    				t = typeof x,
    				tab = '';

    			if (x === null) {
    				r += "(null)\n";
    			} else if (t == 'object') {

    				l++;

    				for (i = 0; i < l; i++) {
    					tab += sep;
    				}

    				if (x && x.length) {
    					t = 'array';
    				}

    				r += '(' + t + ") :\n";

    				for (i in x) {
    					try {
    						r += tab + '[' + i + '] : ' + print_r(x[i], max, sep, (l + 1));
    					} catch(e) {
    						return "[ERROR: " + e + "]\n";
    					}
    				}

    			} else {

    				if (t == 'string') {
    					if (x == '') {
    						x = '(empty)';
    					}
    				}

    				r += '(' + t + ') ' + x + "\n";

    			}

    			return r;

    		};
    		var_dump = print_r;

    		function utf8_encode ( argString ) {
			    // Encodes an ISO-8859-1 string to UTF-8  
			    // 
			    // version: 909.322
			    // discuss at: http://phpjs.org/functions/utf8_encode
			    // +   original by: Webtoolkit.info (http://www.webtoolkit.info/)
			    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
			    // +   improved by: sowberry
			    // +    tweaked by: Jack
			    // +   bugfixed by: Onno Marsman
			    // +   improved by: Yves Sucaet
			    // +   bugfixed by: Onno Marsman
			    // +   bugfixed by: Ulrich
			    // *     example 1: utf8_encode('Kevin van Zonneveld');
			    // *     returns 1: 'Kevin van Zonneveld'
			    var string = (argString+''); // .replace(/\r\n/g, "\n").replace(/\r/g, "\n");

			    var utftext = "";
			    var start, end;
			    var stringl = 0;

			    start = end = 0;
			    stringl = string.length;
			    for (var n = 0; n < stringl; n++) {
			        var c1 = string.charCodeAt(n);
			        var enc = null;

			        if (c1 < 128) {
			            end++;
			        } else if (c1 > 127 && c1 < 2048) {
			            enc = String.fromCharCode((c1 >> 6) | 192) + String.fromCharCode((c1 & 63) | 128);
			        } else {
			            enc = String.fromCharCode((c1 >> 12) | 224) + String.fromCharCode(((c1 >> 6) & 63) | 128) + String.fromCharCode((c1 & 63) | 128);
			        }
			        if (enc !== null) {
			            if (end > start) {
			                utftext += string.substring(start, end);
			            }
			            utftext += enc;
			            start = end = n+1;
			        }
			    }

			    if (end > start) {
			        utftext += string.substring(start, string.length);
			    }

			    return utftext;
			};
			
			function utf8_decode ( str_data ) {
			    // http://kevin.vanzonneveld.net
			    // +   original by: Webtoolkit.info (http://www.webtoolkit.info/)
			    // +      input by: Aman Gupta
			    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
			    // +   improved by: Norman "zEh" Fuchs
			    // +   bugfixed by: hitwork
			    // +   bugfixed by: Onno Marsman
			    // +      input by: Brett Zamir (http://brett-zamir.me)
			    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
			    // *     example 1: utf8_decode('Kevin van Zonneveld');
			    // *     returns 1: 'Kevin van Zonneveld'

			    var tmp_arr = [], i = 0, ac = 0, c1 = 0, c2 = 0, c3 = 0;
			    
			    str_data += '';
			    
			    while ( i < str_data.length ) {
			        c1 = str_data.charCodeAt(i);
			        if (c1 < 128) {
			            tmp_arr[ac++] = String.fromCharCode(c1);
			            i++;
			        } else if ((c1 > 191) && (c1 < 224)) {
			            c2 = str_data.charCodeAt(i+1);
			            tmp_arr[ac++] = String.fromCharCode(((c1 & 31) << 6) | (c2 & 63));
			            i += 2;
			        } else {
			            c2 = str_data.charCodeAt(i+1);
			            c3 = str_data.charCodeAt(i+2);
			            tmp_arr[ac++] = String.fromCharCode(((c1 & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
			            i += 3;
			        }
			    }

			    return tmp_arr.join('');
			};
			
			function sha1 (str) {
			    // Calculate the sha1 hash of a string  
			    // 
			    // version: 909.322
			    // discuss at: http://phpjs.org/functions/sha1
			    // +   original by: Webtoolkit.info (http://www.webtoolkit.info/)
			    // + namespaced by: Michael White (http://getsprink.com)
			    // +      input by: Brett Zamir (http://brett-zamir.me)
			    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
			    // -    depends on: utf8_encode
			    // *     example 1: sha1('Kevin van Zonneveld');
			    // *     returns 1: '54916d2e62f65b3afa6e192e6a601cdbe5cb5897'
			    var rotate_left = function (n,s) {
			        var t4 = ( n<<s ) | (n>>>(32-s));
			        return t4;
			    };
			
			    /*var lsb_hex = function (val) { // Not in use; needed?
			        var str="";
			        var i;
			        var vh;
			        var vl;
			
			        for ( i=0; i<=6; i+=2 ) {
			            vh = (val>>>(i*4+4))&0x0f;
			            vl = (val>>>(i*4))&0x0f;
			            str += vh.toString(16) + vl.toString(16);
			        }
			        return str;
			    };*/
			
			    var cvt_hex = function (val) {
			        var str="";
			        var i;
			        var v;
			
			        for (i=7; i>=0; i--) {
			            v = (val>>>(i*4))&0x0f;
			            str += v.toString(16);
			        }
			        return str;
			    };
			
			    var blockstart;
			    var i, j;
			    var W = new Array(80);
			    var H0 = 0x67452301;
			    var H1 = 0xEFCDAB89;
			    var H2 = 0x98BADCFE;
			    var H3 = 0x10325476;
			    var H4 = 0xC3D2E1F0;
			    var A, B, C, D, E;
			    var temp;
			
			    str = this.utf8_encode(str);
			    var str_len = str.length;
			
			    var word_array = [];
			    for (i=0; i<str_len-3; i+=4) {
			        j = str.charCodeAt(i)<<24 | str.charCodeAt(i+1)<<16 |
			        str.charCodeAt(i+2)<<8 | str.charCodeAt(i+3);
			        word_array.push( j );
			    }
			
			    switch (str_len % 4) {
			        case 0:
			            i = 0x080000000;
			        break;
			        case 1:
			            i = str.charCodeAt(str_len-1)<<24 | 0x0800000;
			        break;
			        case 2:
			            i = str.charCodeAt(str_len-2)<<24 | str.charCodeAt(str_len-1)<<16 | 0x08000;
			        break;
			        case 3:
			            i = str.charCodeAt(str_len-3)<<24 | str.charCodeAt(str_len-2)<<16 | str.charCodeAt(str_len-1)<<8    | 0x80;
			        break;
			    }
			
			    word_array.push( i );
			
			    while ((word_array.length % 16) != 14 ) {word_array.push( 0 );}
			
			    word_array.push( str_len>>>29 );
			    word_array.push( (str_len<<3)&0x0ffffffff );
			
			    for ( blockstart=0; blockstart<word_array.length; blockstart+=16 ) {
			        for (i=0; i<16; i++) {W[i] = word_array[blockstart+i];}
			        for (i=16; i<=79; i++) {W[i] = rotate_left(W[i-3] ^ W[i-8] ^ W[i-14] ^ W[i-16], 1);}
			
			
			        A = H0;
			        B = H1;
			        C = H2;
			        D = H3;
			        E = H4;
			
			        for (i= 0; i<=19; i++) {
			            temp = (rotate_left(A,5) + ((B&C) | (~B&D)) + E + W[i] + 0x5A827999) & 0x0ffffffff;
			            E = D;
			            D = C;
			            C = rotate_left(B,30);
			            B = A;
			            A = temp;
			        }
			
			        for (i=20; i<=39; i++) {
			            temp = (rotate_left(A,5) + (B ^ C ^ D) + E + W[i] + 0x6ED9EBA1) & 0x0ffffffff;
			            E = D;
			            D = C;
			            C = rotate_left(B,30);
			            B = A;
			            A = temp;
			        }
			
			        for (i=40; i<=59; i++) {
			            temp = (rotate_left(A,5) + ((B&C) | (B&D) | (C&D)) + E + W[i] + 0x8F1BBCDC) & 0x0ffffffff;
			            E = D;
			            D = C;
			            C = rotate_left(B,30);
			            B = A;
			            A = temp;
			        }
			
			        for (i=60; i<=79; i++) {
			            temp = (rotate_left(A,5) + (B ^ C ^ D) + E + W[i] + 0xCA62C1D6) & 0x0ffffffff;
			            E = D;
			            D = C;
			            C = rotate_left(B,30);
			            B = A;
			            A = temp;
			        }
			
			        H0 = (H0 + A) & 0x0ffffffff;
			        H1 = (H1 + B) & 0x0ffffffff;
			        H2 = (H2 + C) & 0x0ffffffff;
			        H3 = (H3 + D) & 0x0ffffffff;
			        H4 = (H4 + E) & 0x0ffffffff;
			    }
			
			    temp = cvt_hex(H0) + cvt_hex(H1) + cvt_hex(H2) + cvt_hex(H3) + cvt_hex(H4);
			    return temp.toLowerCase();
			};

			function md5 (str) {
			    // Calculate the md5 hash of a string  
			    // 
			    // version: 909.322
			    // discuss at: http://phpjs.org/functions/md5
			    // +   original by: Webtoolkit.info (http://www.webtoolkit.info/)
			    // + namespaced by: Michael White (http://getsprink.com)
			    // +    tweaked by: Jack
			    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
			    // +      input by: Brett Zamir (http://brett-zamir.me)
			    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
			    // -    depends on: utf8_encode
			    // *     example 1: md5('Kevin van Zonneveld');
			    // *     returns 1: '6e658d4bfcb59cc13f96c14450ac40b9'
			    var xl;

			    var rotateLeft = function (lValue, iShiftBits) {
			        return (lValue<<iShiftBits) | (lValue>>>(32-iShiftBits));
			    };

			    var addUnsigned = function (lX,lY) {
			        var lX4,lY4,lX8,lY8,lResult;
			        lX8 = (lX & 0x80000000);
			        lY8 = (lY & 0x80000000);
			        lX4 = (lX & 0x40000000);
			        lY4 = (lY & 0x40000000);
			        lResult = (lX & 0x3FFFFFFF)+(lY & 0x3FFFFFFF);
			        if (lX4 & lY4) {
			            return (lResult ^ 0x80000000 ^ lX8 ^ lY8);
			        }
			        if (lX4 | lY4) {
			            if (lResult & 0x40000000) {
			                return (lResult ^ 0xC0000000 ^ lX8 ^ lY8);
			            } else {
			                return (lResult ^ 0x40000000 ^ lX8 ^ lY8);
			            }
			        } else {
			            return (lResult ^ lX8 ^ lY8);
			        }
			    };

			    var _F = function (x,y,z) { return (x & y) | ((~x) & z); };
			    var _G = function (x,y,z) { return (x & z) | (y & (~z)); };
			    var _H = function (x,y,z) { return (x ^ y ^ z); };
			    var _I = function (x,y,z) { return (y ^ (x | (~z))); };

			    var _FF = function (a,b,c,d,x,s,ac) {
			        a = addUnsigned(a, addUnsigned(addUnsigned(_F(b, c, d), x), ac));
			        return addUnsigned(rotateLeft(a, s), b);
			    };

			    var _GG = function (a,b,c,d,x,s,ac) {
			        a = addUnsigned(a, addUnsigned(addUnsigned(_G(b, c, d), x), ac));
			        return addUnsigned(rotateLeft(a, s), b);
			    };

			    var _HH = function (a,b,c,d,x,s,ac) {
			        a = addUnsigned(a, addUnsigned(addUnsigned(_H(b, c, d), x), ac));
			        return addUnsigned(rotateLeft(a, s), b);
			    };

			    var _II = function (a,b,c,d,x,s,ac) {
			        a = addUnsigned(a, addUnsigned(addUnsigned(_I(b, c, d), x), ac));
			        return addUnsigned(rotateLeft(a, s), b);
			    };

			    var convertToWordArray = function (str) {
			        var lWordCount;
			        var lMessageLength = str.length;
			        var lNumberOfWords_temp1=lMessageLength + 8;
			        var lNumberOfWords_temp2=(lNumberOfWords_temp1-(lNumberOfWords_temp1 % 64))/64;
			        var lNumberOfWords = (lNumberOfWords_temp2+1)*16;
			        var lWordArray=new Array(lNumberOfWords-1);
			        var lBytePosition = 0;
			        var lByteCount = 0;
			        while ( lByteCount < lMessageLength ) {
			            lWordCount = (lByteCount-(lByteCount % 4))/4;
			            lBytePosition = (lByteCount % 4)*8;
			            lWordArray[lWordCount] = (lWordArray[lWordCount] | (str.charCodeAt(lByteCount)<<lBytePosition));
			            lByteCount++;
			        }
			        lWordCount = (lByteCount-(lByteCount % 4))/4;
			        lBytePosition = (lByteCount % 4)*8;
			        lWordArray[lWordCount] = lWordArray[lWordCount] | (0x80<<lBytePosition);
			        lWordArray[lNumberOfWords-2] = lMessageLength<<3;
			        lWordArray[lNumberOfWords-1] = lMessageLength>>>29;
			        return lWordArray;
			    };

			    var wordToHex = function (lValue) {
			        var wordToHexValue="",wordToHexValue_temp="",lByte,lCount;
			        for (lCount = 0;lCount<=3;lCount++) {
			            lByte = (lValue>>>(lCount*8)) & 255;
			            wordToHexValue_temp = "0" + lByte.toString(16);
			            wordToHexValue = wordToHexValue + wordToHexValue_temp.substr(wordToHexValue_temp.length-2,2);
			        }
			        return wordToHexValue;
			    };

			    var x=[],
			        k,AA,BB,CC,DD,a,b,c,d,
			        S11=7, S12=12, S13=17, S14=22,
			        S21=5, S22=9 , S23=14, S24=20,
			        S31=4, S32=11, S33=16, S34=23,
			        S41=6, S42=10, S43=15, S44=21;

			    str = this.utf8_encode(str);
			    x = convertToWordArray(str);
			    a = 0x67452301; b = 0xEFCDAB89; c = 0x98BADCFE; d = 0x10325476;
			    
			    xl = x.length;
			    for (k=0;k<xl;k+=16) {
			        AA=a; BB=b; CC=c; DD=d;
			        a=_FF(a,b,c,d,x[k+0], S11,0xD76AA478);
			        d=_FF(d,a,b,c,x[k+1], S12,0xE8C7B756);
			        c=_FF(c,d,a,b,x[k+2], S13,0x242070DB);
			        b=_FF(b,c,d,a,x[k+3], S14,0xC1BDCEEE);
			        a=_FF(a,b,c,d,x[k+4], S11,0xF57C0FAF);
			        d=_FF(d,a,b,c,x[k+5], S12,0x4787C62A);
			        c=_FF(c,d,a,b,x[k+6], S13,0xA8304613);
			        b=_FF(b,c,d,a,x[k+7], S14,0xFD469501);
			        a=_FF(a,b,c,d,x[k+8], S11,0x698098D8);
			        d=_FF(d,a,b,c,x[k+9], S12,0x8B44F7AF);
			        c=_FF(c,d,a,b,x[k+10],S13,0xFFFF5BB1);
			        b=_FF(b,c,d,a,x[k+11],S14,0x895CD7BE);
			        a=_FF(a,b,c,d,x[k+12],S11,0x6B901122);
			        d=_FF(d,a,b,c,x[k+13],S12,0xFD987193);
			        c=_FF(c,d,a,b,x[k+14],S13,0xA679438E);
			        b=_FF(b,c,d,a,x[k+15],S14,0x49B40821);
			        a=_GG(a,b,c,d,x[k+1], S21,0xF61E2562);
			        d=_GG(d,a,b,c,x[k+6], S22,0xC040B340);
			        c=_GG(c,d,a,b,x[k+11],S23,0x265E5A51);
			        b=_GG(b,c,d,a,x[k+0], S24,0xE9B6C7AA);
			        a=_GG(a,b,c,d,x[k+5], S21,0xD62F105D);
			        d=_GG(d,a,b,c,x[k+10],S22,0x2441453);
			        c=_GG(c,d,a,b,x[k+15],S23,0xD8A1E681);
			        b=_GG(b,c,d,a,x[k+4], S24,0xE7D3FBC8);
			        a=_GG(a,b,c,d,x[k+9], S21,0x21E1CDE6);
			        d=_GG(d,a,b,c,x[k+14],S22,0xC33707D6);
			        c=_GG(c,d,a,b,x[k+3], S23,0xF4D50D87);
			        b=_GG(b,c,d,a,x[k+8], S24,0x455A14ED);
			        a=_GG(a,b,c,d,x[k+13],S21,0xA9E3E905);
			        d=_GG(d,a,b,c,x[k+2], S22,0xFCEFA3F8);
			        c=_GG(c,d,a,b,x[k+7], S23,0x676F02D9);
			        b=_GG(b,c,d,a,x[k+12],S24,0x8D2A4C8A);
			        a=_HH(a,b,c,d,x[k+5], S31,0xFFFA3942);
			        d=_HH(d,a,b,c,x[k+8], S32,0x8771F681);
			        c=_HH(c,d,a,b,x[k+11],S33,0x6D9D6122);
			        b=_HH(b,c,d,a,x[k+14],S34,0xFDE5380C);
			        a=_HH(a,b,c,d,x[k+1], S31,0xA4BEEA44);
			        d=_HH(d,a,b,c,x[k+4], S32,0x4BDECFA9);
			        c=_HH(c,d,a,b,x[k+7], S33,0xF6BB4B60);
			        b=_HH(b,c,d,a,x[k+10],S34,0xBEBFBC70);
			        a=_HH(a,b,c,d,x[k+13],S31,0x289B7EC6);
			        d=_HH(d,a,b,c,x[k+0], S32,0xEAA127FA);
			        c=_HH(c,d,a,b,x[k+3], S33,0xD4EF3085);
			        b=_HH(b,c,d,a,x[k+6], S34,0x4881D05);
			        a=_HH(a,b,c,d,x[k+9], S31,0xD9D4D039);
			        d=_HH(d,a,b,c,x[k+12],S32,0xE6DB99E5);
			        c=_HH(c,d,a,b,x[k+15],S33,0x1FA27CF8);
			        b=_HH(b,c,d,a,x[k+2], S34,0xC4AC5665);
			        a=_II(a,b,c,d,x[k+0], S41,0xF4292244);
			        d=_II(d,a,b,c,x[k+7], S42,0x432AFF97);
			        c=_II(c,d,a,b,x[k+14],S43,0xAB9423A7);
			        b=_II(b,c,d,a,x[k+5], S44,0xFC93A039);
			        a=_II(a,b,c,d,x[k+12],S41,0x655B59C3);
			        d=_II(d,a,b,c,x[k+3], S42,0x8F0CCC92);
			        c=_II(c,d,a,b,x[k+10],S43,0xFFEFF47D);
			        b=_II(b,c,d,a,x[k+1], S44,0x85845DD1);
			        a=_II(a,b,c,d,x[k+8], S41,0x6FA87E4F);
			        d=_II(d,a,b,c,x[k+15],S42,0xFE2CE6E0);
			        c=_II(c,d,a,b,x[k+6], S43,0xA3014314);
			        b=_II(b,c,d,a,x[k+13],S44,0x4E0811A1);
			        a=_II(a,b,c,d,x[k+4], S41,0xF7537E82);
			        d=_II(d,a,b,c,x[k+11],S42,0xBD3AF235);
			        c=_II(c,d,a,b,x[k+2], S43,0x2AD7D2BB);
			        b=_II(b,c,d,a,x[k+9], S44,0xEB86D391);
			        a=addUnsigned(a,AA);
			        b=addUnsigned(b,BB);
			        c=addUnsigned(c,CC);
			        d=addUnsigned(d,DD);
			    }

			    var temp = wordToHex(a)+wordToHex(b)+wordToHex(c)+wordToHex(d);

			    return temp.toLowerCase();
			};

			function base64_encode (data) {
			    // Encodes string using MIME base64 algorithm  
			    // 
			    // version: 909.322
			    // discuss at: http://phpjs.org/functions/base64_encode
			    // +   original by: Tyler Akins (http://rumkin.com)
			    // +   improved by: Bayron Guevara
			    // +   improved by: Thunder.m
			    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
			    // +   bugfixed by: Pellentesque Malesuada
			    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
			    // -    depends on: utf8_encode
			    // *     example 1: base64_encode('Kevin van Zonneveld');
			    // *     returns 1: 'S2V2aW4gdmFuIFpvbm5ldmVsZA=='
			    // mozilla has this native
			    // - but breaks in 2.0.0.12!
			    //if (typeof this.window['atob'] == 'function') {
			    //    return atob(data);
			    //}
			        
			    var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
			    var o1, o2, o3, h1, h2, h3, h4, bits, i = 0, ac = 0, enc="", tmp_arr = [];

			    if (!data) {
			        return data;
			    }

			    data = this.utf8_encode(data+'');
			    
			    do { // pack three octets into four hexets
			        o1 = data.charCodeAt(i++);
			        o2 = data.charCodeAt(i++);
			        o3 = data.charCodeAt(i++);

			        bits = o1<<16 | o2<<8 | o3;

			        h1 = bits>>18 & 0x3f;
			        h2 = bits>>12 & 0x3f;
			        h3 = bits>>6 & 0x3f;
			        h4 = bits & 0x3f;

			        // use hexets to index into b64, and append result to encoded string
			        tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
			    } while (i < data.length);
			    
			    enc = tmp_arr.join('');
			    
			    switch (data.length % 3) {
			        case 1:
			            enc = enc.slice(0, -2) + '==';
			        break;
			        case 2:
			            enc = enc.slice(0, -1) + '=';
			        break;
			    }

			    return enc;
			};
			function base64_decode (data) {
			    // Decodes string using MIME base64 algorithm  
			    // 
			    // version: 909.322
			    // discuss at: http://phpjs.org/functions/base64_decode
			    // +   original by: Tyler Akins (http://rumkin.com)
			    // +   improved by: Thunder.m
			    // +      input by: Aman Gupta
			    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
			    // +   bugfixed by: Onno Marsman
			    // +   bugfixed by: Pellentesque Malesuada
			    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
			    // +      input by: Brett Zamir (http://brett-zamir.me)
			    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
			    // -    depends on: utf8_decode
			    // *     example 1: base64_decode('S2V2aW4gdmFuIFpvbm5ldmVsZA==');
			    // *     returns 1: 'Kevin van Zonneveld'
			    // mozilla has this native
			    // - but breaks in 2.0.0.12!
			    //if (typeof this.window['btoa'] == 'function') {
			    //    return btoa(data);
			    //}
			
			    var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
			    var o1, o2, o3, h1, h2, h3, h4, bits, i = 0, ac = 0, dec = "", tmp_arr = [];
			
			    if (!data) {
			        return data;
			    }
			
			    data += '';
			
			    do {  // unpack four hexets into three octets using index points in b64
			        h1 = b64.indexOf(data.charAt(i++));
			        h2 = b64.indexOf(data.charAt(i++));
			        h3 = b64.indexOf(data.charAt(i++));
			        h4 = b64.indexOf(data.charAt(i++));
			
			        bits = h1<<18 | h2<<12 | h3<<6 | h4;
			
			        o1 = bits>>16 & 0xff;
			        o2 = bits>>8 & 0xff;
			        o3 = bits & 0xff;
			
			        if (h3 == 64) {
			            tmp_arr[ac++] = String.fromCharCode(o1);
			        } else if (h4 == 64) {
			            tmp_arr[ac++] = String.fromCharCode(o1, o2);
			        } else {
			            tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
			        }
			    } while (i < data.length);
			
			    dec = tmp_arr.join('');
			    dec = this.utf8_decode(dec);
			
			    return dec;
			};

            return {
            	print_r		: print_r,
            	var_dump	: var_dump,
                utf8_encode : utf8_encode,
                utf8_decode : utf8_decode,
                md5         : md5,
                base64_encode: base64_encode,
                base64_decode: base64_decode,
                sha1    : sha1
 
            }
        }()
    },
    Cookies: function(){ return Ext.util.Cookies }()
};
ume = new os.init();