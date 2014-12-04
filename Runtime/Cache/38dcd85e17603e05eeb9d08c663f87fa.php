<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FAQBBS</title>

  <!-- Bootstrap -->
  <link href="http://localhost/app/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <style type="text/css">
      body { padding-top: 70px; }
      
      </style>
      
    </head>
    <body>

     <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
       <div class="container">
         <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" 
          data-target="#example-navbar-collapse">
          <span class="sr-only">切换导航</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo ($_SESSION['urlroot']); ?>Question">FAQBBS</a>

      </div>
      <div class="collapse navbar-collapse" id="example-navbar-collapse">
        <ul class="nav navbar-nav">

          <form class="navbar-form navbar-left" action="http://localhost/app/Search/search" method="POST" role="search">

     <div class="form-group">

      <div class="btn-group" data-toggle="buttons">
       <label class="btn btn-default">
        <input type="radio" name="options" id="option1" value='0'>用户
      </label>
      <label class="btn btn-default">
        <input type="radio" name="options" id="option2" value='1'>问题
      </label>
    </div>
    <input type="text" class="form-control" name="searchinfo" placeholder="查点什么...">

    <button class="btn btn-default" type="submit">
     搜索
   </button>
 </div>
</form>  

</ul>
<ul class="nav navbar-nav navbar-right user">
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo ($userdata['username']); ?><span class="caret"></span></a>
    <ul class="dropdown-menu pull-right" role="menu">
      <li><a href="<?php echo ($_SESSION['urlroot']); ?>userinfo/<?php echo ($_SESSION['uid']); ?>">我的主页</a></li>
      <li><a href="<?php echo ($_SESSION['urlroot']); ?>member/logout">注销</a></li>

    </ul>
  </li>
</ul>
</div>
</div>
</nav>

<div class="container content">


  <div class="row">
    <div class="col-sm-8 content-main">

      <h3>问题</h3>
      <hr>
      <h3>出错啦！ 问题未找到</h3>
    </div><!-- questionlist-main -->


    <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
      <div class="sidebar-module sidebar-module-inset">
        <form role="form" action="http://localhost/app/AskQuestion" method="post">
          <button type="submit" class="btn btn-default btn-lg">提问</button>
        </form>
      </div>
      <hr>
      <div class="sidebar-module userinfo">
          <ul class="list-group">
            <li class="list-group-item">
                <span class="badge"><?php echo ($userdata['uid']); ?></span>
                ID
              </li>
            <li class="list-group-item">
                <span class="badge"><?php echo ($userdata['email']); ?></span>
                EMAIL
              </li>
            <li class="list-group-item">
                <span class="badge"><?php echo ($userdata['score']); ?></span>
                积分
              </li>
          </ul>           
      </div>
      <div class="sidebar-module">

      </div>
    </div><!-- /.blog-sidebar -->

  </div><!-- /.row -->

</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->


<script src="http://localhost/app/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>