
<?php
session_start();
include_once "db.php" ;
?>
<?php 


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  
class create extends db {
 
    public function getUsers(){
        if(isset($_POST['submit'] )){

                $username = test_input($_POST['username']);
                $email = test_input($_POST['email']);
                $password = test_input($_POST['password']);
                $repeatPass = test_input($_POST['repeatPass']) ;

                $usernamePattern =" /^[A-Za-z]{3,13}$/";
                $emailRegex = "/^[^ ]+@[^ ]+\.[a-z]{2,3}$/";
              
                if(preg_match($usernamePattern,$username) && preg_match($emailRegex,$email ) && strlen($password) >= 8 && $password == $repeatPass ){

                  $sql ="SELECT email FROM registredusers WHERE email='$email'";
                  $stmt =$this->connect()->prepare($sql);
                  $stmt = $this -> connect() ->query($sql);
                if($stmt ->fetchColumn()> 0){

                   echo '<script type="text/javascript">alert("email exist")</script>';

                }else{
      
                  $query ="INSERT INTO registredusers (username,email,password,repeatPass)";
                  $query .="VALUES (?,? ,?,?)";
                  $stmt =$this->connect()->prepare($query);
                  $stmt ->execute([$username ,$email ,$password ,$repeatPass]);
           
                   header("location:login.php");
                  

           }
          
        } else{
            echo '<script type="text/javascript">alert("please check your information")</script>';
        }
    }
}}
// function craete(){
//     if(isset($_POST['submit'] )){
//      global $pdo;
//         // global $connection;
//         $username = test_input($_POST['username']);
//         $email = test_input($_POST['email']);
//         $password = test_input($_POST['password']);
//         $repeatPass = test_input($_POST['repeatPass']) ;

//     //   $username =  mysqli_real_escape_string($connection ,$username);
//     //    $hashFormat = "$2y$10$";
//     //    $salt ="beshiralkhadrakhaled22"
//     //    $hashF_and_salt=$hashFormat . $salt;
//     //    $password = crypt($password,$hashF_and_salt);
//         $usernamePattern =" /^[A-Za-z]{3,13}$/";
//         $emailRegex = "/^[^ ]+@[^ ]+\.[a-z]{2,3}$/";
      
//         if(preg_match($usernamePattern,$username) && preg_match($emailRegex,$email ) && strlen($password) >= 8 && $password == $repeatPass ){
        
//             $query ="SELECT email FROM registredusers WHERE email='$email'";
//             $stmt =$pdo->prepare($query);
//             $result = $pdo ->query($query);
//             print_r($result);
//            if($result ->fetchColumn()> 0){
//             echo '<script type="text/javascript">alert("email exist")</script>';
//            }else{
      
//             $query ="INSERT INTO registredusers (username,email,password,repeatPass)";
//             $query .="VALUES (:username ,:email ,:password ,:repeatPass)";
//             $stmt = $pdo->prepare($query);
//             $stmt ->execute(['username' =>$username ,'email'=>$email ,'password' =>$password ,'repeatPass'=>$repeatPass]);
//             // mysqli_query($connection ,$query);
//             header("location:login.php");

//            }
        
//         }
//         else{
//             echo '<script type="text/javascript">alert("please check your information")</script>';
//         }
        
//     }

// }

class login extends db {

    public function loggedUsers(){

        if(isset($_POST['submit'] )){

            
       
    
            $email = test_input($_POST['email']);
            $password = test_input($_POST['password']);
            $emailRegex = "/^[^ ]+@[^ ]+\.[a-z]{2,3}$/";
            if(preg_match($emailRegex,$email )){
    
                $query ="SELECT * FROM registredusers WHERE (email = '$email') AND (password = '$password')  ";
                $stmt =$this->connect()->prepare($query);
                $stmt = $this -> connect() ->query($query); //we run it
               
                        if($stmt ->fetchColumn()> 0){  
                            $stmt->execute();
                            $result = $stmt->fetchAll(); //we set the default behavior in db file (fetch mode) ,also you use fetch without all
                           $isAdmin=$result[0]['is_admin'];
                           echo $isAdmin;
                           if(!$isAdmin){

                               $_SESSION['loggedUser'] = $result[0]; //if you use only fetch ,there is non need for '[0]' anymore
                               header("location:welcoming.php");
                           }else{
                            header("location:cms/table.php");
                           }
                
                
                        }else{
                            echo '<script type="text/javascript">alert("incorrect email or password")</script>';
                        }
            }else{
                echo '<script type="text/javascript">alert("please check your information")</script>';
            }
    
        }
    }

}

