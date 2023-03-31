<?php

include 'connect.php';

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};
if (isset($_POST['add_to_wishlist'])) {

   if ($user_id == '') {
      echo json_encode(array('success' => 0));
      // header('location:user_login.php');
   } else {

      $pid = $_POST['pid'];
      $check_wishlist_numbers = $conn->prepare("SELECT count(id) count FROM `wishlist` WHERE pid = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$pid, $user_id]);
      $rs_check_wishlist_numbers = $check_wishlist_numbers->fetchAll();

      // $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE pid = ? AND user_id = ?");
      // $check_cart_numbers->execute([$pid, $user_id]);

      if ($rs_check_wishlist_numbers[0]['count'] > 0) {
         echo json_encode(array('success' => 1, 'exist' => 1));
      } else {
         $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid) VALUES(?,?)");
         $insert_wishlist->execute([$user_id, $pid]);
         // $message[] = 'Added to wishlist!';

         $check_wishlist_numbers = $conn->prepare("SELECT count(id) count FROM `wishlist` WHERE user_id = ?");
         $check_wishlist_numbers->execute([$user_id]);
         $rs_check_wishlist_numbers = $check_wishlist_numbers->fetchAll();
         echo json_encode(array('success' => 1, 'exist' => 0, 'total' => $rs_check_wishlist_numbers[0]['count']));
      }
   }
}

if (isset($_POST['add_to_cart'])) {

   if ($user_id != '') {
      $pid = $_POST['pid'];
      $price = $_POST['price'];
      $qty = isset($_POST['qty']) ? $_POST['qty'] : 1;

      $check_cart_numbers = $conn->prepare("SELECT quantity FROM `cart` WHERE pid = ? AND user_id = ?");
      $check_cart_numbers->execute([$pid, $user_id]);
      $rs_check_cart_numbers = $check_cart_numbers->fetchAll();

      if ($check_cart_numbers->rowCount() > 0) {
         $update_cart = $conn->prepare("update `cart` set quantity = ? where user_id = ? and  pid = ?");
         $update_cart->execute([$qty + $rs_check_cart_numbers[0]["quantity"], $user_id, $pid]);
         echo json_encode(array('success' => 1, 'type' => 'update', 'quantity' => $rs_check_cart_numbers[0]["quantity"]));
      } else {

         $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE pid = ? AND user_id = ?");
         $check_wishlist_numbers->execute([$pid, $user_id]);

         // if ($check_wishlist_numbers->rowCount() > 0) {
         //    $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
         //    $delete_wishlist->execute([$name, $user_id]);
         // }

         $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, quantity) VALUES(?,?,?)");
         $insert_cart->execute([$user_id, $pid, $qty]);
         // $message[] = 'Added to cart!';

         $total_in_cart = $conn->prepare("SELECT count(*) cnt FROM `cart` WHERE user_id = ?");
         $total_in_cart->execute([$user_id]);
         $rs_total_in_cart = $total_in_cart->fetchAll();
         echo json_encode(array('success' => 1, 'type' => 'add', 'total' => $rs_total_in_cart[0]["cnt"]));
      }
   } else {
      echo json_encode(array('success' => 0));
      // header('location:../user_login.php');
   }
}
