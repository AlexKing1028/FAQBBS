<?php
	class AnswersModel extends Model{
		public function getAnswersOfQuestion($questionid){
			$Answer_model=new Model('answer');
			$answers_array=$Answer_model->join('user ON user.uid=answer.uid')->where("qid=$questionid")->field('aid,answer.uid,agree,disagree,firstname,lastname,content')->select();
//伪造数据
			
			for ($i=1; $i <15 ; $i++) { 
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
				$answers_array[$i]=$answer;
			}
			return $answers_array;
		}
	}