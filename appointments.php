<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
    <link rel="stylesheet"  href="style2.css">
    <script>
        function submitForm() {
            document.getElementById("myForm").submit();
            alert("Appointment booked!");
            window.location.href = "landingpage2.html";
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <img src="logo1.png" alt="LOGO" class="logo">
            <nav>
                <ul>
                    <li><a href="landingpage2.html">HOME</a></li>
                    <li><a href="profile.php">HISTORY</a></li>
                    <li><a href="appointments.php">APPOINTMENTS</a></li>
                    <li><a href="about.html">ABOUT</a></li>
                </ul>
            </nav>
        </div>
        <div class="form-box">
            <h1>Book an Appointment</h1>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="myForm">
                <div class="input-group">
                    <div class="input-field">
                        <input type="text" name="name" placeholder="Name" required>
                    </div>
                    <div class="input-field">
                        <input type="email" name="email" placeholder="E-Mail" required>
                    </div>
                    <div class="input-field">
                        <input type="text" name="phone" placeholder="Phone1" required>
                    </div>
                    <div class="input-field">
                        <input type="message" name="specifications" placeholder="Any Specifications">
                    </div>
                </div>
                <div id="message"></div>
                <div class="btn-field">
                    <button type="submit" onclick="submitForm()">BOOK</button>
                </div>
            </form>
        </div>
    </div>
    </body>
</html>
  <?php
        // Get form data
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $specifications = $_POST['specifications'];

            // Connect to MySQL database
            $host = 'localhost';
            $user = 'root';
            $password = '';
            $database = 'login'; // Replace with your actual database name
            $conn = mysqli_connect($host, $user, $password, $database);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare SQL statement
            $sql = "INSERT INTO appointments (name, email, phone, specifications) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $name, $email, $phone, $specifications);

            // Execute SQL statement
            if ($stmt->execute()) {
                echo "Appointment booked successfully!";
            } else {
                die("Error: " . $stmt->error);
            }
        }
            // Close MySQL connection
            $stmt->close();
            $conn->close();
?>
