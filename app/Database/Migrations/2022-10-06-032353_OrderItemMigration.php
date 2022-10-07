<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrderItemMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 50,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'item_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'items_amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'items_qty' => [
                'type'       => 'INT',
                'constraint' => 50,
            ],
            'fk_orderid' => [
                'type'           => 'INT',
                'constraint'     => 50,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('order_items');
    }

    public function down()
    {
        $this->forge->dropTable('order_items');
    }
}
