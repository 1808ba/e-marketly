<?php

include 'components/connect.php';



if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:user_login.php');
};

// include 'components/wishlist_cart.php';

if (isset($_POST['delete'])) {
   $wishlist_id = $_POST['wishlist_id'];
   $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist_item->execute([$wishlist_id]);
}

if (isset($_GET['delete_all'])) {
   $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
   $delete_wishlist_item->execute([$user_id]);
   header('location:wishlist.php');
}
include 'components/header.php';
?>



<section class="products">

   <h3 class="heading">Your wishlist</h3>

   <div class="box-container">

      <?php
      $grand_total = 0;
      $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` w inner join products p on w.pid = p.id WHERE user_id = ?");
      $select_wishlist->execute([$user_id]);
      if ($select_wishlist->rowCount() > 0) {
         while ($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)) {
            $grand_total += $fetch_wishlist['price'];
      ?>
            <form action="" method="post" class="box" style=" border-color: white;" name="form-<?= $fetch_wishlist['pid'];?>">
               <input type="hidden" name="pid" value="<?= $fetch_wishlist['pid']; ?>">
               <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id']; ?>">
               <a href="quick_view.php?pid=<?= $fetch_wishlist['pid']; ?>" style="border-color: white; color: black; background-color: white;" class="fas fa-eye"></a>

               <img src="uploaded_img/<?= $fetch_wishlist['image_01']; ?>" alt="">
               <div class="name"><?= $fetch_wishlist['name']; ?></div>
               <div class="flex">
                  <div class="price" style=" color: #063970; "><span></span><strong><?= $fetch_wishlist['price']; ?><span>.00 Dhs</span></strong></div>

               <input type="number" name="qty" class="qty" min="1" max="99" style=" border-color:white; color: white; " onkeypress="if(this.value.length == 2) return false;" value="1">
               </div>
               <input type="submit" style="font-size: 18px; background-color: #FA6868;" value="Add to cart" class="btn" name="add_to_cart" onclick="to_cart('form-<?= $fetch_wishlist['pid']; ?>')">
               <input type="submit" style="font-size: 18px; color: white;" value="Delete item" onclick="return confirm('delete this from wishlist?');" class="delete-btn" name="delete">
            </form>
      <?php
         }
      } else {
         echo '<p class="empty">your wishlist is empty</p>';
      }
      ?>
      <div class="wishlist-total">
         <p>Grand total : <span><strong><?= $grand_total; ?><span>.00 Dhs</span></strong></span></p>


         <a href="shop.php" style="font-size: 18px; background-color: #38b04a;" class="option-btn">Continue shopping</a>
         <a href="wishlist.php?delete_all" style="font-size: 18px; background-color: #FA6868;" class="delete-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm('delete all from wishlist?');">Delete all item</a>
      </div>
   </div>



</section>

<br></br>

<?php include 'components/footer.php'; ?>

</body>

</html>