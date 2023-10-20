# Alpaca Peruleon Cafe

This is a PHP website for an mobile / online ordering of a coffee shop. 

This is a university moduel.


# Login, Sign Up and accounts

## SignUp
*This code can be found in forms/validation/_signup.php forms/validation/validation.php*

Have a HTML form that has an action to the same file

`action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>`

`PHP_SELF` is a super veriable that refrances to the file name its in.

To show the errors, the php code will be in the same file as the form.

This can be done by either having it in the same file or using requiers.

Once you have a html form, you can validate the user inputs.

## PHP Code

Start by checking if a post action has been done.

```php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Validation Here
  }
```

## Validation
*Your validation depends on the requiered forms*

To get your from input values: `$_POST["input_name"]`
**Validating Emails**
Steralise the input
`filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)`
this will use a PHP built in function to filter the input. This can be used by asssigning to a veriable or in an if statment to check if its a valid email.

Perform a regex to insure it is in the form of an expected email.
`preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $email)`
*when used in an if statment, if it matches it will return true*

**Validating Passwords**
Steralise the input
`$password = htmlspecialchars($_POST["Password"])`

Perform a regex to ensure it:
- is more than 8 Characters
- At least one Captial letter
- At least one number
- At least one special character

`preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);` 

*when used in an if statment, if it matches it will return true*

**Validating Names**
Steralise the input 
`$first_name = htmlspecialchars($_POST["Firstname"])`

Perform a regex to ensure it only contains letters
`preg_match('/^[A-Za-z]+$/', $first_name);`

**Validating UserNames**
This will depend on your username requierments, but the ideaa is the same

**Example Validation**

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

**Displaying Errors to user**

To display errors, you can just `echo $err` to the user.
Use an if statment if multiple err used.

*There are diffrent ways to check if all fields are validated, you could check if the requiered verables have been assigned values are no longer empty. Or by a giat if statment*

## Storing Data
Store the user in the databse, this will depend on your table are requierments.

**Hasing Passwords**
Its important to store passwords securly, php has a built in way to do this.

`password_hash($password, PASSWORD_DEFAULT);`

PASSWORD_DEFAULT is a php built in way to hash passwords.

**Storing the user details**
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

#Login
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

**Check if the action is a post**

```php
if($_SERVER["REQUEST_METHOD"] == "POST"){
  //code
}
  ```

  **Sanatise**
  ```php
    $email = htmlspecialchars($_POST["Email"]);
    $password = htmlspecialchars($_POST["Password"]);
  ```

  **Valdiate User**

  ```php
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

  ```

  This will query the databse, and get the users details.

  check if there is an user by that email:
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

you can check hashed passwords by using phps built in methid
`password_verify($input_password, $hashed_password)`

And now your user can sign in. `$_SESSION['user'] = $row["id"]` is used to save the current user to a session, more on it next section.

# Creating a Session
Sessions allow for data to persit across pages.

**Starting a session**
`session_start();`

This must be declared before any html

**Adding to session**

You can assign veriables to the session.

`$_SESSION['veriable'] = $data_you_want_to_add`

**Getting Data**

You can use `$_SESSION["veriable"]` just like any other veriable.

`$user = $_SESSION["user"]`

**Checking a user is sign in**

```php
  if (isset($_SESSION['user'])) {
    //if a user is signed in
  } else {
    //if a user is not signed in
  }
```
