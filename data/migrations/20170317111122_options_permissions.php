<?php

use Phinx\Migration\AbstractMigration;

class OptionsPermissions extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $data = [
            [
                'roleId' => 2,
                'module' => 'options',
                'privilege' => 'Management'
            ],
            [
                'roleId' => 2,
                'module' => 'api',
                'privilege' => 'Options/Read'
            ],
            [
                'roleId' => 2,
                'module' => 'api',
                'privilege' => 'Options/Edit'
            ],
        ];

        $privileges = $this->table('acl_privileges');
        $privileges->insert($data)
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->execute('DELETE FROM acl_privileges WHERE module = "options"');
        $this->execute('DELETE FROM acl_privileges WHERE module = "api" AND privilege = "Options/Read"');
        $this->execute('DELETE FROM acl_privileges WHERE module = "api" AND privilege = "Options/Edit"');
    }
}
