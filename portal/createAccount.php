<?php
require_once("../includes/initialize.php");

if(isset($_POST['submit']) && $_POST['submit'] === 'Create Profile'){
    $user = new User();
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];
    $user->firstName = $_POST['firstName'];
    $user->lastName = $_POST['lastName'];
    $user->companyName = $_POST['companyName'];
    $user->email = $_POST['email'];
    $user->phone = $_POST['phone'];
    
    if($user->create()){
        $session->login($user);
        $message = "User successfully created.";
        redirect_to('login.php');
    }else {
        $message = "Sorry, there was a problem creating your profile. Please contact support for help.";
    };
   
}
?>

<?php include_layout_template('header.php'); ?>

<?php
    if($_GET){
        echo output_message($_GET["message"]);
    }
?>

<form action="createProfile.php" method="post">

    <div class="ctcForm createProfile">
        <label for="username">Username:*</label>
        <input type="text" name="username" id="username" required></input>
    </div>

    <div class="ctcForm createProfile">
        <label for="password">Password:*</label>
        <input type="password" name="password" id="password" required></input>
    </div>

    <div class="ctcForm createProfile">
        <label for="confirmPassword">Confirm Password:*</label>
        <input type="password" name="confirmPassword" id="confirmPassword" required></input>
    </div>

    <div class="ctcForm createProfile">
        <label for="firstName">First Name:*</label>
        <input type="text" name="firstName" id="firstName" required></input>
    </div>

    <div class="ctcForm createProfile">
        <label for="lastName">Last Name:*</label>
        <input type="text" name="lastName" id="lastName" required></input>
    </div>

    <div class="ctcForm createProfile">
        <label for="companyName">Company Name:</label>
        <input type="text" name="companyName" id="companyName" ></input>
    </div>

    <div class="ctcForm createProfile">
        <label for="email">Email:*</label>
        <input type="email" name="email" id="email" required></input>
    </div>

    <div class="ctcForm createProfile">
        <label for="phone">Phone:*</label>
        <input type="text" name="phone" id="phone" placeholder="999-999-9999" pattern="[\d{3}-\d{3}-\d{4}]" required></input>
    </div>

    <div class="ctcForm createProfile">
        <input type="submit" name="submit" value="Create Profile"></input>
    </div>

    
</form>

<?php include_layout_template('footer.php'); ?>