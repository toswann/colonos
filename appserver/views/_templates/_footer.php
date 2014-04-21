    <script src="/public/lib/jquery.min.js"></script>
    <script src="/public/lib/bootstrap/js/bootstrap.min.js"></script>
	<?php if (isset($voteindex)) {?>
    	<script src="/public/lib/jquery.validate.min.js"></script>
    	<script src="/public/js/vote.index.js"></script>
	<?php } ?>
	<?php if (isset($placeshow)) {?>
	    <script src="/public/lib/rs.slideshow/jquery.rs.slideshow.min.js"></script>
    	<script src="/public/js/place.show.js"></script>
	<?php } ?>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-49827724-1', 'rutadeloscolonos.cl');
	  ga('send', 'pageview');
	
	</script>
  </body>
</html>
