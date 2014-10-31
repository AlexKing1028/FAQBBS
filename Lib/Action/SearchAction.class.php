<?php
	class Search extends Action{
		public function search(){
			$search_type=$this->_param('options');
			if($search_type=='0'){
				$this->searchUser();
			}else{
				$this->searchQuestion();
			}
		}

		private function searchUser($searchtxt){
//搜索用户，获取用户list

//调用用户list显示界面
			new UserInfoAction()->userInfoList($userinfolist);
		}

		private function searchQuestion($searchtxt){
//搜索问题，获取问题内容


//调用问题显示的界面
			new QuestionAction()->showTargetedQeustion($questionlist);
		}
	}