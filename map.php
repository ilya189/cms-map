<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Feedback module
 */
class Map extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->module('core');
    }

    public function autoload() {
       
    }

    // Index function
    public function index() {
		$query = $this->db->get('map_cities');
		$cities = $query->result_array();
		$this->template->assign('cities', $cities);
        $this->display_tpl('public');
    }
	
	function auto_complit($type) {
		
        $term = $this->input->get('term');
		
		if ($type == 'street') {
			$city_id = $this->input->get('city_id');

			$this->db->like('street', $term);
			$this->db->where('city_id',$city_id);
			$this->db->order_by('street', 'asc');

			$query = $this->db->get('map_streets');

			$streets = $query->result_array();

			foreach ($streets as $street) {
				$response[] = array(
					'value' => $street['street'],
					'id' => $street['id']
				);
			}
		}
		if ($type == 'house') {
			$street_id = $this->input->get('street_id');

			$this->db->like('house', $term);
			$this->db->where('street_id',$street_id);
			$this->db->order_by('house', 'asc');

			$query = $this->db->get('map_houses');

			$houses = $query->result_array();

			foreach ($houses as $house) {
				$response[] = array(
					'value' => $house['house'],
					'id' => $house['id']
				);
			}
		}
        echo json_encode($response);
    }

    // Install 
    public function _install()
    {
        
    	if( $this->dx_auth->is_admin() == FALSE) exit;

        $this->load->dbforge();

        $fields = array(
            'id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                         'auto_increment' => TRUE,
                     ),
            'city' => array(
                         'type' => 'VARCHAR',
                         'constraint' => 250,
                     ),
			'lat' => array(
                         'type' => 'DOUBLE ',
                     ),
			'lng' => array(
                         'type' => 'DOUBLE ',
                     ),
			'zoom' => array(
                         'type' => 'TINYINT',
                     ),
			'created' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                     ),
                 );
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('map_cities', TRUE);
		
		$fields = array(
            'id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                         'auto_increment' => TRUE,
                     ),
			'city_id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                     ),
            'street' => array(
                         'type' => 'VARCHAR',
                         'constraint' => 250,
                     ),
			'created' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                     ),
                 );
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('map_streets', TRUE);
		
		$fields = array(
            'id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                         'auto_increment' => TRUE,
                     ),
			'street_id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                     ),
            'house' => array(
                         'type' => 'VARCHAR',
                         'constraint' => 250,
                     ),
			'created' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                     ),
                 );
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('map_houses', TRUE);
		/*
        // Enable module autoload
        $this->db->where('name', 'sample_module');
        $this->db->update('components', array('autoload' => '1'));

        // Or
        $this->load->model('model_name');
        $this->model_name->make_install();
        */
    }

    // Delete module
    public function _deinstall()
    {
        
       	if( $this->dx_auth->is_admin() == FALSE) exit;
    
        $this->load->dbforge();
        $this->dbforge->drop_table('map_cities');
		$this->dbforge->drop_table('map_streets');
		$this->dbforge->drop_table('map_houses');
        
    }

    /**
     * Display template file
     */
    private function display_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/public/' . $file;
        $this->template->show('file:' . $file);
    }
	
	/**
     * Fetch template file
     */
    private function fetch_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/public/' . $file . '.tpl';
        return $this->template->fetch('file:' . $file);
    }

}

/* End of file sample_module.php */
