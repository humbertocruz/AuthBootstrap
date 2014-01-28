<?php 
	// Permissoes
	$adicionar = ($this->AuthBs->hasPerm('Adicionar',$perms))?(true):(false);

	// Breadcrumb
	echo $this->Element('Ab.breadcrumb');

	/**
	* Cria tabela de dados
	*/
	// Configura STATE ou "cor" da tabela de dados
	$state = 'info';
	echo $this->Element('Ab.table/table-create', array(
		'state'=>$state, 
		'title'=>'Sistemas', 
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
				echo $this->Element('Ab.table/row-actions', array(
					'state'=>$state,
					'label'=>'',
					'id'=>$sistema['AbSistema']['id'],
					'desc' => $sistema['AbSistema']['nome']
				)
				);
			?>
		</td>
		<td><?php echo $sistema['AbSistema']['nome']; ?></td>
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
<?php echo $this->Element('Ab.table/table-end'); ?>