<?php
	$supMenu = 0;
	// Encontra o Menu Superior
	foreach ($menus as $menu) {
		if ($menu['Menu']['title'] == 'Menu Superior') $supMenu = $menu;
	}
?>
<script type="text/javascript">$(document).ready(function(){
	// Adiciona a class "active" ao menu atual
	$('ul.dropdown-menu li.active').each(function(){
		$(this).parents('.dropdown').addClass('active');
	})
});
</script>
<nav class="navbar navbar-default" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Alterar navigação</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="/">Admin</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li><a href="/">Home</a></li>
			<?php if (!empty($menus)) { ?>
			<?php foreach ($supMenu['Links'] as $link) { ?>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $link['Link']['text'];?> <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<?php foreach ($link['children'] as $sublink) {
						//$plugin = ($sublink['plugin'])?(''):('');
						$active = ($sublink['Link']['controller'] == $this->params['controller'] AND $sublink['Link']['action'] == $this->params['action'])?('class="active"'):('');
					?>
					<li <?php echo $active; ?>>
					<?php echo $this->Html->link($sublink['Link']['text'], array('plugin'=>$sublink['Link']['plugin'],'controller'=>$sublink['Link']['controller'],'action'=>$sublink['Link']['action'])); ?>
					</li>
					<?php } ?>
				</ul>
			</li>
			<?php } ?>
			<?php } ?>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $usuario['nome'];?> <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="/logout">Sair</a></li>
					<li><a href="#">Alterar Dados</a></li>
					<li class="divider"></li>
					<li><a href="#">Perfil</a></li>
				</ul>
			</li>
		</ul>
	</div>
</nav>
<?php //} ?>