<?php

require 'config.php';
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->post('/parentLogin','parentlogin'); /* Parent login */
$app->post('/parentSignup','parentsignup'); /* Parent Signup  */
$app->post('/teacherLogin','teacherlogin'); /* Teacher Login  */
$app->post('/teacherRegister','teacherregister'); /* Teacher Signup  */
$app->post('/teacherManage','teacherrmanage');
$app->post('/studentLogin','studentlogin');
$app->post('/submitQuiz','submitquiz'); 
$app->post('/showQuizDetails','showquizdetails');
$app->post('/submitQuizAnswer','submitquizanswer');
$app->post('/AllStudentDetails','allstudentdetails');
$app->post('/studentQuizGraph','studentquizgraph');
$app->post('/submitVideo','submitvideo');
$app->post('/fetchVideo','fetchvideo');

$app->run();

/************************* Parent LOGIN *************************************/
/* ### Parent login ### */
function parentlogin() {
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    
    try {
        
        $db = getDB();
        $parentData ='';
        $sql = "SELECT parentFName, parentSName, parentEmail, studentID, studentSName, parentPassword FROM Parent WHERE (parentEmail=:parentEmail) and parentPassword=:parentPassword ";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("parentEmail", $data->parentEmail, PDO::PARAM_STR);
        $parentPassword=hash('sha256',$data->parentPassword);
        $stmt->bindParam("parentPassword", $parentPassword, PDO::PARAM_STR);
        $stmt->execute();
        $mainCount=$stmt->rowCount();
        $parentData = $stmt->fetch(PDO::FETCH_OBJ);
        
        if(!empty($parentData))
        {
            $parent_id=$parentData->parent_id;
            $parentData->token = apiToken($parent_id);
        }
        
        $db = null;
         if($parentData){
               $parentData = json_encode($parentData);
                echo '{"parentData": ' .$parentData . '}';
            } else {
               echo '{"error":{"text":"Bad request wrong username and passworserDatad"}}';
            }

           
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


/* ### Parent registration ### */
function parentsignup() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $parentFName = $data->parentFName;
    $parentSName = $data->parentSName;
    $parentEmail = $data->parentEmail;
    $studentID = $data->studentID;
    $studentSName = $data->studentSName;
    $parentPassword = $data->parentPassword;
    
    try {

        $parentEmail_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $parentEmail);
        
        
        if (strlen(trim($parentEmail))>0 && $parentEmail_check>0)
        {
            $db = getDB();
            $parentData = '';
            $sql = "SELECT parent_id FROM Parent WHERE parentEmail=:parentEmail";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("parentEmail", $parentEmail,PDO::PARAM_STR);
            $stmt->execute();
            $mainCount=$stmt->rowCount();
            $created=time();
            if($mainCount==0)
            {
                /*Inserting user values*/
                $sql1="INSERT INTO Parent(parentFName, parentSName, parentEmail, studentID, studentSName, parentPassword) VALUES (:parentFName, :parentSName, :parentEmail, :studentID, :studentSName, :parentPassword)";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("parentFName", $parentFName,PDO::PARAM_STR);
                $stmt1->bindParam("parentSName", $parentSName,PDO::PARAM_STR);
                $stmt1->bindParam("parentEmail", $parentEmail,PDO::PARAM_STR);
                $stmt1->bindParam("studentID", $studentID,PDO::PARAM_STR);
                $stmt1->bindParam("studentSName", $studentSName,PDO::PARAM_STR);
                $parentPassword=hash('sha256',$data->parentPassword);
                $stmt1->bindParam("parentPassword", $parentPassword,PDO::PARAM_STR);
                $stmt1->execute();
                
                $parentData = internalParentDetails($parentEmail);
                
            }
            
            $db = null;
         

            if($parentData){
               $parentData = json_encode($parentData);
                echo '{"parentData": ' .$parentData . '}';
            } else {
               echo '{"error":{"text":"Enter valid data"}}';
            }

           
        }
        else {
            echo '{"error":{"text":"enter valid data"}}';
        }
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* ### internal Parent Details ### */
function internalParentDetails($input) {
    
    try {
        $db = getDB();
        $sql = "SELECT parent_id, parentFName, parentSName, parentEmail FROM Parent WHERE parentEmail=:input";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("input", $input,PDO::PARAM_STR);
        $stmt->execute();
        $parentDetails = $stmt->fetch(PDO::FETCH_OBJ);
        $parentDetails->token = apiToken($parentDetails->parent_id);
        $db = null;
        return $parentDetails;
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    } 
}

/*#######################################################################################################################*/
/*#######################################################################################################################*/
/************************* Teacher *************************************/
/* ### Teacher login ### */
function teacherlogin() {
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    
    try {
        
        $db = getDB();
        $teacherData = '';
        $sql = "SELECT teacherFName, teacherSName, email, school, teacherPassword FROM Teacher WHERE (email=:email) and teacherPassword=:teacherPassword ";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("email", $data->email, PDO::PARAM_STR);
        $teacherPassword=hash('sha256',$data->teacherPassword);
        $stmt->bindParam("teacherPassword", $teacherPassword, PDO::PARAM_STR);
        $stmt->execute();
        $mainCount=$stmt->rowCount();
        $teacherData = $stmt->fetch(PDO::FETCH_OBJ);
        
        if(!empty($teacherData))
        {
            $teacherID=$teacherData->teacherID;
            $teacherData->token = apiToken($teacherID);
        }
        
        $db = null;
         if($teacherData){
               $teacherData = json_encode($teacherData);
                echo '{"teacherData": ' .$teacherData . '}';
            } else {
               echo '{"error":{"text":"Bad request wrong username and passworserDatad"}}';
            }

           
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* ### Teacher registration ### */
function teacherregister() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());

    $teacherFName = $data->teacherFName;
    $teacherSName = $data->teacherSName;
    $email = $data->email;
    $school = $data->school;
    $teacherPassword = $data->teacherPassword;
    
    try {

        $email_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $email);
        
        
        if (strlen(trim($email))>0 && $email_check>0)
        {
            $db = getDB();
            $teacherData = '';
            $sql = "SELECT teacherID FROM Teacher WHERE email=:email";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("email", $email,PDO::PARAM_STR);
            $stmt->execute();
            $mainCount=$stmt->rowCount();
            $created=time();
            if($mainCount==0)
            {
                /*Inserting user values*/
                $sql1="INSERT INTO Teacher(teacherFName, teacherSName, email, school, teacherPassword) VALUES (:teacherFName, :teacherSName, :email, :school, :teacherPassword)";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("teacherFName", $teacherFName,PDO::PARAM_STR);
                $stmt1->bindParam("teacherSName", $teacherSName,PDO::PARAM_STR);
                $stmt1->bindParam("email", $email,PDO::PARAM_STR);
                $stmt1->bindParam("school", $school,PDO::PARAM_STR);
                $teacherPassword=hash('sha256',$data->teacherPassword);
                $stmt1->bindParam("teacherPassword", $teacherPassword,PDO::PARAM_STR);
                $stmt1->execute();
                
                $teacherData = internalTeacherDetails($email);
                
            }
            
            $db = null;
         

            if($teacherData){
               $teacherData = json_encode($teacherData);
                echo '{"teacherData": ' .$teacherData . '}';
            } else {
               echo '{"error":{"text":"Enter valid data"}}';
            }

           
        }
        else {
            echo '{"error":{"text":"enter valid data"}}';
        }
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* ### internal Parent Details ### */
function internalTeacherDetails($input) {
    
    try {
        $db = getDB();
        $sql = "SELECT teacherID, teacherFName, teacherSName, email FROM Teacher WHERE email=:input";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("input", $input,PDO::PARAM_STR);
        $stmt->execute();
        $teacherDetails = $stmt->fetch(PDO::FETCH_OBJ);
        $teacherDetails->token = apiToken($teacherDetails->teacherID);
        $db = null;
        return $teacherDetails;
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    } 
}


/* ### Teacher Manage - registering a student ### */
function teacherrmanage() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());

    $username = $data->username;
    $studentFName = $data->studentFName;
    $studentSName = $data->studentSName;
    $studentPassword = $data->studentPassword;
    $teacherEmail = $data->teacherEmail;
    
    try {

        $username_check = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $username);
        
        
        if (strlen(trim($username))>0 && $username_check>0)
        {
            $db = getDB();
            $studentData = '';
            $sql = "SELECT studentID FROM Student WHERE username=:username";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("username", $username,PDO::PARAM_STR);
            $stmt->execute();
            $mainCount=$stmt->rowCount();
            $created=time();
            if($mainCount==0)
            {
                /*Inserting user values*/
                $sql1="INSERT INTO Student(username, studentFName, studentSName, studentPassword, teacherEmail) VALUES (:username, :studentFName, :studentSName, :studentPassword, :teacherEmail)";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("username", $username,PDO::PARAM_STR);
                $stmt1->bindParam("studentFName", $studentFName,PDO::PARAM_STR);
                $stmt1->bindParam("studentSName", $studentSName,PDO::PARAM_STR);
                $studentPassword=hash('sha256',$data->studentPassword);
                $stmt1->bindParam("studentPassword", $studentPassword,PDO::PARAM_STR);
                $stmt1->bindParam("teacherEmail", $teacherEmail,PDO::PARAM_STR);
                $stmt1->execute();
                
                $studentData = internalStudentDetails($username);
                
            }
            
            $db = null;
         

            if($studentData){
               $studentData = json_encode($studentData);
                echo '{"studentData": ' .$studentData . '}';
            } else {
               echo '{"error":{"text":"Enter valid data"}}';
            }

           
        }
        else {
            echo '{"error":{"text":"enter valid data"}}';
        }
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* ### internal Parent Details ### */
function internalStudentDetails($input) {
    
    try {
        $db = getDB();
        $sql = "SELECT studentID, studentFName, studentSName FROM Student WHERE username=:input";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("input", $input,PDO::PARAM_STR);
        $stmt->execute();
        $studentDetails = $stmt->fetch(PDO::FETCH_OBJ);
        $studentDetails->token = apiToken($studentDetails->studentID);
        $db = null;
        return $studentDetails;
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    } 
}

function studentlogin() {
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    
    try {
        
        $db = getDB();
        $studentData = '';
        $sql = "SELECT username, studentFName, studentSName, studentPassword FROM Student WHERE (username=:username) and studentPassword=:studentPassword ";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("username", $data->username, PDO::PARAM_STR);
        $studentPassword=hash('sha256',$data->studentPassword);
        $stmt->bindParam("studentPassword", $studentPassword, PDO::PARAM_STR);
        $stmt->execute();
        $mainCount=$stmt->rowCount();
        $studentData = $stmt->fetch(PDO::FETCH_OBJ);
        
        if(!empty($studentData))
        {
            $studentID=$studentData->studentID;
            $studentData->token = apiToken($studentID);
        }
        
        $db = null;
         if($studentData){
               $studentData = json_encode($studentData);
                echo '{"studentData": ' .$studentData . '}';
            } else {
               echo '{"error":{"text":"Bad request wrong username and passworserDatad"}}';
            }

           
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/*###############################################################################
################### QUIZ SUBMISSION #########################################
##################################################################################
*/
/* ### Quiz submission ### */
function submitquiz() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $teacher_email = $data->teacher_email;
    $quizDateTime = $data->quizDateTime;
    $ques1 = $data->ques1;
    $ques2 = $data->ques2;
    $ques3 = $data->ques3;
	$ques4 = $data->ques4;
	$ques5 = $data->ques5;
	$ans1 = $data->ans1;
    $ans2 = $data->ans2;
	$ans3 = $data->ans3;
	$ans4 = $data->ans4;
	$ans5 = $data->ans5;
	
    try {

            $db = getDB();
            $q = '';
            $sql = "SELECT quiz_id FROM Quiz WHERE quizDateTime=:quizDateTime";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("quizDateTime", $quizDateTime,PDO::PARAM_STR);
            $stmt->execute();
            $mainCount=$stmt->rowCount();
            $created=time();
            if($mainCount==0)
            {
                /*Inserting quiz values*/
                $sql1="INSERT INTO Quiz(teacher_email, quizDateTime, ques1, ques2, ques3, ques4, ques5, ans1, ans2, ans3, ans4, ans5) VALUES (:teacher_email, :quizDateTime, :ques1, :ques2, :ques3, :ques4, :ques5, :ans1, :ans2, :ans3, :ans4, :ans5)";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("teacher_email", $teacher_email,PDO::PARAM_STR);
                $stmt1->bindParam("quizDateTime", $quizDateTime,PDO::PARAM_STR);
                $stmt1->bindParam("ques1", $ques1,PDO::PARAM_STR);
				$stmt1->bindParam("ques2", $ques2,PDO::PARAM_STR);
				$stmt1->bindParam("ques3", $ques3,PDO::PARAM_STR);
				$stmt1->bindParam("ques4", $ques4,PDO::PARAM_STR);
				$stmt1->bindParam("ques5", $ques5,PDO::PARAM_STR);
				$stmt1->bindParam("ans1", $ans1,PDO::PARAM_STR);
				$stmt1->bindParam("ans2", $ans2,PDO::PARAM_STR);
				$stmt1->bindParam("ans3", $ans3,PDO::PARAM_STR);
				$stmt1->bindParam("ans4", $ans4,PDO::PARAM_STR);
				$stmt1->bindParam("ans5", $ans5,PDO::PARAM_STR);
                $stmt1->execute();
                
            }
            
            $db = null;
			
         echo '{"success":{"text":"Quiz has been added"}}';
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* ### Show Quiz Details ### */
function showquizdetails() {
     $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    
    try {
		$db = getDB();
        $quizData = '';
        $sql = "SELECT quiz_id, teacher_email, quizDateTime, ques1, ques2, ques3, ques4, ques5, ans1, ans2, ans3, ans4, ans5 FROM Quiz WHERE quizDateTime=:quizDateTime";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("quizDateTime", $data->quizDateTime, PDO::PARAM_STR);
        $stmt->execute();
        $mainCount=$stmt->rowCount();
        $quizData = $stmt->fetch(PDO::FETCH_OBJ);
        
        if(!empty($quizData))
        {
            $quiz_id=$quizData->quiz_id;
            $quizData->token = apiToken($quiz_id);
        }
        
        $db = null;
         if($quizData){
               $quizData = json_encode($quizData);
                echo $quizData;
            } else {
               echo '{"error":{"text":"Bad request"}}';
            }

        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    } 
}

/*###############################################################################
################### QUIZ SUBMISSION BY STUDENT #########################################
##################################################################################
*/
/* ### Quiz submission ### */
function submitquizanswer() {
	$request = \Slim\Slim::getInstance()->request();
	$data = json_decode($request->getBody());
	$student_username = $data->student_username;
	$quiz_id = $data->quiz_id;
	$ques1 = $data->ques1;
	$ques2 = $data->ques2;
	$ques3 = $data->ques3;
	$ques4 = $data->ques4;
	$ques5 = $data->ques5;
	$ans1 = $data->ans1;
	$ans2 = $data->ans2;
	$ans3 = $data->ans3;
	$ans4 = $data->ans4;
	$ans5 = $data->ans5;
	$obtainedMarks = $data->obtainedMarks;
	$totalMarks = $data->totalMarks;
	try {

		$db = getDB();
		$q = '';
		$sql = "SELECT quiz_id FROM QuizScore WHERE student_username=:student_username and quiz_id = (select quiz_id from Quiz where quizDateTime = CURDATE())";
		$stmt = $db->prepare($sql);
		$stmt->bindParam("student_username", $student_username,PDO::PARAM_STR);
		$stmt->execute();
		$mainCount=$stmt->rowCount();
		$created=time();
		if($mainCount==0)
		{
			/*Inserting quiz score*/
			$sql1="INSERT INTO QuizScore(student_username, quiz_id, ques1, ques2, ques3, ques4, ques5, ans1, ans2, ans3, ans4, ans5, obtainedMarks, totalMarks) VALUES (:student_username, :quiz_id, :ques1, :ques2, :ques3, :ques4, :ques5, :ans1, :ans2, :ans3, :ans4, :ans5, :obtainedMarks, :totalMarks)";
			$stmt1 = $db->prepare($sql1);
			$stmt1->bindParam("student_username", $student_username,PDO::PARAM_STR);
			$stmt1->bindParam("quiz_id", $quiz_id,PDO::PARAM_INT);
			$stmt1->bindParam("ques1", $ques1,PDO::PARAM_STR);
			$stmt1->bindParam("ques2", $ques2,PDO::PARAM_STR);
			$stmt1->bindParam("ques3", $ques3,PDO::PARAM_STR);
			$stmt1->bindParam("ques4", $ques4,PDO::PARAM_STR);
			$stmt1->bindParam("ques5", $ques5,PDO::PARAM_STR);
			$stmt1->bindParam("ans1", $ans1,PDO::PARAM_STR);
			$stmt1->bindParam("ans2", $ans2,PDO::PARAM_STR);
			$stmt1->bindParam("ans3", $ans3,PDO::PARAM_STR);
			$stmt1->bindParam("ans4", $ans4,PDO::PARAM_STR);
			$stmt1->bindParam("ans5", $ans5,PDO::PARAM_STR);
			$stmt1->bindParam("obtainedMarks", $obtainedMarks,PDO::PARAM_INT);
			$stmt1->bindParam("totalMarks", $totalMarks,PDO::PARAM_INT);
			$stmt1->execute();
			$sql2="UPDATE Student set correctAnswers = correctAnswers + :correctAnswers, totalAnswered = totalAnswered + :totalAnswered where username = :student_username";
			$stmt2 = $db->prepare($sql2);
			$stmt2->bindParam("correctAnswers", $obtainedMarks,PDO::PARAM_INT);
			$stmt2->bindParam("totalAnswered", $totalMarks,PDO::PARAM_INT);
			$stmt2->bindParam("student_username", $student_username,PDO::PARAM_STR);
			$stmt2->execute();
			echo '{"success":{"text":"Anwers have been submitted by student"}}';
			}
			else{
			echo '{"success":{"text":"Anwers have already been submitted by this student"}}';
			}
			$db = null;

		}
		catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
}

/* ### All students' Details ### */
function allstudentdetails() {
    try {
        $db = getDB();
        $sql = "SELECT studentID, username FROM Student";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $students = array();
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $students[] = $data;
            
        }
        $db = null;
        $students = json_encode($students);
        echo '{"studentList": ' .$students . '}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    } 
}


/* get student quiz record */
function studentquizgraph() {
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    
    try {
        
        $db = getDB();
        $studentData = '';
        $sql = "SELECT s.score_id, st.username, s.obtainedMarks, s.totalMarks, s.ques1, s.ques2, s.ques3, s.ques4, s.ques5, s.ans1, s.ans2, s.ans3, s.ans4, s.ans5, q.quizDateTime FROM QuizScore s, Quiz q, Student st WHERE q.quiz_id = s.quiz_id and st.username = s.student_username and st.studentID=:studentID ORDER BY s.quiz_id desc LIMIT 6";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("studentID", $data->studentID, PDO::PARAM_INT);
        $stmt->execute();
        $quizes = array();
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $quizes[] = $data;
            
        }
        $db = null;
        $quizes = json_encode($quizes);
        echo '{"quizList": ' .$quizes . '}';
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
function submitvideo() {
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    
    try {
        
        $db = getDB();
        $sql = "INSERT INTO Video (heading, link, teacherEmail) VALUES (:heading, :link, :teacherEmail)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("heading", $data->heading,PDO::PARAM_STR);
        $stmt->bindParam("link", $data->link,PDO::PARAM_STR);
        $stmt->bindParam("teacherEmail", $data->teacherEmail,PDO::PARAM_STR);
        $stmt->execute();
        echo '{"success":{"text":"Video link has been successfully added!"}}';
            
        $db = null;
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function fetchvideo(){
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    
   try{
       $db = getDB();
       $vidoes[] = null;
       if(isset($data->email)){
           $sql = "SELECT heading,link FROM Video WHERE teacherEmail = :teacherEmail ORDER BY video_id DESC";
           $stmt = $db->prepare($sql);
           $stmt->bindParam("teacherEmail", $data->email, PDO::PARAM_STR);
           $stmt->execute();
           while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
             $videos[] = $data;
           }
           $db = null;
           $videos = json_encode($videos);
           echo '{"videoList": ' .$videos . '}';
       }
       elseif(isset($data->parentEmail)){
           $sql = "SELECT heading,link FROM Video WHERE teacherEmail = (SELECT teacherEmail from Student WHERE studentID = (SELECT studentID FROM Parent where parentEmail = :parentEmail)) ORDER BY video_id DESC";
           $stmt = $db->prepare($sql);
           $stmt->bindParam("parentEmail", $data->parentEmail, PDO::PARAM_STR);
           $stmt->execute();
           while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
             $videos[] = $data;
           }
           $db = null;
           $videos = json_encode($videos);
           echo '{"videoList": ' .$videos . '}';
       }
       elseif (isset($data->username)) {
           $sql = "SELECT heading, link FROM Video WHERE teacherEmail = (SELECT teacherEmail from Student WHERE username = :username) ORDER BY video_id DESC";
           $stmt = $db->prepare($sql);
           $stmt->bindParam("username", $data->username, PDO::PARAM_STR);
           $stmt->execute();
           while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
             $videos[] = $data;
           }
           $db = null;
           $videos = json_encode($videos);
           echo '{"videoList": ' .$videos . '}';
       }
   }
   catch(PDOException $e) {
       echo '{"error":{"text":'. $e->getMessage() .'}}';
   }
}

?>

