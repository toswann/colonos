<div class="container-fluid" id="colonosMapApp">
	<div class="row search">
		<div class="col-md-7">
			<div class="group-wrapper">
				<div class="btn-group" data-toggle="buttons">
					<label class="btn btn-default active">
						<input type="radio" name="options" id="option1"> All
					</label>
					<label class="btn btn-default">
						<input type="radio" name="options" id="option1"> Accomodation
					</label>
					<label class="btn btn-default">
						<input type="radio" name="options" id="option1"> Food
					</label>
					<label class="btn btn-default">
						<input type="radio" name="options" id="option1"> Culture
					</label>
					<label class="btn btn-default">
						<input type="radio" name="options" id="option1"> Nature
					</label>
					<label class="btn btn-default">
						<input type="radio" name="options" id="option1"> Aventure
					</label>
					<label class="btn btn-default">
						<input type="radio" name="options" id="option1"> Entertainement
					</label>
					<label class="btn btn-default">
						<input type="radio" name="options" id="option1"> Owner
					</label>
					<label class="btn btn-default">
						<input type="radio" name="options" id="option1"> Products
					</label>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="form-wrapper">
				<form class="form-inline" role="form">
					<div class="form-group">
						<select class="form-control">
							<option>All</option>
							<option>Frutillar</option>
							<option>Puerto montt</option>
							<option>Puerto Varas</option>
							<option>Llanquihue</option>
						</select>
					</div>
					<div class="form-group search-type-container">
<!--
						<select class="form-control">
							<option>All</option>
							<option>Frutillar</option>
							<option>Puerto montt</option>
							<option>Puerto Varas</option>
							<option>Llanquihue</option>
						</select>
-->
					</div>
					<div class="form-group">
						<label class="sr-only" for="exampleInputEmail2">Email address</label>
						<input type="email" class="form-control" id="exampleInputEmail2" placeholder="keywords...">
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-7 col-sm-12 mapside">
        	<div id="mapView"></div>
        </div>
        <div class="col-md-5 col-sm-12 dataside">
        	<div class="row">
	        	<div class="col-md-12 dataresult">
	        		<div class="wrapper results-number-container">
<!-- 						<p>We found <strong>9 results</strong> for your research.</p>		        		 -->
<!-- 						<img src="./public/img/loading.gif" > -->
	        		</div>
	        	</div>
        	</div>
        	<div class="row">
	        	<div class="col-md-12 datalist">
	        		<div class="wrapper results-list-container">
