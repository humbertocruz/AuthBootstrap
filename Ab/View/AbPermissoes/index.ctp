<?php 
	/**
	* Cria tabela de dados
	*/

	// Configura STATE ou "cor" da tabela de dados
	$state = 'info';
	
	echo $this->Element('Ab.table/table-create', array(
		'state'=>$state, 
		'title'=>'Permissões', 
		// Campos da tabela
		'fields'=>array(
			'Grupo',
			'Link',
			'Permissão'
		)
	)); ?>
	<?php foreach($data as $permissao) { ?>
	<tr>
		<td>
			<?php 
				// Acation de cada linha
				echo $this->Element('Ab.table/row-actions-group', array(
					'state'=>$state,
					'label'=>'',
					'id'=>$permissao['AbGrupo']['id'],
					'desc' => $permissao['AbGrupo']['nome'],
					'class' => 'pull-right'
				)
			); ?>
		</td>
		<td><?php echo $permissao['AbGrupo']['nome']; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php foreach($permissao['AbGruposLinksPermissao'] as $links) { ?>
	<tr>
		<td>&nbsp;</td>
		<td>
		<?php 
			// Acation de cada linha
			echo $this->Element('Ab.table/row-actions-perm', array(
				'state'=>'danger',
				'label'=>'',
				'id'=>$links['id'],
				'desc' => $links['AbLink']['text'],
				'class' => 'pull-right'
			)
		); ?>
		</td>
		<td><?php echo $links['AbLink']['text']; ?></td>
		<td><?php echo $links['AbPermissao']['nome']; ?></td>
	</tr>
	<?php } ?>
	<?php } ?>
	</table>
	<div class="panel-footer">

	</div>
<?php echo $this->Element('Ab.table/table-end'); ?>