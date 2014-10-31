<?php
	class AnswersAction extends SignupBaseAction{
		public function _empty($questionid){
			if(!is_null($_SESSION['uid'])){
				$this->assign('userdata',$this->getUserData());		
				$this->answersOfQuestion($questionid);			
			}else{
				$this->redirect('Member/member', array('cate_id' => 2), 1, 'sorry, you havent logged in.');
			}
			
		}

		protected function answersOfQuestion($questionid){
			$uid=$_SESSION['uid'];

			//问题数据
			$Question_model=new QuestionModel();
			$question=$Question_model->getOneQuestion($questionid);
			$this->assign('question',$question);
			//dump($question);

			$notown=true;
			if($question['uid']==$uid){
				$notown=false;
			}
			$this->assign('notown',$notown);

			//回答数据
			$Answer_model=new AnswersModel();
			$answers=$Answer_model->getAnswersOfQuestion($questionid);
			$this->assign('answers_array',$answers['otheranswers']);
			$this->assign('acanswer',$answers['acanswer']);
			//dump($answers);
			//dump($answers[0]);
			//$this->assign('ans1',$answers[0]);

			//是否显示采纳答案按钮
			$cansetAns=false;
			if($question['uid']==$uid && !isset($answers['acanswer'])){
				$cansetAns=true;
			}
			$this->assign('cansetAns',$cansetAns);

			//需要返回该用户对此问题的答案的投票或者回答
			$User_angree_model=new Model('agreeans');
			$user_answers_votes=$User_angree_model->where("uid=$uid and qid=$questionid")->select('aid','isagree');
			//仅仅是test……
			$user_answers_votes[1]=array(
				'aid'=>95270002,
				'isagree'=>true,
				);
			$user_answers_votes[2]=array('aid'=>95270010,'isagree'=>false,);
			
			foreach ($user_answers_votes as $ua) {
				# code...
				$user_answers_map[$ua['aid']]=$ua['isagree'];
			}
			$this->assign('uservote_info',$user_answers_map);
			//dump($question);
			//dump($anwers);
			//dump($user_answers_map);

			$Votequestion_model=new Model('votequestion');
			$is_vote=$Votequestion_model->where("qid=$questionid and uid=$uid")->select();
			if (isset($is_vote[0])) {
				# code...
				$this->assign('is_votequestion', true);
			}else{
				$this->assign('is_votequestion', false);
			}


			$this->display('Answers:answers');
		}


//此方法用于为回答点赞或否认，atype区分是同意还是不同意，es区分是取消还是添加（确认）
		public function agreeAnswer(){
			
			$uid=$_SESSION['uid'];
			$answerid=$this->_param('aid');
			$type=$this->_param('atype');
			$ensure=$this->_param('es');
			$qid=$this->_param('qid');

			$this->ajaxReturn($type,"json");
		}

//ty表示是点赞还是取消点赞，1表示需要取消点赞，0表示添加点赞
		public function voteQuestion(){
			$uid=$_SESSION['uid'];
			$qid=$this->_param('qid');
			$type=$this->_param('ty');


			$this->ajaxReturn($vtype,'点赞成功',1);
		}

		public function uploadAnswer(){
			$data['qid']=$this->_post('qid');
			$data['uid']=$_SESSION['uid'];
			$data['content']=$_POST['content'];
			dump($data);
			
			$Question_model=new Model('question');
			$Question_model->where("qid=$qid")->setInc('answernum',1);
			$Answer_model=new Model('answer');
			$Answer_model->create($data);
			$Answer_model->add();
			
			$this->answersOfQuestion($data['qid']);
		}

		public function setAcceptedAnswer(){

		}

	}