<!--
			        	<div class="row item">
			        	<div class="col-md-9">
				        	<div class="row name">
				        		<div class="col-md-12"><h3>Hotel Laguna Club</h3></div>
				        	</div>
				        	<div class="row category">
				        		<div class="col-md-12">
				        			<div class="category-item"><div class="raty"></div></div>
				        			<div class="category-item text">34 ratings</div>
				        			<div class="category-item text">- Hotel</div>
				        		</div>
				        	</div>
				        	<div class="row address">
				        		<div class="col-md-12">
				        			<span class="glyphicon glyphicon-map-marker"></span> Kilometro 3 Camino a Los Bajos, Frutillar, Chile
				        		</div>
				        	</div>
				        	<div class="row phone">
				        		<div class="col-md-12">
									<div class="pull-left"><span class="glyphicon glyphicon-phone-alt"></span> +56 65 33 0033</div>
									<div class="pull-right"><span class="glyphicon glyphicon-envelope"></span> contact@laguneclub.com</div>
 								</div>		        	
				        	</div>
			        	</div>
			        	<div class="col-md-3 thumb">
				        	<img src="./public/storage/thumbs/1.jpg" alt="Hotel Lagune Club" class="img-thumbnail">
			        	</div>
		        	</div>
			        	<div class="row item">
			        	<div class="col-md-9">
				        	<div class="row name">
				        		<div class="col-md-12"><h3>Hotel Boutique Frau Holle Am See</h3></div>
				        	</div>
				        	<div class="row category">
				        		<div class="col-md-12">
				        			<div class="category-item"><div class="raty"></div></div>
				        			<div class="category-item text">18 ratings</div>
				        			<div class="category-item text">- Hotel</div>
				        		</div>
				        	</div>
				        	<div class="row address">
				        		<div class="col-md-12">
				        			<span class="glyphicon glyphicon-map-marker"></span> Antonio Varas #54, Frutillar Bajo, Los Lagos Region, Chile
				        		</div>
				        	</div>
				        	<div class="row phone">
				        		<div class="col-md-12">
									<div class="pull-left"><span class="glyphicon glyphicon-phone-alt"></span> +56 65 42 1345</div>
									<div class="pull-right"><span class="glyphicon glyphicon-envelope"></span> contact@frau-holle.com</div>
 								</div>		        	
				        	</div>
			        	</div>
			        	<div class="col-md-3 thumb">
				        	<img src="./public/storage/thumbs/2.jpg" alt="Hotel Lagune Club" class="img-thumbnail">
			        	</div>
		        	</div>
			        	<div class="row item">
			        	<div class="col-md-9">
				        	<div class="row name">
				        		<div class="col-md-12"><h3>Chilotito Marino Restaurant</h3></div>
				        	</div>
				        	<div class="row category">
				        		<div class="col-md-12">
				        			<div class="category-item"><div class="raty"></div></div>
				        			<div class="category-item text">10 ratings</div>
				        			<div class="category-item text">- Restaurant</div>
				        		</div>
				        	</div>
				        	<div class="row address">
				        		<div class="col-md-12">
				        			<span class="glyphicon glyphicon-map-marker"></span> Palafitos de Angelmo local 19, Puerto Montt, Décima Región de Los Lagos, Chili
				        		</div>
				        	</div>
				        	<div class="row phone">
				        		<div class="col-md-12">
									<div class="pull-left"><span class="glyphicon glyphicon-phone-alt"></span> +56 65 27 7585</div>
									<div class="pull-right"><span class="glyphicon glyphicon-envelope"></span> reservation@chilotito.com</div>
 								</div>		        	
				        	</div>
			        	</div>
			        	<div class="col-md-3 thumb">
				        	<img src="./public/storage/thumbs/3.jpg" alt="Hotel Lagune Club" class="img-thumbnail">
			        	</div>
		        	</div>
			        	<div class="row item">
			        	<div class="col-md-9">
				        	<div class="row name">
				        		<div class="col-md-12"><h3>Hotel Laguna Club</h3></div>
				        	</div>
				        	<div class="row category">
				        		<div class="col-md-12">
				        			<div class="category-item"><div class="raty"></div></div>
				        			<div class="category-item text">34 ratings</div>
				        			<div class="category-item text">- Hotel</div>
				        		</div>
				        	</div>
				        	<div class="row address">
				        		<div class="col-md-12">
				        			<span class="glyphicon glyphicon-map-marker"></span> Kilometro 3 Camino a Los Bajos, Frutillar, Chile
				        		</div>
				        	</div>
				        	<div class="row phone">
				        		<div class="col-md-12">
									<div class="pull-left"><span class="glyphicon glyphicon-phone-alt"></span> +56 65 33 0033</div>
									<div class="pull-right"><span class="glyphicon glyphicon-envelope"></span> contact@laguneclub.com</div>
 								</div>		        	
				        	</div>
			        	</div>
			        	<div class="col-md-3 thumb">
				        	<img src="./public/storage/thumbs/1.jpg" alt="Hotel Lagune Club" class="img-thumbnail">
			        	</div>
		        	</div>
			        	<div class="row item">
			        	<div class="col-md-9">
				        	<div class="row name">
				        		<div class="col-md-12"><h3>Hotel Boutique Frau Holle Am See</h3></div>
				        	</div>
				        	<div class="row category">
				        		<div class="col-md-12">
				        			<div class="category-item"><div class="raty"></div></div>
				        			<div class="category-item text">18 ratings</div>
				        			<div class="category-item text">- Hotel</div>
				        		</div>
				        	</div>
				        	<div class="row address">
				        		<div class="col-md-12">
				        			<span class="glyphicon glyphicon-map-marker"></span> Antonio Varas #54, Frutillar Bajo, Los Lagos Region, Chile
				        		</div>
				        	</div>
				        	<div class="row phone">
				        		<div class="col-md-12">
									<div class="pull-left"><span class="glyphicon glyphicon-phone-alt"></span> +56 65 42 1345</div>
									<div class="pull-right"><span class="glyphicon glyphicon-envelope"></span> contact@frau-holle.com</div>
 								</div>		        	
				        	</div>
			        	</div>
			        	<div class="col-md-3 thumb">
				        	<img src="./public/storage/thumbs/2.jpg" alt="Hotel Lagune Club" class="img-thumbnail">
			        	</div>
		        	</div>
			        	<div class="row item">
			        	<div class="col-md-9">
				        	<div class="row name">
				        		<div class="col-md-12"><h3>Chilotito Marino Restaurant</h3></div>
				        	</div>
				        	<div class="row category">
				        		<div class="col-md-12">
				        			<div class="category-item"><div class="raty"></div></div>
				        			<div class="category-item text">10 ratings</div>
				        			<div class="category-item text">- Restaurant</div>
				        		</div>
				        	</div>
				        	<div class="row address">
				        		<div class="col-md-12">
				        			<span class="glyphicon glyphicon-map-marker"></span> Palafitos de Angelmo local 19, Puerto Montt, Décima Región de Los Lagos, Chili
				        		</div>
				        	</div>
				        	<div class="row phone">
				        		<div class="col-md-12">
									<div class="pull-left"><span class="glyphicon glyphicon-phone-alt"></span> +56 65 27 7585</div>
									<div class="pull-right"><span class="glyphicon glyphicon-envelope"></span> reservation@chilotito.com</div>
 								</div>		        	
				        	</div>
			        	</div>
			        	<div class="col-md-3 thumb">
				        	<img src="./public/storage/thumbs/3.jpg" alt="Hotel Lagune Club" class="img-thumbnail">
			        	</div>
		        	</div>
			        	<div class="row item">
			        	<div class="col-md-9">
				        	<div class="row name">
				        		<div class="col-md-12"><h3>Hotel Laguna Club</h3></div>
				        	</div>
				        	<div class="row category">
				        		<div class="col-md-12">
				        			<div class="category-item"><div class="raty"></div></div>
				        			<div class="category-item text">34 ratings</div>
				        			<div class="category-item text">- Hotel</div>
				        		</div>
				        	</div>
				        	<div class="row address">
				        		<div class="col-md-12">
				        			<span class="glyphicon glyphicon-map-marker"></span> Kilometro 3 Camino a Los Bajos, Frutillar, Chile
				        		</div>
				        	</div>
				        	<div class="row phone">
				        		<div class="col-md-12">
									<div class="pull-left"><span class="glyphicon glyphicon-phone-alt"></span> +56 65 33 0033</div>
									<div class="pull-right"><span class="glyphicon glyphicon-envelope"></span> contact@laguneclub.com</div>
 								</div>		        	
				        	</div>
			        	</div>
			        	<div class="col-md-3 thumb">
				        	<img src="./public/storage/thumbs/1.jpg" alt="Hotel Lagune Club" class="img-thumbnail">
			        	</div>
		        	</div>
			        	<div class="row item">
			        	<div class="col-md-9">
				        	<div class="row name">
				        		<div class="col-md-12"><h3>Hotel Boutique Frau Holle Am See</h3></div>
				        	</div>
				        	<div class="row category">
				        		<div class="col-md-12">
				        			<div class="category-item"><div class="raty"></div></div>
				        			<div class="category-item text">18 ratings</div>
				        			<div class="category-item text">- Hotel</div>
				        		</div>
				        	</div>
				        	<div class="row address">
				        		<div class="col-md-12">
				        			<span class="glyphicon glyphicon-map-marker"></span> Antonio Varas #54, Frutillar Bajo, Los Lagos Region, Chile
				        		</div>
				        	</div>
				        	<div class="row phone">
				        		<div class="col-md-12">
									<div class="pull-left"><span class="glyphicon glyphicon-phone-alt"></span> +56 65 42 1345</div>
									<div class="pull-right"><span class="glyphicon glyphicon-envelope"></span> contact@frau-holle.com</div>
 								</div>		        	
				        	</div>
			        	</div>
			        	<div class="col-md-3 thumb">
				        	<img src="./public/storage/thumbs/2.jpg" alt="Hotel Lagune Club" class="img-thumbnail">
			        	</div>
		        	</div>
			        	<div class="row item">
			        	<div class="col-md-9">
				        	<div class="row name">
				        		<div class="col-md-12"><h3>Chilotito Marino Restaurant</h3></div>
				        	</div>
				        	<div class="row category">
				        		<div class="col-md-12">
				        			<div class="category-item"><div class="raty"></div></div>
				        			<div class="category-item text">10 ratings</div>
				        			<div class="category-item text">- Restaurant</div>
				        		</div>
				        	</div>
				        	<div class="row address">
				        		<div class="col-md-12">
				        			<span class="glyphicon glyphicon-map-marker"></span> Palafitos de Angelmo local 19, Puerto Montt, Décima Región de Los Lagos, Chili
				        		</div>
				        	</div>
				        	<div class="row phone">
				        		<div class="col-md-12">
									<div class="pull-left"><span class="glyphicon glyphicon-phone-alt"></span> +56 65 27 7585</div>
									<div class="pull-right"><span class="glyphicon glyphicon-envelope"></span> reservation@chilotito.com</div>
 								</div>		        	
				        	</div>
			        	</div>
			        	<div class="col-md-3 thumb">
				        	<img src="./public/storage/thumbs/3.jpg" alt="Hotel Lagune Club" class="img-thumbnail">
			        	</div>
		        	</div>
