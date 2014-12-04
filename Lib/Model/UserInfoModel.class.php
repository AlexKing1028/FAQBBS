<?php
	class UserInfoModel extends Model{
		public function getUserInfoTot($uid){
			$User=new Model('user');
			$result=$User->where("uid=$uid")->field('password',true)->select();
			//dump($result);
			return $result;
		}

		public function getUserQuestion($uid){
			$Question=new Model('question');
			$data=$Question->where("uid=$uid")->field('title,qid,tags')->select();
			$i=0;
			foreach ($data as $vo) {
				# code...
				$temp=$vo;
				$temp['href']='Answers/'.$vo['qid'];
				$temp['types']=explode(',', $vo['tags']);
				//dump($temp);
				$result[$i]=$temp;
				$i++;
			}
			//dump($result);
			return $result;
		}

		public function getLatestActivity($uid){
			$Agreeans=new Model('agreeans');
			$isagree_result=$Agreeans->join('question on question.qid=agreeans.qid')
			->join('answer on answer.aid=agreeans.aid')
			->where("agreeans.uid=$uid")
			->field('agreeans.qid,agreeans.uid,agreeans.aid,question.title,agreeans.isagree,answer.content')
			->select();
			$i=0;
			foreach ($isagree_result as $vo) {
				# code...
				$temp['qid']=$vo['qid'];
				$temp['qhref']='Answers/'.$vo['qid'];
				$temp['qtitle']=$vo['title'];
				$temp['acontent']=$vo['content'];

				if($vo['isagree']=="0"){
					$temp['action']="他反对了回答";
				}else{
					$temp['action']="他同意了回答";
				}
				$result[$i]=$temp;
				$i++;
			}

			$Answer=new Model('answer');
			$answer_result=$Answer->join('question on answer.qid=question.qid')
			->where("answer.uid=$uid")->field('answer.aid,answer.qid,answer.content,question.title')
			->select();
			//dump($answer_result);
			foreach ($answer_result as $vo) {
				# code...
				$temp['qid']=$vo['qid'];
				$temp['qhref']='Answer/'.$vo['qid'];
				$temp['qtitle']=$vo['title'];
				$temp['acontent']=$vo['content'];
				$temp['action']="他回答道";
				$result[$i]=$temp;
				$i++;
			}
			//dump($result);
			return $result;
		}

		public function getHistoryMessage($uid){
			/*
			$data[0]=array(
				'uid'=>"2",
				'firstname'=>"rock",
				'lastname'=>'red',
				'targetuid'=>"0" ,
				'timestamp'=>'2014.12.2',
				'content'=>'hahahahahahahaha，我就是来踩一脚而已~~',
				);
*/
			$Message=new Model('message');
			$data=$Message->join('user on user.uid=message.uid')
			->where("message.targetuid=$uid")
			->select();
//			dump($data);
			$i=0;
			foreach ($data as $vo) {
				# code...
				$temp['uid']=$vo['uid'];
				$temp['firstname']=$vo['firstname'];
				$temp['lastname']=$vo['lastname'];
				$temp['href']='UserInfo/'.$vo['uid'];
				$temp['timestamp']=$vo['timestamp'];
				$temp['content']=$vo['content'];
				$result[$i]=$temp;
				$i++;
			}
			//dump($result);

			return $result;
		}

		public function searchUser($info){
			//查询所有匹配项
			//dump($info);
			$infolist=explode(" ", $info);
			$i=0;
			//dump($infolist);
			$pre_tag="<span class='text-danger'>";
			$post_tag="</span>";			
			foreach ($infolist as $vo) {
				# code...
				//对每一个关键字进行查询
				$array[$i]='%'.$vo.'%';
				$replace[$vo]=$pre_tag.$vo.$post_tag;	
				$i++;
			}
			//dump($array);
			//dump($replace);

			$map['firstname|lastname']=array('like',$array,'OR');
			$User=new Model('user');
			$users=$User->where($map)->field('password',true)->select();
			//dump($users);
			//替换
			$len=count($users);

			for($i=0;$i<$len;$i++){
				$users[$i]['firstname']=strtr($users[$i]['firstname'],$replace);
				$users[$i]['lastname']=strtr($users[$i]['lastname'],$replace);
			}
			//dump($users);
			$i=0;
			foreach ($users as $vo) {
				# code...
				$temp['uid']=$vo['uid'];
				$temp['firstname']=$vo['firstname'];
				$temp['lastname']=$vo['lastname'];
				$temp['href']='UserInfo/'.$vo['uid'];
				$temp['score']=$vo['score'];
				$temp['email']=$vo['email'];
				$result[$i]=$temp;
				$i++;
			}
			//dump($result);
			return $result;

		}

		
	}