<?php
namespace Api\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$Blog = D("Blog");
    	$UserModel =D("User");
    	$Classify = D("Classify");
    	$BannerModel = D("Banner");
		$data = $Blog->where('status=1')->select();
		
		foreach ($data as $key => $value) {
				$data[$key] = $Blog->format1($value);
				foreach ($value as $k => $va) {
					// var_dump($va);
						$user = $UserModel->where("id = {$value['user_id']}")->find();
						$data3 =$Classify->where(array('id'=>$va['classify_id']))->find();
						$data[$key]['author_name'] = $user['uname'];
						$data[$key]['classify_name'] = $data3['name'];
				}
					//$data['classify_id'] = $v['classify_id'];
			
				
				
		}

		// var_dump($data);
		// die();

		
		$data2 = $BannerModel->where('status=1')->select();
		foreach ($data2 as $key => $value) {
			$data2[$key] = $BannerModel->format2($value);
		}

		$Classifylist = $Classify->where('status=1')->select();
		foreach ($Classifylist as $key => $value) {
			$data4[$key] = $Classify->format1($value);
		}
		// $this->assign('data',$data);
		// $this->display('/home/index');
		$result = array(
			"blog_list" => $data,
			"banner" =>$data2,
			"Classifylist"=>$data4,
		);
		_res($result);
     }
     
}
