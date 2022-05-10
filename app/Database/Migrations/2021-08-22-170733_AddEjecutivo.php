<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEjecutivo extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id_ejecutivo' => [
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
            'apellido1' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'telefono' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => false
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id_ejecutivo');
        $this->forge->createTable('ejecutivo');
	}

	public function down()
	{
		$this->forge->dropTable('ejecutivo');
	}
}
