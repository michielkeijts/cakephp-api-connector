<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class ChangeColumnToLongText extends AbstractMigration
{
    public function up()
    {
        $this->table('cake_api_connector_dataobjects')->changeColumn('data', 'text',
            [
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'null' => true,
            ]
        )->save();
    }

    public function down() {
        $this->table('cake_api_connector_dataobjects')->changeColumn('data', 'blob',
            [
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'null' => true,
            ]
        )->save();
    }
}
