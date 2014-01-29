<div class="row">
	<?php foreach($Sistemas as $sistema) { ?>
	<div class="col-md-4">
		<div class="panel panel-info">
			<div class="panel-heading">
			<h4 class="center-block"><?php echo $sistema['Sistema']['nome']; ?></h4>
			</div>
			<div class="panel-body">
				<a href="<?php echo $sistema['Sistema']['url'];?>">
					<img class="center-block" src="/ab/img/<?php echo $sistema['Sistema']['icone'];?>">
				</a>
			</div>
		</div>		
	</div>
<?php } ?>
</div>
