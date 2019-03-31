<?php
    class Admin extends CI_Controller{
        function __construct(){ 
            parent::__construct(); 
            $this->load->model('admin_models');
        }
        public function auth()
        {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => base64_encode($this->input->post('password')),
            );

           $query =  $this->db->get_where('admin_users', $data);
           $data_session = array(
			'nama' =>  $this->input->post('username'),
			'status' => "login"
            );
            
           if($query->num_rows()){
                $this->session->set_userdata($data_session);
           } 
           $this->index();
        }

        public function index()
        {
            if($this->session->userdata('status') != "login"){
                $this->load->view('login');
            }else{
                $data['name'] = $this->session->userdata('nama');
                $this->load->view('admin_index', $data);
            }
        }

        function logout(){
            $this->session->sess_destroy();
            redirect(base_url('login'));
        }

        public function regis()
        {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => base64_encode($this->input->post('password')),
            );

            $this->db->insert('admin_users', $data);
        }


        // list

        public function userReg_tenant(){
            $this->load->view('');
        }
    }

?>