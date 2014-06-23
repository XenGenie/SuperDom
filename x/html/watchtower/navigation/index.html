<div class="row" id="navi-tree">
    <div class="col-md-6">
    	<header>
            <h5>
                <span class="label label-success"><i class="fa fa-eye"></i></span> &nbsp; <strong>Online</strong>
            </h5>
            <div class="widget-controls">
                <a onclick="window.navi.newLink();" title="Reload" href="#" class="btn btn-info btn-small"><strong>New Linx <i class="fa fa-link"></i> </strong></a>
                <!-- <a data-widgster="close" title="Close" href="#"><strong>Close</strong></a> -->
            </div>
        </header>

        <div class="dd" id="nestable1" >
            {if $navi == 0}
                <div class="dd-empty"></div>
            {else}
                <ol class="dd-list" style=" ">  
                    {foreach $navi as $n => $link}
                        {if $link.parent == 0} 
                            {include file="watchtower/navigation/nest.html" link=$link} 
                        {/if} 
                    {/foreach}
                </ol> 
            {/if} 
        </div>
         
    </div>
    <div class="col-md-6">
        <div class="widget-controls">
            <a data-widgster="load" title="Reload" href="#" class="btn btn-danger btn-small"><strong>Delete Page <i class="fa fa-ban"></i> </strong></a><!-- <a data-widgster="close" title="Close" href="#"><strong>Close</strong></a> -->
        </div>
		<header>
		    <h5>
		        <span class="label label-inverse"><i class="fa fa-eye-slash"></i></span> &nbsp; Offline
		    </h5>
		    
		</header>
        <div class="dd" id="nestable2"> 
            {if $deku == 0}
                <div class="dd-empty"></div>
            {else}
                <ol class="dd-list"> 
                {foreach $deku as $n => $link}
                    {if $link.parent == 0} 
                        {include file="watchtower/navigation/nest.html" link=$link navi=$deku} 
                    {/if} 
                {/foreach}
                </ol>
            {/if}
        </div>
    </div>
</div> 
<script type="text/javascript">
    
    window.navi = {
        newLink : function () {
            var a,b,c;

            a = {
                title : prompt("Give the New Page a Title")
            };

            if(a != ''){

                $.ajax({
                    type     : "POST",
                    url      : '/{$toBackDoor}/navigation/newLink/.json',
                    data     : a,
                    dataType : "json",
                    success: function(data)
                    {

                      $.pjax({ 
                        container : '.content',
                        fragment  : '.content',
                        timeout   : 5000,
                        url       : window.location.pathname+window.location.search+window.location.hash
                      });
                      // Handle the server response (display errors if necessary)

                      // $.pjax({

                      //   container : '.content',
                      //   fragment  : '.content',
                      //   timeout   : 5000,
                      //   url       : window.location.pathname+window.location.search+window.location.hash
                      // });

                    }
                });


            }
        }
    }; 

    $('.dd').on('change', function() {
        
        /* on change event */
        var on  = $("#nestable1").nestable('serialize');
        var off = $("#nestable2").nestable('serialize');


        $.ajax({
            type     : "POST",
            url      : '/{$toBackDoor}/navigation/updateNest/.json',
            data     : { 
                on  : on,
                off : off
            },
            dataType : "json",
            success: function(data)
            {

              // $.pjax({ 
              //   container : '.content',
              //   fragment  : '.content',
              //   timeout   : 5000,
              //   url       : window.location.pathname+window.location.search+window.location.hash
              // });
              // Handle the server response (display errors if necessary)

              // $.pjax({

              //   container : '.content',
              //   fragment  : '.content',
              //   timeout   : 5000,
              //   url       : window.location.pathname+window.location.search+window.location.hash
              // });

            }
        });

    });



</script>
<script src="/x/html/layout/watchtower/js/list-groups.js" type="text/javascript"> </script>
