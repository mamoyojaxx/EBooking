<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
    <link rel="stylesheet" href="css/bg.css">
    <link rel="shortcut icon" href="img/horseicon.ico">  
    <title>Forgot Password</title>
</head>
<body>
<?php
session_start();

$_SESSION["user"] = "";
$_SESSION["usertype"] = "";

// Set the new timezone
date_default_timezone_set('UTC');
$date = date('Y-m-d');
$_SESSION["date"] = $date;

// Import database
include("connection.php");

$error = "";
$success = "";

// Check if there's a success message in the session
if (isset($_SESSION['msg']['success'])) {
    $success = $_SESSION['msg']['success'];
    unset($_SESSION['msg']['success']); // Clear the message after displaying it
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $stmt = $database->prepare("SELECT * FROM client WHERE clientemail = ?");
    
    // Check if the statement was prepared correctly
    if ($stmt === false) {
        $error = "Error preparing the statement: " . $database->error;
    } else {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $email = $data['clientemail']; // Corrected to match the database field
            
            $subject = "Reset Password";
            $message = "";
            ob_start();
            //include("reset_mail-template.php"); // Uncomment and create this file if needed
            $message = ob_get_clean();
            // echo $message;exit;
            $eol = "\r\n";
            // Mail Main Header
            $headers = "From: info@sample.com" . $eol;
            $headers .= "Reply-To: noreply@sample.com" . $eol;
            $headers .= "To: <{$email}>" . $eol;
            $headers .= "MIME-Version: 1.0" . $eol;
            $headers .= "Content-Type: text/html; charset=iso-8859-1" . $eol;
            
            try {
                mail($email, $subject, $message, $headers);
                $_SESSION['msg']['success'] = "We have sent you an email to reset your password.";
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit;
            } catch (Exception $e) {
                $error = "Error: " . $e->getMessage();
            }
        } else {
            $error = "Email is not registered.";
        }
        $stmt->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $stmt = $database->prepare("SELECT * FROM staff WHERE staffemail = ?");
    
    // Check if the statement was prepared correctly
    if ($stmt === false) {
        $error = "Error preparing the statement: " . $database->error;
    } else {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $email = $data['staffemail']; // Corrected to match the database field
            
            $subject = "Reset Password";
            $message = "";
            ob_start();
            //include("reset_mail-template.php"); // Uncomment and create this file if needed
            $message = ob_get_clean();
            // echo $message;exit;
            $eol = "\r\n";
            // Mail Main Header
            $headers = "From: info@sample.com" . $eol;
            $headers .= "Reply-To: noreply@sample.com" . $eol;
            $headers .= "To: <{$email}>" . $eol;
            $headers .= "MIME-Version: 1.0" . $eol;
            $headers .= "Content-Type: text/html; charset=iso-8859-1" . $eol;
            
            try {
                mail($email, $subject, $message, $headers);
                $_SESSION['msg']['success'] = "We have sent you an email to reset your password.";
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit;
            } catch (Exception $e) {
                $error = "Error: " . $e->getMessage();
            }
        } else {
            $error = "Email is not registered.";
        }
        $stmt->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $stmt = $database->prepare("SELECT * FROM admin WHERE aemail = ?");
    
    // Check if the statement was prepared correctly
    if ($stmt === false) {
        $error = "Error preparing the statement: " . $database->error;
    } else {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $email = $data['aemail']; // Corrected to match the database field
            
            $subject = "Reset Password";
            $message = "";
            ob_start();
            //include("reset_mail-template.php"); // Uncomment and create this file if needed
            $message = ob_get_clean();
            // echo $message;exit;
            $eol = "\r\n";
            // Mail Main Header
            $headers = "From: info@sample.com" . $eol;
            $headers .= "Reply-To: noreply@sample.com" . $eol;
            $headers .= "To: <{$email}>" . $eol;
            $headers .= "MIME-Version: 1.0" . $eol;
            $headers .= "Content-Type: text/html; charset=iso-8859-1" . $eol;
            
            try {
                mail($email, $subject, $message, $headers);
                $_SESSION['msg']['success'] = "We have sent you an email to reset your password.";
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit;
            } catch (Exception $e) {
                $error = "Error: " . $e->getMessage();
            }
        } else {
            $error = "Email is not registered.";
        }
        $stmt->close();
    }
}

?>

<center>
    <div class="container">
        <table border="0" style="margin: 0;padding: 0;width: 60%;">
            <tr>
                <td colspan="2">
                    <img class="logo-img" src="img/logo.png" alt="logo" width="{conf.logoWidth}" height="27">
                </td>
            </tr>
            <tr>
                <td>
                    <p class="header-text">Forgot Password!</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="sub-text">Enter your email so we can send a link:</p>
                </td>
            </tr>
            <tr>
                <td>
                    <form action="" method="POST">
                        <label for="email" class="form-label">Email: </label>
                        <input type="email" name="email" class="input-text" placeholder="Email Address" required>
                        <?php if (!empty($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
                        <input type="submit" value="Send Link to email" class="login-btn btn-primary btn">
                    </form>
                    <?php if (!empty($success)) { echo "<p style='color: green;'>$success</p>"; } ?>
                </td>
            </tr>
            <tr><td><a href = "index.php"><input type="submit" value="Close" class="login-btn btn-primary btn"></a></td></tr>
        </table>
    </div>
</center>
</body>
</html>
