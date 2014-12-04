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
        #submit-question{
          float: right;
          margin-top: 10px;
        }
        #tags{
          margin-top: 5px;
          margin-bottom: 7px;
        }
        
        #rewards{
          margin-top: 7px;
        }

        #warning_noscore{
          display: none;
        }
        #warning_notitle{
          display: none;
        }
        #warning_notags{
          display: none;
        }
              

      </style>
      
      <script type="text/javascript">
        window.UEDITOR_HOME_URL='http://localhost/app/ueditor/';
      </script>      
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


<div id="warning_noscore" class="alert alert-danger" role="alert"><strong>警告！</strong> 您的积分不足，无法悬赏发布该问题，请尝试增加积分或减少悬赏金额</div>
<div id="warning_notitle" class="alert alert-danger" role="alert"><strong>警告！</strong> 您的问题缺少标题</div>
<div id="warning_notags" class="alert alert-danger" role="alert"><strong>警告！</strong> 您的问题缺少标签，标签将用于其他用户定位问题</div>


<form action="__URL__/uploadQuestion" method="post" name="askquestion" class="form-horizontal" id="question-submit" role="form">
        <!-- 加载编辑器的容器 -->
        <input class="form-control" type="text" name="title" id="question-title" placeholder="问题标题">
        
        <div class="form-group form-group-sm" id="tags">
            <label class="col-sm-1 control-label" for="formGroupInputSmall_tags">标签:</label>
            <div class="col-sm-11">
              <input class="form-control" type="text" id="formGroupInputSmall_tags" name="tags"  placeholder="使用','分割不同标签">
            </div>
          </div>
             
        <script id="container" name="content" type="text/plain">具体陈述你的问题
        </script>
        <div class="form-group form-group-sm" id="rewards">
          
          <div class="col-sm-2 pull-right">
            <input class="form-control" type="text" id="formGroupInputSmall_reward" name="reward" placeholder="number">
          </div>
      
          <label class="col-sm-2 pull-right control-label" for="formGroupInputSmall_reward">悬赏分:</label>
        
        </div>
        <button class="btn btn-default" type="submit" id="submit-question">提交问题</button>
    </form>
    <!-- 配置文件 -->


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
    <script type="text/javascript" src="http://localhost/app/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="http://localhost/app/ueditor/ueditor.all.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var editor = UE.getEditor('container');
        
        function chk_validation(){
          var title=document.getElementById("question-title");
          if(!chk_title(title.value)){
            hide_all_warning();
            display_one_warning("warning_notitle");
            return false;
          }
    
          var tags=document.getElementById("formGroupInputSmall_tags");
          if(!chk_tags(tags.value)){
            hide_all_warning();
            display_one_warning("warning_notags");
            return false;
          }

          var reward=document.getElementById("formGroupInputSmall_reward");
          if(!chk_score_isenough(reward.value)){
            hide_all_warning();
            display_one_warning("warning_noscore");
            return false;
          }
          return true;
        }

        function chk_title(title){
          return title!="";
        }

        function chk_tags(tags){
          return tags!=""&&tags!=",";
        }

        function chk_score_isenough(reward){

          if(Number(<?php echo ($userdata['score']); ?>)<Number(reward)){
              return false;
          }
          return true;
        }

        function hide_all_warning(){
            document.getElementById("warning_noscore").style.display="none";
            document.getElementById("warning_notags").style.display="none";
            document.getElementById("warning_notitle").style.display="none";
        }

        function display_one_warning(warning_id){
            document.getElementById(warning_id).style.display="block";
        }

        document.getElementById("question-submit").onsubmit=chk_validation;

    </script>





</body>
</html>