<div class="row">
	<?php foreach($AbSistemas as $sistema) { ?>
	<div class="col-md-4">
		<div class="panel panel-info">
			<div class="panel-heading">
			<h4 class="center-block"><?php echo $sistema['AbSistema']['nome']; ?></h4>
			</div>
			<div class="panel-body">
				<a href="<?php echo $sistema['AbSistema']['url'];?>">
					<img class="center-block" src="/ab/img/<?php echo $sistema['AbSistema']['icone'];?>">
				</a>
			</div>
		</div>		
	</div>
<?php } ?>
</div>
