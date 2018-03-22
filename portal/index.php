<?php
require_once("../includes/initialize.php");

if(!$session->is_logged_in()) { 
    redirect_to("login.php");
}


$user = User::find_by_id($_SESSION['user_id']);
if(isset($_POST['submit']) && $_POST['submit'] === 'Upload'){

    $appendName = $user->lastName . $user->firstName;

    $tmp_file = $_FILES['file_upload']['tmp_name'];
    $target_file = basename($_FILES['file_upload']['name']);
    $target_file = $appendName . $target_file;
    $upload_dir = "shh!";
    if(!is_dir($upload_dir."/".$appendName."/")){
        mkdir($upload_dir."/".$appendName."/");
    }

    if(move_uploaded_file($tmp_file, $upload_dir."/".$appendName."/".$target_file)){
        $message = "File uploaded successfully.";
    } else {
        $error = $_FILES['file_upload']['error'];
        $message = $upload_errors[$error];
    }
} 

if(isset($_POST['submit']) && $_POST['submit'] === 'Yes, I agree to these terms.'){
    $user->ackSigned = 1;
    $user->update();
}

if(isset($_POST['submit']) && $_POST['submit'] === 'Logout'){
   $session->logout();
   redirect_to("login.php");
}
?>

<?php include_layout_template('header.php'); ?>

<?php
    $user = User::find_by_id($_SESSION['user_id']);
?>

<h2>Welcome, <?php echo $user->full_name(); ?>
<form action="index.php" method="post" class="frmLogout">
    <input type="submit" name="submit" class="logout ctcForm" style="margin-left: 0; margin-top: -40px;" value="Logout"/ >
</form>
</h2>

<?php
if($user->ackSigned == 1) {
?>
    <p>Thank you for accepting the terms of our Client Acknowledgement Information document. You can find a downloadable copy in the Document Center below.</p>
<?php
}else {
?>
<form action="index.php" method="post">
    <div class="ackMessage">
    <h3>IMPORTANT INFORMATION/CLIENT ACKNOWLEDGEMENT </h3>
        <p>Thank you for choosing us.</p>

        <p>We sincerely thank you and appreciate your business.</p>
        
        <input type="checkbox" name="ackSigned" required /> By checking this box, you acknowledge that you have read and agree to these terms. A copy of these terms is also available for you to downlod and print in the Document Center section of this page.</p>
        <div><input type="submit" name="submit" style="margin-left: 0;" value="Yes, I agree to these terms."/ ></div>
    </div>
    </form>
<?php
}
?>

    <?php 
            if(!empty($message)) {
                echo output_message($message);
            }
    ?>
        <div class="centersMargin">
            <h3>Document Center</h3>
            
                <fieldset>
                    <legend>Download Forms</legend>
                    Please download and complete the following documents. Once completed, simply upload below or via the app:

                    <ul>
                        <li>
                            <a href="../docs/ACKNOWLEDGEMENT_INFO.pdf" target="_blank">Client Acknowledgement Information</a>
                        </li>
                        <li>
                            <a href="../docs/intake.pdf" target="_blank">Intake Form</a>
                        </li>
                        <li>
                        <a href="../docs/CHECKLIST.pdf" target="_blank">Client Checklist</a>
                        </li>
                        
                    </ul>
                </fieldset>
            

                <fieldset >
                    <legend>Upload Forms</legend>
                
                    <form action="index.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="MAX_FILE_SIZE" value="2000000  ">
                        <div class="ctcForm">
                            <label for="file_upload">Select file(s):</label>
                            <input type="file" name="file_upload" multiple=""  required />
                        </div>
                        <div><input type="submit" name="submit" value="Upload"/ ></div>
                    </form>
                </fieldset>
        </div>


        <div  class="centersMargin">
            <h3>Payment Center</h3>
            Make a secure payment by clicking the Paypal button below:
            <!-- <form action="https://www.paypal.com" method="post" target="_top">
                PayPal Form
            </form> -->
        </div>

        <div  class="centersMargin">
            <h3>Status Center</h3>
            Once your return process begins, you can check the status here or via the app.

            <p><strong>Return Status: Pending</strong></p>
        </div>

<?php include_layout_template('footer.php'); ?>