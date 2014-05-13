<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="<?=C::D('LOGO_PATH') ?>{%=file.name%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="<?=C::D('LOGO_PATH') ?>{%=file.folder%}/{%=file.name%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="<?=C::D('LOGO_PATH') ?>{%=file.name%}" title="{%=file.name%}">{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="POST" data-url="/admin/logoupload/{%=file.name%}/delete" {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
<!--                 <input type="checkbox" name="delete" value="1" class="toggle"> -->
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="/public/lib/fileupload/jquery-ui.custom.min.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="/public/lib/fileupload/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="/public/lib/fileupload/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="/public/lib/fileupload/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="/public/lib/fileupload/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="/public/lib/fileupload/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="/public/lib/fileupload/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="/public/lib/fileupload/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="/public/lib/fileupload/jquery.fileupload-image.js"></script>
<!-- The File Upload validation plugin -->
<script src="/public/lib/fileupload/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="/public/lib/fileupload/jquery.fileupload-ui.js"></script>

<!-- The main application script -->
<script src="/public/js/admin.edit.place.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="/public/lib/fileupload/jquery.xdr-transport.js"></script>
<![endif]-->

<div class="row">
	<div class="form-group col-sm-12 col-md-8 col-lg-6">
		<label for="item-name">Name</label>
		<input type="text" class="form-control" id="item-name" name="item-name" value="<?php if (isset($item) && $item->name) { echo $item->name; } ?>">
	</div>
	<div class="hidden-sm col-md-4  col-lg-6">
	</div>
</div>
<div class="row">
	<div class="form-group col-sm-6 col-md-4 col-lg-3">
		<label for="item-category">Category</label>
		<select class="form-control" id="item-category" name="item-category">
			<option>Categorías...</option>
			<?php foreach (C::CATEGORIES() as $k => $v) { ?>
				<option value="<?=$k?>" <?php if (isset($item) && $item->category == $k) { echo "selected"; } ?>><?=$v?></option>
			<?php } ?>
		</select>				
	</div>
	<div class="form-group col-sm-6 col-md-4 col-lg-3">
		<label for="item-type">Type</label>
		<select class="form-control" id="item-type" name="item-type">
			<option>Typos...</option>
			<?php if (isset($item) && $item->type) {
					foreach (C::TYPES($item->type) as $k => $v) { ?>
						<option value="<?=$k?>" <?php if ($item->type == $k) { echo "selected"; } ?>><?=$v?></option>
			<?php } } ?>                                                
                                                
		</select>				
	</div>
	<div class="hidden-sm col-md-4  col-lg-6">
	</div>
</div>
<div class="row">
	<div class="form-group col-sm-6 col-md-4 col-lg-3">
		<label for="item-city">City</label>
		<select class="form-control" id="item-city" name="item-city">
			<option>Ciudades...</option>
			<?php foreach (C::CITIES() as $k => $v) { ?>
				<option value="<?=$k?>" <?php if (isset($item) && $item->city_id == $k) { echo "selected"; } ?>><?=$v?></option>
			<?php } ?>
		</select>				
	</div>
	<div class="form-group col-sm-6 col-md-4 col-lg-3">
		<label for="item-zone">Zona</label>
		<select class="form-control" id="item-zone" name="item-zone">
			<option>Zonas...</option>
			<?php foreach (C::ZONES_LIST() as $k => $v) { ?>
				<option value="<?=$k?>" <?php if (isset($item) && $item->zone_id == $k) { echo "selected"; } ?>><?=$v?></option>
			<?php } ?>
		</select>
	</div>
	<div class="hidden-sm col-md-4  col-lg-6">
	</div>
</div>
<div class="row">
	<div class="form-group col-sm-12 col-md-8 col-lg-6">
		<label for="item-address">Address</label>
		<div class="row">
			<div class="col-md-12">
				<input type="text" class="form-control" id="item-address" name="item-address" value="<?php if (isset($item) && $item->address) { echo $item->address; } ?>">				
			</div>
		</div>
	</div>
	<div class="hidden-sm col-md-4  col-lg-6">
		<div class="bs-callout bs-callout-warning help">
			<p>No need to write the name of the city.</p>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group col-sm-6 col-md-4 col-lg-3">
		<label for="item-phone">Phone contact</label>
		<input type="text" class="form-control" id="item-phone" name="item-phone" value="<?php if (isset($item) && $item->phone) { echo $item->phone; } ?>">
	</div>
	<div class="form-group col-sm-6 col-md-4 col-lg-3">
		<label for="item-email">Email contact</label>
		<input type="text" class="form-control" id="item-email" name="item-email" value="<?php if (isset($item) && $item->mail) { echo $item->mail; } ?>">
	</div>
	<div class="hidden-sm col-md-4  col-lg-6">
		<div class="bs-callout bs-callout-warning help">
			<p>Please use the international format ex: <code>+56 9 3519 9467</code></p>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group col-sm-12 col-md-8 col-lg-6">
		<label for="item-website">Website contact</label>
		<div class="row">
			<div class="col-md-6">
				<input type="text" class="form-control" id="item-website" name="item-website" value="<?php if (isset($item) && $item->website) { echo $item->website; } ?>">				
			</div>
		</div>
	</div>
	<div class="hidden-sm col-md-4  col-lg-6">
		<div class="bs-callout bs-callout-warning help">
			<p>ex: <code>http://rutadeloscolonos.com</code></p>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group col-sm-12 col-md-8 col-lg-6">
		<label for="item-description">Description</label>
		<div class="row">
			<div class="col-md-12">
				<textarea id="item-description" name="item-description" class="form-control" rows="6"><?php if (isset($item) && $item->description) { echo $item->description; } ?></textarea>				
			</div>
		</div>
	</div>
	<div class="hidden-sm col-md-4  col-lg-6">
		<div class="bs-callout bs-callout-warning help">
			<p>Use <strong>all the keywords</strong> in your description, It'll be easier for the client to find you</p>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group col-sm-6 col-md-4 col-lg-3">
		<label for="item-image">Image Thumb</label>
		<div class="row">
			<div class="col-md-12">
				<div class="radio">
					<label>
						<input type="radio" name="item-image" value="0" <?php if (isset($item) && $item->image == 0) { echo "checked"; } ?>> Desactivated
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" name="item-image" value="1" <?php if (isset($item) && $item->image == 1) { echo "checked"; } ?>> Activated
					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group col-sm-6 col-md-4 col-lg-3 col-sm-pull-1">
                                <?php
                                if (isset($item) && $item->logo) { ?>
                                    <div class="row fileupload-buttonbar" > 
                                            <div class="col-lg-7">
                                                <img src="<?=C::D('LOGO_PATH').$item->logo;?>" class="img-thumbnail center-block" >   
                                                <span class="btn fileinput-button">                                                 
                                                    <button class="btn btn-danger delete" data-type="POST" data-url="/admin/logoupload/<?=$item->item_id."/".$item->logo ?>/delete">
                                                        <i class="glyphicon glyphicon-trash"></i><span>Delete</span>
                                                    </button>
                                                </span>
                                            </div>
                                     </div>
                                <?php   }   else { ?>
                                <?php   }  ?>                                            
                                            
                                            
                                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                <div class="row fileupload-buttonbar">
                                    <div class="col-lg-7">
                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                        <span class="btn btn-success fileinput-button">
                                            <i class="glyphicon glyphicon-plus"></i>
                                            <span>Add files...</span>
                                            <input type="file" name="files[]" multiple>
                                        </span>
                                        <!-- The global file processing state -->
                                        <span class="fileupload-process"></span>
                                    </div>
                                    <!-- The global progress state -->
                                    <div class="col-lg-5 fileupload-progress fade">
                                        <!-- The global progress bar -->
                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                        </div>
                                        <!-- The extended global progress state -->
                                        <div class="progress-extended">&nbsp;</div>
                                    </div>
                                </div>
                                <!-- The table listing the files available for upload/download -->
                                <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>                
                
                
	</div>
	<div class="hidden-sm col-md-4  col-lg-6">
		<div class="bs-callout bs-callout-warning help">
			<p>Name your image with your <code>'id'.jpg</code>. Your images must be stored in your ftp at <code>/www/public/storage/thumbs/</code> and the size should be 90x90 px.</p>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group col-sm-6 col-md-4 col-lg-3">
		<label for="item-lat">Latitude</label>
		<input type="text" class="form-control" id="item-lat" name="item-lat" value="<?php if (isset($item) && $item->latitude) { echo $item->latitude; } ?>">					</div>
	<div class="form-group col-sm-6 col-md-4 col-lg-3">
		<label for="item-long">Longitude</label>
		<input type="text" class="form-control" id="item-long" name="item-long" value="<?php if (isset($item) && $item->longitude) { echo $item->longitude; } ?>">
	</div>
	<div class="hidden-sm col-md-4  col-lg-6">
		<div class="bs-callout bs-callout-warning help">
			<p>Use <code>www.openstreetmap.org</code> to find your coordinates.</p>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12 col-md-8 col-lg-6" id="map-container">			
	</div>
	<div class="hidden-sm col-md-4  col-lg-6">
	</div>
</div>
<div class="row">
	<div class="form-group col-sm-12 col-md-8 col-lg-6">
		<label for="item-price">Price from :</label>
		<div class="row">
			<div class="col-md-6">
				<input type="text" id="item-price" class="form-control" name="item-price" value="<?php if (isset($item) && $item->price) { echo $item->price; } ?>">
			</div>
		</div>
	</div>
	<div class="hidden-sm col-md-4  col-lg-6">
		<div class="bs-callout bs-callout-warning help">
			<p>This is the starting price of your place. ex: <code>30000</code></p>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-2">
		<a href="/admin/places" class="btn btn-danger">Cancel modifications</a>			
	</div>
	<div class="col-xs-1">
		<button type="submit" class="btn btn-primary">Save</button>
	</div>
</div>

<script type="text/javascript">

$(document).ready(function () {

   
    $( "#item-category" ).change(function () {
            var str = "";
            $( "#item-category option:selected" ).each(function() {
                str = $( this ).val();
                console.log('->'+str );
                      
                $.ajax({
                    url: '/api/getTypesForCategory/' + str,
                    dataType: 'json'
                }).done(function(result) {
                    //$(this).fileupload('option', 'done').call(this, $.Event('done'), {result: result});
                    console.log('result-> ', result);

                    var $subType = $("#item-type");
                    $subType.empty();                    
                     //$(".type-select").i18n();
                    $.each(result, function (index,value) {
                               //$subType.append($('<option></option>').attr("value", this).text(this.name));
                               console.log(value);
                               $subType.append($('<option></option>').attr("value", index).text(value));
                    });                    
                    
                });                      
            });

      });
      
      
      
      
});


</script>