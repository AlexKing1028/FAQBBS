<?php
	class SearchAction extends Action{
		public function search(){
			$search_type=$this->_param('options');
			$info=$this->_param('searchinfo');
			if($search_type=='0'){
				$userinfo=new UserInfoAction();
				//dump($info);
				$userinfo->userInfoList($info);
			}else{
//				dump('search question');
				//dump($info);
				$question=new QuestionAction();
				$question->questionList($info);
			}
		}

	}