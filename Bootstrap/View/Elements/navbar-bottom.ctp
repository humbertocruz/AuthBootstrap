<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav pull-right">
			<?php foreach($belongsForms as $key=>$value) { ?>
				<li><a href="<?php echo $belongsForms[$key]['BelongsFormUrl']; ?>"><?php echo $key; ?></a></li>
			<?php } ?>
		</ul>
	</div>
</nav>
