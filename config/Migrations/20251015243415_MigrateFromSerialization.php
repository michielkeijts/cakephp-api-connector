<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class MigrateFromSerialization extends AbstractMigration
{
    public function up()
    {
        $max_id = 0;
        do {
            $rows = $this->fetchAll('SELECT * FROM `cake_api_connector_dataobjects` WHERE id > '.$max_id.' ORDER BY id ASC LIMIT 1000');

            if (empty($rows)) {
                break;
            }
            foreach ($rows as $row) {
                $max_id = max($row['id'], $max_id);

                try {
                    $row['data'] = unserialize($row['data']);
                } catch (\Throwable $e) {
                    $row['data'] = [];
                }

                $row['data'] = json_encode($row['data']);

                $this->execute("UPDATE `cake_api_connector_dataobjects` SET `data` = ? WHERE `id` = ?", [$row['data'], $row['id']]);
            }
        } while (TRUE);
    }

    public function down() {
        $max_id = 0;
        do {
            $rows = $this->fetchAll('SELECT * FROM `cake_api_connector_dataobjects` WHERE id > '.$max_id.' ORDER BY id ASC LIMIT 1000');

            if (empty($rows)) {
                break;
            }
            foreach ($rows as $row) {
                $max_id = max($row['id'], $max_id);

                try {
                    $row['data'] = json_decode($row['data'], TRUE);
                } catch (\Throwable $e) {
                    $row['data'] = [];
                }

                $row['data'] = serialize($row['data']);

                $this->execute("UPDATE `cake_api_connector_dataobjects` SET `data` = ? WHERE `id` = ?", [$row['data'], $row['id']]);
            }
        } while (TRUE);
    }
}
