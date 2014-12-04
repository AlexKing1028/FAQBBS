<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FAQBBS</title>

  <!-- Bootstrap -->
  <link href="http://localhost/app/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="http://localhost/app/jquery-1.11.1.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <style type="text/css">
      body { padding-top: 70px; } 

      .users{
        float: right;
      }   
      
      .answer-content{
        margin-top: 5px;
      }

      #submit-answer{
        float: right;
        margin-top: 10px;
      }

      </style>
      <script type="text/javascript">

      window.UEDITOR_HOME_URL='http://localhost/app/ueditor/';
      //$("#qidnum").val("<?php echo ($question['qid']); ?>");
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

      <h3><?php echo ($targetudata['firstname']); ?>_<?php echo ($targetudata['lastname']); ?>的主页</h3>
      <hr>


      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">个人信息</h3>
        </div>
          <ul class="list-group">
            <li class="list-group-item">
                <span class="badge"><?php echo ($targetudata['uid']); ?></span>
                ID
              </li>

            <li class="list-group-item">
                <span class="badge"><?php echo ($targetudata['firstname']); ?>_<?php echo ($targetudata['lastname']); ?></span>
                name
              </li>


            <li class="list-group-item">
                <span class="badge"><?php echo ($targetudata['email']); ?></span>
                EMAIL
              </li>
            <li class="list-group-item">
                <span class="badge"><?php echo ($targetudata['score']); ?></span>
                积分
              </li>

            <li class="list-group-item">
                <h5>个人简介</h5>
                <br>
                <?php echo ($targetudata['Introduction']); ?>
              </li>

          </ul>         
      </div>      

      <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">你的提问</div>

        <!-- List group -->
        <ul class="list-group">
          
          <?php if(is_array($userquestion)): $i = 0; $__LIST__ = $userquestion;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="list-group-item"><a href='<?php echo ($_SESSION['urlroot']); echo ($vo['href']); ?>'><?php echo ($vo[title]); ?></a>
          <br>
          <br>
          <div class="question-label">

          <?php foreach($vo["types"] as $tag){ ?>
          <button type="button" class="btn btn-default btn-xs"><strong><?php echo $tag; ?></strong></button>
          <?php
 } ?>
        </div>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
<!--
          <li class="list-group-item"><a href='#'>Dapibus ac facilisis in</a></li>
          <li class="list-group-item"><a href='#'>Morbi leo risus</a></li>
          <li class="list-group-item"><a href='#'>Porta ac consectetur ac</a></li>
          <li class="list-group-item"><a href='#'>Vestibulum at eros</a></li>
    -->
        </ul>
      </div>

      <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">最新动态</div>
        <!-- List group -->
        <ul class="list-group">
          <?php if(is_array($latestaction)): $i = 0; $__LIST__ = $latestaction;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="list-group-item">
            <!--question title-->
            <a href='<?php echo ($_SESSION['urlroot']); echo ($vo[qhref]); ?>'><?php echo ($vo['qtitle']); ?></a>
            <br>
            <!--type-->
            <?php echo ($vo['action']); ?>
            <br>
            <!--answer-->
            <?php echo ($vo['acontent']); ?>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
<!--
          <li class="list-group-item">Dapibus ac facilisis in</li>
          <li class="list-group-item">Morbi leo risus</li>
          <li class="list-group-item">Porta ac consectetur ac</li>
          <li class="list-group-item">Vestibulum at eros</li>
 -->
        </ul>
      </div>

      <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">历史留言</div>
        <!-- List group -->
        <ul class="list-group">
          <?php if(is_array($message)): $i = 0; $__LIST__ = $message;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="list-group-item">
            
              <a href='<?php echo ($_SESSION['urlroot']); echo ($vo['href']); ?>'><?php echo ($vo['firstname']); ?>_<?php echo ($vo['lastname']); ?></a>
            <br>
            <?php echo ($vo['timestamp']); ?>
            <br>
            <?php echo ($vo['content']); ?>
          </li><?php endforeach; endif; else: echo "" ;endif; ?>
  <!--
          <li class="list-group-item">Dapibus ac facilisis in</li>
          <li class="list-group-item">Morbi leo risus</li>
          <li class="list-group-item">Porta ac consectetur ac</li>
          <li class="list-group-item">Vestibulum at eros</li>
      -->
        </ul>
      </div>

    
    
    <?php if($_SESSION['uid'] != $targetudata['uid']): ?><h4> 留个言：</h4>
      <hr>
      <form action="<?php echo ($_SESSION['urlroot']); ?>UserInfo/uploadMessage" method="post" name="answerquestion" role="form">
        <!-- 加载编辑器的容器 -->
        <input type="hidden" name="targetuid" value="<?php echo ($targetudata['uid']); ?>"></input>
        <script id="container" name="content" type="text/plain">
        </script>
        <button class="btn btn-default" type="submit" id="submit-answer">提交</button>
      </form>
      <?php else: ?>

      <h4> 编辑我的简介：</h4>
      <hr>
      <form action="<?php echo ($_SESSION['urlroot']); ?>UserInfo/editIntroduction" method="post" name="answerquestion" role="form">
        <!-- 加载编辑器的容器 -->
        <script id="container" name="content" type="text/plain">
        </script>
        <button class="btn btn-default" type="submit" id="submit-answer">提交</button>
      </form><?php endif; ?>
  </div><!-- questionlist-main -->


  <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
      <form role="form" action="<?php echo ($_SESSION['urlroot']); ?>}AskQuestion" method="post">
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
</script>


</body>
</html>