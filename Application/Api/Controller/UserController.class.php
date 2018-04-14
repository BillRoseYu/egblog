<?php
namespace Api\Controller;
use Think\Controller;
    class UserController extends Controller {
		public function reg(){
			include "./Application/Api/View/user/reg.html";
		}
		// public function doReg(){
		// 	$data = array();
		// 	$data['name'] = $_POST['name'];
		// 	$data['email'] = $_POST['email'];
		// 	$data['image'] = uploadFile('image','user');
		// 	$data['password'] = $_POST['password'];
		// 	$userModel = new \Home\Model\UserModel();
		// 	$status = $userModel->add($data);
		// 	if ($status){
  //    			$this->success('注册成功','/Home/UserCenter/login',3);
		// 	}else{
  //   			$this->error('注册失败');
		// 	}
			
		// }
		 public function doReg(){
			$data = array();
			$data['uname'] = $_POST['name'];
			$data['phone'] = $_POST['phone'];
			$date['email'] ="";
			$data['image'] = "";
			$data['status'] = 1;
			$data['password'] = $_POST['password'];
			$userModel = new \Api\Model\UserModel();
			$status = $userModel->add($data);
			if ($status){
				$result = array(
					'error_code' => 0,

					"message"=>"success",

					"data" => $data,
				);
				_res($result);
     			
			}else{
				$result = array(
					'error_code' => 1,

					"message"=>"注册失败",

					"data" => array(),
				);
				_res($result);
     			
    			
			}
			
		}
		// public function login(){
		// 	include "./Application/Home/View/user/login.html";

		// }
		public function doLogin(){
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$password = $_POST['password'];
			//$verifyCode = $_POST['verifyCode'];
			$userModel = new \Api\Model\UserModel();
			$userInfo = $userModel->getUserInfoByPhone($phone);
			if($userInfo['status']){
				$_SESSION['me'] = $userInfo;
				if($userInfo){
					if($password == $userInfo['password']){
						//$res = check_verify($verifyCode, $id = '');
						$result = array(
						'error_code' => 0,

						"message"=>"success",

						"data" => $userInfo,
						);
						_res($result);
					}
					else{
						$result = array(
						'error_code' => 1,

						"message"=>"密码错误",

						"data" => array(),
				);
					_res($result);

							
						}
				} 	
			}
							
			
				// 	else{
				// 		$result = array(
				// 		'error_code' => 1,

				// 		"message"=>"验证码错误",

				// 		"data" => array(),
				// );
				// _res($result);
						
					// }
				else{
					$result = array(
						'error_code' => 1,

						"message"=>"该用户不存在",

						"data" => array(),
				);
				_res($result);

					//$this->error('该用户不存在','/Home/UserCenter/reg',3);
				}
			// else{
			// 	$result = array(
			// 			'error_code' => 1,

			// 			"message"=>"该用户已封号",

			// 			"data" => array(),
			// 	);
			// 	_res($result);
			// 	//$this->error('该用户已封号');
			// }	
		}
		public function logout(){
			unset($_SESSION['me']);
		    echo "<script>history.go(-1);</script>";  
		}
		public function verifyCode(){
			$config =    array(
			    'fontSize'    =>   15,    // 验证码字体大小
			    'length'      =>    4,     // 验证码位数
			    'useNoise'    =>    true, // 关闭验证码杂点
			);
			$Verify = new \Think\Verify($config);
			$Verify->entry();
		}
		public function checkEmail(){
			$email = '329944908@qq.com';
			$p = "/(\w+)@(?:qq|163)\.(?:com|cn)/";
			$res = preg_match($p, $email,$arr);
			var_dump($res);
			var_dump($arr);
			die();
		}

	}