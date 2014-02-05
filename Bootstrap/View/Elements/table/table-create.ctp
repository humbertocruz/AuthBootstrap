<?php echo $this->Bootstrap->paginator($this->Paginator); ?>
<div class="panel panel-<?php echo $state; ?>">
 	<div class="panel-heading">
  		<?php echo $title; ?>
 	</div>
	<table class="table table-striped table-hover">
	<tr class="panel">
		<th class="col-md-1">&nbsp;</th>
		<?php foreach ($fields as $field) { ?>
			<th><?php echo $field; ?></th>
		<?php } ?>
	</tr>