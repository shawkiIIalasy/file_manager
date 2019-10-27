<?php

use Cake\ORM\TableRegistry;
use Migrations\AbstractMigration;

class NotificationTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $notification=$this->table('notifications');
        $notification->addPrimaryKey('id','integer');
        $notification->addForeignKey('user_id','users');
        $notification->addColumn('name','string')
            ->addColumn('message','string')
            ->addColumn('user_id','integer')
            ->save();
    }
}
