<?php header('Refresh: 3; URL=http://localhost/howfartoreach/'); ?>
<div class="col-md-12" style="background-image: url(../img/tires3.png);opacity: 0.7;">
	<center>
<h2 style= "margin-bottom: 800px;margin-top: 120px;">Welcome <?php echo $this->Html->link($current_user['login'], ['controller' => 'Users', 'action' => 'view', $current_user['id'] ]); ?></h2>
</center>
</div>