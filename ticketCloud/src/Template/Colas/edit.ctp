<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cola $cola
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $cola->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $cola->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Colas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Cliente Relationship'), ['controller' => 'ClienteRelationship', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cliente Relationship'), ['controller' => 'ClienteRelationship', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vw Detalle'), ['controller' => 'VwDetalle', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vw Detalle'), ['controller' => 'VwDetalle', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="colas form large-9 medium-8 columns content">
    <?= $this->Form->create($cola) ?>
    <fieldset>
        <legend><?= __('Edit Cola') ?></legend>
        <?php
            echo $this->Form->control('nombre');
            echo $this->Form->control('tiempo_duracion_min');
            echo $this->Form->control('last_update');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
