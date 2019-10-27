<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$title = 'Files Manager';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title ?>:
        <?= $this->fetch('title') ?>

    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->css('font-awesome-4.7.0/css/font-awesome.min.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js')?>
    <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js')?>
    <?= $this->Html->script('bootstrap.js') ?>
    <?= $this->Html->script('app.js') ?>
    <?= $this->Html->script('notify.js') ?>


</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-2 medium-4 columns">
            <li class="name">
                <h1><a href="/files"><?= __('msg') ?></a></h1>

            </li>

        </ul>



        <div class="top-bar-section">

            <ul class="right">

                <?php if ($this->request->session()->read('Auth.User')):?>


                    <li>
                        <a class=" dropdown-toggle"  id="navbarDropdownMenuLink-5" data-toggle="dropdown" >
                            <span class="badge badge-danger">4</span>
                            <i class="fa fa-bell"></i>
                        </a>
                        <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink-5">
                            <a class="dropdown-item" style="background: white" href="#">Action </a>

                        </div>
                    </li>
                    <li><a  href=""><?= $this->request->session()->read('Auth.User.username')?></a></li>
                    <li><a  href="/auth/logout"> <?= __('Logout') ?></a></li>
                <?php endif;?>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
        <?= $this->Html->link('Arabic', ['controller'=>'App','action' => 'changeLang','ar_JO'],['class'=>'btn btn-success']); ?>
        <?= $this->Html->link('English', ['controller'=>'App','action' => 'changeLang','en_US'],['class'=>'btn btn-primary']); ?>
    </footer>
</body>
</html>
