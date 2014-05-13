<!-- Carousel ================================================== -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class=""></li>
        <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
    </ol>
    <div class="carousel-inner">
        <div class="item">
            <img data-src="/public/img/slider1_3.jpg" alt="Projecto Ruta de los Colonos" src="/public/img/slider1_3.jpg">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Que es Ruta de los Colonos</h1>
                    <p>Informaciones sobre projecto y su objetivos</p>
                    <p><a class="btn btn-lg btn-primary" href="<?=URL?>projec" role="button">Lea mas</a></p>
                </div>
            </div>
        </div>
        <div class="item active">
            <img data-src="/public/img/slider2.jpg" alt="Historia de Colonization" src="/public/img/slider2.jpg">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Historia de colonization</h1>
                    <p>Personas y fechas importantes, todo sobre la historia de colonization alemana en Chile</p>
                    <p><a class="btn btn-lg btn-primary" href="<?=URL?>history" role="button">Lea mas</a></p>
                </div>
            </div>
        </div>
        <div class="item">
            <img data-src="/public/img/slider3.jpg" alt="Alemanes en Chile" src="/public/img/slider3.jpg">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Alemanes en Chile</h1>
                    <p>Arboles genealogicos de familias alemanas en Chile</p>
                    <p><a class="btn btn-lg btn-primary" href="<?=URL?>people" role="button">Vea arboles</a></p>
                </div>
            </div>
        </div>
    </div>
    <a class="left carousel-control" href="<?=URL?>#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
    <a class="right carousel-control" href="<?=URL?>#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div><!-- /.carousel -->

<div class="container marketing">
    <div class="row">
        <div class="col-lg-4">
            <img class="img-circle" data-src="/public/img/image1.png" alt="140x140" src="/public/img/image1.png" style="width: 140px; height: 140px;">
            <h2>Ofertas</h2>
            <p>Donde alojarse? Donde comer? Informaciones practicas sobre el region.</p>
            <p><a class="btn btn-primary" href="<?=URL?>map" target="_blank"" role="button">Vea detalles »</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <img class="img-circle" data-src="/public/img/slider1.jpg" alt="140x140" src="/public/img/slider1.jpg" style="width: 140px; height: 140px;">
            <h2>Region</h2>
            <p>Atraciones turisticas, ciudades, todo sobre el region de Los Lagos.</p>
            <p><a class="btn btn-primary" href="<?=URL?>region" role="button">Lea mas »</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <img class="img-circle" data-src="/public/img/bandera.png" alt="140x140" src="/public/img/bandera.png" style="width: 140px; height: 140px;">
            <h2>Wiki</h2>
            <p>Todo sobre colonization alemana en Chile.</p>
            <p><a class="btn btn-primary" href="<?=URL?>wiki" role="button">Vea detalles »</a></p>
        </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->
    <hr class="featurette-divider">
</div>