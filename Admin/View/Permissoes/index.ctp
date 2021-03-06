<?php 

	// Breadcrumb
	echo $this->Element('Bootstrap.breadcrumb');

	/**
	* Cria tabela de dados
	*/

	// Configura STATE ou "cor" da tabela de dados
	$state = 'info';
	
	echo $this->Element('Bootstrap.table/table-create', array(
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
				echo $this->Element('Bootstrap.table/row-actions-group', array(
					'state'=>$state,
					'label'=>'',
					'id'=>$permissao['Grupo']['id'],
					'desc' => $permissao['Grupo']['nome'],
					'class' => 'pull-right'
				)
			); ?>
		</td>
		<td><?php echo $permissao['Grupo']['nome']; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php foreach($permissao['GruposLinksPermissao'] as $links) { ?>
	<tr>
		<td>&nbsp;</td>
		<td>
		<?php 
			// Acation de cada linha
			echo $this->Element('Bootstrap.table/row-actions-perm', array(
				'state'=>'danger',
				'label'=>'',
				'id'=>$links['id'],
				'desc' => $links['Link']['text'],
				'class' => 'pull-right'
			)
		); ?>
		</td>
		<td><?php echo $links['Link']['text']; ?></td>
		<td><?php echo $links['Permissao']['nome']; ?></td>
	</tr>
	<?php } ?>
	<?php } ?>
	</table>
	<div class="panel-footer">

	</div>
<?php echo $this->Element('Bootstrap.table/table-end'); ?>