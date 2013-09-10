<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Feedback Module
 */

class Admin extends BaseAdminController {
   
	public function __construct()
	{
		parent::__construct();

        // Only admin access 
        $this->load->library('DX_Auth');
		$this->load->library('Form_validation');
        //cp_check_perm('module_admin'); 
	}


    // Display settings form
	public function index()
	{
        $this->template->assign('cities', $this->get_cities());
	    $this->display_tpl('cities');
	}
	
	public function get_cities()
	{
		$query = $this->db->get('map_cities');
		
		if ($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        } 
	}
	
	public function create_city_tpl()
	{
		$this->display_tpl('create_city');
	}
	
	function create_city() {
        //cp_check_perm('menu_create');
        if ($_POST['city_name'] == NULL) {
            showMessage(lang('a_menu_field_emp'), '', 'r');
            exit;
        }

        $val = $this->form_validation;
        $val->set_rules('city_name', 'Населенный пункт', 'trim|required|xss_clean|max_length[250]');
		$val->set_rules('city_lat', 'Широта', 'trim|xss_clean|numeric');
		$val->set_rules('city_lng', 'Долгота', 'trim|xss_clean|numeric');
		$val->set_rules('city_zoom', 'Зум', 'trim|xss_clean|integer');

        if ($this->form_validation->run($this) == FALSE) {
            showMessage(validation_errors(), '', 'r');
        } else {
            $data = array(
                'city' => $this->input->post('city_name'),
				'lat' => $this->input->post('city_lat'),
				'lng' => $this->input->post('city_lng'),
				'zoom' => $this->input->post('city_zoom'),
                'created' => time()
            );

            $this->db->insert('map_cities', $data);

            showMessage('Населенный пункт добавлен');
            if ($this->input->post('action') == 'tomain')
                pjax('/admin/components/cp/map');
            else
                pjax('/admin/components/cp/map/edit_city/' . $this->db->insert_id());
        }
    }
	
	function edit_city($id) {
        //cp_check_perm('menu_edit');
		$this->db->where('id',$id);
        $query = $this->db->get('map_cities');
        $city_data = $query->row_array();
        $this->template->add_array($city_data);
        $this->display_tpl('edit_city');
    }
	
	function update_city($id) {

        $val = $this->form_validation;
        $val->set_rules('city_name', 'Населенный пункт', 'trim|required|xss_clean|max_length[250]');
		$val->set_rules('city_lat', 'Широта', 'trim|xss_clean|numeric');
		$val->set_rules('city_lng', 'Долгота', 'trim|xss_clean|numeric');
		$val->set_rules('city_zoom', 'Зум', 'trim|xss_clean|integer');

        if ($this->form_validation->run($this) == FALSE) {
            showMessage(validation_errors(), '', 'r');
        } else {

            $data = array(
                'city' => $this->input->post('city_name'),
				'lat' => $this->input->post('city_lat'),
				'lng' => $this->input->post('city_lng'),
				'zoom' => $this->input->post('city_zoom'),
                'created' => time()
            );


            $this->db->where('id', $id);
            $this->db->update('map_cities', $data);
            showMessage('Изменения сохранены');
            if ($_POST['action'] == 'tomain')
                pjax('/admin/components/cp/map');
        }
    }
	
	function delete_city($id = null) {
		if ($id == null) {
            $id = $this->input->post('ids');
            foreach ($id as $i) {
                $this->db->limit(1);
				$this->db->where('city_id', $i);
				$query = $this->db->get('map_streets');
				if ($query->num_rows() > 0) {
					showMessage('Удалите улицы для id - ' . $i);
					return;
				} else {
					$this->db->limit(1);
					$this->db->delete('map_cities',array('id' => $i));
				}
            }
            showMessage(lang('a_menu_deleted'));
            pjax('/admin/components/cp/map');
        } else {
			$this->db->limit(1);
			$this->db->where('city_id', $id);
			$query = $this->db->get('map_streets');
			if ($query->num_rows() > 0) {
				showMessage('Удалите улицы для id - ' . $id);
				return;
			} else {
				$this->db->limit(1);
				$this->db->delete('map_cities',array('id' => $id));
			}
            showMessage(lang('a_menu_deleted'));
            pjax('/admin/components/cp/map');
        }
    }
	
