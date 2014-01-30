<?php
	if (isset($this->data['Menu']['icone'])) 
		$icon = $this->data['Menu']['icone'];
	else 
		$icon = '';

	echo $this->Element('Bootstrap.breadcrumb');

	$orderby_options = array(
		'text' => 'Alfabética',
		'orderby' => 'Ordenada'
	);

	echo $this->Form->create('Menu', array('role'=>'form', 'class' => 'form-vertical'));
	echo $this->Form->input('Menu.title', array('label'=>'Título','div'=>'form-group','class'=>'form-control'));
	echo $this->Form->input('Menu.orderby', array('type'=>'select', 'label'=>'Ordenação','div'=>'form-group','class'=>'form-control','options'=>$orderby_options));
	echo $this->Form->input('Menu.grupo_id', array('type'=>'select', 'label'=>'Grupo','div'=>'form-group','class'=>'form-control','options'=>$Grupos));
	echo $this->Form->submit('Gravar', array('class'=>'btn btn-sm btn-info', 
		'after'=>'&nbsp;'.$this->Html->link('Cancelar', array('action'=>'index'), array('class'=>'btn btn-sm btn-default'))
	));
	echo $this->Form->end();