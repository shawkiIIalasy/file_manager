<?php
use Migrations\AbstractMigration;

class UsersUpdatedAt extends AbstractMigration
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
        $user=$this->table('users');
        $user->changeColumn('username','string',['length'=>'255','null'=>false])
            ->changeColumn('created','timestamp')
            ->changeColumn('modified','timestamp',['default' => 'CURRENT_TIMESTAMP','update'=>'CURRENT_TIMESTAMP'])
            ->addIndex('username',['unique'=>true,'name'=>'idx_username'])
            ->update();
    }
}
