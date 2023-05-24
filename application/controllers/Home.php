<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
    }

    public function index()
    {
        $page_data['page_name'] = "home";
        $page_data['page_title'] = "Home";
        $page_data['users'] = $this->home_model->get_users()->result();
        $page_data['countries'] = $this->home_model->get_countries()->result();
        $page_data['states'] = $this->home_model->get_states()->result();
        $page_data['cities'] = $this->home_model->get_countries()->result();

        $this->load->view('/index.php', $page_data);
    }

    public function getstates()
    {
        $json = array();
        $json = $this->home_model->get_states($this->input->post('countryID'))->result_array();
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function getcities()
    {
        $json = array();
        $json = $this->home_model->get_cities($this->input->post('stateID'))->result_array();
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function get_user_by_id()
    {
        $json = array();
        $json = $this->home_model->get_users($this->input->post('id'))->row_array();
        header('Content-Type: application/json');
        echo json_encode($json);
    }



    public function adduser()
    {
        $this->load->library('upload');

        $data['fullname'] = $this->input->post('fullname');
        $data['email'] = $this->input->post('email');
        $data['mobile'] = $this->input->post('mobile');
        $data['country'] = $this->input->post('country');
        $data['state'] = $this->input->post('state');
        $data['city'] = $this->input->post('city');
        $files = $_FILES;

        $config = array();
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $config['max_size']      = '0';
        $config['overwrite']     = FALSE;

        $countfiles = count($_FILES['images']['name']);
        $images = array();
        for ($i = 0; $i < $countfiles; $i++) {
            $_FILES['images']['name'] = $files['images']['name'][$i];
            $_FILES['images']['type'] = $files['images']['type'][$i];
            $_FILES['images']['tmp_name'] = $files['images']['tmp_name'][$i];
            $_FILES['images']['error'] = $files['images']['error'][$i];
            $_FILES['images']['size'] = $files['images']['size'][$i];

            $this->upload->initialize($config);
            $this->upload->do_upload('images');
            $images[] = $this->upload->data()['file_name'];
        }

        $data['images'] = json_encode($images);
        $this->home_model->insertUser($data);
        redirect(site_url(''), 'refresh');
    }

    public function edituser()
    {
        $this->load->library('upload');

        $data['fullname'] = $this->input->post('fullname');
        $data['email'] = $this->input->post('email');
        $data['mobile'] = $this->input->post('mobile');
        $data['country'] = $this->input->post('country');
        $data['state'] = $this->input->post('state');
        $data['city'] = $this->input->post('city');
        $files = $_FILES;

        $config = array();
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $config['max_size']      = '0';
        $config['overwrite']     = FALSE;

        $countfiles = count($_FILES['images']['name']);
        $images = array();
        for ($i = 0; $i < $countfiles; $i++) {
            $_FILES['images']['name'] = $files['images']['name'][$i];
            $_FILES['images']['type'] = $files['images']['type'][$i];
            $_FILES['images']['tmp_name'] = $files['images']['tmp_name'][$i];
            $_FILES['images']['error'] = $files['images']['error'][$i];
            $_FILES['images']['size'] = $files['images']['size'][$i];

            $this->upload->initialize($config);
            $this->upload->do_upload('images');
            $images[] = $this->upload->data()['file_name'];
        }

        $data['images'] = json_encode($images);
        $this->home_model->updateUser($this->input->post('id'), $data);
        redirect(site_url(''), 'refresh');
    }

    public function deleteuser($id = '')
    {
        $this->home_model->deleteUser($id);
        redirect(site_url(''), 'refresh');
    }


}
