<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTipoProducto extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'cod_tipo_producto' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => true,
            ],
			'cod_entidad' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false
            ],
            'descripcion' => [
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
        $this->forge->addPrimaryKey('cod_tipo_producto');
		$this->forge->addKey('cod_entidad');
        $this->forge->createTable('tipo_producto');
	}

	public function down()
	{
		$this->forge->dropTable('tipo_producto');
	}
}
