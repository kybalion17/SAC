<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cliente $cliente
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Clientes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Cliente Relationship'), ['controller' => 'ClienteRelationship', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cliente Relationship'), ['controller' => 'ClienteRelationship', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="clientes form large-9 medium-8 columns content">
    <?= $this->Form->create($cliente) ?>
    <fieldset>
        <legend><?= __('Add Cliente') ?></legend>
        <?php
            echo $this->Form->control('dni');
            echo $this->Form->control('nombre');
            echo $this->Form->control('last_update');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
