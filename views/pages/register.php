<?php

if (isset($_POST['register'])) {
    if (
        $_POST['firstname'] &&
        $_POST['lastname'] &&
        $_POST['identificationNumber'] &&
        $_POST['address'] &&
        $_POST['city'] &&
        $_POST['country'] &&
        $_POST['profilePicture'] &&
        $_POST['phoneNumber'] &&
        $_POST['email'] &&
        $_POST['password']
    ) {
        require 'core/database.php';
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $identificationNumber = $_POST['identificationNumber'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $profilePicture = $_POST['profilePicture'];
        $phoneNumber = $_POST['phoneNumber'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $created_at = date('Y-m-d H:i:s');
        $branch_code = 50;
        $message = '';

        // Create user login
        $create_user_sql = "INSERT INTO user(email, phoneNum, password, role_id) VALUES (:email, :phoneNum, :password, 2)";
        $create_user_stmt = $conn->prepare($create_user_sql);
        $create_user_stmt->bindParam('email', $email);
        $create_user_stmt->bindParam('phoneNum', $phoneNumber);
        $create_user_stmt->bindParam('password', $password);
        $create_user_stmt->execute();

        $get_user_sql = "SELECT user.id FROM user 
            JOIN role r on user.role_id = r.id 
            WHERE (email=:email OR phoneNum=:phoneNum) AND password=:password";
        $get_user_stmt = $conn->prepare($get_user_sql);
        $get_user_stmt->bindParam('email', $email);
        $get_user_stmt->bindParam('phoneNum', $phoneNumber);
        $get_user_stmt->bindParam('password', $password);
        $get_user_stmt->execute();
        $user_row = $get_user_stmt->fetch(PDO::FETCH_ASSOC);

        // Add customer info
        $sql = "
            INSERT INTO customer (last_name, first_name, created_at, branch_code, address, city, country, identification_num, profile_pic, user_id) 
            VALUES (:last_name, :first_name, :created_at, :branch_code, :address, :country, :city, :identification_num, :profile_pic, :user_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('last_name', $lastname);
        $stmt->bindParam('first_name', $firstname);
        $stmt->bindParam('created_at', $created_at);
        $stmt->bindParam('branch_code', $branch_code);
        $stmt->bindParam('identification_num', $identificationNumber);
        $stmt->bindParam('address', $address);
        $stmt->bindParam('city', $city);
        $stmt->bindParam('country', $country);
        $stmt->bindParam('profile_pic', $profilePicture);
        $stmt->bindParam('user_id', $user_row['id']);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            header('location: ?controller=login');
        }
    }
}

?>
<div class="columns is-centered mt-3 px-4">
    <div class="column is-two-thirds">
        <form class="box" action="?controller=register" method="post">
            <div class="field-body mb-3">
                <div class="field">
                    <label for="firstname" class="label">First Name</label>
                    <div class="control">
                        <input id="firstname" name="firstname" class="input" type="text" placeholder="Alex">
                    </div>
                </div>
                <div class="field">
                    <label for="lastname" class="label">Last Name</label>
                    <div class="control">
                        <input id="lastname" name="lastname" class="input" type="text" placeholder="Example">
                    </div>
                </div>
                <div class="field">
                    <label for="identificationNumber" class="label">Identification Number</label>
                    <div class="control">
                        <input id="identificationNumber" name="identificationNumber" class="input" type="number"
                               placeholder="134789009">
                    </div>
                </div>
            </div>
            <div class="field">
                <label for="address" class="label">Address</label>
                <div class="control">
                    <input id="address" name="address" class="input" type="text"
                           placeholder="e.g. Cecilia Chapman 711-2880 Nulla St">
                </div>
            </div>
            <div class="field-body mb-3">
                <div class="field">
                    <label for="city" class="label">City</label>
                    <div class="control">
                        <input id="city" name="city" class="input" type="text"
                               placeholder="e.g. Ho Chi Minh">
                    </div>
                </div>
                <div class="field">
                    <label for="country" class="label">Country</label>
                    <div class="control">
                        <input id="country" name="country" class="input" type="text"
                               placeholder="e.g. Vietnam">
                    </div>
                </div>
                <div class="field">
                    <label for="phoneNumber" class="label">Phone Number</label>
                    <div class="control">
                        <input id="phoneNumber" name="phoneNumber" class="input" type="text"
                               placeholder="e.g. 09021920">
                    </div>
                </div>
            </div>
            <div class="field">
                <label for="email" class="label">Email</label>
                <div class="control">
                    <input id="email" name="email" class="input" type="email" placeholder="e.g. alex@example.com">
                </div>
            </div>
            <div class="field">
                <label for="password" class="label">Password</label>
                <div class="control">
                    <input id="password" name="password" class="input" type="password" placeholder="********">
                </div>
            </div>
            <div class="field">
                <label for="profilePicture" class="label">Profile Picture</label>
                <div class="control">
                    <input id="profilePicture" name="profilePicture" class="input" type="text"
                           placeholder="e.g. alex@example.com">
                </div>
            </div>
            <button type="submit" name="register" value="register" class="button is-primary">
                <strong>Sign up</strong>
            </button>
        </form>
    </div>
</div>


