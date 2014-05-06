        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">¡Hola, <?= $_SESSION["user"]->name ?>!</h1>
          <h5 class="page-header">You are logged in as: 
              <?php 

                    echo '<b class="">'.F::getUserCurrentRoleName().'</b> <small class="text text-muted">'.F::getUserCurrentRole('Description').'</small>';
                    ?></h5><br>
          <div class="row placeholders">
