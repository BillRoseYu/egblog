<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>详情</title>
</head>
<body>
	<img src="<?php echo '/Uploads/'.$info['image'];?>" width=200 height=auto>
	<P><?php echo $info['content'];?></P>
</body>
</html>