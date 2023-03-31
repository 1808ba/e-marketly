<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<header class="header">

   <section class="flex">

      <a href="../provider/dashboard.php" class="logo">Provider<span>Panel</span></a>

      <nav class="navbar">
         <a href="../provider/dashboard.php">home</a>
         <a href="../provider/products.php">products</a>
         <a href="../provider/add_products.php">add products</a>
         <!-- <a href="../admin/admin_accounts.php">admins</a> -->
         <!-- <a href="../admin/users_accounts.php">users</a> -->
         <!-- <a href="../provider/messages.php">messages</a>  -->
         
         <!-- <a href="../admin/dashboard.php"> Accueil</a>
         <a href="../admin/products.php">produits</a>
         <a href="../admin/placed_orders.php">ordres</a>
         <a href="../admin/admin_accounts.php">administrateurs</a>
         <a href="../admin/users_accounts.php">utilisateurs</a>
         <a href="../admin/users_accounts.php">fournisseur</a>
         <a href="../admin/messages.php">messages</a> -->

      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            // $select_profile = $conn->prepare("SELECT * FROM `provider` WHERE id_pro = ?");
            // $select_profile->execute();
            // $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p>Provider</p>
        <!-- <a href="../admin/update_profile.php" class="btn">update profile</a> -->
         <div class="flex-btn">
            <a href="../admin/user_register.php" class="option-btn">register like user</a>
            <a href="../admin/user_login.php" class="option-btn">login like user</a>
         </div>
         <a href="../components/admin_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
         <!-- <a href="../admin/update_profile.php" class="btn">modifier profile</a>
         <div class="flex-btn">
            <a href="../admin/register_admin.php" class="option-btn">S'inscrire</a>
            <a href="../admin/admin_login.php" class="option-btn">se connecter</a>
         </div>
         <a href="../components/admin_logout.php" class="delete-btn" onclick="return confirm('se déconnecter du site ?');">se déconnecter</a> 
       -->
      
      </div>

   </section>

</header>