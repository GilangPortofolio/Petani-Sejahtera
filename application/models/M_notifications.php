<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MessageData{
    public $en;
}

class M_notifications extends CI_Model {
	public function create($from, $to, $type_id, $description) {
        $this->db->insert("notifications",
            [
                "from_id" => $from,
                "to_id" => $to,
                "type_id" => $type_id,
                "description" => $description
            ]);
	}
   
    public function sendNotificationsToUser($user_id, $m){
        //check if user have onesignal_id
        $user = $this->db->from('user')->where('id',$user_id)->get()->row();
        if($user){
            if($user->onesignal_id != null && $user->onesignal_id != ''){
                $url = 'https://onesignal.com/api/v1/notifications';
                $ch = curl_init($url);
                $message = new MessageData();
                $message->en = $m;
                $data = [
                    "app_id" => "4d8cd403-2a9e-48ae-a390-0b837a63012b",
                    "include_player_ids" => [
                        $user->onesignal_id
                    ],
                    "contents" => $message,
                    "name" => "Notifikasi Order Baru"
                ];
                curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($data));
                curl_setopt($ch,CURLOPT_HTTPHEADER, array("Content-type:application/json","Authorization:Basic ODZmYTAzNjUtODczNi00ODcwLTgwOGEtZDM5YjAwYjk2ZWJj"));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($ch);
                curl_close($ch);
            }
        }
    }
    public function get_new_order_notifications($user_id){
        $this->db->from('notifications');
        $this->db->where('type_id',1);
        $this->db->where('to_id',$user_id);
        $this->db->where('is_read',0);
        $data =  $this->db->get()->result();
        if(count($data) > 0){
            //update is_read
            $this->db->where('type_id',1);
            $this->db->where('to_id',$user_id);
            $this->db->set('is_read',1)->update('notifications');
            return $data;
        }else{
            return null;
        }
    }

    public function get_cancel_order_notifications($user_id){
        $this->db->from('notifications');
        $this->db->where('type_id',3);
        $this->db->where('to_id',$user_id);
        $this->db->where('is_read',0);
        $data =  $this->db->get()->result();
        if(count($data) > 0){
            //update is_read
            $this->db->where('type_id',3);
            $this->db->where('to_id',$user_id);
            $this->db->set('is_read',1)->update('notifications');
            return $data;
        }else{
            return null;
        }
    }

    public function get_notificaitons($from,$to,$type){
        $this->db->from('notifications');
        $this->db->where('type_id',$type);
        if($from != null){
            $this->db->where('from_id',$from);
        }
        if($to != null){
            $this->db->where('to_id',$to);
        }
        $this->db->where('is_read',0);
        $data = $this->db->get()->result();
        if(count($data) > 0){
            $this->db->from('notifications');
            $this->db->where('type_id',$type);
            if($from != null){
                $this->db->where('from_id',$from);
            }
            if($to != null){
                $this->db->where('to_id',$to);
            }
            $this->db->set('is_read',1)->update('notifications');
            return count($data);
        }
    }

    public function get_new_pickup_notification($user_id){
        $this->db->from('notifications');
        $this->db->where('type_id',3);
        $this->db->where('to_id',$user_id);
        $this->db->where('is_read',0);
        $data =  $this->db->get()->result();
        if(count($data) > 0){
            //update is_read
            $this->db->where('type_id',3);
            $this->db->where('to_id',$user_id);
            $this->db->set('is_read',1)->update('notifications');
            return $data;
        }else{
            return null;
        }
    }
}