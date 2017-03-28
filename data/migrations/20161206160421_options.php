<?php

use Phinx\Migration\AbstractMigration;

class Options extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $pages = $this->table('options', ['id' => false, 'primary_key' => ['namespace', 'key']]);
        $pages
            ->addColumn('namespace', 'string', ['length' => 255, 'default' => 'default'])
            ->addColumn('key', 'string', ['length' => 255])
            ->addColumn('value', 'text')
            ->addColumn('description', 'text', ['null' => true])
            ->addTimestamps('created', 'updated')
            ->create();

        $data = [
            [
                'roleId' => 2,
                'module' => 'options',
                'privilege' => 'Management'
            ]
        ];

        $privileges = $this->table('acl_privileges');
        $privileges->insert($data)
            ->save();
    }
}
