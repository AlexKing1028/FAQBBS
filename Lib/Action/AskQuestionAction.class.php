<?php
	class AskQuestionAction extends SignupBaseAction{
		public function _empty(){
			if(!is_null($_SESSION['uid'])){
				$this->assign('userdata',$this->getUserData());		
				$this->askQuestion();
			}else{
				$this->redirect('Member/member', array('cate_id' => 2), 1, 'sorry, you havent logged in.');
			}
		}


		public function askQuestion(){
			$this->display("AskQuestion:askquestion");
		}

		public function uploadQuestion(){
			//存储问题数据
			
			$data['title']=$this->_post('title');
			$data['content']=$this->_post('content');
			$data['tags']=$this->_post('tags');
			$data['reward']=$this->_post('reward');
			$data['uid']=$this->_post($_SESSION['uid']);
			
			$Question=new Model('question');
			$Question->create();
			$Question->add();
			
			//更新用户数据	
			$User=new Model('user');
			$data['score']=intval($_SESSION['score'])-intval($this->_post('reward'));
			$uid=$_SESSION['uid'];
			//dump($uid);
			//dump($data);
			$User->where("uid=$uid")->save($data);

			$this->redirect('Question/question', array('cate_id' => 2), 1, 'wait and you will see your question~');
		}


	}