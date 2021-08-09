<?php
$email_empty_warning = '';
$email_input_warning = '';
$password_empty_warning = '';
$password_input_warning = '';
$login_warning = '';

if (isset($_POST['login'])) {
    if ($_POST['email'] == null) {
        $email_input_warning = 'is-danger';
        $email_empty_warning = '<p class="help is-danger">Please enter your email</p>';
    }
    if ($_POST['password'] == null) {
        $password_input_warning = 'is-danger';
        $password_empty_warning = '<p class="help is-danger">Please enter your password</p>';
    }
    if ($_POST['email'] && $_POST['password']) {
        require 'core/database.php';
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM user WHERE email=:email AND password=:password";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('email', $email, PDO::PARAM_STR);
        $stmt->bindParam('password', $password, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($count == 1 && !empty($row)) {
            $_SESSION['user_id'] = $row['ID'];
            $_SESSION['first_name'] = $row['firstName'];
            $_SESSION['last_name'] = $row['lastName'];
            $_SESSION['profile_picture'] = $row['profilePicture'];
            $_SESSION['role'] = $row['role'];
            header('location: index.php');
        } else {
            $login_warning =
                '<div class="notification is-danger is-light">
                    <strong>Login failed</strong>
                <p>Your email or password is not correct. Please try again.</p>
                </div>';
        }
    }
}
?>

<div class="columns is-centered mt-3 px-4">
    <div class="column is-one-third">
        <?php echo $login_warning ?>
        <form action="?controller=login" class="box" method="post">
            <div class="field">
                <label for="email" class="label">Email</label>
                <div class="control">
                    <input name="email" id="email" class="input <?php echo $email_input_warning ?>" type="email"
                           placeholder="e.g. alex@example.com">
                </div>
                <?php echo $email_empty_warning ?>
            </div>

            <div class="field">
                <label for="password" class="label">Password</label>
                <div class="control">
                    <input name="password" id="password" class="input <?php echo $password_input_warning ?>"
                           type="password" placeholder="********">
                </div>
                <?php echo $password_empty_warning ?>
            </div>

            <button type="submit" name="login" value="Login" class="button is-warning is-fullwidth">Login</button>
        </form>
    </div>
</div>