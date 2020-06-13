<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

    public function upload()
    {
        if(isset($_FILES['userfile']['name']) && !empty($_FILES['userfile']['name'])){
            //Pengambilan Ektensi
            $pecah = explode(".", $_FILES['userfile']['name']);
            $ext = end($pecah);
            
            //Pemberian Nama Baru
            $nama_file_baru = date('dmyhis').".".$ext;

            $config['upload_path']          = FCPATH.'/assets/panel/img/upload/avatar';
            $config['allowed_types']        = 'jpg|jpeg|png|JPG|JPEG|PNG';
            $config['file_name']            =  $nama_file_baru;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('userfile'))
            {
                $file_data = $this->upload->data();


                $file_name = $file_data['file_name'];
                $input['pict'] = $file_name;

            } else {
                $response = array(
                'status' => 0,
                'message' => 'Gagal mengupload foto. Silahkan diulang kembali dengan format jpg atau png ',
                'return_url' => '#'
                );
                echo json_encode($response);
                die();
            }
        }else{
            $input['pict'] = $input['default_pict'];
        }
    }
}