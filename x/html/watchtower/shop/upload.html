<form id="fileupload" action="server/php" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12">
            <div id="dropzone"  class="dropzone">
                Drop files here
                <i class="fa fa-download-alt pull-right"></i>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 fileupload-progress fade">
            <!-- The global progress bar -->
            <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                <div class="bar" style="width:0%;"></div>
            </div>
            <!-- The extended global progress information -->
            <div class="progress-extended">&nbsp;</div>
        </div>
    </div>
    <div class="form-actions fileupload-buttonbar no-margin">
        <span class="btn btn-sm btn-default fileinput-button">
                <i class="fa fa-plus"></i>
                <span>Add files...</span>
                <input type="file" name="files[]" multiple="">
            </span>
        <button type="submit" class="btn btn-primary btn-sm start">
            <i class="fa fa-upload"></i>
            <span>Start upload</span>
        </button>
        <button type="reset" class="btn btn-inverse btn-sm cancel">
            <i class="fa fa-ban"></i>
            <span>Cancel upload</span>
        </button>
    </div>
    <div class="fileupload-loading"><i class="fa fa-spin fa-spinner"></i></div>
    <!-- The table listing the files available for upload/download -->
    <table role="presentation" class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
</form>
 
 
<!-- jquery plugins -->
<!-- <script type="text/javascript" src="{$WT}lib/jquery-maskedinput/jquery.maskedinput.js"></script>
<script type="text/javascript" src="{$WT}lib/parsley/parsley.js"> </script>
<script type="text/javascript" src="{$WT}lib/icheck.js/jquery.icheck.js"></script>
<script type="text/javascript" src="{$WT}lib/select2.js"></script>
 -->
<script type="text/javascript" src="{$WT}lib/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script type="text/javascript" src="{$WT}lib/vendor/http_blueimp.github.io_JavaScript-Templates_js_tmpl.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script type="text/javascript" src="{$WT}lib/vendor/http_blueimp.github.io_JavaScript-Load-Image_js_load-image.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script type="text/javascript" src="{$WT}lib/vendor/http_blueimp.github.io_JavaScript-Canvas-to-Blob_js_canvas-to-blob.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script type="text/javascript" src="{$WT}lib/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script type="text/javascript" src="{$WT}lib/jquery.fileupload.js"></script>
<!-- The File Upload file processing plugin -->
<script type="text/javascript" src="{$WT}lib/jquery.fileupload-fp.js"></script>
<!-- The File Upload user interface plugin -->
<script type="text/javascript" src="{$WT}lib/jquery.fileupload-ui.js"></script>

 

<!-- bootstrap custom plugins -->
<script type="text/javascript" src="{$WT}lib/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="{$WT}lib/bootstrap-select/bootstrap-select.js"></script>
<script type="text/javascript" src="{$WT}lib/wysihtml5/wysihtml5-0.3.0_rc2.js"></script>
<script type="text/javascript" src="{$WT}lib/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

<!-- basic application js-->
<!-- <script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript" src="js/settings.js"></script> -->

<!-- page specific -->
<script type="text/javascript">
    
    $(function () {
        function pageLoad(){
            'use strict';


            // Initialize the jQuery File Upload widget:
            var $fileupload = $('#fileupload');
            $fileupload.fileupload({
                // Uncomment the following to send cross-domain cookies:
                //xhrFields: { withCredentials: true },
                url: '/{$toBackDoor}/xtra/x{$Xtra|ucfirst}/index.php',
                dropZone: $('#dropzone')
            });

            // Enable iframe cross-domain access via redirect option:
            $fileupload.fileupload(
                'option',
                'redirect',
                window.location.href.replace(
                    /\/[^\/]*$/,
                    '/cors/result.html?%s'
                )
            );

            // Load existing files:
            $.ajax({
                // Uncomment the following to send cross-domain cookies:
                //xhrFields: { withCredentials: true},
                url: $fileupload.fileupload('option', 'url'),
                dataType: 'json',
                context: $fileupload[0]
            }).done(function (result) {
                    $(this).fileupload('option', 'done')
                        .call(this, null, { result: result });
                });
        }

        pageLoad();

        PjaxApp.onPageLoad(pageLoad);

    });

</script>
{literal}
<script id="template-upload" type="text/template">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="preview"><span class="fade"></span></td>
        <td class="name"><span>{%=file.name%}</span></td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        {% if (file.error) { %}
        <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else if (o.files.valid && !i) { %}
        <td>
            <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div class="bar" style="width:0%;"></div>
            </div>
        </td>
        <td>{% if (!o.options.autoUpload) { %}
            <button class="btn btn-primary btn-sm start">
                <i class="fa fa-upload"></i>
                <span>Start</span>
            </button>
            {% } %}</td>
        {% } else { %}
        <td colspan="2"></td>
        {% } %}
        <td>{% if (!i) { %}
            <button class="btn btn-warning btn-sm cancel">
                <i class="fa fa-ban"></i>
                <span>Cancel</span>
            </button>
            {% } %}</td>
    </tr>
    {% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/template">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        {% if (file.error) { %}
        <td></td>
        <td class="name"><span>{%=file.name%}</span></td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else { %}
        <td class="preview">{% if (file.thumbnail_url) { %}
            <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
            {% } %}</td>
        <td class="name">
            <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
        </td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        <td colspan="2"></td>
        {% } %}
        <td>
            <button class="btn btn-danger btn-sm delete" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
            <i class="fa fa-trash"></i>
            <span>Delete</span>
            </button>
        </td>
    </tr>
    {% } %}
</script>

<script type="text/template" id="settings-template">
    <div class="setting clearfix">
        <div>Background</div>
        <div id="background-toggle" class="pull-left btn-group" data-toggle="buttons-radio">
            <% dark = background == 'dark'; light = background == 'light';%>
            <button type="button" data-value="dark" class="btn btn-sm btn-transparent <%= dark? 'active' : '' %>">Dark</button>
            <button type="button" data-value="light" class="btn btn-sm btn-transparent <%= light? 'active' : '' %>">Light</button>
        </div>
    </div>
    <div class="setting clearfix">
        <div>Sidebar on the</div>
        <div id="sidebar-toggle" class="pull-left btn-group" data-toggle="buttons-radio">
            <% onRight = sidebar == 'right'%>
            <button type="button" data-value="left" class="btn btn-sm btn-transparent <%= onRight? '' : 'active' %>">Left</button>
            <button type="button" data-value="right" class="btn btn-sm btn-transparent <%= onRight? 'active' : '' %>">Right</button>
        </div>
    </div>
    <div class="setting clearfix">
        <div>Sidebar</div>
        <div id="display-sidebar-toggle" class="pull-left btn-group" data-toggle="buttons-radio">
            <% display = displaySidebar%>
            <button type="button" data-value="true" class="btn btn-sm btn-transparent <%= display? 'active' : '' %>">Show</button>
            <button type="button" data-value="false" class="btn btn-sm btn-transparent <%= display? '' : 'active' %>">Hide</button>
        </div>
    </div>
    <div class="setting clearfix">
        <div>White Version</div>
        <div>
            <a href="white/" class="btn btn-sm btn-transparent">&nbsp; Switch &nbsp;   <i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</script>
{/literal}