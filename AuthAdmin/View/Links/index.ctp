<?php 
	// Permissoes
	$adicionar = ($this->AuthBs->hasPerm('Adicionar',$perms))?(true):(false);

	/**
	* Cria tabela de dados
	*/

	// Configura STATE ou "cor" da tabela de dados
	$state = 'info';
	
	echo '<div class="panel panel-default"><div class="panel-body">';
	
	echo $this->Form->create('Link', array('type' => 'get','class'=>'form-inline','role'=>'form','action'=>'index'));
	echo $this->Form->input('Sistema.menu_id', array('value'=>$menu_id, 'type'=>'select', 'div'=>'form-group', 'label'=>false, 'options'=>array($menus_list), 'class'=>'form-control'));
	echo $this->Form->end();
	
	echo '</div></div>';

	// Inicia tabela de dados
	echo $this->Element('AuthBootstrap.table/table-create', array(
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
				echo $this->Element('AuthBootstrap.table/row-actions-with-add', array(
					'state'=>'success',
					'label'=>'',
					'id'=>$link_pai['Link']['id'],
					'menu_id' => $menu_id,
					'desc' => $link_pai['Link']['text']
				)
			); ?>
		</td>
		<td><?php echo $link_pai['Link']['text']; ?></td>
		<td>---</td>
		<td><?php echo $link_pai['Link']['orderby']; ?></td>
	</tr>
	<?php foreach($link_pai['children'] as $link_filho) { ?>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;
			<?php 
				// Acation de cada linha
				echo $this->Element('AuthBootstrap.table/row-actions', array(
					'state'=>$state,
					'label'=>'',
					'id'=>$link_filho['Link']['id'],
					'menu_id' => $menu_id,
					'desc' => $link_filho['Link']['text']
				)
			); ?>
		</td>
		<td>&nbsp;&nbsp;&nbsp;<?php echo $link_filho['Link']['text']; ?></td>
		<td>&nbsp;&nbsp;&nbsp;<?php echo $link_filho['Link']['controller'].'/'.$link_filho['Link']['action']; ?></td>
		<td>&nbsp;&nbsp;&nbsp;<?php echo $link_filho['Link']['orderby']; ?></td>
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
<?php echo $this->Element('AuthBootstrap.table/table-end'); ?>

<script>
$(document).ready(function() {
	$('#SistemaMenuId').change(function(){
		location.href = $(this).parents('form').attr('action')+'/index/'+$(this).val();
	});
});
</script>