<?php
include "../src/header.php";

// Function to encode an array into URL parameters
function encodeParams($params) {
    return http_build_query($params);
}

// Function to decode URL parameters into an array
function decodeParams($params) {
    parse_str($params, $decoded);
    return $decoded;
}

if (isset($_POST['register'])) {
    $name = $_POST['comp_name'];
    $email = $_POST['comp_email'];
    $phone = $_POST['comp_phone'];
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $status = 'pending';

    // Check if username already exists
    $stmt = mysqli_prepare($con, "SELECT COUNT(*) AS count FROM user WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Check if company name already exists
    $stmt = mysqli_prepare($con, "SELECT COUNT(*) AS count FROM user WHERE company_name = ?");
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $count_company);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if  ($count_company > 0){
        // Company name already exists, encode form values into URL parameters and redirect back to the registration page
        $params = [
            'comp_name' => $name,
            'comp_email' => $email,
            'comp_phone' => $phone,
            'username' => $user,
            'password' => $pass
        ];
        $encodedParams = encodeParams($params);
        echo "<script> alert('Company name already exists. Please choose different ones.'); window.location='register.php?$encodedParams'; </script>";
        exit; // Stop further execution

    } else if ($count > 0) {
        // Username already exists, encode form values into URL parameters and redirect back to the registration page
        $params = [
            'comp_name' => $name,
            'comp_email' => $email,
            'comp_phone' => $phone,
            'username' => $user,
            'password' => $pass
        ];
        $encodedParams = encodeParams($params);
        echo "<script> alert('Username already exists. Please choose different ones.'); window.location='register.php?$encodedParams'; </script>";
        exit; // Stop further execution
    } else {
        // Proceed with registration
        $query = mysqli_query($con, "INSERT INTO user(company_name, user_email, company_tel, username,password, status) VALUES ('$name','$email','$phone','$user','$pass','$status')");
        if (!$query) {
            die("Query failed: " . mysqli_error($con));
        } else {
            echo "<script> alert('Your Company account has been registered. Please wait for your account to be approved by the admin. We will email you when the account has been approved.'); window.location='login.php'; </script>";
            exit; // Stop further execution
        }
    }
}

// Decode URL parameters and populate form fields if present
if (!empty($_SERVER['QUERY_STRING'])) {
    $decodedParams = decodeParams($_SERVER['QUERY_STRING']);
    foreach ($decodedParams as $key => $value) {
        $_POST[$key] = $value;
    }
}
?>

<title>Register</title>
<div class="card" style="border: 0px;">
    <div class="card_body">
        <center>
            <img src="../img/Sas logo.png" class="rounded" style="height: auto; width: 200px; margin-bottom: 35px;">
            <div class="login-card">
                <form method="POST">
                    <h3 style="color: white;">User Register</h3>
                    <input type="text" placeholder="Company Name" name="comp_name" required value="<?php echo isset($_POST['comp_name']) ? $_POST['comp_name'] : ''; ?>">
                    <input type="text" placeholder="Company Email Address" name="comp_email" required value="<?php echo isset($_POST['comp_email']) ? $_POST['comp_email'] : ''; ?>">
                    <input type="text" placeholder="Company Phone Number" name="comp_phone" required value="<?php echo isset($_POST['comp_phone']) ? $_POST['comp_phone'] : ''; ?>">
                    <input type="text" placeholder="Username" name="username" required value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>">
                    <input type="password" placeholder="Password" name="password" required>
                    <div class="button-container">
                        <button class="btn btn-primary" name="register">Register</button>
                        <a class="btn btn-outline-primary" href="login.php" style="width: 80px;">Login</a>
                    </div>
                </form>
            </div>
        </center>
    </div>
</div>
<a href="ad_login.php"><img src="../img/user.png" class="float-end" style="width: 50px; margin-right: 20px;"></a>
