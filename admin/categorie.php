<?php

include '../components/connect.php';

;

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_user = $conn->prepare("DELETE FROM `categories` WHERE category = ?");
   $delete_user->execute([$delete_id]);
   $delete_orders = $conn->prepare("DELETE FROM `products` WHERE category = ?");
   $delete_orders->execute([$delete_id]);

   header('location:categorie.php');
}


if(isset($_POST['add_categorie'])){

    $titre = $_POST['titre'];
 
    $select_categorie = $conn->prepare("SELECT * FROM `categories` WHERE category = ?");
    $select_categorie->execute([$titre]);
 
    if($select_categorie->rowCount() > 0){
       $message[] = 'Categorie title already exist!';
    }else{
 
       $insert_categorie = $conn->prepare("INSERT INTO `categories`(category) VALUES(?)");
       $insert_categorie->execute([$titre]);
 
 
       }
 
    };

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin accounts</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="accounts">
<br></br>
   <h1 class="heading">categorie accounts</h1>
   <!-- <h1 class="heading">comptes administrateur</h1> -->

   <div class="box-container">

   <div class="box">
      <p>Add new category</p>

      <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <!-- <p>categorie title</p> -->
            <input type="text" class="box" required maxlength="100" placeholder="Category title" name="titre">
         </div>
      </div>
      
      <input type="submit" value="add categorie" class="btn" name="add_categorie">
   </form>
       </div>

   <?php
      $select_accounts = $conn->prepare("SELECT * FROM `categories`");
      $select_accounts->execute();
      if($select_accounts->rowCount() > 0){
         while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
   ?>
     
   <div class="box">
      <!-- <p> categorie id : <span><?= $fetch_accounts['id_cat']; ?></span> </p> -->
      <p> Categorie title : <strong><span><?= $fetch_accounts['category']; ?></span></strong> </p>
      <div class="flex-btn">
      <a href="update_categories.php?update=<?= $fetch_accounts['category'];?>" class="option-btn">Update</a>
         <a href="categorie.php?delete=<?= $fetch_accounts['category']; ?>" onclick="return confirm('delete this account?')" class="delete-btn">delete</a>
      
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no categories available!</p>';
        //  echo '<p class="empty">aucun compte disponible !</p>';
      }
   ?>

   </div>

</section>


<script src="../js/admin_script.js"></script>
   
</body>
</html>