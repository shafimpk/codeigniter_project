<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Selectitems extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'select_item' => [
                'type'=> 'VARCHAR',
                'constraint' => '150'
            ],
            'select_item_parent_id' => [
                'type' => 'INT',
                'null' => true                
            ],
            'created_at datetime default current_timestamp',
            
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('SelectItems');
    }

    public function down()
    {
        //
    }
}
