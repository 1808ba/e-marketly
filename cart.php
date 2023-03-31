<?php

include 'components/connect.php';;

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:user_login.php');
};

if (isset($_POST['delete'])) {
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
}

if (isset($_GET['delete_all'])) {
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   header('location:cart.php');
}

if (isset($_POST['update_qty'])) {
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   // $message[] = 'cart quantity updated';
}
include 'components/header.php';
?>



<section class="products shopping-cart">

   <h3 class="heading">Shopping cart</h3>

   <div class="box-container">

      <?php
      $grand_total = 0;
      $select_cart = $conn->prepare("SELECT c.id,p.id pid,p.image_01,p.name,p.price,c.quantity FROM cart c inner join products p on c.pid = p.id WHERE user_id = ?");
      $select_cart->execute([$user_id]);
      if ($select_cart->rowCount() > 0) {
         while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
      ?>
            <form action="" method="post" class="box" style=" border-color: white;">
               <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
               <a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>" style="border-color: white; color: black; background-color: white;" class="fas fa-eye"></a>
               <img src="uploaded_img/<?= $fetch_cart['image_01']; ?>" alt="">
               <div class="name"><?= $fetch_cart['name']; ?></div>
               <div class="flex">
                  <div class="price" style=" color: #063970; "><span></span><strong><?= $fetch_cart['price']; ?><span>.00 Dhs</span></strong></div>
                  <div class="price" style=" color: #063970; "><span></span><strong><?= $fetch_cart['quantity']; ?> pcs</strong></div>

                   <!-- <input type="number" name="qty" style="font-size: 18px;"  min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cart['quantity']; ?>"> -->
        <!-- <button type="submit" class="fas fa-edit" name="update_qty"></button> -->
               </div>
               <div class="sub-total"> Total : <span style=" color: #063970; "><strong><?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?><span style=" color: #063970; ">.00 Dhs</span></strong></span> </div>
               <input type="submit" value="Delete item" style="font-size: 18px; background-color: #FA6868;" onclick="return confirm('delete this from cart?');" class="delete-btn" name="delete">
            </form>
      <?php
            $grand_total += $sub_total;
         }
      } else {
         echo '<p class="empty">your cart is empty</p>';
      }
      ?>
      <div class="cart-total" style=" border-color: white; ">
         <p>Total :
            <span style=" color: #063970; "><strong><?= $grand_total; ?><span style=" color: #063970; ">.00 Dhs</span></strong></span>
         </p>

         <a href="shop.php" class="option-btn" style="font-size: 18px; background-color: #FA6868; color: white;">Continue shopping</a>
         <a href="cart.php?delete_all" style="font-size: 18px; background-color: #38b04a; color: white;" class="delete-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm('delete all from cart?');">Delete all item</a>
         <a href="checkout.php" style="font-size: 18px; background-color: #365db5; color: white;" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to checkout</a>
      </div>
   </div>



</section>













<?php include 'components/footer.php'; ?>


</body>

</html>