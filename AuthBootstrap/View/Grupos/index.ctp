<?php 
	// Permissoes
	$adicionar = ($this->AuthBs->hasPerm('Adicionar',$perms))?(true):(false);

	/**
	* Cria tabela de dados
	*/

	// Configura STATE ou "cor" da tabela de dados
	$state = 'info';
	
	echo $this->Element('AuthBootstrap.table/table-create', array(
		'state'=>$state, 
		'title'=>'Grupos', 
		// Campos da tabela
		'fields'=>array(
			'Nome'
		)
	)); ?>
	<?php foreach($data as $sistema) { ?>
	<tr>
		<td>
			<?php 
				// Acation de cada linha
				echo $this->Element('AuthBootstrap.table/row-actions', array(
					'state'=>$state,
					'label'=>'',
					'id'=>$sistema['Grupo']['id'],
					'desc' => $sistema['Grupo']['nome']
				)
			); ?>
		</td>
		<td><?php echo $sistema['Grupo']['nome']; ?></td>
	</tr>
	<?php } ?>
	</table>
	<div class="panel-footer">
		<?php echo ($adicionar)?($this->Html->link(
			'Adicionar',
			array(
				'action'=>'add'
			),
			array(
				'class'=>'btn btn-sm btn-'.$state
			)
		)):(''); ?>
	</div>
<?php echo $this->Element('AuthBootstrap.table/table-end'); ?>