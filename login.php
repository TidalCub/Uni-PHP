<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "views/shared/_head.php" ?>
    
</head>
<body>
    <?php require "views/shared/_header.php" ?>
    <div class="background-2">
        <h1>Login or Sign Up</h1>
        <div class="bg-body w-50 m-auto ">
            <div class="d-flex flex-row justify-content-between ">
                <button class="h1 flex-fill p-2 pt-1 pb-1 text-start" onclick="showLoginForm()">Login</button>
                <button class="h1 flex-fill text-end login-form-secondary p-2 pt-1 pb-1" onclick="showSignUpForm()" >Sign Up</button>
            </div>
            <div class="p-2" id="dynamicFormLogin"> <?php require "forms/_log_signupin.php" ?> </div>
            <div class="p-2" id="dynamicFormSignUp"> <?php require "forms/_signup.php" ?> </div>
        </div>
    </div>
  </div>
</body>
<script> 
var dynamicFormSignUp = document.getElementById('dynamicFormSignUp');
  dynamicFormSignUp.style.display = 'none';

function showLoginForm() {
  var dynamicFormSignUp = document.getElementById('dynamicFormSignUp');
  dynamicFormSignUp.style.display = 'none';

  var dynamicFormLogin = document.getElementById('dynamicFormLogin');
  dynamicFormLogin.style.display = 'block';
}

function showSignUpForm() {
  var dynamicFormLogin = document.getElementById('dynamicFormLogin');
  dynamicFormLogin.style.display = 'none';

  var dynamicFormSignUp = document.getElementById('dynamicFormSignUp');
  dynamicFormSignUp.style.display = 'block';
}
</script>
</html>
