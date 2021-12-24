<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Status $status
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $status->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $status->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Status'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Cliente Relationship'), ['controller' => 'ClienteRelationship', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cliente Relationship'), ['controller' => 'ClienteRelationship', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vw Detalle'), ['controller' => 'VwDetalle', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vw Detalle'), ['controller' => 'VwDetalle', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="status form large-9 medium-8 columns content">
    <?= $this->Form->create($status) ?>
    <fieldset>
        <legend><?= __('Edit Status') ?></legend>
        <?php
            echo $this->Form->control('nombre');
            echo $this->Form->control('last_update');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
