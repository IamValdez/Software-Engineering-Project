<?php
session_start();
//error_reporting(0);
include('faculty/includes/dbconnection.php');
    if(isset($_POST['submit']))
  {
 $Fname=$_POST['Fname'];
 $STid=$_POST['STid'];
  $mobnum=$_POST['phone'];
 $email=$_POST['email'];
 $appdate=$_POST['date'];
 $aaptime=$_POST['time'];
 $specialization=$_POST['specialization'];
  $facultylist=$_POST['facultylist'];
 $message=$_POST['message'];
 $aptnumber=mt_rand(100000000, 999999999);
 $cdate=date('Y-m-d');

if($appdate<=$cdate){
       echo '<script>alert("Appointment date must be greater than todays date")</script>';
} else {
$sql="insert into tblappointment(AppointmentNumber,StudentID,FullName,MobileNumber,Email,AppointmentDate,AppointmentTime,Specialization,Faculty,Message)values(:aptnumber,:STid, :Fname,:mobnum,:email,:appdate,:aaptime,:specialization,:facultylist,:message)";
$query=$dbh->prepare($sql);
$query->bindParam(':aptnumber',$aptnumber,PDO::PARAM_STR);
$query->bindParam(':Fname',$Fname,PDO::PARAM_STR);
$query->bindParam(':STid',$STid,PDO::PARAM_STR);
$query->bindParam(':mobnum',$mobnum,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':appdate',$appdate,PDO::PARAM_STR);
$query->bindParam(':aaptime',$aaptime,PDO::PARAM_STR);
$query->bindParam(':specialization',$specialization,PDO::PARAM_STR);
$query->bindParam(':facultylist',$facultylist,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);

 $query->execute();
   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    
    // echo "<script>alert($aptnumber)</script>";
    echo "<script>alert('{$aptnumber} Your appointment number.')</script>";
echo "<script>window.location.href ='index.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
}
}
?>
<!doctype html>
<html lang="en">
    <head>
        <title>
            Faculty AMS
        </title>
            <link rel="icon" href="images/title/logo.jpg">


        <!-- CSS FILES -->        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
        
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/owl.carousel.min.css" rel="stylesheet">

        <link href="css/owl.theme.default.min.css" rel="stylesheet">

        <link href="css/templatemo-medic-care.css" rel="stylesheet">
      
        <script>
function getfacultys(val) {
  //  alert(val);
$.ajax({

type: "POST",
url: "get_facultys.php",
data:'sp_id='+val,
success: function(data){
$("#facultylist").html(data);
}
});
}
</script>
    </head>
    
    <body id="top">
    
        <main>

            <?php include_once('includes/header.php');?>

            <section class="hero" id="hero">
                <div class="container">
                    <div class="row">

                        <div class="col-12">
                            <div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="images/slider/Slider-picture2.jpg" class="img-fluid" alt="">
                                    </div>

                                    <div class="carousel-item">
                                        <img src="images/slider/Slider-picture2.jpg" class="img-fluid" alt="">
                                    </div>

                                    <div class="carousel-item">
                                        <img src="images/slider/Slider-picture3.jpg" class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </section>

            <section class="section-padding" id="about">
                <div class="container">
                    <div class="row">

                    <div class="col-lg-6 col-md-6 col-12">
                            <?php
$sql="SELECT * from tblpage where PageType='aboutus'";
$query=$dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                            <h2 class="mb-lg-3 mb-3"><?php  echo htmlentities($row->PageTitle);?></h2>

                            <p><?php  echo ($row->PageDescription);?>.</p>

                           <?php $cnt=$cnt+1;}} ?>
                        </div>

                        <div class="col-lg-4 col-md-5 col-12 mx-auto">
  <div class="featured-circle bg-white shadow-lg d-flex justify-content-center align-items-center">
    <img src="images/slider/logo.jpg" alt="Years of Experience" class="featured-image" style="max-width: 100%; max-height: 100%;">
  </div>
</div>



                    </div>
                </div>
            </section>

<style>

.grid-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(3, 1fr));
  grid-gap: 20px;
  justify-items: center;
  align-items: center;
  padding: 20px;

}

.grid-container .title-grid-wrap{
  /* border: 1px solid red; */
  height: 100%;
  display: flex;
  justify-content: center;
   align-items: center;
   grid-column: 1 / span 3;

}

.grid-item {
  position: relative;
  overflow: hidden;
  width: 100%;

}

.grid-item img {
  width: 67%;
  height: auto;
  display: block;
  margin: 0 auto; /* this centers the image horizontally */
  transition: transform 0.3s ease;
  transform: scale(1);
}

