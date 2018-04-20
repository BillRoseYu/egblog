<?php
namespace Api\Controller;
use Think\Controller;
    class AttentionController extends Controller {
    
        public function addAttention() {

            $Attention = D('Attention');
            // $user_id = I('get.user_id','');
            // $blog_id = I('get.blog_id','');
            
            $user_id = empty($_POST['user_id']) ? 0 : $_POST['user_id'];
            $blog_id = empty($_POST['blog_id']) ? 0 : $_POST['blog_id'];
             
            $result = array('error_code'=>0,'message'=>'','data'=>array());
            if (empty($user_id)) {
                $result['error_code'] = 1;
                $result['message'] ="用户未登录";
                echo json_encode($result);
                die();
            }
            if (empty($blog_id)) {
                $result['error_code'] = 2;
                $result['message'] ="参数错误";
                echo json_encode($result);
                die();
            }
            // var_dump($blog_id);
            // die(); 
            $Blog = D('Blog');
            $blog_att = $Blog->where("id=$blog_id")->find();
            // var_dump($blog_att);
            // die();
             $Attentionuser_id = $blog_att['user_id'];
            
            // var_dump($user_id);
            // die();
$data1 = $Attention->add(array('status'=>1,'user_id'=>$user_id,'attentionuser_id'=>$Attentionuser_id));
            //D('collect')->addCollect($user_id,$blog_id);
            $result = array(
                        "Attention"=>$data1,
                    );
                    _res($result);
           
        }
/**
 * @Author   YuJiahao
 * @DateTime 2018-04-18
 * @return   json     [关注列表]
 */
    public function myatt_Lists() {
            $user_id = I('post.user_id','');
            //$user_id = I('get.user_id','');
            //$Blog = D('Blog');
            $Attention = D('Attention');
            $UserModel = D('user');
            //$ClassifyModel =D('classify');
            $result = array('error_code'=>0,'message'=>'','data'=>array());
        if (empty($user_id)) {
                $result['error_code'] = 1;
                $result['message'] ="用户未登录";
               _res($result);
                die();
        }
            // var_dump($user_id);
            // die();
            $lists = $Attention->where(array('user_id'=>$user_id,'status'=>1))->select();
                // var_dump($lists);
                // die();
        $attuser_list =array();
        if($lists){
            foreach ($lists as $key => $value) {
               $attuser_list[] = $UserModel->where("id = {$value['attentionuser_id']}")->find();

            }
        
            $result = array(
                "myatt_Lists"=>$attuser_list);
            _res($result);
            die();
        }
            else{
            _res('无数据',false,'1009');
            }
    }


/**
 * @Author   YuJiahao
 * @DateTime 2018-04-18
 * @return   json     [取消关注]
 */
    public function delAttention(){
        $Attentionuser_id = I('get.Attentionuser_id',''); 
        $Attention = D('Attention');
        $status = $Attention->where("attentionuser_id = $Attentionuser_id")->delete();
        if($status){
            _res();
        }
    }
}