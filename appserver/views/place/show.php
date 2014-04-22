<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2" id="place-show">
	<div class="row">
		<div class="col-xs-8">
			<h1 class="page-header"><?=$item->name?></h1>
			<p><strong><?=C::CATEGORIES($item->category)?> - <?=C::TYPES($item->category, $item->type)?></strong></p>			
			<?php if (isset($item->description) && $item->description) { ?>
			<div class="description">
				<blockquote><?=$item->description?></blockquote>
			</div>
			<?php } ?>
			<?php if (isset($item->price) && $item->price) { ?>
			<div class="other-infos">
				<p><strong data-i18n="place.show.other_infos">Otras informaciones :</strong></p>
				<p>Precio desde : <?=$item->price?></p>			
			</div>
			<?php } ?>
		</div>
		<div class="col-xs-4">
			<div class="thumbs">
				<?php if (isset($item->image) && $item->image == 1) { ?>
				<img src="/public/storage/thumbs/<?=$item->id?>.jpg" class="img-thumbnail" />
				<?php } else { ?>
				<img src="/public/storage/thumbs/na.jpg" class="img-rounded" />
				<?php } ?>
			</div>
			<div class="address">
				<address>
					<strong><?=$item->name?></strong><br>
					<?=$item->address?><br>
					<?=C::CITIES($item->city)?>, zona <?=C::ZONES($item->zone)?>
				</address>
				<address>
					<strong data-i18n="place.show.contact">Contacto</strong><br>
					<?php if (isset($item->phone) && $item->phone) { ?>
					<a href="tel:<?=$item->phone?>" target="_blank"><?=$item->phone?></a><br>
					<?php } if (isset($item->mail) && $item->mail) { ?>
					<a href="mailto:<?=$item->mail?>" target="_blank"><?=$item->mail?></a><br>
					<?php } if (isset($item->website) && $item->website) { ?>
					<a href="<?=$item->website?>" target="_blank"><?=$item->website?></a><br>
					<?php } ?>
				</address>
			</div>
		</div>
	</div>
	<?php if (isset($item->galery)) {
			$photos = unserialize($item->galery);
			if ($photos && count($photos) > 0) { ?>
	<div class="row">
		<div class="col-xs-12 galery">
			<p><strong data-i18n="place.show.galery">Galeria de fotos :</strong></p>
			<div class="rss-container">
			
				<div id="slideshow" class="rs-slideshow">
					<div class="slide-container">
						<img src="/public/storage/galeries/<?=$item->id."/".$photos[0]?>" alt="" />
					</div>
					<ol class="slides">
					<?php for ($i = 1; $i < count($photos) ;$i++) { ?>
						<li>
							<a href="/public/storage/galeries/<?=$item->id."/".$photos[$i]?>"></a>
						</li>
					<?php } ?>
					</ol>
				</div>
				
				
				<!--<ul class="controls clearfix">
					<li><a href="#" class="rs-play-pause" data-control-for="slideshow">Click to Pause</a></li>
					<li><a href="#" class="rs-prev" data-control-for="slideshow">Previous Slide</a></li>
					<li><a href="#" class="rs-next" data-control-for="slideshow">Next Slide</a></li>
				</ul>-->
				
			
			
			</div>

		</div>
	</div>
	<?php } } ?>
</div>
