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
			if(!is_null($_SESSION['uid'])){
				$this->assign('userdata',$this->getUserData());		
			}else{
				$this->redirect('Member/member', array('cate_id' => 2), 1, 'sorry, you havent logged in.');
			}


			$data['title']=$this->_post('title');
			$data['content']=$_POST['content'];
			$data['tags']=$this->_post('tags');
			$data['reward']=$this->_post('reward');
			$data['uid']=intval($_SESSION['uid']);

			//检查权限
			$canUpload=$this->checkRight($_SESSION['uid']);
			if($canUpload==0){
				//当权限不够时直接返回
				$this->display('askforbidden');
			}else{
			
			$Question=new Model('question');
			
			$Question->add($data);
			
			dump($data);

			//更新用户数据	
			$uid=intval($_SESSION['uid']);
			$User=new Model('user');
			$strcurScore=$User->where("uid=$uid")->field('score')->select();
			$curScore=intval($strcurScore[0]['score']);
			//dump($strcurScore);
			//dump($curScore);

			$data2['score']=$curScore-intval($this->_post('reward'));
			//dump($uid);
			//dump($data2);

			$User->where("uid=$uid")->save($data2);
			

			$this->redirect('Question/question', array('cate_id' => 2), 1, 'wait and you will see your question~');
			}
		}
		private function checkRight($uid){
			$score_level=array(0,10,20,30);
			$questionnum_level=array(0,1,2,3);
			$level=3;


			//dump($uid);
			$Question=new Model('question');
			$question_array=$Question->where("uid=$uid")->field('timestamp')->select();
			//dump($question_array);
			$curdate=date('Y-m-d');
			//dump($curdate);
			$i=0;
			foreach ($question_array as $timestamp) {
				# code...
				//dump($timestamp['timestamp']);
				//dump(strpos($timestamp['timestamp'], $curdate));
				if(!(strpos($timestamp['timestamp'], $curdate)===false)){
					$i++;
				//	dump("jwef");
				}
			}
			if(0==$i){
				return 1;
			}

			$User=new Model('user');
			$strscore=$User->where("uid=$uid")->field('score')->select();
			$score=intval($strscore[0]['score']);
			//dump($score);
			//dump($score_level);
			for($j=1;$j<=$level;$j++){
				//dump($score_level[$j-1]);
				//dump($score_level[$j]);
				if($score>$score_level[$j-1] && $score<=$score_level[$j]){
					//dump($j);
					if($i>=$questionnum_level[$j]){
						//dump("reject");
						return 0;
					}else{
						//
						return 1;
					}
				}
			}
			if($score>$score_level[$level]){
				//
				return 1;
			}
			return 0;
		}

	}