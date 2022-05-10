<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPropuesta extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id_propuesta' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => true,
            ],
            'cod_tipo_producto' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false
            ],
            'tipo_producto' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'importe' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id_propuesta');
        $this->forge->addKey('cod_tipo_producto');
        $this->forge->createTable('propuesta');
	}

	public function down()
	{
		$this->forge->dropTable('propuesta');
	}
}
