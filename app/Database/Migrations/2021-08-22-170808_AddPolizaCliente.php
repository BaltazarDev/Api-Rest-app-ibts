<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPolizaCliente extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id_poliza_cliente' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => true,
            ],
            'id_poliza' => [
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
        $this->forge->addPrimaryKey('id_poliza_cliente');
        $this->forge->addKey('id_poliza');
        $this->forge->addKey('id_cliente');
        $this->forge->createTable('poliza_cliente');
	}

	public function down()
	{
		$this->forge->dropTable('poliza_cliente');
	}
}