.grid-item img:hover {
  transform: scale(1.1);
  transition: transform 0.3s ease;
}


.grid-item-content {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgba(255, 255, 255, 0.9);
  padding: 10px;
  text-align: center;
  transition: transform 0.3s ease;
  transform: translateY(100%);
}

.grid-item:hover .grid-item-content {
  transform: translateY(0%);
}

.grid-item-content h2 {
  font-size: 25px;
  margin: 0;
  color: var(--primary-color);
}


</style>
<div class="grid-container">
  <div class="title-grid-wrap">

    <H2 class="title-department">COLLEGE DEPARTMENT</H2>
  </div>
  <div class="grid-item">
    <a href="crimDepartment.php">
      <img src="images/gallery/CRIM.jpg" alt="Department 1">
    </a>
    <div class="grid-item-content">
      <h2>CRIMINOLOGY</h2>
    </div>
  </div>
  <div class="grid-item">
    <a href="itDepartment.php">
      <img src="images/gallery/IT.jpg" alt="Department 2">
    </a>
    <div class="grid-item-content">
      <h2>INFORMATION TECHNOLOGY</h2>
    </div>
  </div>
  <div class="grid-item">
    <a href="tourismDepartment.php">
      <img src="images/gallery/TOURISM.jpg" alt="Department 3">
    </a>
    <div class="grid-item-content">
      <h2>TOURISM</h2>
    </div>
  </div>
  <div class="grid-item">
    <a href="accountancyDepartment.php">
      <img src="images/gallery/BSA.jpg" alt="Department 4">
    </a>
    <div class="grid-item-content">
      <h2>ACCOUNTANCY</h2>
    </div>
  </div>
  <div class="grid-item">
    <a href="hmDepartment.php">
      <img src="images/gallery/HM.png" alt="Department 5">
    </a>
    <div class="grid-item-content">
      <h2>HOSPITALITY MANAGEMENT</h2>
    </div>
  </div>
  <div class="grid-item">
    <a href="educationDepartment.php">
      <img src="images/gallery/BSED.png" alt="Department 6">
    </a>
    <div class="grid-item-content">
      <h2>EDUCATION</h2>
    </div>
  </div>
</div>


<style>
.booking-form {
  padding: 30px;
  border: 3px solid #0099ff;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 153, 255, 0.5);
}

  .booking-form h2 {
  font-size: 28px;
  font-weight: 700;
  margin-bottom: 30px;
  text-transform: uppercase;
  letter-spacing: 2px;
  color: #0099ff;
  text-align: center;
}
</style>


            <section class="section-padding" id="booking">
                <div class="container">
                    <div class="row">
                    
                        <div class="col-lg-8 col-12 mx-auto">
                            <div class="booking-form">
                                
                                <h2 class="text-center mb-lg-3 mb-2">Book an Appointment</h2>
                            
                                <form role="form" method="post">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <input type="text" name="Fname" id="name" class="form-control" placeholder="Full name" required='true'>
                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address" required='true'>
                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <input type="text" name="STid" id="schoolID" class="form-control" placeholder="Student ID" required='true'>
                                        </div>
                                   
                                        <div class="col-lg-6 col-12">
                                            <input type="telephone" name="phone" id="phone" class="form-control" placeholder="Enter Phone Number" maxlength="10">
                                        </div>

                                        <div class="col-lg-6 col-12">
                                        <input type="date" name="date" id="date" value="" class="form-control">
                                            
                                        </div>

                                            <div class="col-lg-6 col-12">
                                            <input type="time" name="time" id="time" value="" class="form-control">
                                            
                                        </div>

    <div class="col-lg-6 col-12">
<select onChange="getfacultys(this.value);"  name="specialization" id="specialization" class="form-control" required>
<option value="">Select Department</option>
<!--- Fetching States--->
<?php
$sql="SELECT * FROM tblspecialization";
$stmt=$dbh->query($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while($row =$stmt->fetch()) { 
  ?>
<option value="<?php echo $row['ID'];?>"><?php echo $row['Specialization'];?></option>
<?php }?>
</select>
</div>


<div class="col-lg-6 col-12">
<select name="facultylist" id="facultylist" class="form-control">
<option value="">Select Faculty</option>
</select>
</div>



                                        <div class="col-12">
                                            <textarea class="form-control" rows="5" id="message" name="message" placeholder="Additional Message"></textarea>
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-6 mx-auto">
                                            <button type="submit" class="form-control" name="submit" id="submit-button">Submit Now</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </section>
         
         








        </main>
          <?php include_once('includes/footer.php');?>
        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/scrollspy.min.js"></script>
        <script src="js/custom.js"></script>
    </body>
</html>