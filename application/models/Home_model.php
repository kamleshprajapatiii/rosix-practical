<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

	function __construct()
    {
        parent::__construct();
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function get_users($id = '')
    {
        if ($id != "") {
            $this->db->where('id', $id);
            return $this->db->get('users');
        } else {
            return $this->db->get('users');
        }
    }

    public function get_countries()
    {
        return $this->db->get('countries');
    }

    public function get_states($country_id = "")
    {
        if ($country_id != "") {
            $this->db->where('country_id', $country_id);
            return $this->db->get('states');
        } else {
            return $this->db->get('states');
        }
    }

    public function get_cities($state_id = "")
    {
        if ($state_id != "") {
            $this->db->where('state_id', $state_id);
            return $this->db->get('cities');
        } else {
            return $this->db->get('cities');
        }
    }

    public function insertUser($data = array())
    {
        return $this->db->insert('users', $data);
    }

    public function updateUser($id = "", $data = array())
    {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function deleteUser($id = "")
    {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

}
