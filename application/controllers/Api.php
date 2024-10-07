<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
    public $token;
    public $user;
    //GANTI DENGAN ABSOLUTE LOCATION
    private $uploaddir = '/home/sidutamaweb/public_html/administrator/assets/app_photo/';
	public function __construct() {
		parent::__construct();
        $this->load->model('M_tipe_produk');
        $this->load->model('M_user');
        $this->load->model('M_produk');
        $this->load->model('M_status_produk');
        $this->load->model('M_transaksi');
        header('Content-Type: application/json');
	}
    /*
    * this function will validate access_token at header, and assign it to $user variable and $token variable
    */
    public function validateAccessToken(){
        if($this->input->post('access_token') == null){
            $data = array(
                "status"=> 'error',
                "code" => 500,
                "errorMessage" => 'access token missing'
            );
            echo json_encode($data);
            return false;
        }
        $this->token = $this->input->post('access_token');
        $this->user = $this->M_user->get_user_by_access_token($this->token);
        if($this->user){
            $this->user = $this->user[0];
            return true;
        }else{
            $data = array(
                "status"=> 'error',
                "code" => 500,
                "errorMessage" => 'you are not authorized to access this api'
            );
            echo json_encode($data);
            return false;
        }
    }

    public function success($data){
        $return_data = array(
            "status"=> 'success',
            "code" => 200,
            "data" => $data,
        );
        return $return_data;
    }

    public function error($code,$message){
        $return_data = array(
            "status"=> $message,
            "code" => $code,
            "data" => null,
        );
        return $return_data;
    }
    public function process_foto($prefix){
        $filename = '';
        if(isset($_FILES['foto'])){
            $this->load->helper('string');
            //do upload operation
            
            $generated_prefix_file_name = $prefix.random_string('alnum',10);
            $uploadfile = $this->uploaddir . $generated_prefix_file_name.basename($_FILES['foto']['name']);
            $filename = $generated_prefix_file_name.basename($_FILES['foto']['name']);
            move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile);
        }
        return $filename;
    }
    //API - 1. AUTH
    public function login(){
        $this->load->helper('string');

        $nik = $this->input->post("nik");
        $password = $this->input->post("password");

        $user = $this->M_user->login($nik,$password);
        if($user){
            $user = $user[0];
            $access_token = random_string('alnum',200);
            $this->M_user->set_access_token($user->id,$access_token);
            $user->access_token = $access_token;
            
            if($user->id_kurir == null){
                $user->is_kurir = false;
            }else{
                $user->is_kurir = true;
                $this->load->model("M_kurir");
                $user->data_kurir = $this->M_kurir->select_by_id($user->id_kurir);
            }
            unset($user->id_kurir);
            echo json_encode($this->success($user));
        }else{
            $data = array(
                "status"=> 'error',
                "code" => 500,
                "errorMessage" => 'login error'
            );
            echo json_encode($data);
        }
    }
    //1.2
    public function register(){
        $this->load->helper('string');
        $insert_data = $this->input->post();
        $insert_data['password'] = md5($insert_data['password']);
        $insert_data['access_token'] = random_string('alnum',200);
        $insert_data['foto'] = $this->process_foto('user_photo'.random_string('alnum',10).$insert_data['nik']);
        //check that nik is used.
        $used = $this->M_user->get_user_by_nik($this->input->post('nik'));

        if($used == true){
            echo json_encode($this->error(500,'NIK Sudah pernah didaftarkan, gunakan nik lain atau hubungi kadin!'));
        }else{
            $status = $this->M_user->insert_data($insert_data);
            
            if($status){
                $insert_data['id'] = "$status";
                $insert_data['password'] = '';
                echo json_encode($this->success($insert_data));   
            }else{
                $data = array(
                    "status"=> 'error',
                    "code" => 500,
                    "errorMessage" => 'login error'
                );
                echo json_encode($data);
            }
        }
        
    }

    //1.3
    public function get_pin(){
        if(!$this->validateAccessToken())return;

        $pin = $this->M_user->get_pin_by_id($this->user->id);
        echo json_encode($this->success($pin));
    }
    //1.4
    public function set_pin(){
        if(!$this->validateAccessToken())return;
        $pin = $this->input->post('pin');

        $this->M_user->set_pin_by_id($this->user->id,$pin);
        echo json_encode($this->success($pin));
    }
    //1.5 login via pin
    public function pin_login(){
        $this->load->helper('string');

        $nik = $this->input->post("nik");
        $pin = $this->input->post("pin");

        $user = $this->M_user->pin_login($nik,$pin);
        if($user){
            $user = $user[0];
            $access_token = random_string('alnum',200);
            $this->M_user->set_access_token($user->id,$access_token);
            $user->access_token = $access_token;
            
            if($user->id_kurir == null){
                $user->is_kurir = false;
            }else{
                $user->is_kurir = true;
                $this->load->model("M_kurir");
                $user->data_kurir = $this->M_kurir->select_by_id($user->id_kurir);
            }
            unset($user->id_kurir);
            echo json_encode($this->success($user));
        }else{
            $data = array(
                "status"=> 'error',
                "code" => 500,
                "errorMessage" => 'login error'
            );
            echo json_encode($data);
        }
    }

    
    //END API - 1. AUTH
    //API - 2. APP DATA
    //2.1 get all available harga
    public function harga(){
        if(!$this->validateAccessToken())return;
        
        $data = $this->M_tipe_produk->select_all();
        echo json_encode($this->success($data));
        
    }
    //2.2 get all available user produk
    public function produk(){
        if(!$this->validateAccessToken())return;
        $data = $this->M_produk->select_produk_by_user_id($this->user->id);
        echo json_encode($this->success($data));
    }
    //2.7 Get penjualan
    public function penjualan(){
        if(!$this->validateAccessToken())return;
        $filterType = $this->input->get('filter_type');
       
        //sanity filter type
        if($filterType != null){
            foreach($filterType as $f){
                if(($f == 3 || $f == 4 || $f == 5) == false){
                    echo json_encode($this->error(500, 'filter only support 3,4,5'));
                    return;
                }
            }
        }
        
        $data = $this->M_transaksi->select_all_transaksi_by_user_id($this->user->id);
        echo json_encode($this->success($data));
    }
    //2.7A Get order ready by driver
    public function driver_order_ready(){
        //validate access token
        if(!$this->validateAccessToken())return;
        

        //get driver id
        $driver_id = $this->M_user->get_driver_id_by_user_id($this->user->id);
        if($driver_id == "NOT_DRIVER"){
            echo(json_encode($this->error(500,'User bukan driver')));
            return;
        }else{
            $data = $this->M_transaksi->select_all_transaksi_by_driver_id($driver_id,[6]);
            echo json_encode($this->success($data));
            return;
        }
    }

     //2.7B Get ongoing order by driver
     public function driver_order_ongoing(){
        //validate access token
        if(!$this->validateAccessToken())return;
        

        //get driver id
        $driver_id = $this->M_user->get_driver_id_by_user_id($this->user->id);
        if($driver_id == "NOT_DRIVER"){
            echo(json_encode($this->error(500,'user bukan driver')));
            return;
        }else{
            $data = $this->M_transaksi->select_all_transaksi_by_driver_id($driver_id,[7,5]);
            echo json_encode($this->success($data));
            return;
        }
    }

    //2.7B Get ongoing order by driver
    public function driver_order_finished(){
        //validate access token
        if(!$this->validateAccessToken())return;
        

        //get driver id
        $driver_id = $this->M_user->get_driver_id_by_user_id($this->user->id);
        if($driver_id == "NOT_DRIVER"){
            echo(json_encode($this->error(500,'user bukan driver')));
            return;
        }else{
            $data = $this->M_transaksi->select_all_transaksi_by_driver_id($driver_id,[4]);
            echo json_encode($this->success($data));
            return;
        }
    }



    //2.3 get all available produk status
    public function status_produk(){
        if(!$this->validateAccessToken())return;

        $data =$this->M_status_produk->select_all();
        echo json_encode($this->success($data));
    }
    //2.4 create produk
    public function create_produk(){
        if(!$this->validateAccessToken())return;
    
        // $foto = $this->process_foto($this->user->id);
        $insert_data = $this->input->post();
        // $insert_data['foto'] = $foto;
        $insert_data['id_status_produk'] = 1;
        $insert_data['id_user'] = $this->user->id;
        unset($insert_data['access_token']);
        $success = $this->M_produk->insert_data($insert_data);
        if($success){
            $insert_data['id'] = $success;
            echo json_encode($this->success($insert_data));
        }else{
            echo json_encode($this->error(500, 'something went wrong'));
        }
        
    }
    //2.5 get dusun
    public function get_dusun(){
        $this->load->model('M_desa');
        $data = $this->M_desa->select_all();
        if($data){
            echo json_encode($this->success($data));
        }else{
            echo json_encode($this->error(500, 'something went wrong'));
        }

    }
    //2.6 UPDATE PRODUK
    public function update_produk(){
        if(!$this->validateAccessToken())return;
        $insert_data = $this->input->post();
        $produk = $this->M_produk->select_by_id($insert_data['id']);
        unset($insert_data['access_token']);
        if($produk->id_user != $this->user->id){
            echo json_encode($this->error(502, 'you are not authorize to edit this produk'));
        }else{
            $success = $this->M_produk->update2($insert_data);
            if($success){
                echo json_encode($this->success($insert_data));
            }else{
                echo json_encode($this->error(500, 'something went wrong'));
            }
        }
        
    }

    // 2.8 KONFIRMASI ORDER
    public function konfirmasi_order(){
        if(!$this->validateAccessToken())return;
        
        //get id transaksi
        $id_transaksi = $this->input->post('id_transaksi');
        $tanggal = $this->input->post('tanggal_penjemputan');
        $data = $this->M_transaksi->isForThisCurier($this->user->id_kurir,$id_transaksi);
        if($data != null){
            $this->M_transaksi->confirm_transaction($id_transaksi,$tanggal);
            echo json_encode($this->success(200,'success'));
        }else{
            echo json_encode($this->error(500, 'This is not your transaction'));
        }
    }

    //2.9 JEMPUT ORDER
    public function jemput_order(){
        if(!$this->validateAccessToken())return;
        $id_transaksi = $this->input->post('id_transaksi');
        $transaksi = $this->M_transaksi->isForThisCurier($this->user->id_kurir, $id_transaksi);
        if($transaksi != null){
            $this->M_transaksi->confirm_pickup($id_transaksi);
            $produk = $this->M_produk->select_by_id($transaksi->id_produk);
            $this->load->model('M_notifications');
            $this->M_notifications->create($this->user->id, $transaksi->id_user, 6, "Kurir {$this->user->nama} sedang menjemput panen {$produk->tipe_produk} anda!");
            $this->M_notifications->sendNotificationsToUser($transaksi->id_user,"Kurir {$this->user->nama} sedang menjemput panen ".$produk->tipe_produk." anda!");
            echo json_encode($this->success(200,'success'));
        }else{
            echo json_encode($this->error(500, 'This is not your transaction'));
        }
    }

    //2.10 batal jemput order
    public function batal_jemput(){
        if(!$this->validateAccessToken())return;
        $id_transaksi = $this->input->post('id_transaksi');
        $transaksi = $this->M_transaksi->isForThisCurier($this->user->id_kurir, $id_transaksi);
        if($transaksi != null){
            $this->M_transaksi->batal_jemput($id_transaksi);
            $produk = $this->M_produk->select_by_id($transaksi->id_produk);
            
            $this->load->model('M_notifications');
            $this->M_notifications->create($this->user->id, $transaksi->id_user, 7, "Kurir {$this->user->nama} batal menjemput panen {$produk->tipe_produk} anda!");
            $this->M_notifications->sendNotificationsToUser($transaksi->id_user,"Kurir membatalkan penjemputan panen ".$produk->tipe_produk." anda!");
            echo json_encode($this->success(200,'success'));
        }else{
            echo json_encode($this->error(500, 'This is not your transaction'));
        }
    }

    //2.11 finish jemput order
    public function finish_order(){
        if(!$this->validateAccessToken())return;
        $id_transaksi = $this->input->post('id_transaksi');
        $transaksi = $this->M_transaksi->isForThisCurier($this->user->id_kurir, $id_transaksi);
        if($transaksi != null){
            $this->M_transaksi->finish_order($id_transaksi);
            $this->load->model('M_notifications');
            $produk = $this->M_produk->select_by_id($transaksi->id_produk);
            $this->M_notifications->create($transaksi->id,$transaksi->id_user,5, "Pesanan sudah diselesaikan");
            $this->M_notifications->sendNotificationsToUser($transaksi->id_user,"Kurir telah menyelesaikan penjemputan panen  {$produk->tipe_produk} anda!");
            
            echo json_encode($this->success(200,'success'));
        }else{
            echo json_encode($this->error(500, 'This is not your transaction'));
        }
    }
    //2.12 konfirmasi petani
    public function petani_confirm_finish(){
        if(!$this->validateAccessToken())return;
        $id_transaksi = $this->input->post('id_transaksi');
        $transaksi = $this->M_transaksi->isForThisUser($this->user->id, $id_transaksi);
        if($transaksi != null){
            $this->M_transaksi->confirm_finish_user($id_transaksi);
            $produk = $this->M_produk->select_by_id($transaksi->id_produk);
            $this->load->model('M_notifications');
            $kurir_user_id = $this->M_user->get_user_id_by_kurir_id($transaksi->id_kurir);
            $this->M_notifications->create($id_transaksi,$kurir_user_id,4,"Telah dikonfirmasi petani");
            $this->M_notifications->sendNotificationsToUser($kurir_user_id,"Petani telah mengkonfirmasi penyelesaian jemputan anda!");
            
            echo json_encode($this->success(200,'success'));
        }else{
            echo json_encode($this->error(500, 'This is not your transaction'));
        }
    }
    //END API - APP DATA


    //API - 3. USER DATA
    public function user(){
        if(!$this->validateAccessToken())return;
        echo json_encode($this->success($this->user));
    }
    
    //END API - 3. USER DATA

    //API - 4. NOTIFICAITONS (this function is defined at the routes.php)
    //API - 4.1 Get new order notifications
    public function notification_new_order_get(){
        if(!$this->validateAccessToken())return;
        if($this->user->id_kurir == null){
            echo json_encode($this->error(500, "you are not a driver"));
            return;
        }

        //get new order notifications
        $this->load->model('M_notifications');
        $total_new_order_notifications = $this->M_notifications->get_notificaitons(null,$this->user->id,1);
        $string_notification = "";
        if($total_new_order_notifications > 0){
            $string_notification = "\nKamu memiliki $total_new_order_notifications order baru!";
        } 
        $total_cancel_notifications = $this->M_notifications->get_notificaitons(null,$this->user->id,3);
        if($total_cancel_notifications>0){
            $string_notification .= "\nAda $total_cancel_notifications order yang dibatalkan kadin!";
        } 

        $total_confirmed_order = $this->M_notifications->get_notificaitons(null,$this->user->id,4);
        if($total_confirmed_order>0){
            $string_notification .= "\nAda $total_confirmed_order order yang telah dikonfirmasi petani!";
        } 

        if($string_notification != ""){
            echo json_encode($this->success($string_notification));
        }else{
            echo json_encode($this->error(404,"tidak ada notifikasi"));
        }
    }
    //API - 4.2 get new pickup notification (petani)
    //api/notifications/petani/order-pickup
    public function notification_order_pickup(){
        if(!$this->validateAccessToken())return;
        if($this->user->id_kurir != null){
            echo json_encode($this->error(500, "you are not a petani"));
            return;
        }

        //get new order notifications
        $this->load->model('M_notifications');

        //get batal jemput kurir
        $total = $this->M_notifications->get_notificaitons(null,$this->user->id,7);
        $string_notification = "";
        if($total > 0){
            $string_notification .= "\nAda $total panen kamu yang batal dijemput kurir!";
        } 

        $total = $this->M_notifications->get_notificaitons(null,$this->user->id,6);
        if($total > 0){
            $string_notification .= "\nKurir sedang menjemput $total panen kamu!";
        }

        $total = $this->M_notifications->get_notificaitons(null,$this->user->id,8);
        if($total > 0){
            $string_notification .= "\nKadin sudah menugaskan kurir untuk menjemput $total panen kamu!";
        }

        $total = $this->M_notifications->get_notificaitons(null,$this->user->id,5);
        if($total > 0){
            $string_notification .= "\nPenjemputan sudah selesai, segera konfirmasi pengambilan!";
        } 

        if($string_notification != ""){
            echo json_encode($this->success($string_notification));
        }else{
            echo json_encode($this->error(404,"tidak ada notifikasi"));
        }
    }
    //API - 4.3 set onesignal id
    //api/notifications/set-id
    public function set_user_id(){
        if(!$this->validateAccessToken())return;
        $this->M_user->set_onesignal_id($this->user->id,$this->input->post('onesignal_id'));
        echo json_encode($this->success(null));
    }
}