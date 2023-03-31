<?php

include '../components/connect.php';

;
$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update'])){


   $category = $_POST['category'];
   $categorie = $_POST['categorie'];

   $update_category = $conn->prepare("UPDATE `categories` SET category = ? WHERE category = ?");
   $update_category->execute([$categorie,$category ]);

   $message[] = 'category updated successfully!';
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update category</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- update product section starts  -->

<section class="update-product">

   <h1 class="heading">update category</h1>
   <?php
      $update_id = $_GET['update'];
      $show_category = $conn->prepare("SELECT * FROM `categories` WHERE category = ?");
      $show_category->execute([$update_id]);
      if($show_category->rowCount() > 0){
         while($fetch_categories = $show_category->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <form action="" method="POST" enctype="multipart/form-data">
   
      <span>Old category</span>
      <input type="text" required name="category" maxlength="100" class="box" value="<?= $fetch_categories['category']; ?>">
      <span>New category</span>
      <input type="text" required placeholder="enter new category name" name="categorie" maxlength="100" class="box" >
      
      <div class="flex-btn">
         <input type="submit" value="update" class="btn" name="update">
         <a href="categorie.php" class="option-btn">go back</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">category updated</p>';
      }
   ?>

</section>

<!-- update product section ends -->



<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>