<!-- File: /app/View/Posts/edit.ctp -->
<div class="add">
<h3>Edite Aqui o Post</h3>
<?php
    echo $this->Form->create('Post');
    echo $this->Form->input('title' , array ('label' => 'Titulo'));
    echo $this->Form->input('body', array('rows' => '3', 'label' => 'Texto'));
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Html->link('Clique para voltar aos posts', array('controller' => 'posts', 'action' => 'index'));
    echo $this->Form->end('Save Post');