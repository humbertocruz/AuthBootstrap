<?php
	echo $this->Element('Ab.breadcrumb');

	echo $this->Form->create('AbUsuario', array('role'=>'form', 'class' => 'form-vertical'));

	echo $this->Form->input('nome', array('div'=>'form-group','class'=>'form-control'));
	echo $this->Form->input('usuario', array('label'=>'Usuário','div'=>'form-group','class'=>'form-control'));
	echo $this->Form->input('senha', array('value'=>'', 'type'=>'password','div'=>'form-group','class'=>'form-control'));

	echo $this->Form->input('AbGruposUsuario.grupo_id', array('type'=>'select','div'=>'form-group','class'=>'form-control','options'=>$AbGrupos));

	echo $this->Form->input('ativo', array('type'=>'checkbox','div'=>'checkbox','class'=>'checkbox'));

	echo $this->Form->submit('Gravar', array('class'=>'btn btn-sm btn-info', 
		'after'=>'&nbsp;'.$this->Html->link('Cancelar', array('action'=>'index'), array('class'=>'btn btn-sm btn-default'))
	));
	echo $this->Form->end();