<?php
use Migrations\AbstractMigration;

class Files extends AbstractMigration
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
        $files=$this->table('files');
        $files
            ->addColumn('name','string')
            ->addColumn('path','string')
            ->addColumn('user_id','integer')
            ->addColumn('created','timestamp',['default' => 'CURRENT_TIMESTAMP','update'=>'CURRENT_TIMESTAMP'])
            ->addColumn('modified','timestamp',['default' => 'CURRENT_TIMESTAMP','update'=>'CURRENT_TIMESTAMP']);

        $files->addPrimaryKey('id');
        $files->addForeignKey('user_id','users');
        $files->create();
    }
    /*
     *




     */
}
