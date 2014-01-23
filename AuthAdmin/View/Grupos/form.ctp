<?php
	if (isset($this->data['Grupo']['icone'])) 
		$icon = $this->data['Grupo']['icone'];
	else 
		$icon = '';

	echo $this->Element('AuthBootstrap.breadcrumb');

	echo $this->Form->create('Grupo', array('role'=>'form', 'class' => 'form-vertical'));
	echo $this->Form->input('nome', array('div'=>'form-group','class'=>'form-control'));
	echo $this->Form->submit('Gravar', array('class'=>'btn btn-sm btn-info', 
		'after'=>'&nbsp;'.$this->Html->link('Cancelar', array('action'=>'index'), array('class'=>'btn btn-sm btn-default'))
	));
	echo $this->Form->end();