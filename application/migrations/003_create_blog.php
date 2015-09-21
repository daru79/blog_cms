<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Blog extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'alias' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'date' => array(
                'type' => 'DATE',
            ),
            'views' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'content' => array(
                'type' => 'TEXT',
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('blog');
    }

    public function down() {
        $this->dbforge->drop_table('blog');
    }
}