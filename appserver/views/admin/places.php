<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Places</h1>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>State</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
		<?php for($i = 0; $i < count($items) ; $i++) { ?>
			<tr>
				<td><?=$i+1?></td>
				<td><?=$items[$i]->name?></td>
				<td><?=$items[$i]->state?></td>
				<td><a href="/admin/editplace/<?=$items[$i]->id?>">edit</a></td>
			</tr>
		
		<?php } ?>
		</tbody>
	</table>
</div>
