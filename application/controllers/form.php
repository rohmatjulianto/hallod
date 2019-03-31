<?php
    class Form extends CI_Controller{
        public function cpbt(){
            $this->load->view('form_cpbt');
        }
        public function ppbt()
        {
            $this->load->view('form_ppbt');
        }
    }
    
?>