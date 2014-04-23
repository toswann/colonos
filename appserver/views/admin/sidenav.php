<div class="col-sm-3 col-md-2 sidebar">
	<ul class="nav nav-sidebar">
	<?php if($_SESSION["user"]->type == C::D('TYPE_GENERAL_ADMIN')) { ?>
		<li class="<?=$dashboard?>"><a href="/admin/dashboard">Dashboard</a></li>
		<li class="<?=$zoneadmins?>"><a href="/admin/listzoneadmins">Manage Zone Admins</a></li>      
                                <li class="<?=$managevotes?>"><a href="/admin/listvotes">See all votes</a></li> 
	<?php } ?>
	<?php if($_SESSION["user"]->type >= C::D('TYPE_ZONE_ADMIN')) { ?>
		<li class="<?=$placeowners?>"><a href="/admin/listowners">Manage Owners</a></li>                    
	<?php } ?>
	<?php if($_SESSION["user"]->type >= C::D('TYPE_MODERATOR')) { ?>
		<li class="<?=$newplace?>"><a href="/admin/newplace">Add a new place</a></li>
		<li class="<?=$places?>"><a href="/admin/places">See my places</a></li>

	<?php } ?>
	</ul>
</div>
