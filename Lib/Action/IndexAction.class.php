<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
		if(isset($_SESSION['uid'])){
			//echo "welcome to index";
			$this->display('Text:ajax');
		}else{
			$this->display('User:login');
		}
	}
	public function ajaxtest(){
		$this->ajaxReturn('gsm',"hehe",1);
	}
}