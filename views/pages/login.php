<?php
$login_info_empty_warning = '';
$login_info_input_warning = '';
$password_empty_warning = '';
$password_input_warning = '';
$login_warning = '';

if (isset($_POST['login'])) {
    if ($_POST['login_info'] == null) {
        $login_info_input_warning = 'is-danger';
        $login_info_empty_warning = '<p class="help is-danger">Please enter your Email or Phone number</p>';
    }
    if ($_POST['password'] == null) {
        $password_input_warning = 'is-danger';
        $password_empty_warning = '<p class="help is-danger">Please enter your password</p>';
    }
    if ($_POST['login_info'] && $_POST['password']) {
        require 'core/database.php';
        $login_info = $_POST['login_info'];
        $password = $_POST['password'];
        $sql = "
            SELECT * FROM user 
            JOIN role r on user.role_id = r.id 
            WHERE (email=:login_info OR phoneNum=:login_info) AND password=:password";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('login_info', $login_info);
        $stmt->bindParam('password', $password);
        $stmt->execute();
        $count = $stmt->rowCount();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($count == 1 && !empty($row)) {
            if ($row['type'] != 'admin') {
                $sql = "
                    SELECT user_id, first_name, last_name, profile_pic, type, balance FROM user
                    JOIN role r on user.role_id = r.id
                    JOIN customer c on user.id = c.user_id
                    JOIN wallet w on c.id = w.customer_id
                    WHERE (email=:login_info OR phoneNum=:login_info) AND password=:password;";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam('login_info', $login_info);
                $stmt->bindParam('password', $password);
                $stmt->execute();
                $count = $stmt->rowCount();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['balance'] = $row['balance'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['profile_pic'] = $row['profile_pic'];
            }
            $_SESSION['role'] = $row['type'];
            header('location: index.php');
        } else {
            $login_warning =
                '<div class="notification is-danger is-light">
                    <strong>Login failed</strong>
                <p>Invalid login info. Please try again.</p>
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
                <label for="login_info" class="label">Email / Phone number</label>
                <div class="control">
                    <input name="login_info" id="login_info" class="input <?php echo $login_info_input_warning ?>"
                           type="text"
                           placeholder="e.g. alex@example.com or 09021920">
                </div>
                <?php echo $login_info_empty_warning ?>
            </div>

            <div class="field">
                <label for="password" class="label">Password</label>
                <div class="control">
                    <input name="password" id="password" class="input <?php echo $password_input_warning ?>"
                           type="password" placeholder="********">
                </div>
                <?php echo $password_empty_warning ?>
            </div>

            <button type="submit" name="login" value="login" class="button is-primary is-fullwidth">
                <strong>Login</strong>
            </button>
        </form>
    </div>
</div>