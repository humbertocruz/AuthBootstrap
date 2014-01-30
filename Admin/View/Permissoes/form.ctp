<?php
	echo $this->Element('Bootstrap.breadcrumb');
	
	echo $this->Form->create('GruposLinksPermissoes', array('role'=>'form', 'class' => 'form-vertical'));
	echo $this->Form->input('link_id', array('type'=>'select','div'=>'form-group','class'=>'form-control','options'=>$Links));
	echo $this->Form->input('permissao_id', array('type'=>'select','div'=>'form-group','class'=>'form-control','options'=>$Permissoes));
	echo $this->Form->submit('Gravar', array('class'=>'btn btn-sm btn-info', 
		'after'=>'&nbsp;'.$this->Html->link('Cancelar', array('action'=>'index'), array('class'=>'btn btn-sm btn-default'))
	));
	echo $this->Form->end();