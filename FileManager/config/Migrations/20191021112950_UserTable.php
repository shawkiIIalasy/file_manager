<?php
use Migrations\AbstractMigration;
use Cake\Database\Schema\TableSchema;
class UserTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */

    public function up()
    {
        $users=$this->table('users');
        $users
            ->addColumn('username','string')
            ->addColumn('password','string')
            ->addColumn('created','datetime')
            ->addColumn('modified','datetime');
        $users->create();
        $users->addPrimaryKey('id');

    }
    public function down()
    {
        $this->table('users')->drop();
    }


}
