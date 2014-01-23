<div class="jumbotron">
	<h1>Olá <?php echo $usuario['nome'];?>!</h1>
	<p>Você tem acesso aos seguintes sistemas da rede FENAPAES</p>
</div>

<?php foreach ( $sistemas as $sistema ) { ?>
	<div class="well col-md-3" style="margin: 5px;">
		<img class="img-rounded" alt="140x140" style="width: 100%; display: block;"
			 src="<?php echo $sistema['Sistema']['icone'];?>">
		<h3><?php echo $sistema['Sistema']['nome']; ?></h3>
		<h5><?php echo $sistema['Grupo'][0]['nome']; ?></h5>
		<a href="<?php echo $sistema['Sistema']['url'];?>" target="_blank"><?php echo $sistema['Sistema']['url'];?></a><br>
		<br>
		<button class="btn btn-primary">Acessar</button>
	</div>
	<?php } ?>
