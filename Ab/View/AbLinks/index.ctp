<?php 
	// Permissoes
	$adicionar = ($this->AuthBs->hasPerm('Adicionar',$perms))?(true):(false);

	/**
	* Cria tabela de dados
	*/

	// Configura STATE ou "cor" da tabela de dados
	$state = 'info';
	
	echo '<div class="panel panel-default"><div class="panel-body">';
	
	echo $this->Form->create('AbLink', array('type' => 'get','class'=>'form-inline','role'=>'form','action'=>'index'));
	echo $this->Form->input('AbSistema.menu_id', array('value'=>$menu_id, 'type'=>'select', 'div'=>'form-group', 'label'=>false, 'options'=>array($menus_list), 'class'=>'form-control'));
	echo $this->Form->end();
	
	echo '</div></div>';

	// Inicia tabela de dados
	echo $this->Element('Ab.table/table-create', array(
		'state'=>$state, 
		'title'=>'Links', 
		// Campos da tabela
		'fields'=>array(
			'Texto',
			'View',
			'Ordem'
		)
	)); ?>
	
	<?php foreach($data as $link_pai) { ?>
	<tr>
		<td>
			<?php 
				// Acation de cada linha
				echo $this->Element('Ab.table/row-actions-with-add', array(
					'state'=>'success',
					'label'=>'',
					'id'=>$link_pai['AbLink']['id'],
					'menu_id' => $menu_id,
					'desc' => $link_pai['AbLink']['text']
				)
			); ?>
		</td>
		<td><?php echo $link_pai['AbLink']['text']; ?></td>
		<td>---</td>
		<td><?php echo $link_pai['AbLink']['orderby']; ?></td>
	</tr>
	<?php foreach($link_pai['children'] as $link_filho) { ?>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;
			<?php 
				// Acation de cada linha
				echo $this->Element('Ab.table/row-actions', array(
					'state'=>$state,
					'label'=>'',
					'id'=>$link_filho['AbLink']['id'],
					'menu_id' => $menu_id,
					'desc' => $link_filho['AbLink']['text']
				)
			); ?>
		</td>
		<td>&nbsp;&nbsp;&nbsp;<?php echo $link_filho['AbLink']['text']; ?></td>
		<td>&nbsp;&nbsp;&nbsp;<?php echo $link_filho['AbLink']['controller'].'/'.$link_filho['AbLink']['action']; ?></td>
		<td>&nbsp;&nbsp;&nbsp;<?php echo $link_filho['AbLink']['orderby']; ?></td>
	</tr>
	<?php } ?>
	<?php } ?>
	</table>
	<div class="panel-footer">
		<?php echo ($adicionar)?($this->Html->link(
			'Adicionar',
			array(
				'action'=>'add/0/'.$menu_id
			),
			array(
				'class'=>'btn btn-sm btn-'.$state
			)
		)):(''); ?>
	</div>
<?php echo $this->Element('Ab.table/table-end'); ?>

<script>
$(document).ready(function() {
	$('#AbSistemaMenuId').change(function(){
		location.href = $(this).parents('form').attr('action')+'/index/'+$(this).val();
	});
});
</script>