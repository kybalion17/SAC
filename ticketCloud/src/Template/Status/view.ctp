<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Status $status
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Status'), ['action' => 'edit', $status->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Status'), ['action' => 'delete', $status->id], ['confirm' => __('Are you sure you want to delete # {0}?', $status->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Status'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Status'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cliente Relationship'), ['controller' => 'ClienteRelationship', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cliente Relationship'), ['controller' => 'ClienteRelationship', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vw Detalle'), ['controller' => 'VwDetalle', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vw Detalle'), ['controller' => 'VwDetalle', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="status view large-9 medium-8 columns content">
    <h3><?= h($status->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($status->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($status->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Update') ?></th>
            <td><?= h($status->last_update) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Cliente Relationship') ?></h4>
        <?php if (!empty($status->cliente_relationship)): ?>
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
            <?php foreach ($status->cliente_relationship as $clienteRelationship): ?>
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
    <div class="related">
        <h4><?= __('Related Vw Detalle') ?></h4>
        <?php if (!empty($status->vw_detalle)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Client Id') ?></th>
                <th scope="col"><?= __('Client Dni') ?></th>
                <th scope="col"><?= __('Client Name') ?></th>
                <th scope="col"><?= __('Ticket Number') ?></th>
                <th scope="col"><?= __('Cola Id') ?></th>
                <th scope="col"><?= __('Cola Name') ?></th>
                <th scope="col"><?= __('Tiempo Atencion Minutos') ?></th>
                <th scope="col"><?= __('Status Id') ?></th>
                <th scope="col"><?= __('Status Name') ?></th>
                <th scope="col"><?= __('Fecha Asignacion') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($status->vw_detalle as $vwDetalle): ?>
            <tr>
                <td><?= h($vwDetalle->client_id) ?></td>
                <td><?= h($vwDetalle->client_dni) ?></td>
                <td><?= h($vwDetalle->client_name) ?></td>
                <td><?= h($vwDetalle->ticket_number) ?></td>
                <td><?= h($vwDetalle->cola_id) ?></td>
                <td><?= h($vwDetalle->cola_name) ?></td>
                <td><?= h($vwDetalle->tiempo_atencion_minutos) ?></td>
                <td><?= h($vwDetalle->status_id) ?></td>
                <td><?= h($vwDetalle->status_name) ?></td>
                <td><?= h($vwDetalle->fecha_asignacion) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'VwDetalle', 'action' => 'view', $vwDetalle->]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'VwDetalle', 'action' => 'edit', $vwDetalle->]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'VwDetalle', 'action' => 'delete', $vwDetalle->], ['confirm' => __('Are you sure you want to delete # {0}?', $vwDetalle->)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
