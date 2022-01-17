<?php 
//where you want to connect (login app)
$connection = mysqli_connect('localhost','root','','loginapp');
if ($connection){
    echo 'beshir';
    echo '<br>';
}else{
    echo 'no';
}
// sending alll data to sql
$query ="SELECT * FROM users";//users it is out table name in sql

  $result = mysqli_query($connection ,$query);


if (!$result){
    die ('failed'); //stop every thing


}else{
    echo 'welcome home Beshir';
}
    // if ($username && $password){
    //     echo $username;
    //     echo '<br>';
    //     echo $password;
    // }else{
    //     echo 'noo';
    // }

    // echo $username;
    // echo '<br>';
    // echo $password;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    
<div class="container">
<div class="col-sm-6">

    <pre>
        <?php 
        while($row = mysqli_fetch_assoc($result)){
    print_r ($row);
}
    ?>
        
   </pre>
</div>



</div>


</body>
</html>