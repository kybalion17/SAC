<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClienteRelationship[]|\Cake\Collection\CollectionInterface $clienteRelationship
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Cliente Relationship'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Colas'), ['controller' => 'Colas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cola'), ['controller' => 'Colas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Status'), ['controller' => 'Status', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Status'), ['controller' => 'Status', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="clienteRelationship index large-9 medium-8 columns content">
    <h3><?= __('Cliente Relationship') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ticket_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cliente_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cola_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_update') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clienteRelationship as $clienteRelationship): ?>
            <tr>
                <td><?= $this->Number->format($clienteRelationship->id) ?></td>
                <td><?= h($clienteRelationship->ticket_number) ?></td>
                <td><?= $clienteRelationship->has('cliente') ? $this->Html->link($clienteRelationship->cliente->id, ['controller' => 'Clientes', 'action' => 'view', $clienteRelationship->cliente->id]) : '' ?></td>
                <td><?= $clienteRelationship->has('cola') ? $this->Html->link($clienteRelationship->cola->id, ['controller' => 'Colas', 'action' => 'view', $clienteRelationship->cola->id]) : '' ?></td>
                <td><?= $clienteRelationship->has('status') ? $this->Html->link($clienteRelationship->status->id, ['controller' => 'Status', 'action' => 'view', $clienteRelationship->status->id]) : '' ?></td>
                <td><?= h($clienteRelationship->last_update) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $clienteRelationship->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $clienteRelationship->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $clienteRelationship->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clienteRelationship->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
