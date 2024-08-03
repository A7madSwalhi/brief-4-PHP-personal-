<?php





class Validator
{
    private $username;
    private $email;
    private $password;
    private $conpassword;
    private $conn;
    private $usernamereg = "/^[a-zA-Z0-9_-]{3,16}$/";
    private $emailreg = "/^([a-z0-9_\.\+-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/";
    private $passwordreg = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.*\s).{8,}$/';
    private $errors = [];

    public function __construct($username, $email, $password, $conpassword, $conn)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->conpassword = $conpassword;
        $this->conn = $conn;
    }

    private function checkUsername()
    {
        if (!preg_match($this->usernamereg, $this->username)) {
            $this->errors['user'] = "Invalid username format";
            return false;
        }
        return true;
    }

    private function checkEmail()
    {
        if (!preg_match($this->emailreg, $this->email)) {
            $this->errors['email'] = "Invalid email format";
            return false;
        }
        return true;
    }

    private function checkPassword()
    {
        if (!preg_match($this->passwordreg, $this->password)) {
            $this->errors['pass'] = "Invalid password format";
            return false;
        }
        return true;
    }

    private function checkConfirmPassword()
    {
        if ($this->password !== $this->conpassword) {
            $this->errors['con_pass'] = "Passwords do not match";
            return false;
        }
        return true;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function validate()
    {
        $valid = true;

        $valid &= $this->checkUsername();
        $valid &= $this->checkEmail();
        $valid &= $this->checkPassword();
        $valid &= $this->checkConfirmPassword();
        return $valid;
    }

    public function checkUserExist()
    {
        $usernameEscaped = mysqli_real_escape_string($this->conn, $this->username);
        $emailEscaped = mysqli_real_escape_string($this->conn, $this->email);

        // Check if username exists
        $queryUsername = "SELECT * FROM `users` WHERE name='$usernameEscaped'";
        $resultUsername = mysqli_query($this->conn, $queryUsername);

        if (!$resultUsername) {
            $this->errors['db'] = 'Query failed: ' . mysqli_error($this->conn);
            return false;
        }

        if (mysqli_num_rows($resultUsername) > 0) {
            $this->errors['username_exist'] = 'Username already exists!';
            return false;
        }

        // Check if email exists
        $queryEmail = "SELECT * FROM `users` WHERE email='$emailEscaped'";
        $resultEmail = mysqli_query($this->conn, $queryEmail);

        if (!$resultEmail) {
            $this->errors['db'] = 'Query failed: ' . mysqli_error($this->conn);
            return false;
        }

        if (mysqli_num_rows($resultEmail) > 0) {
            $this->errors['email_exist'] = 'Email already exists!';
            return false;
        }

        return true;
    }

    public function insertUserInDatabase()
    {
        $usernameEscaped = mysqli_real_escape_string($this->conn, $this->username);
        $emailEscaped = mysqli_real_escape_string($this->conn, $this->email);
        $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);

        $query = "INSERT INTO `users` (name, email, password) VALUES ('$usernameEscaped', '$emailEscaped', '$hashedPassword')";

        if (!mysqli_query($this->conn, $query)) {
            $this->errors['db'] = 'Query failed: ' . mysqli_error($this->conn);
            return false;
        }

        return true;
    }
}






class LoginValidator
{
    private $email;
    private $password;
    private $conn;
    private $errors = [];

    public function __construct($email, $password, $conn)
    {
        $this->email = $email;
        $this->password = $password;
        $this->conn = $conn;
    }

    private function checkEmail()
    {
        $emailReg = "/^([a-z0-9_\.\+-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/";
        if (!preg_match($emailReg, $this->email)) {
            $this->errors['email'] = "Invalid email format";
            return false;
        }
        return true;
    }

    private function authenticateUser()
    {
        $emailEscaped = mysqli_real_escape_string($this->conn, $this->email);
        $query = "SELECT * FROM `users` WHERE email='$emailEscaped'";
        $result = mysqli_query($this->conn, $query);

        if (!$result) {
            $this->errors['db'] = 'Query failed: ' . mysqli_error($this->conn);
            return false;
        }

        if (mysqli_num_rows($result) === 0) {
            $this->errors['email'] = 'No user found with this email';
            return false;
        }

        $user = mysqli_fetch_assoc($result);
        if (!password_verify($this->password, $user['password'])) {
            $this->errors['login'] = 'Incorrect password';
            return false;
        }

        return $user;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    private function addToSession($user)
    {
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_type'] = $user['user_type'];


        if ($user['user_type'] == 'admin') {
            
            header('Location: adminProducts.php');
            exit();
        } elseif ($user['user_type'] == 'user') {
            
            header('Location: userDetails.php');
            exit();
        } else {
            $this->errors['session'] = 'No user type found!';
        }
        exit();
    }

    public function validateAndLogin()
    {
        if (!$this->checkEmail()) {
            return false;
        }

        $user = $this->authenticateUser();
        if ($user) {
            $this->addToSession($user);
            return true;
        } else {
            return false;
        }
    }
}
