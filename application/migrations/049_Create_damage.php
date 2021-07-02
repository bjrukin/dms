<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * PROJECT
 *
 * @package         PROJECT
 * @author          <AUTHOR_NAME>
 * @copyright       Copyright (c) 2016
 */
// ---------------------------------------------------------------------------

/**
 * Migration_Create_damage
 *
 * Extends the CI_Migration class
 * 
 */
class Migration_Create_damage extends CI_Migration {

    function up() {

        if (!$this->db->table_exists('log_damage')) {
            // Setup Keys 
            $this->dbforge->add_key('id', TRUE);

            $this->dbforge->add_field(array(
                'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => TRUE),
                'created_by' => array('type' => 'int', 'constraint' => 11, 'null' => TRUE, 'unsigned' => TRUE),
                'updated_by' => array('type' => 'int', 'constraint' => 11, 'null' => TRUE, 'unsigned' => TRUE),
                'deleted_by' => array('type' => 'int', 'constraint' => 11, 'null' => TRUE, 'unsigned' => TRUE),
                'created_at' => array('type' => 'timestamp', 'default' => null),
                'updated_at' => array('type' => 'timestamp', 'default' => null),
                'deleted_at' => array('type' => 'timestamp', 'default' => null),
                'damage_id' => array('type' => 'int', 'constraint' => 11, 'null' => TRUE, 'unsigned' => TRUE),
                'name' => array('type' => 'varchar', 'constraint' => 255, 'null' => TRUE),
                'vehicle_created_at' => array('type' => 'timestamp', 'default' => null),
                'chass_no' => array('type' => 'int', 'constraint' => 11, 'null' => TRUE, 'unsigned' => TRUE),
                'description' => array('type' => 'text', 'null' => TRUE),
                'vehicle_id' => array('type' => 'int', 'constraint' => 11, 'null' => TRUE, 'unsigned' => TRUE),
                'repair_by' => array('type' => 'varchar', 'constraint' => 255, 'null' => TRUE),
                'repair_at' => array('type' => 'timestamp', 'default' => null),
                'image' => array('type' => 'varchar', 'constraint' => 255, 'null' => TRUE),
                'service_center' => array('type' => 'varchar', 'constraint' => 255, 'null' => TRUE),
                'amount' => array('type' => 'int', 'constraint' => 11, 'null' => TRUE, 'unsigned' => TRUE),
                'estimated_date_of_repair' => array('type' => 'date', 'default' => null),
            ));

            $this->dbforge->create_table('log_damage', TRUE);
        }
    }

    function down() {
        $this->dbforge->drop_table('log_damage');
    }

}
