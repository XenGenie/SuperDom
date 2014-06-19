<script src="/bin/js/jq/DDM.js"></script> 
        <style type="text/css"><!-- 
        	body{
        		margin: 0px;
        	}
        
	        #filelist {
	            float:left;
	            margin-left:5px;
	            background:#f3f3f3;
	            color:#999;
	            padding:5px;
	            -webkit-border-radius:10px;
	            -moz-border-radius:10px;
	            border-radius:10px;
	            display:none;
	        }
        #image-container { 
        }
        #image-container img {
            max-width:200px; 
            background:transparent url(/bin/images/loading/ajax-loader.gif) no-repeat center center;
        }
        #upload {
            position:absolute;
            top:0;
            left:0; 
            filter:alpha(opacity=0);
            -khtml-opacity:0;
            -webkit-opacity:0;
            -moz-opacity:0;
            opacity:0;
            
            width	: 100%;
            height	: 100%;
        }
        #drop-container {
            width	: 100%; 
            height	: 100%;
            background: #cfcfcf;
            top: 0px;
            left: 0px;
            overflow:hidden;
            position:absolute;
            text-align:center;
            color	: #666;
            font	:normal 24px Helvetica,Arial,sans-serif; 
        }
        .dropzone {
           height	: 100%;
           width	: 100%;
            background: #fafafa;
           /*  background: #fafafa url(/bin/images/icons/256x256/Paste.png) no-repeat center 0; */
            -webkit-border-radius:5px;
            -moz-border-radius:5px;
            border-radius:5px;
        }
        
        #drop-container.dragging .dropzone {
            background-color:#00ff00;
            background-position:center -200px;
        }
        #loader {
            background:transparent url(/bin/images/loading/ajax-loader.gif) 0 0;
            width:16px;
            height:16px;
            position:absolute;
            left:50%;
            top: 50%;
            
            

            display:none;
        } 
        --></style> 
        <div id="drop-container"> 
	        <div class="dropzone">
	        	<div id="image-container"></div>
	        	<div id="filelist"></div>
        		<p class="note" ><b>Drag & Drop Desktop Files</b>
				<br/>Works well with Safari 4/Chrome 2+. Firefox Requires an <a href="https://addons.mozilla.org/en-US/firefox/addon/dragdropupload/?application=firefox&id=2190" target="_blank" />Extension</a></p>
			<div id="loader"></div>
	       </div> 
			<form id="deskDrop" action="/upload/index?json" method="post" enctype="multipart/form-data"> 
			    <input type="file" name="files[]" id="upload" multiple="multiple" />
			    <input type="hidden" name="timestamp" value="{$time}" />
			    <input type="hidden" name="dir" value="{$dir}" />
			    <input type="hidden" name="folder" value="{$folder}" />
			</form> 
		</div>   
        <script type="text/javascript"> 
        var dd = new Swell.Lib.DD.Droppable('drop-container', {
            'denyDrop' : true
        });
        dd.ondragover = function(e) {
            $('drop-container').addClass('dragging');
        }
        Swell.Core.Event.add('upload', 'change', function() {
            $('loader').show();
            $('drop-container').removeClass('dragging');
            AJAX = $("deskDrop").xhr(function(wrapper) {
				if(parent){
					//parent.Ext.get(document.body).mask('masking');
				}
                
                var currentEl = $('upload').current();
                $('filelist').show();
                var num = 0;
                for (var i = 0, len = currentEl.files.length; i < len; i++) {
                    $('filelist').appendHTML(currentEl.files.item(i).fileName + '<br />');
                    num++;
                }
                var imgs = wrapper.responseText.split('|');

                // alert(wrapper.responseText);
                
                
                if(!parent){
                	new Swell.Core.Asset().load('img', imgs, function(img) {
	                	$(img).appendTo('image-container');
	                	$('loader').hide();
	                });
					
					alert(num+' File(s) Uploaded Successfully!');	
				}else{
                    if(parent.Ext){
                    	parent.Ext.Msg.alert('Success!',imgs.length+' File(s) Uploaded Successfully!');
                    	parent.Ext.getCmp('upload').loadStore({
	            				params : {
		        					dir	: '{$folder}'
		        				}
	        	    	});


                    	
                    	parent.Ext.getCmp('upload-to-dir-{$folder}').close();     
					}
				}
            });
        });
        </script> 