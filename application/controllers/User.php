<?php
class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    function index()
    {
        $users = $this->User_model->all();

        $this->load->view(
            'list',
            array('users' => $users)
        );
    }

    function create()
    {

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('create');
        } else {

            $formInput = array(
                "name" => $this->input->post('name'),
                "email" => $this->input->post('email'),
                "created_at" => mdate('%Y-%M-%d')
            );

            $this->User_model->create($formInput); //saving data in database
            $this->session->set_flashdata('success', 'Data Added Successfully!');

            redirect(base_url() . 'User/index');
        }
    }

    function edit($user_id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view(
                'edit',
                array(
                    'user' => $this->User_model->getUser($user_id)
                )
            );
        } else {
            $this->User_model->updateUser(
                $user_id,
                array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email')
                )
            );

            $this->session->set_flashdata('success', 'Data Updated Successfully!');

            redirect(base_url() . "User");
        }
    }


    function delete($userId)
    {
        $this->User_model->delete($userId);
        $this->session->set_flashdata('success', 'Data Deleted Successfully!');
        redirect(base_url() . "User");
    }
}
