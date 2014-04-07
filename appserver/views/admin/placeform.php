<form role="form" class="item-form">
	<div class="row">
		<div class="form-group col-sm-12 col-md-8 col-lg-6">
			<label for="item-name">Name</label>
			<input type="text" class="form-control" id="item-name" value="<?php if (isset($item) && $item->name) { echo $item->name; } ?>">					</div>
		<div class="hidden-sm col-md-4  col-lg-6">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-sm-6 col-md-4 col-lg-3">
			<label for="item-category">Category</label>
			<select class="form-control" id="item-category">
				<option>Categorías...</option>
				<?php foreach (C::CATEGORIES() as $k => $v) { ?>
					<option value="<?=$k?>" <?php if (isset($item) && $item->category == $k) { echo "selected"; } ?>><?=$v?></option>
				<?php } ?>
			</select>				
		</div>
		<div class="form-group col-sm-6 col-md-4 col-lg-3">
			<label for="item-type">Type</label>
			<select class="form-control" id="item-type">
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
			<select class="form-control" id="item-city">
				<option>Ciudades...</option>
				<?php foreach (C::CITIES() as $k => $v) { ?>
					<option value="<?=$k?>" <?php if (isset($item) && $item->city == $k) { echo "selected"; } ?>><?=$v?></option>
				<?php } ?>
			</select>				
		</div>
		<div class="form-group col-sm-6 col-md-4 col-lg-3">
			<label for="item-zone">Zona</label>
			<select class="form-control" id="item-zone">
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
					<input type="text" class="form-control" id="item-address" value="<?php if (isset($item) && $item->address) { echo $item->address; } ?>">				
				</div>
			</div>
		</div>
		<div class="hidden-sm col-md-4  col-lg-6">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-sm-6 col-md-4 col-lg-3">
			<label for="item-phone">Phone contact</label>
			<input type="text" class="form-control" id="item-phone" value="<?php if (isset($item) && $item->phone) { echo $item->phone; } ?>">
		</div>
		<div class="form-group col-sm-6 col-md-4 col-lg-3">
			<label for="item-email">Email contact</label>
			<input type="text" class="form-control" id="item-email" value="<?php if (isset($item) && $item->mail) { echo $item->mail; } ?>">				</div>

		<div class="hidden-sm col-md-4  col-lg-6">
			<div class="alert alert-warning help">
				<p>Please une the internatinal form ex: +56 000 00 00</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-sm-12 col-md-8 col-lg-6">
			<label for="item-website">Website contact</label>
			<div class="row">
				<div class="col-md-6">
					<input type="text" class="form-control" id="item-website" value="<?php if (isset($item) && $item->website) { echo $item->website; } ?>">				
				</div>
			</div>
		</div>
		<div class="hidden-sm col-md-4  col-lg-6">
			<div class="alert alert-warning help">
				<p>ex: http://rutadeloscolonos.com</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-sm-12 col-md-8 col-lg-6">
			<label for="item-description">Description</label>
			<div class="row">
				<div class="col-md-12">
					<textarea id="item-description" class="form-control" rows="6"><?php if (isset($item) && $item->description) { echo $item->description; } ?></textarea>				
				</div>
			</div>
		</div>
		<div class="hidden-sm col-md-4  col-lg-6">
			<div class="alert alert-warning help">
				<p>Use all the keywords in your description, It'll be easier for the client to find you</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-sm-6 col-md-4 col-lg-3">
			<label for="item-lat">Latitude</label>
			<input type="text" class="form-control" id="item-lat" value="<?php if (isset($item) && $item->latitude) { echo $item->latitude; } ?>">					</div>
		<div class="form-group col-sm-6 col-md-4 col-lg-3">
			<label for="item-long">Longitude</label>
			<input type="text" class="form-control" id="item-long" value="<?php if (isset($item) && $item->longitude) { echo $item->longitude; } ?>">
		</div>
		<div class="hidden-sm col-md-4  col-lg-6">
			<div class="alert alert-warning help">
				<p>use www.openstreetmap.org to find your coordinates.</p>
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
					<input type="text" id="item-price" class="form-control" value="<?php if (isset($item) && $item->price) { echo $item->price; } ?>">
				</div>
			</div>
		</div>
		<div class="hidden-sm col-md-4  col-lg-6">
			<div class="alert alert-warning help">
				<p>This is the starting price of your place. ex: 30 000 $</p>
			</div>
		</div>
	</div>
	<button type="submit" class="btn btn-default">Submit</button>
</form>