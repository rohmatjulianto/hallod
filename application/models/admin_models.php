<?php
class Admin_models extends CI_Model{

    public function mail_invite_cbpt($data) {
        $from_email = "jouleyanto@gmail.com";
        $to_email = $data['email_user'];

        //Load email library
        $this->load->library('email');

        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.gmail.com';
        $config['smtp_user'] = $from_email;
        $config['smtp_pass'] = 'sintingpisan123';
        $config['smtp_port'] = '465';
        $config['smtp_crypto'] = 'ssl';
        $config['smtp_timeout'] = '7';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html';
        $config['validation'] = TRUE; // 
        $this->email->initialize($config);

        // getemailwithoutdomain
        $explode = explode("@",$to_email);
		array_pop($explode);
        $nameemail = join('@', $explode);
        
        $url_reg = "http://localhost/form/cbpt";
        
        $this->email->from($from_email, 'Admin CBPT');
        $this->email->to($to_email);
        $this->email->subject('Undangan CBPT');
        $this->email->message('klik <a href="'.$url_reg.''.urlencode(base64_encode(http_build_query($data))).'"> disni cuk</a>');
        //Send mail

        if($this->email->send()){
            echo "ya";
        } else{
            echo " gagal";
        }
    }
}

?>