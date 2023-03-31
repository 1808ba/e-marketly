<?php

include 'components/connect.php';

;

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:user_login.php');
};

if (isset($_POST['order'])) {

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $address = 'flat no. ' . $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code'];
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if ($check_cart->rowCount() > 0) {

      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price,placed_on) VALUES(?,?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price,date("Y-m-d")]);

      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);

      // $message[] = 'order placed successfully!';
   } else {
      // $message[] = 'your cart is empty';
   }
}
include 'components/header.php';
?>

   <section class="checkout-orders">

      <form action="" method="POST" style=" border-color: white;">

         <h3 style="background-color: #FA6868; font-size: 18px;">Your orders</h3>

         <div class="display-orders">
            <?php
            $grand_total = 0;
            $cart_items[] = '';
            $select_cart = $conn->prepare("SELECT * FROM `cart` c inner join products p on p.id = c.pid WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            if ($select_cart->rowCount() > 0) {
               while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                  $cart_items[] = $fetch_cart['name'] . ' (' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity'] . ') - ';
                  $total_products = implode($cart_items);
                  $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
            ?>
                  <p> <?= $fetch_cart['name']; ?> <span><strong style=" color: #063970; ">(<?= $fetch_cart['price'] . '.00 Dhs '; ?>)</strong></span></p>
            <?php
               }
            } else {
               echo '<p class="empty">your cart is empty!</p>';
            }
            ?>
            <input type="hidden" name="total_products" value="<?= $total_products; ?>">
            <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
            <div class="grand-total">Grand total : <span><strong style=" color: #063970; "><?= $grand_total; ?>.00 Dhs</span></div>
         </div>

         <h3 style="background-color: #FA6868; font-size: 18px;">Place your orders</h3>

         <div class="flex">
            <div class="inputBox">
               <span>Your name <span style=" color: red; "> *</span> :</span>
               <input type="text"  name="name" class="box" maxlength="20" required>
            </div>
            <div class="inputBox">
               <span>Your number <span style=" color: red; "> *</span> :</span>
               <input type="number"  name="number" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
            </div>
            <div class="inputBox">
               <span>Your email :</span>
               <input type="email"  name="email" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>Address line 01 <span style=" color: red; "> *</span> :</span>
               <input type="text"  name="flat" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>Address line 02 :</span>
               <input type="text"  name="street" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>City <span style=" color: red; "> *</span> :</span>
               <input type="text"  name="city" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>state <span style=" color: red; "> *</span> :</span>
               <input type="text"  name="state" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>country <span style=" color: red; "> *</span> :</span>
               <input type="text"  name="country" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>Pin code <span style=" color: red; "> *</span> :</span>
               <input type="number"  min="0" name="pin_code" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box" required>
            </div>
            <div class="inputBox">
               <span>Payment method <span style=" color: red; "> *</span> :</span>
               <select name="method" class="box" required  >
                  <option value="cash on delivery">Cash on delivery</option>
                  <option value="credit card">Credit card</option>
                  <option value="paytm">Paytm</option>
                  <option value="paypal">Paypal</option>
               </select>
            </div>

         </div>



         <input type="submit" name="order" style="font-size: 18px; background-color: #FA6868;" class="btn  <?= ($grand_total > 1) ? '' : 'disabled'; ?>" value="Place order">

      </form>
      <br></br>

   </section>


   <?php include 'components/footer.php'; ?>


</body>

</html>