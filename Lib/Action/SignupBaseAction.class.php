<?php
	class SignupBaseAction extends Action{
		public function getUserData(){
			$uid=$_SESSION['uid'];
			$user=M('User')->where("uid='$uid'")->find();
			$name=$user['firstname'].'_'.$user['lastname'];
			$_SESSION['uid']=$user['uid'];
			$_SESSION['username']=$name;
			$_SESSION['score']=$user['score'];
			$_SESSION['email']=$user['email'];
			return array(
				"uid"=>$_SESSION['uid'],
				"username"=>$_SESSION['username'],
				"email"=>$_SESSION['email'],
				"score"=>$_SESSION['score']
				);
		}
	}