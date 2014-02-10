<?php

App::uses('AppHelper', 'View/Helper');

class BootstrapHelper extends AppHelper {

	public $helpers = array('Html','Paginator','Form');

	public function pageHeader($header = '') { ob_start(); ?>

		<div class="page-header">
		<h3><?php echo $header;?></h3>
		</div>

	<?php return ob_get_clean(); }

	public function btnLink($text = 'Adicionar', $url = array(), $type = 'default') {
		return $this->Html->link($text, $url, array('class'=>'btn btn-'.$type));

	}
	
	public function sorter($field = '', $text = '', $options = array()) {
		if ( $this->Paginator->sortKey() == $field ) {
			if ( $this->Paginator->sortDir() == 'desc') {
				$chevron = '&nbsp;<span class="glyphicon glyphicon-chevron-down">';
			} else {
				$chevron = '&nbsp;<span class="glyphicon glyphicon-chevron-up">';
			}
			$options['escape'] = false;
		} else {
			$chevron = '';
		}
		return $this->Paginator->sort($field, $text.$chevron, $options);
	}
	
	private function filter_type($filter) {
		switch ($filter['type']) {
			case 'select':
				ob_start(); ?>
				<select class="form-control" name="data[<?php echo $filter['model'].'.'.$filter['field'].']';?>">
				<?php foreach($filter['options'] as $key => $value) { ?>
					<option value="<?php echo $key; ?>"><?php echo $value;?></option>
				<?php } ?>
				</select>
				<?php return ob_get_clean();
				break;
			case 'text':
				ob_start(); ?>
				<input type="text" class="form-control">
				<?php return ob_get_clean();
				break;
		}
	}
	
	public function filters($fields = array()) { ob_start(); ?>
		<div class="panel panel-default">
			<div class="panel-body">
				<form method="post" class="form-inline">
					<input type="hidden" name="filter" value="1">
					<?php foreach($fields as $field) { ?>
					<?php echo $this->filter_type($field); ?>
					<?php } ?>
					<input type="submit" class="btn btn-default" value="Filtrar">
				</form>
			</div>
		</div>
		<?php return ob_get_clean();
	}

	// Formularios Bootstrap

	public function input($name = null, $options = array()) {

		$options = array_merge(
			array(
				'label' => $name,
				'value' => $this->request->data[Inflector::classify( $this->params['controller'] )][$name],
				'type' => 'text'
			),
			$options
		); 

		ob_start(); ?>

		<div class="form-group">
			<lable><?php echo $options['label']; ?></lable>
			<input value="<?php echo $options['value'];?>" type="<?php echo $options['type'];?>" class="form-control" name="<?php echo $name; ?>">
		</div>

		<?php return ob_get_clean(); 
	}

	public function select($name, $options = array()) {

		$options = array_merge(
			array(
				'label' => $name,
				'value' => $this->request->data[Inflector::classify( $this->params['controller'] )][$name],
				'options' => array()
			),
			$options
		);
		//pr($options);
		ob_start(); ?>

		<div class="form-group">
			<lable><?php echo $options['label']; ?></lable>
			<select class="form-control" name="<?php echo $name; ?>">
			<?php foreach ($options['options'] as $key => $value) { 
				$selected = ($key == $options['value'])?('selected="selected"'):('');
			?>
				<option <?php echo $selected; ?> value="<?php echo $key;?>"><?php echo $value;?></option>
			<?php } ?>
			</select>
		</div>

		<?php return ob_get_clean(); 
	}
	
	public function text($name, $options = array()) {
		
		$options = array_merge(
			array(
				'label' => $name,
				'value' => $this->request->data[Inflector::classify( $this->params['controller'] )][$name]
			),
			$options
		);

		ob_start(); ?>
		
		<div class="form-group">
			<lable><?php echo $options['label']; ?></lable>
			<textarea class="form-control" name="<?php echo $name; ?>"><?php echo $options['value'];?></textarea>
		</div>

		
		<?php return ob_get_clean();
	}

	public function paginator($paginator) {  ob_start(); ?>
		<ul class="pagination">
			<li><a href="#">&laquo;</a></li>
		<?php echo $this->Paginator->numbers(
			array(
				'separator' => null,
				'tag' => 'li',
				'currentClass' => 'active',
				'currentTag' => 'a',
				'escape' => false
			)
		); ?>
			<li><a href="#">&raquo;</a></li>
			<li><a href="#"><?php echo $this->Paginator->counter('{:page} de {:pages}'); ?></a></li>
		</ul>
		<?php //echo $this->Paginator->counter();?>
		<?php return ob_get_clean();
	}
	
	public function chamadaActions($id = 1) { ob_start(); ?>
		<div class="btn-group">
			<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
			Ações&nbsp;<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" role="menu">
				<li><?php echo $this->Html->Link('Editar', array('action'=>'edit', $id));?></li>
				<li><?php echo $this->Form->postLink('Excluir', array('action'=>'del', $id), null, 'Tem Certeza?');?></li>
				<li class="divider"></li>
				<li><?php echo $this->Html->Link('Adicionar Filha', array('action'=>'add', $id));?></li>
				<li><?php echo $this->Html->Link('Finalizar', array('action'=>'ending', $id));?></li>
			</ul>
		</div>
	<?php return ob_get_clean();	
	}

}
