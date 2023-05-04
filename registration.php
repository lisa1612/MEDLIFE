<!DOCTYPE html>
<html>
<head>
	<title>User Registration</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="loginpage.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
            function submitForm() {
            document.getElementById("myForm").submit();
            alert("Successfully Registered. You can now login with your credentials");
            window.location.href = "login1.html";
        }
    </script>
</head>
<body>
<div class="login-box">
	<h2>User Registration Form</h2>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id="myForm">
		<div class="form-group">
			<label for="username">Name:</label>
			<input type="text" class="form-control" id="username" placeholder="Enter name" name="username" required>
		</div>
		<div class="form-group">
			<label for="email">Email:</label>
			<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
		</div>
		<div class="form-group">
			<label for="password">Password:</label>
			<input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
		</div>
		<button type="submit" onclick="submitForm()">Submit</button>
	</form>
</div>
<?php
// Get form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	// Connect to MySQL database
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$dbname = 'login'; // Replace with your actual database name
	$conn = new mysqli($host, $user, $pass, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// Prepare SQL statement
	$sql = "INSERT INTO users (username,password,email) VALUES (?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sss", $username,$password,$email);

	// Execute SQL statement
	if ($stmt->execute()) {
        $url = "login1.html";
        header('Location: ' . $url);
	} else {
		die("Error: " . $stmt->error);
	}

	// Close MySQL connection
	$stmt->close();
	$conn->close();
}
?>
</body>
</html>






