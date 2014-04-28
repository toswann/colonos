<div class="col-sm-3 col-md-2 sidebar">
	<ul class="nav nav-sidebar">
	<?php if($_SESSION["user"]->type == C::D('TYPE_GENERAL_ADMIN')) { ?>
		<li class="<?=@$dashboard?>"><a href="/admin/dashboard">Dashboard</a></li>
		<li class="<?=@$rbac?>"><a href="/admin/rbac">Manage Roles & Permissions</a></li>  
                                <li class="<?=@$zoneadmins?>"><a href="/admin/zoneadmins">Manage Zone Admins</a></li>      
                                <li class="<?=@$votes?>"><a href="/admin/votes">Manage Votes</a></li> 
	<?php } ?>
	<?php if($_SESSION["user"]->type >= C::D('TYPE_ZONE_ADMIN')) { ?>
		<li class="<?=@$placeowners?>"><a href="/admin/owners">Manage my Owners</a></li>                    
	<?php } ?>
	<?php if($_SESSION["user"]->type >= C::D('TYPE_MODERATOR')) { ?>
		<li class="<?=@$places?>"><a href="/admin/places">Manage my Places</a></li>

	<?php } ?>
	</ul>
</div>
