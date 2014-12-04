<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends SignupBaseAction {
    public function index(){
			//echo "welcome to index";
			$questionaction=new QuestionAction();
			$questionaction->_empty();
		
	}
	public function ajaxtest(){
		$this->ajaxReturn('gsm',"hehe",1);
	}
}