	function city_streets($id = 0)
	{
		$this->db->where('city_id', $id);
		$this->db->order_by('street', 'asc');
		$query = $this->db->get('map_streets');
		$streets_data = $query->result_array();
		$this->template->assign('streets', $streets_data);
		
		$ins_city_id = $this->db->get_where('map_cities', array('id' => $id))->row_array();

        $this->template->assign('insert_id', $ins_city_id['id']);
		$this->template->assign('city_name', $ins_city_id['city']);
	    $this->display_tpl('streets');
	}
	
	public function create_street_tpl($city_id = 0)
	{
		$city = $this->db->get_where('map_cities', array('id' => $city_id))->row_array();
		$this->template->assign('city', $city);
		$this->display_tpl('create_street');
	}
	
	function create_street($city_id = 0) {
        //cp_check_perm('menu_create');
        if ($_POST['street_name'] == NULL) {
            showMessage(lang('a_menu_field_emp'), '', 'r');
            exit;
        }

        $val = $this->form_validation;
        $val->set_rules('street_name', 'Улица', 'trim|required|xss_clean|max_length[250]');
		$val->set_rules('street_lat', 'Широта', 'trim|xss_clean|numeric');
		$val->set_rules('street_lng', 'Долгота', 'trim|xss_clean|numeric');
		$val->set_rules('street_zoom', 'Зум', 'trim|xss_clean|integer');

        if ($this->form_validation->run($this) == FALSE) {
            showMessage(validation_errors(), '', 'r');
        } else {
            $data = array(
                'street' => $this->input->post('street_name'),
				'city_id' => $this->input->post('city_id'),
				'lat' => $this->input->post('street_lat'),
				'lng' => $this->input->post('street_lng'),
				'zoom' => $this->input->post('street_zoom'),
                'created' => time()
            );

            $this->db->insert('map_streets', $data);

            showMessage('Улица добавлена');
            if ($this->input->post('action') == 'tomain')
                pjax('/admin/components/cp/map/city_streets/' . $city_id);
            else
                pjax('/admin/components/cp/map/edit_street/' . $this->db->insert_id());
        }
    }
	
	function edit_street($id) {
        //cp_check_perm('menu_edit');
		$this->db->where('id',$id);
        $query = $this->db->get('map_streets');
        $street_data = $query->row_array();
        $this->template->add_array($street_data);
        $this->display_tpl('edit_street');
    }
	
	function update_street($id) {

        $val = $this->form_validation;
        $val->set_rules('street_name', 'Улица', 'trim|required|xss_clean|max_length[250]');
		$val->set_rules('street_lat', 'Широта', 'trim|xss_clean|numeric');
		$val->set_rules('street_lng', 'Долгота', 'trim|xss_clean|numeric');
		$val->set_rules('street_zoom', 'Зум', 'trim|xss_clean|integer');

        if ($this->form_validation->run($this) == FALSE) {
            showMessage(validation_errors(), '', 'r');
        } else {

            $data = array(
                'street' => $this->input->post('street_name'),
				'lat' => $this->input->post('street_lat'),
				'lng' => $this->input->post('street_lng'),
				'zoom' => $this->input->post('street_zoom'),
                'created' => time()
            );


            $this->db->where('id', $id);
            $this->db->update('map_streets', $data);
			$str = $this->db->get_where('map_streets', array('id' => $id))->row_array();
            showMessage('Изменения сохранены');
            if ($_POST['action'] == 'tomain')
                pjax('/admin/components/cp/map/city_streets/' . $str['city_id']);
        }
    }
	
