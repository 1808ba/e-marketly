<?php

include 'components/connect.php';;

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

// include 'components/wishlist_cart.php';
include 'components/header.php';

?>


<section class="products">

   <h1 class="heading">Category</h1>

   <div class="box-container">

      <?php
      $category = $_GET['category'];
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE category = ?");
      $select_products->execute([$category]);
      if ($select_products->rowCount() > 0) {
         while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
      ?>
            <form action="" method="post" name="form-<?= $fetch_products['id']; ?>" class="box" style=" border-color: white; ">
               <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
               <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
               <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
               <input type="hidden" name="image" value="<?= $fetch_products['image_01']; ?>">
               <button class="fas fa-heart" type="button" onclick="to_wishlist('form-<?= $fetch_products['id']; ?>')" style="border-color: white; background-color: white; color: #FA6868 ;" name="add_to_wishlist"></button>
               <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" style="border-color: white; color: black; background-color: white;" class="fas fa-eye"></a>
               <img src="uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
               <div class="name"><?= $fetch_products['name']; ?></div>
               <div class="flex">
                  <div class="price" style=" color: #063970; "><span></span><strong><?= $fetch_products['price']; ?><span>.00 Dhs</span></strong></div>
               </div>
               <input type="button" onclick="to_cart('form-<?= $fetch_products['id']; ?>')" style="font-size: 18px; background-color: #FA6868;" value="Add to cart" class="btn" name="add_to_cart">
            </form>
      <?php
         }
      } else {
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>






      

   </div>

</section>


<?php include 'components/footer.php'; ?>



</body>

</html>