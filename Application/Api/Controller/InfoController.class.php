<?php
namespace Api\Controller;
use Think\Controller;
class InfoController extends Controller {

	public function index(){
		$id = I('get.id','');
		//$classify_id = I('get.classify_id','');
		$Blog = D('Blog');
		$Classify = D('Classify');
		//$classify_id=$id;
		$data = $Blog->where("id = {$id}")->find();

		// var_dump($data);
		// die();
		$data = $Blog->format1($data);
		$data2 =$Classify->where("id = {$data['classify_id']}")->find();
			
		// var_dump($data2);
		// die();
		$result = array("blog_info" => $data,
		"brother_blog"=>$data2,);
		_res($result);

	}
}