	function delete_street($id = null) {
		if ($id == null) {
            $id = $this->input->post('ids');
            foreach ($id as $i) {
				$this->db->limit(1);
				$this->db->where('street_id', $i);
				$query = $this->db->get('map_houses');
				if ($query->num_rows() > 0) {
					showMessage('Удалите дома для id - ' . $i);
					return;
				} else {
					$this->db->limit(1);
					$this->db->delete('map_streets',array('id' => $i));
				}
            }
            showMessage(lang('a_menu_deleted'));
            pjax('/admin/components/cp/map');
        } else {
			$this->db->limit(1);
			$this->db->where('street_id', $id);
			$query = $this->db->get('map_houses');
			if ($query->num_rows() > 0) {
				showMessage('Удалите дома для id - ' . $id);
				return;
			} else {
				$this->db->limit(1);
				$this->db->delete('map_streets',array('id' => $id));
			}
            showMessage(lang('a_menu_deleted'));
            pjax('/admin/components/cp/map');
        }
    }
	
	function street_houses($id = 0)
	{
		$this->db->where('street_id', $id);
		$this->db->order_by('house', 'asc');
		$query = $this->db->get('map_houses');
		$houses_data = $query->result_array();
		$this->template->assign('houses', $houses_data);
		
		$ins_street = $this->db->get_where('map_streets', array('id' => $id))->row_array();
		$ins_city = $this->db->get_where('map_cities', array('id' => $ins_street['city_id']))->row_array();

        $this->template->assign('insert_street', $ins_street);
		$this->template->assign('insert_city', $ins_city);
	    $this->display_tpl('houses');
	}
	
	function create_house_tpl($street_id = 0)
	{
		$this->template->assign('street_id', $street_id);
		$this->display_tpl('create_house');
	}
	
	function create_house($street_id = 0) {
		if ($_POST['house_number'] == NULL) {
            showMessage(lang('a_menu_field_emp'), '', 'r');
            exit;
        }

        $val = $this->form_validation;
        $val->set_rules('house_number', 'Улица', 'trim|required|xss_clean|max_length[20]');

        if ($this->form_validation->run($this) == FALSE) {
            showMessage(validation_errors(), '', 'r');
        } else {
            $data = array(
                'house' => $this->input->post('house_number'),
				'street_id' => $this->input->post('street_id'),
                'created' => time()
            );

            $this->db->insert('map_houses', $data);

            showMessage('Дом добавлен');
            if ($this->input->post('action') == 'tomain')
                pjax('/admin/components/cp/map/street_houses/' . $street_id);
            else
                pjax('/admin/components/cp/map/edit_house/' . $this->db->insert_id());
        }
	}
	
	function edit_house($id) {
		$this->db->where('id',$id);
        $query = $this->db->get('map_houses');
        $house_data = $query->row_array();
        $this->template->add_array($house_data);
        $this->display_tpl('edit_house');
	}
	
	function update_house($id) {
		$val = $this->form_validation;
        $val->set_rules('house_number', 'Дом', 'trim|required|xss_clean|max_length[20]');

        if ($this->form_validation->run($this) == FALSE) {
            showMessage(validation_errors(), '', 'r');
        } else {

            $data = array(
                'house' => $this->input->post('house_number'),
                'created' => time()
            );


            $this->db->where('id', $id);
            $this->db->update('map_houses', $data);
			$str = $this->db->get_where('map_houses', array('id' => $id))->row_array();
            showMessage('Изменения сохранены');
            if ($_POST['action'] == 'tomain')
                pjax('/admin/components/cp/map/street_houses/' . $str['street_id']);
        }
	}
	
	function delete_house($id = null) {
		if ($id == null) {
            $id = $this->input->post('ids');
            foreach ($id as $i) {
                $this->db->limit(1);
				$this->db->delete('map_houses',array('id' => $i));
            }
            showMessage(lang('a_menu_deleted'));
            pjax('/admin/components/cp/map');
        } else {
            $this->db->limit(1);
			$this->db->delete('map_houses',array('id' => $id));
            showMessage(lang('a_menu_deleted'));
            pjax('/admin/components/cp/map');
        }
	}
	
    /**
     * Display template file
     */ 
	private function display_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/admin/'.$file;
		$this->template->show('file:'.$file, FALSE);
	}
	
	/**
     * Fetch template file
     */
    private function fetch_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file . '.tpl';
        return $this->template->fetch('file:' . $file);
    }

}


/* End of file admin.php */
