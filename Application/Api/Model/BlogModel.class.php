<?php
	namespace Api\Model;
	class BlogModel extends BaseModel{
		public function format1($info){
			$data = array();
			$data['id'] = $info['id'];
			$data['title'] = $info['title'];
			$data['classify_id'] = $info['classify_id'];
			$data['classify_name'] = $info['classify_name'];
			$data['user_id'] = $info['user_id'];
			$data['date'] = $info['createtime'];
			$data['read_num'] = $info['read_num'];
			return $data;
		}
		public function format2($info){
			$data = array();
			$data['id'] = $info['id'];
			$data['img'] = $info['img'];
			$data['url'] = $info['url'];
			$data['title'] = $info['title'];
			return $data;
		}
		public function format3($info){
			$data = array();
			$data['id'] = $info['id'];
			$data['title'] = $info['title'];
			$data['classify_id'] = $info['classify_id'];
			$data['classify_name'] = $info['classify_name'];
			$data['author_name'] = $info['author_name'];
			$data['date'] = $info['createtime'];
			$data['author_img'] = $info['author_img'];
			$data['content'] = $info['content'];
			return $data;
		}

		public function format4($info){
			$data = array();
			$data['id'] = $info['id'];
			$data['title'] = $info['title'];
			$data['read_num'] = $info['read_num'];
			$data['author_img'] = $info['author_img'];
			$data['author_name'] = $info['author_name'];
			$data['date'] = $info['createtime'];
			return $data;
		}

	}