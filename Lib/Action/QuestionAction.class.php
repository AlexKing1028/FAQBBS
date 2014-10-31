<?php
	class QuestionAction extends SignupBaseAction{
		public function _empty(){
			if(!is_null($_SESSION['uid'])){
				$this->assign('userdata',$this->getUserData());				
				$this->question();
			}else{
				$this->redirect('Member/member', array('cate_id' => 2), 1, 'sorry, you havent logged in.');
			}
		}

		protected function question(){
			$question_model=new QuestionModel();
			$this->assign('question_sum_array',$question_model->getHotQuestion());

			$this->display('Question:question');
		}
		
		public function showTargetedQuestion($question_Info){
			$this->assign('question_sum_array',$question_Info);
			$this->display('Question:question');
		}		
	}