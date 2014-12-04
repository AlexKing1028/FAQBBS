<?php

function sortbyhot($q1, $q2){
			if($q1['hot']==$q2['hot']){
				return 0;
			}else{
				return ($q1['hot']>$q2['hot'])?-1:1;
			}
		}

	class QuestionModel extends Model{
		public function getHotQuestion(){
			/*
			$question_array=array();
			for ($i=0; $i <2 ; $i++) { 
				# code...
				$question_summary=array(
					"qid"=>strval(100009527+$i),
					"uid"=>'0',
					"votes"=>strval(40-$i),
					"answers"=>strval(13+$i),
					"title"=>"宿舍里面谁最厉害？是同学".$i."???",

					//href需要好好定义==
					//链接中包含问题id
					"href"=>"Answers/".strval(100009527+$i),
					"types"=>array("JAVA","PHP","C"),
				);
				$question_array[$i]=$question_summary;
			}

			$qtemp=array_merge($question_array,$this->getAllQuestions());
*/
			$qtemp=$this->getAllQuestions();
			//$this->getAllQuestions();
			return $qtemp;
		}

		public function getAllQuestions(){
			$Question=new Model('question');
			$question_array=$Question->field('content',true)->select();
			$i=0;
			foreach ($question_array as $q) {
				# code...
				$ques=$q;
				$ques['votes']=$q['votenum'];
				$ques['answers']=$q['answernum'];
				$ques['types']=explode(',', $q['tags']);
				$ques['content']="";
				$ques['href']="Answers/".$q['qid'];
				$ques['hot']=intval($q['votenum'])+intval($q['answernum']);
				$result[$i]=$ques;
				$i++;
			}
			usort($result, sortbyhot);
			//dump($result);
			return $result;
		}


		public function getOneQuestion($questionid){
			$Question=new Model('question');
			$q=$Question->where("qid=$questionid")->select();
			//dump($q);
			$ques=$q[0];
			$ques['votes']=$q[0]['votenum'];
			$ques['answers']=$q[0]['answernum'];
			$ques['types']=explode(',', $q[0]['tags']);

			return $ques;
		}


//此方法用于为问题投票
		public function voteQuestion($qid, $uid, $ty){
			$Questionvote=new Model('questionvote');
			$Questionvote->where("qid=$qid and uid=$uid")->delete();
			dump($ty);
			if($ty=='true'){
//添加点赞		
				
			}else{
				$votedata['qid']=$qid;
				$votedata['uid']=$uid;
				$Questionvote->add($votedata);
			}

			$tmp=count($Questionvote->where("qid=$qid")->field('uid')->select());
			$Question=new Model('question');
			$tmp_votenum['votenum']=$tmp;
			$Question->where("qid=$qid")->save($tmp_votenum);
		}

		public function searchQuestion($info){
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
//			dump($array);
			$map['title|tags']=array('like',$array,'OR');
			$Question=new Model('question');
			$questions=$Question->where($map)->select();
			//替换
			$len=count($questions);

			for($i=0;$i<$len;$i++){
				//dump($titles[$i]);
				$questions[$i]['title']=strtr($questions[$i]['title'],$replace);
				$questions[$i]['tags']=strtr($questions[$i]['tags'],$replace);
				//dump($titles[$i]);
			}


			$i=0;
			foreach ($questions as $q) {
				# code...
				$ques=$q;
				$ques['votes']=$q['votenum'];
				$ques['answers']=$q['answernum'];
				$ques['types']=explode(',', $q['tags']);
				$ques['content']="";
				$ques['href']="Answers/".$q['qid'];
				$result[$i]=$ques;
				$i++;
			}
			
			return $result;

		}

	}

	