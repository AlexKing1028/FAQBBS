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



      #qidnum{
        display: none;
      }
      </style>
      <script type="text/javascript">

      window.UEDITOR_HOME_URL='http://localhost/app/ueditor/';
      //$("#qidnum").val("<?php echo ($question['qid']); ?>");
      </script>  

      <script type="text/javascript">

      function agr(aid, atype){

        var ensure=1;
        if(!$("#"+aid+'-'+atype).hasClass('active')){
          ensure=0;
          if($("#"+aid+'-'+(1-atype)).hasClass('active')){
            $("#"+aid+'-'+(1-atype)).button('toggle');

            var num=parseInt($("#"+aid+'-'+(1-atype)).children(".badge").text());
            $("#"+aid+'-'+(1-atype)).children(".badge").text(num-1);    
          }
          var num=parseInt($("#"+aid+'-'+atype).children(".badge").text());
          $("#"+aid+'-'+atype).children(".badge").text(num+1);
        }else{
          var num=parseInt($("#"+aid+'-'+atype).children(".badge").text());
          $("#"+aid+'-'+atype).children(".badge").text(num-1);
        }

        $.ajax(
      { //一个Ajax过程 
        "type": "GET",  //以post方式与后台沟通
    "url" : "http://localhost/app/Answers/agreeAnswer", //与此php页面沟通
    "data": "aid="+aid+"&atype="+atype+"&es="+ensure+"&qid="+<?php echo ($question['qid']); ?>, 
    
    "success":function(){
       //可以考虑在其中加入更新当前赞同或反对数的操作
     }
   });
      };

      function vot(){
        var num=parseInt($("#qvote").children(".badge").text());
        var stat=$("#qvote").hasClass('active');
        if(stat==1){
          $("#qvote").children(".badge").text(num-1);
        }else{
          $("#qvote").children(".badge").text(num+1);
        }

        $.ajax({
          "type":"GET",
          "url":"http://localhost/app/Answers/votequestion",
          "data":"qid="+<?php echo ($question['qid']); ?>+"&ty="+stat,
          "success":function(){
              //...
            }
          });
      };


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

      <h3>问题</h3>
      <hr>
      <div class="question-summary">

        <div class="btn-group" >
         <?php if($is_votequestion): ?><button type="button" data-toggle="button" class="btn btn-default active" onclick="vot()" id="qvote"><strong>VOTES</strong> <span class="badge"><?php echo ($question["votes"]); ?></span></button>

          <?php else: ?>
          <button type="button" data-toggle="button" class="btn btn-default" onclick="vot()" id="qvote"><strong>VOTES</strong> <span class="badge"><?php echo ($question["votes"]); ?></span></button><?php endif; ?>
        <button type="button" data-toggle="button" class="btn btn-default" disabled='disabled'><strong>ANSWERS</strong><span class="badge"><?php echo ($question["answers"]); ?></span></button>
      </div>
      <p></p>
      

      <div class="panel panel-success">
        <div class="panel-heading"><?php echo ($question["title"]); ?></div>
        <div class="panel-body">
          <?php echo ($question['content']); ?>
        </div>
      </div>
      <div class="question-label">
        <?php foreach($question["types"] as $tag){ ?>
          <button type="button" class="btn btn-default btn-xs"><strong><?php echo $tag; ?></strong></button>
          <?php
 } ?>
        
      </div>

      <hr>
    </div>
    <p></p>
    <h3>回答</h3>
    <hr>
    <!--若已经设置了标准答案，则显示之-->
    <div id="acanswer">
      <?php if(isset($acanswer)): ?><div class="acanswer">
          <?php if(isset($uservote_info[$acanswer['aid']]) AND $uservote_info[$acanswer['aid']] == 1): ?><div class="btn-group" >
              <button type="button"  data-toggle="button" class="btn btn-default active other" onclick="agr(<?php echo ($acanswer['aid']); ?>,0)" id='<?php echo ($acanswer['aid']); ?>-0'><strong>AGREE</strong> <span class="badge"><?php echo ($acanswer["agree"]); ?></span></button>
              <button type="button" data-toggle="button" class="btn btn-default other" onclick="agr(<?php echo ($acanswer['aid']); ?>,1)" id='<?php echo ($acanswer['aid']); ?>-1'><strong>DISAGREE</strong><span class="badge"><?php echo ($acanswer["disagree"]); ?></span></button>
            </div>
            <?php elseif(isset($uservote_info[$acanswer['aid']]) AND $uservote_info[$acanswer['aid']] == 0): ?>

            <div class="btn-group" >
              <button type="button" data-toggle="button" class="btn btn-default other" onclick="agr(<?php echo ($acanswer['aid']); ?>,0)" id='<?php echo ($acanswer['aid']); ?>-0'><strong>AGREE</strong> <span class="badge"><?php echo ($acanswer["agree"]); ?></span></button>
              <button type="button" data-toggle="button" class="btn btn-default active other" onclick="agr(<?php echo ($acanswer['aid']); ?>,1)" id='<?php echo ($acanswer['aid']); ?>-1'><strong>DISAGREE</strong><span class="badge"><?php echo ($acanswer["disagree"]); ?></span></button>
            </div>
            <?php else: ?>

            <div class="btn-group">
              <button type="button" data-toggle="button" class="btn btn-default other" onclick="agr(<?php echo ($acanswer['aid']); ?>,0)" id='<?php echo ($acanswer['aid']); ?>-0'><strong>AGREE</strong> <span class="badge"><?php echo ($acanswer["agree"]); ?></span></button>
              <button type="button" data-toggle="button" class="btn btn-default other" onclick="agr(<?php echo ($acanswer['aid']); ?>,1)" id='<?php echo ($acanswer['aid']); ?>-1'><strong>DISAGREE</strong><span class="badge"><?php echo ($acanswer["disagree"]); ?></span></button>
            </div><?php endif; ?>
          <?php if($acanswer['uid'] == $_SESSION['uid']): ?><a href="<?php echo ($_SESSION['urlroot']); ?>userinfo/<?php echo ($_SESSION['uid']); ?>" class="users username">ME</a>
            <?php else: ?>
            <a href="<?php echo ($_SESSION['urlroot']); ?>userinfo/<?php echo ($acanswer['uid']); ?>" class="users username"><?php echo ($acanswer['firstname']); ?> <?php echo ($acanswer['lastname']); ?></a><?php endif; ?>

          <div class="panel panel-info answer-content">
            <div class="panel-heading">已采纳答案</div>
            <div class="panel-body">
              <?php echo ($acanswer['content']); ?>
            </div>
          </div>

        </div>
        <hr><?php endif; ?>
    </div>
    <div id="answers">
      <?php if(is_array($answers_array)): $i = 0; $__LIST__ = $answers_array;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><!--当回答为用户自己的回答时-->
        <?php if($vo['uid'] == $_SESSION['uid']): ?><div class='userown'>
            <div class="btn-group">
              <button type="button" data-toggle="button" class="btn btn-default" disabled='disabled'><strong>AGREE</strong> <span class="badge"><?php echo ($vo["agree"]); ?></span></button>
              <button type="button" data-toggle="button" class="btn btn-default" disabled='disabled'><strong>DISAGREE</strong><span class="badge"><?php echo ($vo["disagree"]); ?></span></button>
            </div>
            <a href="#" class="users username">ME</a>
          </div>

          <?php else: ?>
          <div class='others' id='<?php echo ($vo['aid']); ?>'>
            <div class="btn-group" >
            <?php if(isset($uservote_info[$vo['aid']]) AND $uservote_info[$vo['aid']] == 1): ?><button type="button"  data-toggle="button" class="btn btn-default active other" onclick="agr(<?php echo ($vo['aid']); ?>,0)" id='<?php echo ($vo['aid']); ?>-0'><strong>AGREE</strong> <span class="badge"><?php echo ($vo["agree"]); ?></span></button>
                <button type="button" data-toggle="button" class="btn btn-default other" onclick="agr(<?php echo ($vo['aid']); ?>,1)" id='<?php echo ($vo['aid']); ?>-1'><strong>DISAGREE</strong><span class="badge"><?php echo ($vo["disagree"]); ?></span></button>
            <?php elseif(isset($uservote_info[$vo['aid']]) AND $uservote_info[$vo['aid']] == 0): ?>

                <button type="button" data-toggle="button" class="btn btn-default other" onclick="agr(<?php echo ($vo['aid']); ?>,0)" id='<?php echo ($vo['aid']); ?>-0'><strong>AGREE</strong> <span class="badge"><?php echo ($vo["agree"]); ?></span></button>
                <button type="button" data-toggle="button" class="btn btn-default active other" onclick="agr(<?php echo ($vo['aid']); ?>,1)" id='<?php echo ($vo['aid']); ?>-1'><strong>DISAGREE</strong><span class="badge"><?php echo ($vo["disagree"]); ?></span></button>
            
              <?php else: ?>

              
                <button type="button" data-toggle="button" class="btn btn-default other" onclick="agr(<?php echo ($vo['aid']); ?>,0)" id='<?php echo ($vo['aid']); ?>-0'><strong>AGREE</strong> <span class="badge"><?php echo ($vo["agree"]); ?></span></button>
                <button type="button" data-toggle="button" class="btn btn-default other" onclick="agr(<?php echo ($vo['aid']); ?>,1)" id='<?php echo ($vo['aid']); ?>-1'><strong>DISAGREE</strong><span class="badge"><?php echo ($vo["disagree"]); ?></span></button><?php endif; ?>
            <?php if($cansetAns): ?><!--需要对该button添加设置采纳的调用-->
                <button class="btn btn-default" id="submit-setacanswer" onclick="window.location='<?php echo ($_SESSION['urlroot']); ?>Answers/setAcceptedAnswer?aid=<?php echo ($vo['aid']); ?>&qid=<?php echo ($question['qid']); ?>'">采纳</button><?php endif; ?>
          </div>
            <a href="#" class="users otherusers"><?php echo ($vo['firstname']); ?> <?php echo ($vo['lastname']); ?></a>
          </div><?php endif; ?>
        <div class="panel panel-default answer-content">
          <div class="panel-body">
            <?php echo ($vo['content']); ?>
          </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <?php if($notown): ?><h4>我来回答：</h4>
      <hr>
      <form action="http://localhost/app/Answers/uploadAnswer" method="post" name="answerquestion" role="form">
        <!-- 加载编辑器的容器 -->
        <input id="qidnum" type="text" name="qid" value=<?php echo ($question['qid']); ?>>
        <script id="container" name="content" type="text/plain">
        </script>
        <button class="btn btn-default" type="submit" id="submit-answer">提交回答</button>
      </form><?php endif; ?>
  </div><!-- questionlist-main -->


  <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
      <form role="form" action="<?php echo ($_SESSION['urlroot']); ?>AskQuestion" method="post">
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