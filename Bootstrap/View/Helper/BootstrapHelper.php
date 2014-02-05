<?php

App::uses('AppHelper', 'View/Helper');

class BootstrapHelper extends AppHelper {

	public $helpers = array('Html','Paginator');

	public function pageHeader($header = '') { ob_start(); ?>

		<div class="page-header">
		<h3><?php echo $header;?></h3>
		</div>

	<?php return ob_get_clean(); }

	public function btnLink($text = 'Adicionar', $url = array(), $type = 'default') {
		return $this->Html->link($text, $url, array('class'=>'btn btn-'.$type));

	}

	// Formularios Bootstrap

	public function input($name = null, $options = array()) {

		$options = array_merge(
			array(
				'label' => $name,
				'value' => '',
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
				'value' => '',
				'options' => array()
			),
			$options
		);

		ob_start(); ?>

		<div class="form-group">
			<lable><?php echo $options['label']; ?></lable>
			<select value="<?php echo $options['value'];?>" class="form-control" name="<?php echo $name; ?>">
			<?php foreach ($options['options'] as $key => $value) { ?>
				<option value="<?php echo $key;?>"><?php echo $value;?></option>
			<?php } ?>
			</select>
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

}
