<?php
use CodeIgniter\Database\Migration;

class AddPoliza extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_poliza' => [
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
            'importe_menusal' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'prima' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'fecha_inicio' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'fecha_fin' => [
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
        $this->forge->addPrimaryKey('id_poliza');
        $this->forge->addKey('cod_tipo_producto');
        $this->forge->createTable('poliza');
    }

    public function down()
    {
        $this->forge->dropTable('poliza');
    }
}
