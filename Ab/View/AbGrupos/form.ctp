<?php
	if (isset($this->data['AbGrupo']['icone'])) 
		$icon = $this->data['AbGrupo']['icone'];
	else 
		$icon = '';

	echo $this->Element('Ab.breadcrumb');

	echo $this->Form->create('AbGrupo', array('role'=>'form', 'class' => 'form-vertical'));
	echo $this->Form->input('nome', array('div'=>'form-group','class'=>'form-control'));
	echo $this->Form->submit('Gravar', array('class'=>'btn btn-sm btn-info', 
		'after'=>'&nbsp;'.$this->Html->link('Cancelar', array('action'=>'index'), array('class'=>'btn btn-sm btn-default'))
	));
	echo $this->Form->end();