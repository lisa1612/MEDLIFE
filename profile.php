<!DOCTYPE html>
<html>
   <head>
   <link rel = "stylesheet" href="style2.css">
   <link rel="stylesheet" href="demo1.css">
   </head>
   <body>
<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login1.php");
    exit();
}
$username = $_SESSION['username'];

// Establish a connection to the database
$con = new mysqli("localhost","root","","login");
if($con->connect_error){
   die("Failed to Connect: ".$con->connect_error);
}
else
{
   $stmt=$con->prepare("select * from data where username=?");
   $stmt->bind_param("s",$username);
   $stmt->execute();
   $stmt_result = $stmt->get_result();
   if($stmt_result->num_rows>0){
       $data = $stmt_result->fetch_assoc();
       // Display the user's details on the screen
      //  echo "<p>Welcome, " . $data['username'] . "!</p>";
      //  echo "<p>Your email address is " . $data['phone'] . ".</p>";
      //  echo "<p>Your phone number is " . $data['email'] . ".</p>";
   }
   else{
      echo "<h2>INVALID</h2>"; 
   }
}

// Close the database connection
mysqli_close($con);
?>
 <div class = "container">
            <div class = "navbar">
                <img src = "logo1.png" alt="LOGO" class="logo">
                <nav>
                    <ul>
                        <li><a href="landingpage2.html">HOME</a></li>
                        <li><a href="profile.php">HISTORY</a></li>
                        <li><a href="appointments.php">APPOINTMENTS</a></li>
                        <li><a href="about.html">ABOUT</a></li>
                    </ul>
                </nav>
            </div>
    <center>
      <div class="container12">
      <label for="name">Name:</label>
      <p> <?php echo $data['username']; ?></p>
    </div>
    <div class="container12">
      <label for="dob">Date of Birth:</label>
      <p><?php echo $data['DOB']; ?></p>
    </div>
    <div class="container12">
      <label for="gender">Gender:</label>
      <p><?php echo $data['Gender']; ?></p>
    </div>
    </section>
    <center>
    <section>
        <center>
      <h2>Medical History</h2>
    </center>
      <div class="container1">
      <label for="diagnosis">Diagnosis:</label>
      <p id="diagnosis" name="diagnosis"><?php echo $data['Diagnosis']; ?></p>
    </div>
    <div class="container1">
      <label for="medications">Medications:</label>
      <p id="medications" name="medications"><?php echo $data['Medications']; ?></p>
    </div>
    <div class="container1">
      <label for="allergies">Allergies:</label>
      <p id="allergies" name="allergies"><?php echo $data['Allergies']; ?></p>
    </div>
    </section>
    
  </body>
</html>

   
