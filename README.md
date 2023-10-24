# Alpaca Peruleon Cafe

This is a PHP website for an mobile/online ordering of a coffee shop. 

This is a university module.

## Notice Before Reading

This is a work in progress php webstie, this may not be best practises, or clean, but this is the way i found and it does follow some best practicies pricaples.

This code may get refactored in the future, and this guid will most likly stay the same, it provides usful information in how to make your own validation.

Do not coppy my code straight from the files, use them mearly as a helpful guid to support you in your journy.

There will be spelling mistakes.

---

# Login, Sign Up and accounts

## SignUp
*This code can be found in [SignUp Form](forms/_signup.php), [Signup Validation Code](forms/validation/signup_validation.php) and [Validation Code](forms/validation/validation.php)* 


**Prerequisites**
- Have a HTML form
  

## HTML Forms actions
You will need to have an action to the form that submits to its selfe, like this:
`action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>`

`PHP_SELF` is a super variable that references the file name it's in.

To show the errors, the PHP code will be in the same file as the form.

This can be done by either having it in the same file or using required.

Once you have a html form, you can validate the user inputs.

## PHP Code
*PHP code needs to be in php tags `<?php ?>`*

Start by checking if a post-action has been done.

```php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Validation Here
  }
```

## Validation
*Your validation depends on the required forms*

To get your form input values: `$_POST["input_name"]`

#### Validating Emails
Sterilise the input
`filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)`
this will use a PHP built-in function to filter the input. This can be used by assigning to a variable or in an if statement to check if it's a valid email.

Perform a regex to ensure it is in the form of an expected email.
`preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $email)`
*when used in an if statement, if it matches it will return true*

#### Validating Passwords
Sterilise the input
`$password = htmlspecialchars($_POST["Password"])`

Perform a regex to ensure it:
- is more than 8 Characters
- At least one Captial letter
- At least one number
- At least one special character

`preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);` 

*when used in an if statement, if it matches it will return true*

#### Validating Names
Sterilise the input 
`$first_name = htmlspecialchars($_POST["Firstname"])`

Perform a regex to ensure it only contains letters
`preg_match('/^[A-Za-z]+$/', $first_name);`

#### Validating UserNames
This will depend on your username requirements, but the idea is the same

#### Example Validation

```php
  $canidate_email = filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL);

  if(preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $email)){
    $email_err = "Invalid Email, must look like example@provider.com";
  }elseif(email_exists($canidate_email)){
    $email_err = "User Already found by this email";
  }else{
    $email = $canidate_email;
  }
```

#### Displaying Errors to user

To display errors, you can just `echo $err` to the user.
Use an if statement if multiple err is used.

*There are different ways to check if all fields are validated, you could check if the required variables have been assigned values are no longer empty. Or by a giant if statement*

## Storing Data
Store the user in the database, this will depend on your table are requirements.

#### Hasing Passwords
It's important to store passwords securely, php has a built-in way to do this.

`password_hash($password, PASSWORD_DEFAULT);`

PASSWORD_DEFAULT is a php built-in way to hash passwords.

#### Storing the user details
A connection needs to be established
```php
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  $sql = "INSERT INTO users (email, first_name, last_name, password) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssss", $email, $first_name, $last_name, $hashedPassword);

  if ($stmt->execute()) {
    header('Location: /');
  }  else{
    echo "An error occurred";
  }
```

# Login
You will need a html form, with an action to the same file.

```html
  <form class="form form bg-light w-50 m-auto p-3 rounded" class="form bg-light w-50 m-auto p-3 rounded" id="SignUpForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
  <h1>Login</h1> 
  <div class="form-group">
    <label>email</label>
    <input type="email" name="Email" class="form-control" id="email">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" name="Password" class="form-control" id="password">
  </div>
  <?php require "forms/validation/login_validation.php" ?>
  <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
  <a class="m-auto" href="signup.php">Dont have an account? SignUp for one here</a>
  </from>
```

#### Check if the action is a post

```php
if($_SERVER["REQUEST_METHOD"] == "POST"){
  //code
}
  ```

  #### Sanitise
  ```php
    $email = htmlspecialchars($_POST["Email"]);
    $password = htmlspecialchars($_POST["Password"]);
  ```

 #### Validate User

  ```php
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

  ```

  This will query the database, and get the user's details.

  check if there is a user by that email:
  ```php
    if ($result->num_rows > 0) {
      //code
    }
  ```
  This code will get the password and check if it matches.
  ```php
    while($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])){
          echo "you are now loged in";
          $_SESSION['user'] = $row["id"];
        }else{
          echo "Incorrect Username or Password";
        }
      }
    } else {
      echo "Incorrect Username or Password";
    }
  ```

you can check hashed passwords by using phps built-in method
`password_verify($input_password, $hashed_password)`

And now your user can sign in. `$_SESSION['user'] = $row["id"]` is used to save the current user to a session, more on it next section.

# Creating a Session
Sessions allow for data to persist across pages.

#### Starting a session*
`session_start();`

This must be declared before any html

#### Adding to session

You can assign variables to the session.

`$_SESSION['veriable'] = $data_you_want_to_add`

#### Getting Data From Session

You can use `$_SESSION["veriable"]` just like any other variable.

`$user = $_SESSION["user"]`

#### Checking a user is sign in

```php
  if (isset($_SESSION['user'])) {
    //if a user is signed in
  } else {
    //if a user is not signed in
  }
```
