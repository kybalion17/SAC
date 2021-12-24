<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClienteRelationship $clienteRelationship
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Cliente Relationship'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Colas'), ['controller' => 'Colas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cola'), ['controller' => 'Colas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Status'), ['controller' => 'Status', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Status'), ['controller' => 'Status', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="clienteRelationship form large-9 medium-8 columns content">
    <?= $this->Form->create($clienteRelationship) ?>
    <fieldset>
        <legend><?= __('Add Cliente Relationship') ?></legend>
        <?php
            echo $this->Form->control('ticket_number');
            echo $this->Form->control('cliente_id', ['options' => $clientes]);
            echo $this->Form->control('cola_id', ['options' => $colas]);
            echo $this->Form->control('status_id', ['options' => $status]);
            echo $this->Form->control('last_update');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
