	
<!-- START THE FEATURETTES -->
<div class="container registration-container" style="padding-top: 100px" >
        <div class="row center-block">
                <legend>Forma de contacto</legend>
                <div class="row col-xs-5 col-lg-5">
                    <form class="form-horizontal" id="ContactForm" role="form" method='post' action="<?=URL?>/contact/send">

                            <div class="form-group">
                                <label for="user_name">Su nombre</label>
                                 <input type="text" class="form-control" id="user_name" name="user_name" rel="popover" data-content="Name" data-original-title="Name">
                            </div>

                            <div class="form-group">
                                <label for="user_email">Su e-mail</label>
                                 <input type="text" class="form-control" id="user_email" name="user_email" rel="popover" data-content="Email" data-original-title="Email">
                            </div> 

                            <div class="form-group">
                                <label for="message">Su mensaje</label>
                                 <input type="text" class="form-control" id="message" name="message" rel="popover" data-content="Message" data-original-title="Message" style="height: 200px;">
                            </div> 

                            <div class="form-group">
                                <label class="control-label"></label>
                                <button type="submit" class="btn btn-primary" >Enviar</button>
                                <div class="control-group success">
                                    <!-- TODO -->
                                </div>
                                <div class="control-group error">
                                    <!-- TODO -->
                                </div>
                            </div>
                    </form>
                </div>
      </div>
    <hr class="featurette-divider">
</div>
    <!-- /END THE FEATURETTES -->
