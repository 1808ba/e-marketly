<?php

include 'components/connect.php';

;

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

// include 'components/wishlist_cart.php';
include 'components/header.php';
?>



<section class="quick-view">

   <?php
     $pid = $_GET['pid'];
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?"); 
     $select_products->execute([$pid]);
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" name="form-<?= $fetch_product['id']; ?>" class="box" style=" border-color: white; ">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <div class="row">
         <div class="image-container">
            <div class="main-image">
               <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
            </div>
            <div class="sub-image">
               <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
               <img src="uploaded_img/<?= $fetch_product['image_02']; ?>" alt="">
               <img src="uploaded_img/<?= $fetch_product['image_03']; ?>" alt="">
            </div>
         </div>
         <div class="content">
            <div class="name"><?= $fetch_product['name']; ?></div>
            <div class="flex">
            <div class="price" style=" color: #063970; "><span></span><strong><?= $fetch_product['price']; ?><span>.00 Dhs</span></strong></div>

               <input type="number" name="qty" class="qty" style="color: white; border-color: white;" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
            </div>
            <div class="details"><?= $fetch_product['details']; ?></div>
            <div class="flex-btn">
               <input type="button" onclick="to_cart('form-<?= $fetch_product['id']; ?>')" value="Add to cart"  class="btn" name="add_to_cart">
               <input class="btn option-btn" onclick="to_wishlist('form-<?= $fetch_product['id']; ?>')" type="button"  name="add_to_wishlist" value="Add to wishlist">
            </div>
         </div>
      </div>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

</section>





<?php include 'components/footer.php'; ?>


</body>
</html>