-->
	        		</div>
	        	</div>
        	</div>
        </div>
	</div>
</div>

<script src="./public/lib/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="./public/lib/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="./public/lib/less.min.js" type="text/javascript"></script>
<script src="./public/lib/leaflet/leaflet.js" type="text/javascript"></script>
<script src="./public/lib/raty/jquery.raty.js" type="text/javascript"></script>
<script src="./public/lib/json2.js" type="text/javascript"></script>
<!-- Replace with  .min version for production-->
<script src="./public/lib/underscore.js" type="text/javascript"></script>
<script src="./public/lib/backbone.js" type="text/javascript"></script>

<script src="./public/lib/backbone.query.min.js" type="text/javascript"></script>

<script src="./public/js/app.js" type="text/javascript"></script>
<script src="./public/js/bbapp.js" type="text/javascript"></script>

<script type="text/template" id="search-type-template">
	<select class="form-control">
		<option>All</option>
		<option>Type 1</option>
		<option>Type 2</option>
	</select>
</script>

<script type="text/template" id="result-template">
	<p>We found <strong>9 results</strong> for your research.</p
</script>

<script type="text/template" id="item-template">
	<div class="row item">
		<div class="col-md-9">
	    	<div class="row name">
	    		<div class="col-md-12"><h3>Hotel Laguna Club</h3></div>
	    	</div>
	    	<div class="row category">
	    		<div class="col-md-12">
	    			<div class="category-item"><div class="raty"></div></div>
	    			<div class="category-item text">34 ratings</div>
	    			<div class="category-item text">- Hotel</div>
	    		</div>
	    	</div>
	    	<div class="row address">
	    		<div class="col-md-12">
	    			<span class="glyphicon glyphicon-map-marker"></span> Kilometro 3 Camino a Los Bajos, Frutillar, Chile
	    		</div>
	    	</div>
	    	<div class="row phone">
	    		<div class="col-md-12">
					<div class="pull-left"><span class="glyphicon glyphicon-phone-alt"></span> +56 65 33 0033</div>
					<div class="pull-right"><span class="glyphicon glyphicon-envelope"></span> contact@laguneclub.com</div>
					</div>		        	
	    	</div>
		</div>
		<div class="col-md-3 thumb">
	    	<img src="./public/storage/thumbs/1.jpg" alt="Hotel Lagune Club" class="img-thumbnail">
		</div>
	</div>
</script>
