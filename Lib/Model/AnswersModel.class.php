<?php
	class AnswersModel extends Model{
		//返回数组将包含采纳答案和其他答案两项，分开存储
		public function getAnswersOfQuestion($questionid){
			$Question_model=new Model('question');
			$aids=$Question_model->where("qid=$questionid")->field('aid')->select();
			
			$aid=$aids[0]['aid'];
			//dump($aids);
			$Answer_model=new Model('answer');
			$result['acanswer']=null;
//若未设置答案

			if(isset($aid) && intval($aid)>=0){
//			if(false){
				$acanswers=$Answer_model->join('user ON user.uid=answer.uid')->where("aid=$aid")->field('aid,answer.uid,agree,disagree,firstname,lastname,content')->select();
				//dump($acanswers);
				$result['acanswer']=$acanswers[0];
				$answers_array=$Answer_model->join('user ON user.uid=answer.uid')->where("qid=$questionid and aid<>$aid")->field('aid,answer.uid,agree,disagree,firstname,lastname,content')->select();
				$result['otheranswers']=$answers_array;
			}else{
				$answers_array=$Answer_model->join('user ON user.uid=answer.uid')->where("qid=$questionid")->field('aid,answer.uid,agree,disagree,firstname,lastname,content')->select();
				//dump($answers_array);
				$result['otheranswers']=$answers_array;				
			}
//伪造数据
			/*	
			for ($i=1; $i <4 ; $i++) { 
				# code...
				$answer=array(
					"aid"=>strval(95270000+$i),
					"agree"=>strval(400-$i),
					"disagree"=>strval(13+$i),
					"content"=>"<p>有奶吃的就是娘，懂么？现在对他来说没什么作用了，就想踢开了。</p>",
					//href需要好好定义==
					//链接中包含问题id
					"firstname"=>"同学".('A'+$i),
					"lastname"=>"shit",
					"uid"=>strval(10086+$i),
				);
				$result['otheranswers'][$i]=$answer;
			}
			*/
			return $result;
		}
	}