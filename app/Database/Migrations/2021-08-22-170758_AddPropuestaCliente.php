<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPropuestaCliente extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id_propuesta_cliente' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => true,
            ],
            'id_propuesta' => [
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
        $this->forge->addPrimaryKey('id_propuesta_cliente');
        $this->forge->addKey('id_propuesta');
        $this->forge->addKey('id_cliente');
        $this->forge->createTable('propuesta_cliente');
	}

	public function down()
	{
		$this->forge->dropTable('propuesta_cliente');
	}
}
