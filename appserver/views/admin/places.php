<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="places">
	<h1 class="page-header">Places</h1>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>State</th>
				<th>Infos</th>
				<th>Galery</th>
				<th>Code</th>
			</tr>
		</thead>
		<tbody>
		<?php for($i = 0; $i < count($items) ; $i++) { ?>
			<tr>
				<td class="text"><?=$i+1?></td>
				<td class="text"><?=$items[$i]->name?></td>
				<td class="text"><span class="label label-<?=C::ITEM_STATE($items[$i]->state, 1)?>"><?=C::ITEM_STATE($items[$i]->state, 0)?></span></td>
				<td><a href="/admin/editinfos/<?=$items[$i]->id?>" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Edit infos</a></td>
				<td><a href="/admin/editphotos/<?=$items[$i]->id?>" class="btn btn-default"><span class="glyphicon glyphicon-camera"></span> Edit photos</a></td>
				<td><a href="/admin/editcodes/<?=$items[$i]->id?>" class="btn btn-default"><span class="glyphicon glyphicon-barcode"></span> Edit codes</a></td>
			</tr>
		
		<?php } ?>
		</tbody>
	</table>
</div>
