<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductMigration extends Migration
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
            'product_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'product_desc' => [
                'type'       => 'TEXT',
                
            ],
            'qty' => [
                'type'       => 'INT',
                'constraint' => 50,
            ],
            'mrp' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'sellng_price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'product_desc' => [
                'type'       => 'TEXT',
                
            ],
            'fk_catid' => [
                'type'           => 'INT',
                'constraint'     => 50,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}

