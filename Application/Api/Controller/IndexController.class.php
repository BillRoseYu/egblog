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

						$data3 =$Classify->where(array('id'=>$va['classify_id']))->find();
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
		// $this->assign('data',$data);
		// $this->display('/home/index');
		$result = array(
			"blog_list" => $data,
			"banner" =>$data2,
		);
		_res($result);
     }
     
}
