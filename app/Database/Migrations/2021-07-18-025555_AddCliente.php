<?php

use CodeIgniter\Database\Migration;

class AddCliente extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_cliente' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => true,
            ],
            'nif' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
                'unique' => true
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
                'unique' => true
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true
            ],
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => '40',
                'null' => false,
            ],
            'apellido1' => [
                'type' => 'VARCHAR',
                'constraint' => '40',
                'null' => false,
            ],
            'apellido2' => [
                'type' => 'VARCHAR',
                'constraint' => '40',
                'null' => false,
            ],
            'fecha_nacimiento' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => false,
            ],
            'domicilio' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
                'null' => false,
            ],
            'cp' => [
                'type' => 'VARCHAR',
                'constraint' => '40',
                'null' => false,
            ],
            'localidad' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ],
            'provincia' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ],
            'telefono' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id_cliente');
        $this->forge->createTable('cliente');
    }

    public function down()
    {
        $this->forge->dropTable('cliente');
    }
}
