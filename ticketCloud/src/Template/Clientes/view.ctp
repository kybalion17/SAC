<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cliente $cliente
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cliente'), ['action' => 'edit', $cliente->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cliente'), ['action' => 'delete', $cliente->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cliente->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Clientes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cliente'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cliente Relationship'), ['controller' => 'ClienteRelationship', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cliente Relationship'), ['controller' => 'ClienteRelationship', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="clientes view large-9 medium-8 columns content">
    <h3><?= h($cliente->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($cliente->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cliente->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dni') ?></th>
            <td><?= $this->Number->format($cliente->dni) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Update') ?></th>
            <td><?= h($cliente->last_update) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Cliente Relationship') ?></h4>
        <?php if (!empty($cliente->cliente_relationship)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Ticket Number') ?></th>
                <th scope="col"><?= __('Cliente Id') ?></th>
                <th scope="col"><?= __('Cola Id') ?></th>
                <th scope="col"><?= __('Status Id') ?></th>
                <th scope="col"><?= __('Last Update') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($cliente->cliente_relationship as $clienteRelationship): ?>
            <tr>
                <td><?= h($clienteRelationship->id) ?></td>
                <td><?= h($clienteRelationship->ticket_number) ?></td>
                <td><?= h($clienteRelationship->cliente_id) ?></td>
                <td><?= h($clienteRelationship->cola_id) ?></td>
                <td><?= h($clienteRelationship->status_id) ?></td>
                <td><?= h($clienteRelationship->last_update) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ClienteRelationship', 'action' => 'view', $clienteRelationship->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ClienteRelationship', 'action' => 'edit', $clienteRelationship->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ClienteRelationship', 'action' => 'delete', $clienteRelationship->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clienteRelationship->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
