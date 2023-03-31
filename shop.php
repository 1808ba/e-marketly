<?php

include 'components/connect.php';



if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

// include 'components/wishlist_cart.php';
include 'components/header.php';
?>





<section class="products">
<div class="banner-shop" style="margin-top: 15px; margin-left: 140px; height:100%;">
   <a href="shop.php" class="banner-link">
      <figure><img src="assets/images/shop-banner.jpg" alt=""></figure>
   </a>
</div>
   <h1 class="heading">latest products</h1>

   <div class="box-container" style=" border-color: white; ">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products`"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" name="form-<?= $fetch_product['id']; ?>" class="box" style=" border-color: white;" >
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="button" onclick="to_wishlist('form-<?= $fetch_product['id']; ?>')" style="border-color: white; background-color: white; color: #FA6868 ;" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" style="border-color: white; color: black; background-color: white;" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
      <div class="price" style=" color: #063970; "><span></span><strong><?= $fetch_product['price']; ?><span>.00 Dhs</span></strong></div>
         <input type="number" name="qty" class="qty" style=" color: white; text-align: center; color: white; border-color: white;"  min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="button" onclick="to_cart('form-<?= $fetch_product['id']; ?>')" style="font-size: 18px; background-color: #FA6868;" value="Add to cart" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products found!</p>';
   }
   ?>

   </div>

</section>



<?php include 'components/footer.php'; ?>



</body>
</html>