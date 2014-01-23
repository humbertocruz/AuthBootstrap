<div class="page-header">
	<h2>Faça seu Login nos Sistemas Fenapaes</h2>
</div>
	<div class="row">
	<div class="col-md-4 col-md-push-4">
		<div class="alert alert-info">
			<form method="post">
				<div class="form-group">
					<label for="usuario">Usuário</label>
					<input type="text" name="data[Usuario][usuario]" class="form-control" id="usuario" placeholder="CNPJ ou Usuário">
				</div>
				<div class="form-group">
					<label for="senha">Senha</label>
					<input type="password" name="data[Usuario][senha]" class="form-control" id="senha" placeholder="senha">
				</div>
				<?php if(isset($sistema_id)) { ?>
				<div class="form-group">
					<input type="checkbox" checked="checked" value="<?php echo $sistema_id; ?>" id="esqueceu" name="data[Usuario][sistema_id]">
					<label for="esqueceu">Voltar ao sistema original ?</label>
					<div class="help">
						Marque essa opção para retornar automaticamente ao sistema original.
					</div>
				</div>
				<?php } ?>
				<div class="form-group">
					<input type="checkbox" id="esqueceu" name="data[Usuario][esqueceu]">
					<label for="esqueceu">Esqueceu a senha ?</label>
					<div class="help">
						Marque essa opção para receber um email com o <strong>Token de Confirmação</strong> e alterar sua senha.
					</div>
				</div>
				<button type="submit" class="btn btn-primary">Login</button>
			</form>
		</div>
	</div>
</div>