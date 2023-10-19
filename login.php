<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "views/shared/_head.php" ?>
</head>
<body>
    <?php require "views/shared/_header.php" ?>
    <div class="background-2">
        <h1>Login or Sign Up</h1>
        <div class="bg-body w-50 m-auto rounded">
            <div class="d-flex flex-row justify-content-between ">
                <button class="h1 flex-fill p-2 pt-1 pb-1 text-start toggle-login" id ="toggle-login" onclick="showLoginForm()">Login</button>
                <button class="h1 flex-fill text-end login-form-secondary p-2 pt-1 pb-1 toggle-signup" id = "toggle-signup" onclick="showSignUpForm()" >Sign Up</button>
            </div>
            <div>
              <div class="p-2" id="dynamicFormLogin"> <?php require "forms/_login.php" ?> </div>
              <div class="p-2" id="dynamicFormSignUp"> <?php require "forms/_signup.php" ?> </div>
            </div>
        </div>
    </div>
  </div>
</body>

<script> 
//This js is used to dynamicly change which form is shown to the user
var dynamicFormSignUp = document.getElementById('dynamicFormSignUp');
  dynamicFormSignUp.style.display = 'none';

function showLoginForm() {
  var dynamicFormSignUp = document.getElementById('dynamicFormSignUp');
  dynamicFormSignUp.style.display = 'none';

  var dynamicFormLogin = document.getElementById('dynamicFormLogin');
  dynamicFormLogin.style.display = 'block';

  var loginButton = document.getElementById('toggle-login')
  loginButton.style.backgroundColor = "white"

  var signupButton = document.getElementById('toggle-signup')
  signupButton.style.backgroundColor = "#D8D8D8"

}

function showSignUpForm() {
  var dynamicFormLogin = document.getElementById('dynamicFormLogin');
  dynamicFormLogin.style.display = 'none';

  var dynamicFormSignUp = document.getElementById('dynamicFormSignUp');
  dynamicFormSignUp.style.display = 'block';

  var loginButton = document.getElementById('toggle-login')
  loginButton.style.backgroundColor = "#D8D8D8"

  var signupButton = document.getElementById('toggle-signup')
  signupButton.style.backgroundColor = "white"
}
</script>
</html>
