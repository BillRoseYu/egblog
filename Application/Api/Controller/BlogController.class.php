<?php
namespace Api\Controller;
use Think\Controller;
class BlogController extends Controller {

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
}