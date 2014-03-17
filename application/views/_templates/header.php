<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ruta de los Colonos</title>

    <link href="./public/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./public/lib/leaflet/leaflet.css" rel="stylesheet">

<!--     <link href="./public/css/style.css" rel="stylesheet"> -->
	<link rel="stylesheet/less" type="text/css" href="./public/css/style.less" />

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
		var env = "development";
		var cl = function(val) { (window.env == "development") ? console.log(val) : '';};	    
    </script>
	<script type="text/javascript" src="public/lib/less.min.js"></script>
	<script type="text/javascript" data-main="public/app/main" src="public/lib/require.js"></script>
	<script type="text/javascript">
	require.config({
	    urlArgs: "bust=" + (new Date()).getTime()
	});
	</script>
  </head>

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
          <a class="navbar-brand" href="#">Ruta de los Colonos</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Register</a></li>
            <li><a href="#">Log In</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>
      </div>
    </div>