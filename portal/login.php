<?php
require_once("../includes/initialize.php");

if($session->is_logged_in()) {
    redirect_to("index.php");
}

if(isset($_POST['submit'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $found_user = User::authenticate($username, $password);

    if($found_user) {
        $session->login($found_user);
        redirect_to('index.php');
    } else {
        $message = "Sorry, your username/password combination is incorrect.";
    }
}else {
    $username = "";
    $password = "";
    $message = "";
}
?>

<?php include_layout_template('header.php'); ?>

    <h2>Client Login</h2>
    <?php echo output_message($message); ?>

    <form action="login.php" method="post" >
        <div class="ctcForm">
            <label for="username">Username:</label>
            <input type="text" name="username" maxlength="50" 
            value="<?php echo htmlentities($username); ?>" required
            >
        </div>
        <div class="ctcForm">
            <label for="password">Password:</label>
            <input type="password" name="password" maxlength="50" 
            value="<?php echo htmlentities($password); ?>" required
            >
        </div>
        <div>
            <input type="submit" name="submit" value="Login" />
        </div>
    </form>

    <hr style="margin: 75px 0;" />
    
    <div>
        <h3>Make a Payment</h3>
        Make a secure payment by clicking the Paypal button below:
        <!-- <form action="https://www.paypal.com" method="post" target="_top">
            PayPal Form
        </form> -->
    </div>

<?php include_layout_template('footer.php'); ?>
<?php if(isset($db)) {$db->close_connection(); } ?>