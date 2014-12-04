<?php
	class UserInfoAction extends SignupBaseAction{
		public function _empty($userid){
			if(!is_null($_SESSION['uid'])){
				$this->assign('userdata',$this->getUserData());				
				if(!isset($userid)|$userid==''){
					//若未输出userid
					$userid=$_SESSION['uid'];
				}


				$this->userInfoDetail($userid);
			}else{
				$this->redirect('Member/member', array('cate_id' => 2), 1, 'sorry, you havent logged in.');
			}
		}

		public function userInfoList($info){
			if(!is_null($_SESSION['uid'])){
				$this->assign('userdata',$this->getUserData());				
				if(!isset($userid)|$userid==''){
					$userid=$_SESSION['uid'];
				}
			}else{
				$this->redirect('Member/member', array('cate_id' => 2), 1, 'sorry, you havent logged in.');
			}
//			dump($info);
			$UserInfo=new UserInfoModel();
			$userlist=$UserInfo->searchUser($info);
			$this->assign('userlist',$userlist);
			$this->display('UserInfo:userlist');
		}

		public function userInfoDetail($userid){
			
			$uid=intval($userid);
			$Userinfo=new UserInfoModel();

			$simpleInfo=$Userinfo->getUserInfoTot($uid);

			if(count($simpleInfo)==0){
//找不到该用户时，默认显示当前用户的界面
				$uid=$_SESSION['uid'];
				$simpleInfo=$Userinfo->getUserInfoTot($uid);
			}

			//dump($simpleInfo);
			$this->assign('targetudata',$simpleInfo[0]);
			$this->assign('userquestion',$Userinfo->getUserQuestion($uid));
			$this->assign('latestaction',$Userinfo->getLatestActivity($uid));
			$this->assign('message',$Userinfo->getHistoryMessage($uid));

			$this->display('UserInfo:userinfodetail');

		}

//上传留言
		public function uploadMessage(){
			
			$data['uid']=$_SESSION['uid'];
			$data['targetuid']=$this->_param('targetuid');
			$data['content']=$_POST['content'];

			dump($data);
			$Message=new Model('message');
			$Message->create($data);
			$Message->add();
			$this->_empty($data['targetuid']);

/*
			$data['qid']=$this->_post('qid');
			$qid=$this->_post('qid');
			$data['uid']=$_SESSION['uid'];
			$data['content']=$_POST['content'];
			dump($data);
			
			$Question_model=new Model('question');
			$Question_model->where("qid=$qid")->setInc('answernum',1);
			$Answer_model=new Model('answer');
			$Answer_model->create($data);
			$Answer_model->add();
			
			$this->answersOfQuestion($data['qid']);
*/

		}

		public function editIntroduction(){
			$data['uid']=$_SESSION['uid'];
			$data['Introduction']=$_POST['content'];

			//dump($data);
			$User=new Model('user');
			$User->save($data);
			$this->_empty($data['uid']);

		}
	}