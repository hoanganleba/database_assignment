<?php

if (isset($_POST['register'])) {
    if (
        $_POST['firstname'] &&
        $_POST['lastname'] &&
        $_POST['identificationNumber'] &&
        $_POST['address'] &&
        $_POST['city'] &&
        $_POST['country'] &&
        $_FILES['profilePicture']['name'] &&
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
        $profilePicture = $_FILES['profilePicture']['name'];
        $phoneNumber = $_POST['phoneNumber'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $message = '';
        $data = explode(".", $_FILES['profilePicture']['name']);
        $extension = $data[1];
        $allowed_extension = array("jpg", "png", "gif", "jpeg");
        if (in_array($extension, $allowed_extension)) {
            $img = $_FILES['profilePicture']['name'];
            $img_loc = $_FILES['profilePicture']['tmp_name'];
            $file_type = $_FILES['profilePicture']['type'];
            $img_folder = dirname(__FILE__) . "images/" . $img_loc;

            if (@move_uploaded_file($img_loc, $img_folder . $img)) {
                $message = 'File is successfully uploaded.';
            } else {
                $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            }
        } else {
            $message = 'Invalid Image File';
        }

        $sql = "INSERT INTO user (firstName,lastName,identificationNumber,address,city,country,profilePicture,email,phoneNumber,password, role) VALUES (:firstname, :lastname, :identificationNumber, :address, :city, :country, :profilePicture, :email, :phoneNumber, :password, 'user')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindParam('lastname', $lastname, PDO::PARAM_STR);
        $stmt->bindParam('identificationNumber', $identificationNumber, PDO::PARAM_STR);
        $stmt->bindParam('address', $address, PDO::PARAM_STR);
        $stmt->bindParam('city', $city, PDO::PARAM_STR);
        $stmt->bindParam('country', $country, PDO::PARAM_STR);
        $stmt->bindParam('profilePicture', $profilePicture, PDO::PARAM_STR);
        $stmt->bindParam('phoneNumber', $phoneNumber, PDO::PARAM_STR);
        $stmt->bindParam('email', $email, PDO::PARAM_STR);
        $stmt->bindParam('password', $password, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            header('location: ?controller=login');
        }
    }
}

?>
<div class="columns is-centered mt-3 px-4">
    <div class="column is-two-thirds">
        <form class="box" action="?controller=register" enctype="multipart/form-data" method="post">
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
            <div id="file-js-example" class="file has-name my-5">
                <label class="file-label control">
                    <input id="profilePicture" name="profilePicture" class="file-input" type="file">
                    <span class="file-cta">
                        <span class="file-icon">
                            <i class="fas fa-upload"></i>
                        </span>
                        <span class="file-label">
                            Choose a file…
                        </span>
                    </span>
                    <span class="file-name">
                        No file uploaded
                    </span>
                </label>
            </div>
            <button type="submit" name="register" value="register" class="button is-warning">Sign up</button>
        </form>
    </div>
</div>


