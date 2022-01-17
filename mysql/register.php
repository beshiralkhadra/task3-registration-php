<?php include "db.php"; ?>
<?php include "functions.php"; ?>
<?php 
$testObj = new create();
$testObj->getUsers();
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
<h1 class="text-center">Create Acoount</h1>
<form  method='post' action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ;?>
>
<div class="form-group">

<label for='username'>username</label>
<input type="text" class="form-control" id="username-field" name='username'>
</div>
<div class="msg1"></div>

<div class="form-group">
<label for='username'>Email</label>
<input type="email" class="form-control" id="email-field" name='email' >
</div>
<div class="msg2"></div>

<div class="form-group">
<label for='username'>Paswword</label>
<input type="password" class="form-control" id="password-field" name='password' >
</div>
<div class="msg3"></div>

<div class="form-group">
<label for='password'>Repeat Password</label>
<input type="password" class="form-control" id="repeatPass-field" name='repeatPass' >
</div>
<div class="msg4"></div>

<input type="submit" class="btn btn-primary" id="submit-btn" value='Submit' name='submit'>
</form>
</div>
</div>

<script src="validation.js"></script>
</body>
</html>