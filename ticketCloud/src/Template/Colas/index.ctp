<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cola[]|\Cake\Collection\CollectionInterface $colas
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Cola'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cliente Relationship'), ['controller' => 'ClienteRelationship', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cliente Relationship'), ['controller' => 'ClienteRelationship', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vw Detalle'), ['controller' => 'VwDetalle', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vw Detalle'), ['controller' => 'VwDetalle', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="colas index large-9 medium-8 columns content">
    <h3><?= __('Colas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tiempo_duracion_min') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_update') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($colas as $cola): ?>
            <tr>
                <td><?= $this->Number->format($cola->id) ?></td>
                <td><?= h($cola->nombre) ?></td>
                <td><?= $this->Number->format($cola->tiempo_duracion_min) ?></td>
                <td><?= h($cola->last_update) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $cola->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cola->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cola->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cola->id)]) ?>
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
