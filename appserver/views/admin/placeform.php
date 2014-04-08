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
			<?php if (isset($item) && $item->category) {
					foreach (C::TYPES($item->category) as $k => $v) { ?>
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
				<option value="<?=$k?>" <?php if (isset($item) && $item->city == $k) { echo "selected"; } ?>><?=$v?></option>
			<?php } ?>
		</select>				
	</div>
	<div class="form-group col-sm-6 col-md-4 col-lg-3">
		<label for="item-zone">Zona</label>
		<select class="form-control" id="item-zone" name="item-zone">
			<option>Zonas...</option>
			<?php foreach (C::ZONES() as $k => $v) { ?>
				<option value="<?=$k?>" <?php if (isset($item) && $item->zone == $k) { echo "selected"; } ?>><?=$v?></option>
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
	<div class="form-group col-sm-6 col-md-4 col-lg-3">
		<img src="/public/storage/thumbs/<?php if (isset($item) && $item->image == 1) { echo $item->id; } else echo "na"; ?>.jpg" class="img-thumbnail">
	</div>
	<div class="hidden-sm col-md-4  col-lg-6">
		<div class="bs-callout bs-callout-warning help">
			<p>Name your image with your <code>'id'.jpg</code>. Your images must be stored in your ftp at <code>/www/public/storage/thumbs/</code> and the size should be 90x90 px.</p>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group col-sm-6 col-md-4 col-lg-3">
		<label for="item-galery">Galery</label>
		<input type="text" id="item-galery" name="item-galery" class="form-control" value="<?php if (isset($item) && $item->galery) { echo $item->galery; } ?>">
	</div>
	<div class="form-group col-sm-6 col-md-4 col-lg-3">
		<?php if (isset($item) && $item->id) { ?>
		<p class="hint-id"><strong>hint:</strong> your id is <code><?php echo $item->id; ?></code></p>
		<? } ?>
	</div>
	<div class="hidden-sm col-md-4  col-lg-6">
		<div class="bs-callout bs-callout-warning help">
			<p>Indicate the number of images you have in your galery ex: <code>6</code> if you have 6 images. Your images must be stored in your ftp at <code>/www/public/storage/galeries/</code>, renamed id-numimage.jpg ex: <code>'3-1.jpg' ... '3-6.jpg'</code> and the size 600x400 px.</p>
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
