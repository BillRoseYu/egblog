<?php
    namespace Api\Model;
    class CollectModel extends BaseModel{
       

        // public function addCollect($user_id, $blog_id) {
            
        //     $time = date('Y-m-d H:i:s');
        //     $sql = "insert into collect (user_id,blog_id,createtime,status) value ({$user_id}, {$blog_id}, '{$time}',{$status}') ";
        //     $query = $this->mysqli->query($sql);
        //     return $query;
        // }
        // public function getMyBlog($user_id) {
        //     $sql = "select * from egblog where id in (select blog_id from zt_collect where user_id = {$user_id}) ";
        //     $query = $this->mysqli->query($sql);
        //     $lists = $query->fetch_all(MYSQLI_ASSOC);
        //     return $lists;
        // }   
        public function addCollect(){
            $data['user_id'] = $_POST['user_id'];
            //$data['title'] = $_POST['title'];
            //$data['content'] = $_POST['content'];
            $data['blog_id'] = $_POST['blog_id'];
            //$data['classify_id'] = $_POST['classify_id'];
            if(isset($data['user_id'])&&!empty($data['user_id'])&&isset($data['blog_id'])&&!empty($data['blog_id'])){
                $CollectModel = D("Collect");
                $res = $CollectModel->doAdd($data);
                if($res){
                    _res();
                }else{
                    _res('收藏失败',false,'1011');
                }
            }else{
                _res('参数错误',false,'1001');
            }
        }
        public function doAdd() {
            D('collect')->addCollect($user_id,$blog_id);
            echo json_encode($result);
            die();
        }

        //public function 

    }