<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\file[]|\Cake\Collection\CollectionInterface $files
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Upload File'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="files index large-9 medium-8 columns content">
    <h3><?= __('File') ?></h3>
    <?php $this->Paginator->li?>
    <?php echo $this->Form->create('',array('url'=>'/files/deleteAll'));?>
<div class="hh"></div>
    <table>

        <thead>
        <tr>

            <th><?php echo $this->Form->checkbox('',['name'=>'select[]','onClick'=>'toggle(this)'])?></th>
            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($files as $file): ?>
            <tr>
                <td><?php echo $this->Form->input('',['type'=>'checkbox','name'=>'select[]','value'=>$file->id,]) ?></td>
                <td><?= h($file->name) ?></td>
                <td><?= h($file->created) ?></td>
                <td><?= h($file->modified) ?></td>
                <td class="actions">

                    <?= $this->Html->link('', ['action' => 'view', $file->id],['class' =>'fa fa-eye fa-2x text-primary'])?>
                    <?= $this->Html->link('', ['action' => 'view', $file->id],['class'=>'fa fa-download fa-2x text-dark']) ?>
                    <?= $this->Form->postLink('', ['action' => 'delete', $file->id], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id),'class'=>'fa fa-close fa-2x text-danger']) ?>

                </td>
            </tr>

        <?php endforeach; ?>
        <tr>

        </tr>
        </tbody>

    </table>
    <?php if (count($files)>0) :?>
    <?=$this->Form->button('',['class'=>'bg-danger btn-lg fa fa-trash fa-lg text-white rounded right']);?>
    <?php echo $this->Form->end();?>
    <?php endif;?>
    <div class="paginator left">
        <ul class="pagination ">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
