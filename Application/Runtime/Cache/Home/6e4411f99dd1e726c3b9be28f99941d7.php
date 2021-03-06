<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人博客</title>
    <link rel="stylesheet" href="/Public/css/reset.css">
    <link rel="stylesheet" href="/Public/css/main.css">
    <script type="text/javascript" src="/Public/js/jquery-3.2.0.js"></script>
    <script type="text/javascript" src="/Public/js/main.js"></script>
</head>
<body>
    <div class="main">
        <div class="header">
            <div class="logo">
                <img src="/Public/img/logo.png" alt="">
            </div>
            <div class="top-nav">
                <ul class="top-nav-ul">
                    <li>
                        <a href="index.php" class="mouseOn">首页</a>
                        <span class="top-nav-out">Home</span>
                    </li>
                    <li>
                        <a href="#" class="mouseOn">关于我</a>
                        <span class="top-nav-out">About</span>
                    </li>
                    <li>
                        <a href="#" class="mouseOn">慢生活</a>
                        <span class="top-nav-out">Life</span>
                    </li>
                    <li>
                        <a href="#" class="mouseOn">模板分享</a>
                        <span class="top-nav-out">Share</span>
                    </li>
                    <li>
                        <a href="index.php?c=Home&a=study" class="mouseOn">学无止境</a>
                        <span class="top-nav-out">Learn</span>
                    </li>
                    <li>
                        <a href="liuyan.html" class="mouseOn">留言</a>
                        <span class="top-nav-out">Saying</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content-box">
            <div class="content">
                <div class="content-top">
                    <img src="/Public/img/midd1.png" alt="">
                    <img src="/Public/img/midd2.png" alt="">
                    <img src="/Public/img/midd3.png" alt="">
                </div>
                <div class="content-time">
                    <ul class="content-time-ul">
                    <?php foreach ($data as $value) { ?>
                        <li>
                            <span class="timer">
                                <span class="timer1"><?php echo $value['month'];?></span>
                                <span class="timer2"><?php echo $value['year'];?></span>
                            </span>
                            <div class="time-spot"></div>
                            <div class="time-con">
                                <h2>
                                    <a href="#">
                                       <?php echo $value['title'];?>
                                    </a>
                                </h2>
                                <div class="time-con-p">
                                    <img src="<?php echo '/Uploads/'.$value['image'];?>" alt="">
                                    <p><?php echo $value['content'];?></p>
                                    <p class="p-Notes"><a href="#"><?php echo $value['classify_name'];?></a><a href="/Home/getBlogInfo/id/<?php echo $value['id'];?>" class="time-con-p-a">阅读全文>></a></p>
                                </div>
                            </div>
                        </li> 
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer">Design by DanceSmile 蜀ICP备11002373号-1</div>
    </div>
</body>
</html>