// function login(){


//     if(isset($_POST['submit'] )){

//         // echo "<pre>";
//         // print_r(mysqli_fetch_assoc($query));
//         // "</pre>";
//         global $pdo;

//         $email = test_input($_POST['email']);
//         $password = test_input($_POST['password']);
//         $emailRegex = "/^[^ ]+@[^ ]+\.[a-z]{2,3}$/";
//         if(preg_match($emailRegex,$email ) && strlen($password) >= 8){

//             $query ="SELECT * FROM registredusers WHERE (email = '$email') AND (password = '$password')  ";
//             $stmt = $pdo->prepare($query);
//             $result = $pdo ->query($query);
//             $stmt->execute();
//             $secondRes=$stmt->fetchAll(PDO::FETCH_ASSOC);
//                 print_r($secondRes);
//                     if($result ->fetchColumn()> 0 ){   
//                         // header("location:register.php");
//                         echo 'suc';
//                     }else{
//                         echo '<script type="text/javascript">alert("incorrect email or password")</script>';
//                     }
//         }else{
//             echo '<script type="text/javascript">alert("please check your information")</script>';
//         }

//     }
// }
class showAllData extends db{
    
    public function read(){
        
        $query ="SELECT * FROM registredusers";
        $stmt =$this->connect()->prepare($query);
        $stmt = $this -> connect() ->query($query);
        if (!$stmt){
            die ('failed'); //stop every thing
        }
        while($row = $stmt->fetch()){
            $id = $row ['id'];
          echo "<option value='$id'>$id</option> ";
        
        }
    }
}
 class updateTable extends db {


    public function updateUser(){

        if(isset($_POST['submit'])){

        $username= $_POST['username'];
        $password= $_POST['password'];
        $id = $_POST['id'];
  
    //    $query ="UPDATE registredusers SET (username = '$username') AND (password = '$password') WHERE id= $id  ";
       $query = "UPDATE registredusers SET ";//make sure to put space set
       $query .= "username = '$username', "; //first username coming from database 'colounm' 
       $query .= "password = '$password' ";  //first password coming from database 'colounm'
       $query .= "WHERE id = $id ";  //first id coming from database 'colounm'
       
       $stmt =$this->connect()->prepare($query);
       $stmt = $this -> connect() ->query($query);
       
         if (!$stmt){
            echo 'failed';
         }else{
            header("location:../mysql/cms/table.php");
         }
        }
    }
 }
 
 


class delete extends db {

    public function deleteUser( ){
   
       
           if(isset($_POST['delete-user'])){

               $id = $_POST['delete-user'];
               $query = "DELETE FROM registredusers WHERE id='$id'";//make sure to put space
               $stmt =$this->connect()->prepare($query);
               $stmt = $this -> connect() ->query($query); 
               
                 if ($stmt){
                   echo 'deklkl';
                    // echo '<script type="text/javascript">alert("user deleted")</script>';
                 }
           }
                
        

   
 }}
// function craete(){
//     if(isset($_POST['submit'] )){

//         global $connection;
//         $username = test_input($_POST['username']);
//         $email = test_input($_POST['email']);
//         $password = test_input($_POST['password']);
//         $repeatPass = test_input($_POST['repeatPass']) ;

//       $username =  mysqli_real_escape_string($connection ,$username);
//        $hashFormat = "$2y$10$";
//        $salt ="beshiralkhadrakhaled22"
//        $hashF_and_salt=$hashFormat . $salt;
//        $password = crypt($password,$hashF_and_salt);
//         $usernamePattern =" /^[A-Za-z]{3,13}$/";
//         $emailRegex = "/^[^ ]+@[^ ]+\.[a-z]{2,3}$/";
      
//         if(preg_match($usernamePattern,$username) && preg_match($emailRegex,$email ) && strlen($password) >= 8 && $password == $repeatPass ){
        
//             $query ="SELECT email FROM registredusers WHERE email='$email'";
//             $result = mysqli_query($connection ,$query);
//            if(mysqli_num_rows($result)){
//             echo '<script type="text/javascript">alert("email exist")</script>';
//            }else{
      
//             $query ="INSERT INTO registredusers (username,email,password,repeatPass)";
//             $query .="VALUES ('$username' ,'$email' ,'$password' ,'$repeatPass')";
//             mysqli_query($connection ,$query);
//             header("location:login.php");

//            }
        
//         }
//         else{
//             echo '<script type="text/javascript">alert("please check your information")</script>';
//         }
        
//     }

// }

?>
