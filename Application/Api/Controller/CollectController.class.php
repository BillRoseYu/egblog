<?php
namespace Api\Controller;
use Think\Controller;
    class CollectController extends Controller {
    
        public function doAdd() {
           // $user_id = I('get.user_id','');
           // $blog_id = I('get.blog_id','');
           $Collect = D('Collect');
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
            $data1 = $Collect->add(array('status'=>1,'user_id'=>$user_id,'blog_id'=>$blog_id));
            //D('collect')->addCollect($user_id,$blog_id);
            $result = array(
                        "collect"=>$data1,
                    );
                    _res($result);
           
        }
/**
 * @Author   YuJiahao
 * @DateTime 2018-04-18
 * @return   json     [收藏列表]
 */
    public function myLists() {
            $user_id = I('post.user_id','');
            //$user_id = empty($_POST['user_id']) ? 0 : $_POST['user_id'];
            $Blog = D('Blog');
            $Collect = D('Collect');
            $UserModel = D('user');
            $ClassifyModel =D('classify');
            
            $result = array('error_code'=>0,'message'=>'','data'=>array());
        if (empty($user_id)) {
                $result['error_code'] = 1;
                $result['message'] ="用户未登录";
               _res($result);
                die();
        }
            // var_dump($user_id);
            // die();
            $lists = $Collect->where(array('user_id'=>$user_id,'status'=>1))->select();
                // var_dump($lists);
                // die();
        if($lists){
            
            
            $blog_list_id = array();
            foreach ($lists as $key => $value) {
                $blog_list_id[] = $value['blog_id'];

            }
            $find['id'] = array('in',$blog_list_id);
            $blog_list = $Blog->where($find)->select();
            foreach ($blog_list as $key => $value) {
                $user = $UserModel->where("id={$value['user_id']}")->find();
                $classify = $ClassifyModel->where("id = {$value['classify_id']}")->find();
                $blog_list[$key] = $Blog->format1($value);
                //var_dump($blog_list);
                $blog_list[$key]['author_name'] = $user['uname'];
                $blog_list[$key]['classify_name'] = $classify['name'];


            }
            // var_dump($blog_list);
            // die();
            //$lists = $blog_data;
            $result = array(
                "myLists"=>$blog_list);
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
 * @return   json     [取消收藏]
 */
    public function delCollect(){
        $id = I('get.id','');   
        //$data = array();
        $Collect = D('Collect');
        $status = $Collect->where("id = $id")->delete();
        if($status){
            _res();
        }
    }
}