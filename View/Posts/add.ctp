<!-- File: /app/View/Posts/add.ctp -->
<h2>Adicione um Post</h2>
<div class="add">

<?php
echo $this->Form->create('Post');
echo $this->Form->input('title', array ('label' => 'Titulo'));
echo $this->Form->input('body', array('rows' => '3' , 'label' => 'Texto'));
echo $this->Html->link('Clique para voltar aos posts', array('controller' => 'posts', 'action' => 'index'));
echo $this->Form->end('Salvar');
?>
