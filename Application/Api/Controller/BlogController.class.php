<?php
namespace Api\Controller;
use Think\Controller;
class BlogController extends Controller {
/**
 * @Author   YuJiahao
 * @DateTime 2018-04-18
 * @return   [json]     [blog详情]
 */
	public function info(){
		$id = I('get.id','');
		//$classify_id = I('get.classify_id','');
		$Blog = D('Blog');
		$Classify = D('Classify');
		//$classify_id=$id;
		$data = $Blog->where("id = {$id}")->find();
		$data2 =$Classify->where("id = {$data['classify_id']}")->find();
		$data['classify_name'] = $data2['name'];
		// var_dump($data2);
		// 	die();
		$data3 =$Blog->where("classify_id = {$data2['id']}")->select();

		foreach ($data3 as $key => $value) {
			$data3[$key] = $Blog->format4($value);
		}
		 // var_dump($data3);
		 // die();
			
		$data = $Blog->format3($data);
		//$res =$Blog->format4($data3);
		
			
		// var_dump($data2);
		// die();
		$result = array("blog_info" => $data,
		"related_blog"=>$data3,);
		_res($result);
	}
	// public function getclassify(){
	// 	$id  = I('get.id',''); 
	// 	$Classify = D('classify');
	// 	$Blog = D('blog');
	// 	$data = D('classify')->getClassifyLists($id);
	// 	foreach ($data as $key => $value) {
	// 		$data[$key] = $Classify->formatclassify($value);
	// 		$data2 =$Blog->where("classify_id = {$value['id']}")->select();
	// 	}
		
	// 	$result = array("blog_list1" => $data2,);
	// 	_res($result);

	// }
	/**
	 * @Author   YuJiahao
	 * @DateTime 2018-04-18
	 * @return   [json]     [博客分类]
	 */
	public function lists(){
			$classify_id = I('get.classify_id','');		
			//$classify_id = $_GET['classify_id'];
			if(isset($classify_id)&&!empty($classify_id)){
				$BlogModel = D("Blog");
    			$ClassifyModel = D("Classify");
    			$UserModel = D("User");
				$blog_data = $BlogModel->where(array('status'=>1,'classify_id'=>$classify_id))->select();
				if($blog_data){
					foreach ($blog_data as $key => $value) {
						$user = $UserModel->where("id = {$value['user_id']}")->find();
						$classify = $ClassifyModel->where("id = {$value['classify_id']}")->find();
						$blog_data[$key] = $BlogModel->format1($value);
						$blog_data[$key]['author_name'] = $user['uname'];
						$blog_data[$key]['classify_name'] = $classify['name'];
					}
					$result = array(
	    				"blog_lists"=>$blog_data,
	    			);
	    			_res($result);
				}else{
					_res('暂无数据',false,'1007');
				}
			}else{
				_res('参数错误',false,'1002');
			}
		}



/**
 * @Author   YuJiahao
 * @DateTime 2018-04-18
 * @return   [json]     [发布博客]
 */
	public function addblog(){
			//$image = uploadFile('image','blog');
			$user_id = $_POST['user_id'];
			$content = $_POST['content'];
			$classify_id = $_POST['classify_id'];
			$title = $_POST['title'];
			$data = array(
				'title' 	=> $title,
				'content' 	=> $content,
				'user_id' => $user_id,
				//'image' 	=> $image,
				'classify_id' 	=> $classify_id,
				'status' =>1,			
				);
			$BlogModel = D('Blog');

			$status = $BlogModel->add($data);
			if ($status) {
					_res();
			}	

	}
	public function delblog(){
		$id = I('get.id','');	
		//$data = array();
		$Blog = D('Blog');
		$status = $Blog->where("id = $id")->delete();
		if($status){
			_res();
		}
	}


	public function my_blogLists(){
			$user_id= isset($_GET['user_id']) ? $_GET['user_id']: 0;
			// $user_id = $_GET['user_id'];
			$BlogModel = D("Blog");
			$UserModel = D("User");
			$ClassifyModel  = D("Classify"); 
			// var_dump($data);
			// die();
			$blog_data = $BlogModel->where(array('status'=>1,'user_id'=>$user_id))->select();
				if($blog_data){
					foreach ($blog_data as $key => $value) {
						$user = $UserModel->where("id = {$value['user_id']}")->find();
						$classify = $ClassifyModel->where("id = {$value['classify_id']}")->find();
						$blog_data[$key] = $BlogModel->format1($value);
						$blog_data[$key]['author_name'] = $user['uname'];
						$blog_data[$key]['classify_name'] = $classify['name'];
					}
					$result = array(
	    				"blog_lists"=>$blog_data,
	    			);
	    			_res($result);
				}else{
					_res('暂无数据',false,'1007');
				}
	}
	public function doEdit(){
			$id = isset($_POST['id'])?$_POST['id']:0;
			$content = $_POST['content'];
			$classify_id = $_POST['classify_id'];
			$title = $_POST['title'];
			$data = array(
				'title' 	=> $title,
				'content' 	=> $content,
				'classify_id' 	=> $classify_id,			
				);
			$data['updatetime'] = date('Y-m-d H:i:s');	

			// $id = $_GET['id'];
			// $content =$_GET['content'];
			// $classify_id = $_GET['classify_id'];
			// $title = $_GET['title'];
			// //$image2 = $_POST['imagePath'];
			// //$image = uploadFile('image','blog');
			// //if(empty($image)){
			// 	//$image = $image2;
			// //}
			// $data = array(
			// 	'title' 	=> $title,
			// 	'content' 	=> $content,
			// 	//'image' 	=> $image,
			// 	'classify_id' 	=> $classify_id,			
			// 	);
			// $data['updatetime'] = date('Y-m-d H:i:s');
			
			$BlogModel = D("Blog");
			$status = $BlogModel->where("id = {$id}")->save($data);
			if ($status) {
				_res();
			}
		}

}





