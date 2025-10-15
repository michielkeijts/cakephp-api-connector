<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class RemoveOldDatabase extends AbstractMigration
{
    public function up()
    {
        $this->execute("DROP TABLE IF EXISTS `cake_api_connector_dataobjects_old`");
    }

    public function down() {

    }
}
