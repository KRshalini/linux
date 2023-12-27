<?php
ob_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "details";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn) {
 // echo "Connection Success";
}else{
    echo "Connection failed .mysqli_connect_error";
}

?>
<?php
include_once("db.php");
include_once("response.php");
?>

<html>

  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>FORM</title>
</head>
  <body>
 
    <div class="class">
        <form action="#" id="formvalidation"  method="POST" enctype="multipart/form-data">
        <div class="title">
         <h1>FORM</h1>
        </div>
      <div class="form">
        <div class="input">
          <label for="fname">FirstName:</label>
          <input type="text" id="firstname" name="firstname"><br>
        </div>

        <div class="input">
          <label for="lname">LastName:</label>
          <input type="text" name="lastname"><br>
        </div>

        <div class="input">
          <label for="email">Email:</label>
          <input type="email" name="email"><br>
        </div>

        <div class="input">
          <label for="password">Password:</label>
          <input type="password" name="password"><br>
        </div>

       
        <div class="container">
        <div class="input">

            <label for="country"> Country</label>
            <select class="form-select" id="country" name="country">
                <option value=""> Select Country</option>
                <?php

                $query = "select * from country";
                // $query = mysqli_query($con, $qr);
                $result = $con->query($query);
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="input">
            <label for="country"> State</label>
            <select class="form-select" id="state" name="state">
                <option value="">select State</option>

            </select>
        </div>
        <div class="input">
            <label for="country"> City</label>
            <select class="form-select" id="city" name="city">
                <option value="">select City</option>
            </select>
        </div>
    </div>
 </div>
    <script>
        $(document).ready(function() {
            $("#country").on('change', function() {
                var countryid = $(this).val();

                $.ajax({
                    method: "POST",
                    url: "response.php",
                    data: {
                        id: countryid
                    },
                    datatype: "html",
                    success: function(data) {
                        $("#state").html(data);
                        $("#city").html('<option value="">Select city</option');

                    }
                });
            });
            $("#state").on('change', function() {
                var stateid = $(this).val();
                $.ajax({
                    method: "POST",
                    url: "response.php",
                    data: {
                        sid: stateid
                    },
                    datatype: "html",
                    success: function(data) {
                        $("#city").html(data);

                    }

                });
            });
        });
    </script>
    
     <!-- <div class="input">
        <label for="role">Role:</label>
        <select name="role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
        </select>
      </div>-->

        <!-- radio button -->
        <div class="input">
          <label for="gender">Gender:</label><br>
          <input type="radio" name="gender" value="Female">Female
          <input type="radio" name="gender" value="Male">Male<br>
        </div>
  

        <!-- Dropdown -->
        <div class="input">
          <label for="native">Native:</label>
          <select name="native">
            <option value="Select">Select</option>
            <option value="Chennai">Chennai</option>
            <option value="Madurai">Madurai</option>
            
          </select>
    
            <!-- checkbox -->
          <div class="input">
            <label for="skills">Skills:</label>
            <input type="checkbox"  name="skills[]" value="Java">Java 
           
            <input type="checkbox"  name="skills[]" value="CPP">cpp
           
            <input type="checkbox"  name="skills[]" value="Python">python
          
            <input type="checkbox"  name="skills[]" value="NodeJs">nodejs
           
            <input type="checkbox"  name="skills[]" value="C">C
            
            <input type="checkbox"  name="skills[]" value="Javascript">Javascript<br>
           
           <!--file upload 
          <div class="input">
          <input type="file" name="uploadfile" required><br>
          </div>  
          -->
            <!-- multiple daatas in dropdown -->
            <div class="input">
            
              <label for="location">Preferred location:</label><br>
              <textare></textarea>
              <select name="location[]" multiple required="select-form-control" >
                 <option value="Madurai">Madurai</option>
                 <option value="Bangalore">Bangalore</option>
                 <option value="Chennai">Chennai</option>
                 <option value="Coimbatore">Coimbatore</option>   
                 <option value="Tirchy">Trichy</option>          
                 <option value="Hyderabad">Hyderabad</option>   
                  
              </select>
            </div>

        <div class="input">
            <input type="submit" name="submit" value="Submit">   
        </div>
        <div>
            <p>Already have an account, <a href="login.php">login</a>.</p>
       </div>

      </div>
    </div>  
    </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.f.js"></script>
    <script src="form.js"></script>
  </body>
</html>

<?php

$query="SELECT * FROM `person_details` ORDER BY Id DESC LIMIT 1";
$data = mysqli_query($conn,$query);
$total = mysqli_num_rows($data);

  if(isset($_POST['submit'])){
    if($total==0)
{
  $id = 1; 
}else{
    $result = mysqli_fetch_assoc($data);
    $id =$result['id']+1; 
}
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = trim($_POST["password"]);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
   // $hashedPassword = md5($password);
    $gender = $_POST['gender'];
    $native = $_POST['native'];
    $skills = $_POST['skills'];
    $country=$_POST['country'];
    $state=$_POST['state'];
    $city=$_POST['city'];
   // $role = $_POST['role'];

   // $img = $_POST['img'];
    $location = implode(',',$_POST['location']);
    $skills1 = implode(",",$skills);
  
    if(isset($_POST['native'])){
        $selected = $_POST['native'];
    }
   // $role = isset($_POST['role']) ? $_POST['role'] : '2'; 
    

  //  $image = file_get_contents($_FILES['uploadfile']['tmp_name']);

   // $escapedImage = $conn->real_escape_string($image);

   $sql = "insert into person_details(id,firstname,lastname,email,password,gender,native,skills,country,state,city,location) values('$id','$firstname','$lastname','$email','$hashedPassword','$gender','$native','$skills1','$country','$state','$city','$location')";
   $query = mysqli_query($conn,$sql);
   

   if ($query) {
   // echo "<script>alert('Successful');</script>";
    header("Location: login.php");
    exit();
} else {
    echo "Failed to submit";
}

  }
 ob_end_flush();
?>

