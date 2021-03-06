<?php
	namespace Api\Model;
	class CommentModel extends BaseModel{
		public $table="comment";
		function add($data){
			$data['createtime'] = date('Y:m:d H:i:s');
			$Comment= M("Comment");
			$res=$Comment->add($data);
			return $res;
		}
		function getComments($blog_id){
			$Comment= M("Comment");
			$data = $Comment->where("blog_id ={$blog_id}")->select();
			return $data;
		}
		function count($blog_id){
			$Comment= D("Comment");
			$count = $Comment->where("blog_id ={$blog_id}")->count();
			return isset($count) ? $count : 0;
		}

	}