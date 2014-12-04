<?php if (!defined('THINK_PATH')) exit();?>  <!DOCTYPE html>
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
        body { padding-top: 120px; 
        background-image: url("http://localhost/app/csg-547f33d176095.png");
        background-position: 0 -850px;
        }
        
        </style>
        
      </head>
      <body>


  <div class="container content">


    <div class="row">
      <div class="col-sm-8 content-main">


      </div><!-- questionlist-main -->

      
      <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
        <hr>


      <ul id="myTab" class="nav nav-pills nav-justified" role="tablist">
        <li role="presentation" class="active" ><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">登录</a></li>
        <li class="" role="presentation"><a aria-expanded="false" href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">注册</a></li>
      </ul>
      <div id="myTabContent" class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
          <br>
          <form role="form" id="signup" method="post" action="<?php echo ($_SESSION['urlroot']); ?>Member/signup">
            <div class="form-group">
              <input type="email" class="form-control" name="email" id="emailaddress2" placeholder="Email">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <div class="form-group">

            <button type="submit" class="btn btn-primary">登录</button>
            </div>
    
          </form>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
          <br>
  <form class="form-horizontal" role="form" id="signin" method="post" action="<?php echo ($_SESSION['urlroot']); ?>Member/signin">
    <div class="form-group">
      <div class="col-sm-6">
        <input class="form-control" id="firstname" name="first_name" placeholder="first name">
      </div>
      <div class="col-sm-6">
        <input class="form-control" name="last_name" id="lastname" placeholder="last name">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">
        <input type="email" class="form-control" name="email" id="emailaddress" placeholder="Email">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">
        <input type="password" class="form-control" name="password" id="initial" placeholder="Password">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">
        <input type="password" class="form-control" name="password_identify" id="veritfication" placeholder="Password">
      </div>
    </div>

    <button type="submit" class="btn btn-primary">注册</button>

  </form> 
        </div>
      </div>

        <hr>
        <div class="sidebar-module userinfo">

        </div>
      </div><!-- /.blog-sidebar -->

    </div><!-- /.row -->

  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->


  <script src="http://localhost/app/bootstrap/js/bootstrap.min.js"></script>

  <script>

  $('#myTab a:first').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
    //alert("");
    //修改背景图片
   
   document.body.setAttribute("style",
"background-position: 0 -850px;");
    
  });


  $('#myTab a:last').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
//    alert("");
    //修改背景图片
document.body.setAttribute("style",
"background-position: 0 0px;");
    
  

    });

      function chk_password(password){
        return password!="";
      }

      function chk_emailaddress(email){
        var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        
        if (filter.test(email)){

          return true;
        }
        else {
          return false;
        }
      }


      function chk_signin_value(){
        var firstname=document.getElementById("firstname");
        var lastname=document.getElementById("lastname");
        if(firstname.value==""||lastname.value==""){
          alert("姓名不能为空");
          return false;
        }
        var emailv=document.getElementById("emailaddress");
        if(!chk_emailaddress(emailv.value)){
          alert("邮件格式有误");
          return false;
        }

        var init= document.getElementById("initial");
        if(!chk_password(init.value)){
          alert("密码不能为空");
          return false;
        }

        var verit=document.getElementById("veritfication");
        if(init.value!=verit.value){
          alert("密码输入不一致");
          return false;
        }
        return true;
      }
      
  <!--登录信息验证-->
      function chk_signup_value(){
        var emailaddress2=document.getElementById("emailaddress2");
        if(!chk_emailaddress(emailaddress2.value)){
          alert("邮箱地址错误");
          return false;
        }
        var password=document.getElementById("password");
        if(!chk_password(password.value)){
          alert("密码不能为空");
          return false;
        }
        return true;
      }



      document.getElementById("signin").onsubmit=chk_signin_value;
      document.getElementById("signup").onsubmit=chk_signup_value;

  </script>
  </body>
  </html>