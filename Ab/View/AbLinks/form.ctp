<?php
	if (isset($this->data['AbLink']['icon'])) 
		$icon = $this->data['AbLink']['icon'];
	else 
		$icon = '';

	echo $this->Element('Ab.breadcrumb');

	echo $this->Form->create('AbLink', array('role'=>'form', 'class' => 'form-vertical'));
	echo $this->Form->input('text', array('div'=>'form-group','class'=>'form-control'));
	echo $this->Form->input('plugin', array('div'=>'form-group','class'=>'form-control'));
	echo $this->Form->input('controller', array('div'=>'form-group','class'=>'form-control'));
	echo $this->Form->input('action', array('div'=>'form-group','class'=>'form-control'));
	echo $this->Form->input('orderby', array('div'=>'form-group','class'=>'form-control'));
	echo $this->Form->input('icone', array('type'=>'file', 'after' => '<span class="help-block">'.$icon.'</span>', 'div'=>'form-group','class'=>'form-control'));
	echo $this->Form->submit('Gravar', array('class'=>'btn btn-sm btn-info', 
		'after'=>'&nbsp;'.$this->Html->link('Cancelar', array('action'=>'index'), array('class'=>'btn btn-sm btn-default'))
	));
	echo $this->Form->end();