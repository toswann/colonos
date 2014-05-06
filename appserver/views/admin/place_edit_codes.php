<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2" id="place-code">
	<h1 class="page-header">Códigos de opiniones</h1>
	<div class="row">
		<div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
			<div class="code-form-container">
				<form class="form-inline" role="form" method="POST" action="<?php echo URL; ?>admin/generatecode">
					<input type="hidden" name="item-id" value="<?=$item->item_id?>">
					<button type="submit" class="btn btn-primary">Generar</button>
					<div class="form-group">
						<label class="sr-only" for="nb-code">Password</label>
						<select class="form-control" id="nb-code" name="nb-code">
							<option value="1" selected>1 código</option>
							<option value="20">20 códigos</option>
							<option value="50">50 códigos</option>
						</select>				
					</div>
				</form>
			</div>
		</div>
		<div class="col-xs-6 col-sm-7 col-md-8 col-lg-9">
			<div class="bs-callout bs-callout-warning help">
				<p>Select the number of new you you want to generate</p>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
			<div class="code-form-container">
				<form class="form-inline" role="form" method="POST" action="<?php echo URL; ?>admin/generatecode">
					<input type="hidden" name="item-id" value="<?=$item->item_id?>">
					<button type="submit" class="btn btn-primary">Imprimir</button>
					<div class="form-group">
						<label class="sr-only" for="nb-code">Password</label>
						<select class="form-control" id="nb-code" name="nb-code">
							<option value="1" selected>1 código</option>
							<option value="20">20 códigos</option>
							<option value="50">50 códigos</option>
						</select>				
					</div>
				</form>
			</div>
		</div>
		<div class="col-xs-6 col-sm-7 col-md-8 col-lg-9">
			<div class="bs-callout bs-callout-warning help">
				<p>Select the number of new code you want to print</p>
			</div>
		</div>
	</div>
                <div class="row">
	<?php if ($nb_new_code > 0) { ?>
	
		<div class="col-xs-3 col-sm-3 col-md-3">
                                        <a href="<?=URL?>admin/printCodes/<?=$item->item_id?>" > <span class="glyphicon glyphicon-print"></span> Impresa Códigos de opiniones (<?=$nb_new_code?>)</a>
		</div>
		<?php } if ($nb_print_code > 0) { ?>

		<?php } if ($nb_used_code > 0) { ?>
		<div class="col-xs-6 col-sm-6 col-md-6">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th colspan="2"><?=$nb_used_code ?> códigos usados</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
				<?php for($i = 0; $i < count($codes) ; $i++) {
						if ($codes[$i]->status == C::D("CODE_STATUS_USED")) { ?>
					<tr>
						<td><strong><?=$codes[$i]->code?></strong></td>
						<td class="center-container"><span class="label label-<?=C::CODE_STATUS($codes[$i]->status, 1)?>"><?=C::CODE_STATUS($codes[$i]->status, 0)?></span></td>
						<td><?=$codes[$i]->used_date;?></td>
					</tr>				
				<?php } } ?>
				</tbody>
			</table>
		</div>
		<?php } ?>
	</div>
</div>
<script src="/public/lib/jquery.printThis.js"></script>
<script type="text/javascript">
$(".print").click(function() {
	
	
	var print;
	
	
	
	$("#test").printThis({
		debug: true,              //* show the iframe for debugging
		importCSS: false,           //* import page CSS
		printContainer: true,      //* grab outer container as well as the contents of the selector
		//loadCSS: "path/to/my.css", //* path to additional css file
		pageTitle: "",             //* add title to print page
		removeInline: false,       //* remove all inline styles from print elements
		printDelay: 333,           //* variable print delay
		header: null               //* prefix to html
	});		
})
</script>
