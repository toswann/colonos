<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administración - La Ruta de los Colonos</title>

    <link href="/public/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./public/css/site.css" rel="stylesheet">
    <link href="./public/css/admin.css" rel="stylesheet">
    <link href="./public/lib/fileupload/css/jquery.fileupload.css" rel="stylesheet">
    <link href="./public/lib/fileupload/css/jquery.fileupload-ui.css" rel="stylesheet">
    <link href="./public/lib/fileupload/css/blueimp-gallery.min.css" rel="stylesheet">
    <link href="./public/css/typeahead.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
            var env = "<?php echo APP_ENV ?>";
            var cl = function(val) { (window.env == "development") ? console.log(val) : '';};				    
    </script>
    <script type="text/javascript" src="<?php echo URL ?>public/lib/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo URL ?>public/lib/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo URL ?>public/lib/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo URL ?>public/lib/typeahead.bundle.js"></script>
    <script type="text/javascript" src="<?php echo URL ?>public/lib/handlebars-v1.3.0.js"></script>    
    
    
    <!--<script type="text/javascript" data-main="<?php echo URL.APP_FOLDER_NAME.'/main' ?>" src="<?php echo URL ?>public/lib/require.js"></script>-->
  </head>

  <!--<body id="colonosAppAdmin"> -->
  <body>


    <div class="container-fluid">
      <div class="row">
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2" id="place-code">
    <h1 class="page-header"><?=$item->name?> <small><a href="<?=URL?>admin/editcodes/<?=$item->item_id?>" class="label label-danger"><span class="glyphicon glyphicon-backward"></span> Go Back</a></small></h1>
                
	<div class="row">
		<div class="col-xs-6 col-sm-7 col-md-8 col-lg-9">
			<div class="bs-callout bs-callout-warning help">
                            <p id="printer"><a href="#" onclick="window.print()" class="label label-success"><span class="glyphicon glyphicon-print"></span> Impresa Códigos de opiniones</a></p>
			</div>
		</div>
	</div>		

                <div class="row">
	<?php if ($nb_new_code > 0) { ?>
	
		<div class="col-xs-3 col-sm-3 col-md-3">
                                        <a href="<?=URL?>admin/printCodes/<?=$item->item_id?>" > <span class="glyphicon glyphicon-print"></span> Impresa Códigos de opiniones (<?=$nb_new_code?>)</a>
		</div>
		<div class="col-xs-3 col-sm-3 col-md-3">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th colspan="2"><?=$nb_new_code ?> nuevos códigos</th>
					</tr>
				</thead>
				<tbody id="test">
				<?php for($i = 0; $i < count($codes) ; $i++) {
						if ($codes[$i]->status == C::D("CODE_STATUS_NEW")) { ?>
					<tr>
						<td><strong><?=$codes[$i]->code?></strong></td>
						<td><span class="label label-<?=C::CODE_STATUS($codes[$i]->status, 1)?>"><?=C::CODE_STATUS($codes[$i]->status, 0)?></span></td>
					</tr>				
				<?php } } ?>
				</tbody>
			</table>
		</div>
		<?php } ?>
	</div>

        
</div>