<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<title>Ruta de los Colonos</title>
		
		<link href="<?php echo MAP_CSS_URL ?>/map.css" rel="stylesheet">		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script type="text/javascript">
			var env = "development";
			var cl = function(val) { (window.env == "development") ? console.log(val) : '';};	    
		</script>
		<script type="text/javascript" data-main="<?php echo MAP_JS_URL ?>" src="/public/lib/require.js"></script>
		<script type="text/javascript">
			require.config({
			urlArgs: "bust=" + (new Date()).getTime()
			});
		</script>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		  ga('create', 'UA-49827724-1', 'rutadeloscolonos.cl');
		  ga('send', 'pageview');
		
		</script>
	</head>
	<body id="colonosApp">
	</body>
</html>