<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DEV. Administración - La Ruta de los Colonos</title>

    <link href="/public/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/public/css/site.css" rel="stylesheet">
    <link href="/public/css/admin.css" rel="stylesheet">
    <link href="/public/lib/fileupload/css/jquery.fileupload.css" rel="stylesheet">
    <link href="/public/lib/fileupload/css/jquery.fileupload-ui.css" rel="stylesheet">
    <link href="/public/lib/fileupload/css/blueimp-gallery.min.css" rel="stylesheet">
    <link href="/public/css/typeahead.css" rel="stylesheet">
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

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=URL?>admin">Administración</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
              <li><a href="#"><span class="glyphicon glyphicon-user"></span> (<abbr title="<?=F::getUserCurrentRole('Description')?>"><?=F::getUserData('name').', '.F::getUserCurrentRoleName().'</abbr>: '.C::ZONES(F::getUserData('zone_id')); ?>)</a></li>  
            <li><a href="/admin" class="glyphicon glyphicon-home"></a></li>
            <li><a href="/admin/logout" class="glyphicon glyphicon-off"></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
