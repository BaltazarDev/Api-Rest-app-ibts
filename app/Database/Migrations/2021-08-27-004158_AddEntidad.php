<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEntidad extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'cod_entidad' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => true,
            ],
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('cod_entidad');
        $this->forge->createTable('entidad');
	}

	public function down()
	{
		$this->forge->dropTable('entidad');
	}
}
