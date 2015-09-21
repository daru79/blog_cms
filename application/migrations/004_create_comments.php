<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Comments extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'article_id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'date' => array(
                'type' => 'DATE',
            ),
            'content' => array(
                'type' => 'TEXT',
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('comments');
    }

    public function down() {
        $this->dbforge->drop_table('comments');
    }
}