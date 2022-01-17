
<?php include_once "db.php" ;?>
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
            $query .="VALUES (:username ,:email ,:password ,:repeatPass)";
            $stmt =$this->connect()->prepare($query);
            $stmt ->execute(['username' =>$username ,'email'=>$email ,'password' =>$password ,'repeatPass'=>$repeatPass]);
            // mysqli_query($connection ,$query);
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

function login(){


    if(isset($_POST['submit'] )){

        // echo "<pre>";
        // print_r(mysqli_fetch_assoc($query));
        // "</pre>";
        global $pdo;

        $email = test_input($_POST['email']);
        $password = test_input($_POST['password']);
        $emailRegex = "/^[^ ]+@[^ ]+\.[a-z]{2,3}$/";
        if(preg_match($emailRegex,$email ) && strlen($password) >= 8){

            $query ="SELECT * FROM registredusers WHERE (email = '$email') AND (password = '$password')  ";
            $stmt = $pdo->prepare($query);
            $result = $pdo ->query($query);
            $stmt->execute();
            $secondRes=$stmt->fetchAll(PDO::FETCH_ASSOC);
                print_r($secondRes);
                    if($result ->fetchColumn()> 0 ){   
                        // header("location:register.php");
                        echo 'suc';
                    }else{
                        echo '<script type="text/javascript">alert("incorrect email or password")</script>';
                    }
        }else{
            echo '<script type="text/javascript">alert("please check your information")</script>';
        }

    }
}

//  function updateTable(){
//     if(isset($_POST['submit'])){
//     global $connection;
//     $username= $_POST['username'];
//     $password= $_POST['password'];
//    $id = $_POST['id']; 

// // $query = "UPDATE users SET[username  = '$username', password = '$password'] WHERE id = $id";
   
//    $query = "UPDATE users SET ";//make sure to put space set
//    $query .= "username = '$username', "; //first username coming from database 'colounm' 
//    $query .= "password = '$password' ";  //first password coming from database 'colounm'
//    $query .= "WHERE id = $id ";  //first id coming from database 'colounm'
   
//      $result = mysqli_query($connection , $query);
   
//      if (!$result){
//          die('query failed' . mysquli_error($connection));
//      }
//     }
//  }

//  function deleteRows(){
//     global $connection;
//     $username= $_POST['username'];
//     $password= $_POST['password'];
//    $id = $_POST['id']; 
   
//    $query = "DELETE FROM users ";//make sure to put space
//    $query .= "WHERE id = $id ";  //first id coming from database 'colounm'
   
//      $result = mysqli_query($connection , $query);
   
//      if (!$result){
//          die('query failed' . mysquli_error($connection));
//      }
   
//  }
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
