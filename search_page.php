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


<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search_box" style=" border-color: white; " placeholder="Search here..." maxlength="100" class="box" required>
      <button type="submit" class="fas fa-search" style=" background-color: #FA6868; " name="search_btn"></button>
   </form>
</section>

<section class="products" style="padding-top: 0; min-height:100vh; ">

   <div class="box-container">

   <?php
     if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
     $search_box = $_POST['search_box'];
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search_box}%'"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" name="form-<?= $fetch_product['id']; ?>" method="post" class="box" style=" border-color: white;">
               <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
               <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
               <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
               <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
               <button class="fas fa-heart" onclick="to_wishlist('form-<?= $fetch_product['id']; ?>')" style="border-color: white; background-color: white; color: #FA6868 ;" type="button" name="add_to_wishlist"></button>
               <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" style="border-color: white; color: black; background-color: white;" class="fas fa-eye"></a>
               <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
               <div class="name"><?= $fetch_product['name']; ?></div>
               <div class="flex">
                  <div class="price" style=" color: #063970; "><span></span><strong><?= $fetch_product['price']; ?><span>.00 Dhs</span></strong></div>
                  <input type="number" name="qty" style="  text-align: center; border-color: white;" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
               </div>
               <input type="button" onclick="to_cart('form-<?= $fetch_product['id']; ?>')" value="Add to cart" class="btn btn-add-cart" name="add_to_cart">
            </form>
   <?php
         }
      }else{
         echo '<p class="empty">no products found!</p>';
      }
   }
   ?>


   </div>

</section>



<?php include 'components/footer.php'; ?>


</body>
</html>