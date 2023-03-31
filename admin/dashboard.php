<?php

include '../components/connect.php';

;

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
<br></br>
<section class="dashboard">

   <h1 class="heading">Dashboard</h1>
   <hr>
   <br></br>
   <div class="box-container">

      <div class="box">
         <h3>Welcome!</h3>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn option-btn">Update profile</a>
      </div>

      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pendings = $conn->prepare("SELECT sum(total_price) sum FROM `orders` WHERE payment_status = ?");
            $select_pendings->execute(['pending']);
            $rs_select_pendings = $select_pendings->fetchAll();
         ?>
         <h3><span> - </span><?= $rs_select_pendings[0]['sum']; ?><span>.00 DH - </span></h3>
         <p>Total pendings</p>
         <a href="placed_orders.php" class="btn">See orders</a>
      </div>

      <div class="box">
         <?php
            $total_completes = 0;
            $select_completes = $conn->prepare("SELECT sum(total_price) sum FROM `orders` WHERE payment_status = ?");
            $select_completes->execute(['completed']);
            $rs_select_completes = $select_completes->fetchAll();
         ?>
         <h3><span>- </span><?= $rs_select_completes[0]['sum']; ?><span>.00 DH -</span></h3>
         <p>Completed orders</p>
         <a href="placed_orders.php" class="btn">See orders</a>
      </div>

      <div class="box">
         <?php
            $select_orders = $conn->prepare("SELECT count(*) count FROM `orders`");
            $select_orders->execute();
            $rs_select_orders= $select_orders->fetchAll();
         ?>
         <h3><?= $rs_select_orders[0]['count']; ?></h3>
         <p>Orders placed</p>
         <a href="placed_orders.php" class="btn">See orders</a>
      </div>

      <div class="box">
         <?php
            $select_products = $conn->prepare("SELECT count(*) count FROM `products`");
            $select_products->execute();
            $number_of_products = $select_products->fetchAll();
         ?>
         <h3><?= $number_of_products[0]['count']; ?></h3>
         <p>products added</p>
         <a href="products.php" class="btn">See products</a>
      </div>

      <div class="box">
         <?php
            $select_categorie = $conn->prepare("SELECT count(*) count FROM `categories`");
            $select_categorie->execute();
            $number_of_categorie = $select_categorie->fetchAll();
         ?>
         <h3><?= $number_of_categorie[0]['count']; ?></h3>
         <p>Categorie added</p>
         <a href="categorie.php" class="btn">See categorie</a>
      </div>

      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT count(*) count FROM `users`");
            $select_users->execute();
            $number_of_users = $select_users->fetchAll();
         ?>
         <h3><?= $number_of_users[0]['count']; ?></h3>
         <p>Normal users</p>
         <a href="users_accounts.php" class="btn">See users</a>
      </div>


      <div class="box">
         <?php
            $select_admins = $conn->prepare("SELECT count(*) count FROM `admins`");
            $select_admins->execute();
            $number_of_admins = $select_admins->fetchAll();
         ?>
         <h3><?= $number_of_admins[0]['count']; ?></h3>
         <p>Admin users</p>
         <a href="admin_accounts.php" class="btn">See admins</a>
      </div>

      <div class="box">
         <?php
            $select_messages = $conn->prepare("SELECT count(*) count FROM `messages`");
            $select_messages->execute();
            $number_of_messages = $select_messages->fetchAll()
         ?>
         <h3><?= $number_of_messages[0]['count']; ?></h3>
         <p>New messages</p>
         <a href="messages.php" class="btn">See messages</a>
      </div>

   </div>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>