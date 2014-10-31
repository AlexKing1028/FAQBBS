<?php
	class QuestionModel extends Model{
		public function getHotQuestion(){
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

			//$this->getAllQuestions();
			return $qtemp;
		}

		public function getAllQuestions(){
			$Question=new Model('question');
			$question_array=$Question->select();
			$i=0;
			foreach ($question_array as $q) {
				# code...
				$ques=$q;
				$ques['votes']=$q['votenum'];
				$ques['answers']=$q['answernum'];
				$ques['types']=explode(',', $q['tags']);
				$ques['content']="";
				$result[$i]=$ques;
				$i++;
			}
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
		public function voteQuestion(){

		}
	}