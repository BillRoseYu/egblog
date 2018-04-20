<?php
	namespace Api\Model;
	class AttentionModel extends BaseModel{
		
		public function addAttention(){
            $data['user_id'] = $_POST['user_id'];
            //$data['title'] = $_POST['title'];
            //$data['content'] = $_POST['content'];
            $data['blog_id'] = $_POST['blog_id'];
            //$data['classify_id'] = $_POST['classify_id'];
            if(isset($data['user_id'])&&!empty($data['user_id'])&&isset($data['blog_id'])&&!empty($data['blog_id'])){
                $AttentionModel = D("Attention");
               // $data2 = array();
               	$user_id = $_POST['user_id'];
               	$Blog = D('Blog'); 
            	$blog_att = $Blog->where("id=$blog_id")->find();
            // var_dump($blog_att);
            // die();
             $Attentionuser_id = $blog_att['user_id']; 
                $data2 = array(
                	'user_id'=>$user_id,
                	'attentionuser_id'=>$Attentionuser_id,
                );
                $res = $AttentionModel->doAdd($data2);
                if($res){
                    _res();
                }else{
                    _res('关注失败',false,'1011');
                }
            }else{
                _res('参数错误',false,'1001');
            }
        }
        public function doAdd() {
            D('Attention')->addCollect($user_id,$Attentionuser_id);
            echo json_encode($result);
            die();
        }
	}