
<?php include "db.php"; ?>
<?php include "functions.php"; ?>
<?php 
login();
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
<h1 class="text-center">Login</h1>
<form  method='post'>

<div class="form-group">
<label for='username'>Email</label>
<input type="email" class="form-control" name='email' >
</div>

<div class="form-group">
<label for='username'>Paswword</label>
<input type="password" class="form-control" name='password' >
</div>

<input type="submit" class="btn btn-primary" value='Submit' name='submit'>
</form>
</div>
</div>
</body>
</html>