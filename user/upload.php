 <!DOCTYPE html>
 <html lang="en">

 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AYAYA | Ticket</title>

    <!--  swiper css link -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/style.css">
 </head>

 <body>

    <!--header section starts  -->
    <section class="header">
       <a href="home.php" class="logo">Ayaya</a>
       <nav class="navbar">
          <a href="home.php">home</a>
          <a href="about.php">about</a>
          <a href="destination.php">destination</a>
          <a href="booking.php">book</a>
          <a class="active" href="ticket.php">ticket</a>
          <a class="act" href="logout.php">log out</a>
       </nav>
       <div id="menu-btn" class="fas fa-bars"></div>
    </section>

    <!--    header section ends  -->
    <section class="home">
       <div class="slide" style="background:url(../images/bg1.jpg) no-repeat">
          <div class="card ">
             <div class="booking">
                <h1 class="heading-title">Upload ticket</h1>

                <form action="upload.php" method="POST" class="book-form" enctype="multipart/form-data">
                   <div class="flex">
                      <div class="inputBox">
                         <input type="file" value="" name="file_name">
                      </div>
                      <input type="submit" value="Add Ticket" class="btn" name="upload">
                   </div>
                </form>
             </div>
          </div>
       </div>
    </section>
    <!--  booking section ends -->
    <!-- footer section starts -->
    <?php
      require 'footer.php';
      ?>
    <!-- footer section ends -->

    <!-- swiper js link -->
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    <!-- custom js file link -->
    <?php /* echo "<script> alert('$statusMsg');</script>";  */ ?>
    <script src="../js/script.js"> </script>


    <?php
      include_once 'config.php';

      $statusMsg = '';

      //file upload path
      $targetDir  = "../uploads/";
      $fileName = basename($_FILES["file_name"]["name"]);
      $targetFilePath = $targetDir . $fileName;
      $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

      if (isset($_POST['upload']) && !empty($_FILES["file_name"]["name"])) {

         //Allow certain file formats
         $allowTypes =  array('jpg', 'png', 'jpeg', 'gif');

         if (in_array($fileType, $allowTypes)) {

            //upload file to server
            if (move_uploaded_file($_FILES['file_name']['tmp_name'], $targetFilePath)) {

               //insert image file name iinto database
               $insert = $connection->query("INSERT INTO images (file_name,uploaded_on)
                         VALUES ('" . $fileName . "', NOW())");


               if ($insert) {
                  $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
               } else {
                  $statusMsg = 'File upload failed, please try again.';
               }
            } else {
               $statusMsg = "Sorry, there was an error uploading your file.";
            }
         } else {
            $statusMsg = "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.";
         }
      } else {
         $statusMsg = "Please select a file to upload.";
      }

      echo "<script>  alert('$statusMsg');  </script>";

      ?>

 
 </body>


 </html>