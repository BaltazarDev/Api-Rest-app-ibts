<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEjecutivoCliente extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id_ejecutivo_cliente' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => true,
            ],
            'id_ejecutivo' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false
            ],
            'id_cliente' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id_ejecutivo_cliente');
        $this->forge->addKey('id_ejecutivo');
        $this->forge->addKey('id_cliente');
        $this->forge->createTable('ejecutivo_cliente');
	}

	public function down()
	{
		$this->forge->dropTable('ejecutivo_cliente');
	}
}
