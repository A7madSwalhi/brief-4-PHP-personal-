<?php
include 'config.php';
session_start();

$user_id = 1; 

// استرجاع بيانات المستخدم
$user_sql = "SELECT * FROM users WHERE user_id = ?";
$user_stmt = $conn->prepare($user_sql);
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_result = $user_stmt->get_result();
$user = $user_result->fetch_assoc();

// التحقق من البيانات المسترجعة
if (!$user) {
    die("User not found");
}

// استرجاع بيانات العنوان
$address_sql = "SELECT * FROM address WHERE user_id = ?";
$address_stmt = $conn->prepare($address_sql);
$address_stmt->bind_param("i", $user_id);
$address_stmt->execute();
$address_result = $address_stmt->get_result();
$address = $address_result->fetch_assoc();

// التحقق من البيانات المسترجعة
if (!$address) {
    $address = [
        'country' => 'Not Found',
        'city' => 'Not Found',
        'street' => 'Not Found'
    ];
}

// معالجة تحديث البيانات
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_user'])) {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $update_user_sql = "UPDATE users SET name = ?, email = ? WHERE user_id = ?";
        $update_user_stmt = $conn->prepare($update_user_sql);
        $update_user_stmt->bind_param("ssi", $name, $email, $user_id);
        if ($update_user_stmt->execute()) {
            echo "<script>alert('User profile updated successfully!');</script>";
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "<script>alert('Error updating user profile: " . $update_user_stmt->error . "');</script>";
        }
    }

    if (isset($_POST['update_address'])) {
        $country = isset($_POST['country']) ? $_POST['country'] : '';
        $city = isset($_POST['city']) ? $_POST['city'] : '';
        $street = isset($_POST['street']) ? $_POST['street'] : '';
        $update_address_sql = "UPDATE address SET country = ?, city = ?, street = ? WHERE user_id = ?";
        $update_address_stmt = $conn->prepare($update_address_sql);
        $update_address_stmt->bind_param("sssi", $country, $city, $street, $user_id);
        if ($update_address_stmt->execute()) {
            echo "<script>alert('Address updated successfully!');</script>";
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "<script>alert('Error updating address: " . $update_address_stmt->error . "');</script>";
        }
    }

    if (isset($_POST['update_password'])) {
        $current_password = isset($_POST['current-password']) ? $_POST['current-password'] : '';
        $new_password = isset($_POST['new-password']) ? $_POST['new-password'] : '';
        $confirm_password = isset($_POST['confirm-password']) ? $_POST['confirm-password'] : '';
        
        if ($new_password === $confirm_password) {
            // تحديث كلمة المرور في قاعدة البيانات (يفضل تشفير كلمة المرور قبل تخزينها)
            $update_password_sql = "UPDATE users SET password = ? WHERE user_id = ?";
            $update_password_stmt = $conn->prepare($update_password_sql);
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $update_password_stmt->bind_param("si", $hashed_password, $user_id);
            if ($update_password_stmt->execute()) {
                echo "<script>alert('Password updated successfully!');</script>";
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                echo "<script>alert('Error updating password: " . $update_password_stmt->error . "');</script>";
            }
        } else {
            echo "<script>alert('New password and confirm password do not match');</script>";
        }
    }

    if (isset($_FILES['profile_picture'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            $update_picture_sql = "UPDATE users SET profile_picture = ? WHERE user_id = ?";
            $update_picture_stmt = $conn->prepare($update_picture_sql);
            $update_picture_stmt->bind_param("si", $target_file, $user_id);
            if ($update_picture_stmt->execute()) {
                echo "<script>alert('Profile picture updated successfully!');</script>";
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                echo "<script>alert('Error updating profile picture: " . $update_picture_stmt->error . "');</script>";
            }
        } else {
            echo "<script>alert('Error uploading profile picture');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background: url('./images/breadcrumb.jpg') no-repeat center center;
            background-size: cover;
            height: 200px;
            position: relative;
            color: #333;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .header h1 {
            margin: 0;
            font-size: 2.5em;
            font-family: 'Times New Roman', Times, serif;
            color: #000;
        }

        .header .breadcrumb {
            margin-top: 10px;
            font-size: 1em;
            color: #555;
        }

        .header .breadcrumb a {
            text-decoration: none;
            color: #555;
            transition: color 0.3s;
        }

        .header .breadcrumb a:hover {
            color: #ff4081;
        }

        .container {
            display: flex;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        .sidebar {
            width: 250px;
            background: #fff;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            margin: 10px 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s, color 0.3s;
            cursor: pointer;
        }

        .sidebar ul li a i {
            margin-right: 10px;
        }

        .sidebar ul li a:hover {
            background: #f1f1f1;
        }

        .sidebar ul li a.active {
            background: #ff4081;
            color: #fff;
        }

        .content {
            flex: 1;
            margin-left: 20px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #333;
        }

        .content section {
            display: none;
        }

        .content section.active {
            display: block;
            
        }

        .content h2 {
            margin-top: 0;
            color: #ff4081;
        }

        .form-group {
            margin-bottom: 15px;
            max-width: 80%; /* ضبط عرض الحقول */
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input, .form-group button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-group input[type="file"] {
            border: none;
        }

        .form-group button {
            background: #ff4081;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        .form-group button:hover {
            background: #e0356a;
        }

        .dashboard-content {
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            color: #333;
        }

        .dashboard-content p {
            margin: 10px 0;
        }

        .dashboard-content a {
            color: #ff4081;
            text-decoration: none;
        }

        .dashboard-content a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="header" id="header">
    <h1>My Account</h1>
    <div class="breadcrumb">
        <a href="index.php">Home</a> > <a href="test.php">My Account</a>
    </div>
</div>

<div class="container">
    <div class="sidebar">
        <ul>
            <li><a href="#" class="active" data-section="dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="#" data-section="orders"><i class="fas fa-shopping-cart"></i> Orders</a></li>
            <li><a href="#" data-section="address"><i class="fas fa-map-marker-alt"></i> Address</a></li>
            <li><a href="#" data-section="account-details"><i class="fas fa-user"></i> Account Details</a></li>
        </ul>
    </div>
    <div class="content">
        <section id="dashboard" class="active">
            <h2>Dashboard</h2>
            <div class="dashboard-content">
                <p>Hello, <span id="user-name"><?php echo $user['name']; ?>
                <p>Email: <?php echo $user['email']; ?></p>
                <p>Address: <?php echo $user['address']; ?></p>
            </div>
        </section>
        <section id="orders">
            <h2>Orders</h2>
            <p>Here are your orders.</p>
        </section>
       
        <section id="address">
            <h2>Address</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" id="country" name="country" placeholder="Country" value="<?php echo $address['country']; ?>">
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" placeholder="City" value="<?php echo $address['city']; ?>">
                </div>
                <div class="form-group">
                    <label for="street">Street</label>
                    <input type="text" id="street" name="street" placeholder="Street" value="<?php echo $address['street']; ?>">
                </div>
                <div class="form-group">
                    <button type="submit" name="update_address">Save Address</button>
                </div>
            </form>
        </section>
        <section id="account-details">
            <h2>Account Details</h2>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Name" value="<?php echo $user['name']; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Email Address" value="<?php echo $user['email']; ?>">
                </div>
              
                <div class="form-group">
                    <button type="submit" name="update_user">Save Changes</button>
                </div>
            </form>
            <h2>Change Password</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="current-password">Current Password</label>
                    <input type="password" id="current-password" name="current-password" placeholder="Current Password">
                </div>
                <div class="form-group">
                    <label for="new-password">New Password</label>
                    <input type="password" id="new-password" name="new-password" placeholder="New Password">
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password">
                </div>
                <div class="form-group">
                    <button type="submit" name="update_password">Change Password</button>
                </div>
            </form>
        </section>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('.sidebar ul li a');
        const sections = document.querySelectorAll('.content section');

        links.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                links.forEach(link => link.classList.remove('active'));
                this.classList.add('active');
                const sectionId = this.getAttribute('data-section');
                sections.forEach(section => {
                    section.classList.remove('active');
                    if (section.id === sectionId) {
                        section.classList.add('active');
                    }
                });
            });
        });
    });
</script>

</body>
</html>
