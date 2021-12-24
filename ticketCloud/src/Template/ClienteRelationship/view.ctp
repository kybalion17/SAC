<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClienteRelationship $clienteRelationship
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cliente Relationship'), ['action' => 'edit', $clienteRelationship->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cliente Relationship'), ['action' => 'delete', $clienteRelationship->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clienteRelationship->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cliente Relationship'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cliente Relationship'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Colas'), ['controller' => 'Colas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cola'), ['controller' => 'Colas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Status'), ['controller' => 'Status', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Status'), ['controller' => 'Status', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="clienteRelationship view large-9 medium-8 columns content">
    <h3><?= h($clienteRelationship->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Ticket Number') ?></th>
            <td><?= h($clienteRelationship->ticket_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cliente') ?></th>
            <td><?= $clienteRelationship->has('cliente') ? $this->Html->link($clienteRelationship->cliente->id, ['controller' => 'Clientes', 'action' => 'view', $clienteRelationship->cliente->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cola') ?></th>
            <td><?= $clienteRelationship->has('cola') ? $this->Html->link($clienteRelationship->cola->id, ['controller' => 'Colas', 'action' => 'view', $clienteRelationship->cola->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $clienteRelationship->has('status') ? $this->Html->link($clienteRelationship->status->id, ['controller' => 'Status', 'action' => 'view', $clienteRelationship->status->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($clienteRelationship->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Update') ?></th>
            <td><?= h($clienteRelationship->last_update) ?></td>
        </tr>
    </table>
</div>
