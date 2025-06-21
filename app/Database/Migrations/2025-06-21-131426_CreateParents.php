<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateParents extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'address_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'code'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 10,
            ],
            'name'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
            ],
            'email'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'       => true,
            ],
            'cpf'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 15,
                'null'       => true,
            ],
            'phone'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 15,
                'null'       => true,
            ],
            'created_at'       => [
                'type'       => 'DATETIME',
                'null'       => true,
                'default'    => null,
            ],
            'updated_at'       => [
                'type'       => 'DATETIME',
                'null'       => true,
                'default'    => null,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('address_id');
        $this->forge->addKey('code');
        $this->forge->addKey('name');
        $this->forge->addKey('email');
        $this->forge->addKey('cpf');
        $this->forge->addKey('phone');

        $this->forge->addForeignKey(
            fieldName: 'address_id',
            tableName: 'addresses',
            tableField: 'id',
            onUpdate: 'CASCADE',
            onDelete: 'CASCADE'
        );

        $this->forge->createTable('parents');
    }

    public function down()
    {
        $this->forge->dropTable('parents');
    }
}
