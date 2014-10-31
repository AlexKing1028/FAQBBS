<?php
	class UserInfoAction extends SignupBaseAction{
		public functon _empty($userid){
			if(!is_null($_SESSION['uid'])){
				$this->assign('userdata',$this->getUserData());				
				if(!isset($userid)|$userid==''){
					$userid=$_SESSION['uid'];
				}
				$this->userInfo($userid);
			}else{
				$this->redirect('Member/member', array('cate_id' => 2), 1, 'sorry, you havent logged in.');
			}
		}

		public function userInfoList($userInfo){

		}

		public function userInfoDetail($userid){

		}
	}