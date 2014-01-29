<?php
	echo $this->Element('Bootstrap.breadcrumb');

	echo $this->Form->create('Usuario', array('role'=>'form', 'class' => 'form-vertical'));

	echo $this->Form->input('Usuario.nome', array('div'=>'form-group','class'=>'form-control'));
	echo $this->Form->input('Usuario.usuario', array('label'=>'Usuário','div'=>'form-group','class'=>'form-control'));
	echo $this->Form->input('Usuario.senha', array('value'=>'', 'type'=>'password','div'=>'form-group','class'=>'form-control'));

	echo $this->Form->input('GruposUsuario.grupo_id', array('type'=>'select','div'=>'form-group','class'=>'form-control','options'=>$Grupos));

	echo $this->Form->input('Usuario.ativo', array('type'=>'checkbox','div'=>'checkbox','class'=>'checkbox'));

	echo $this->Form->submit('Gravar', array('class'=>'btn btn-sm btn-info', 
		'after'=>'&nbsp;'.$this->Html->link('Cancelar', array('action'=>'index'), array('class'=>'btn btn-sm btn-default'))
	));
	echo $this->Form->end();