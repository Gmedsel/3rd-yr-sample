<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form with Animation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: black;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .login-container:hover {
            transform: scale(1.02);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-top: 5px;
            transition: border-color 0.3s ease;
        }

        input:focus {
            border-color: #007bff;
        }

        .submit-btn {
            background-color: green;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: aqua;
        }
    </style>

<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "example_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $name = $_POST["name"];
    $password = $_POST["password"];

    // Perform basic validation
    if (empty($email) || empty($name) || empty($password)) {
        echo "<p style='color: red;'>Please fill in all the fields.</p>";
    } else {
        // Insert data into the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Use password_hash for secure password storage
        $sql = "INSERT INTO users (email, name, password) VALUES ('$email', '$name', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
          
            echo "<script>alert('Login successful!');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>
</head>
<body>
    <div class="login-container">
        <h2>Login Form</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="submit-btn">Login</button>
        </form>
    </div>
</body>
</html>
