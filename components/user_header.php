<?php
if (isset($message)) {
   foreach ($message as $message) {
      echo '
         <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
   }
}
?>

<header class="header" style="height:80px;">

   <section class="flex" style="margin-bottom: 50px;">

      <a href="home.php" class="logo" style="margin-bottom: 40px; color: #F93D00; font-family: 'Allerta Stencil', Sans-serif; font-size:30px;">Marketly</a>

      <nav class="navbar">
         <a href="home.php">Home</a>
         <a>|</a>
         <a href="shop.php">Shop</a>
         <a>|</a>
         <a href="orders.php">Orders</a>
         <a>|</a>
         <a href="about.php">About us</a>
         <a>|</a>
         <a href="contact.php">Contact</a>
      </nav>

      <div class="icons" style="margin-bottom: 48px;">
         <?php
         $count_wishlist_items = $conn->prepare("SELECT count(*) count FROM `wishlist` WHERE user_id = ?");
         $count_wishlist_items->execute([$user_id]);
         $rs_count_wishlist_items = $count_wishlist_items->fetchAll();

         $count_cart_items = $conn->prepare("SELECT count(*) count FROM `cart` WHERE user_id = ?");
         $count_cart_items->execute([$user_id]);
         $rs_count_cart_items= $count_cart_items->fetchAll();

         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="search_page.php"><i class="fas fa-search"></i></a>
         <a href="wishlist.php"><i class="fas fa-heart"></i> <span id="count_wishlist_items"><?= $rs_count_wishlist_items[0]['count']; ?></span></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="count_cart_items"><?= $rs_count_cart_items[0]['count']; ?></span></a>
         <div id="user-btn" class="fas fa-user"></div>

      </div>

      <div class="profile" style=" border-color:aliceblue; margin-top: -60px; margin-right: -60px;">
         <?php
         $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_profile->execute([$user_id]);
         if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
            <p>Welcome <span class="special"> <?= $fetch_profile["name"]; ?> </span> </p>
            <a href="update_user.php" class="delete-btn" >Update profile</a>
            <a href="components/user_logout.php" class="btn" onclick="return confirm('logout from the website?');">Logout</a>
         <?php
         } else {
         ?>
            <p style="font-size: 18px;">Please Login or Register first!</p>
            <div class="flex-btn">
               <a href="user_login.php" class="btn">Sign in</a>
            </div>
            <div class="flex-btn">
               <a href="user_register.php" class="option-btn">Register</a>
            </div>
         <?php
         }
         ?>


      </div>

   </section>

</header>