<?php

include 'components/connect.php';


if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $email = $_POST['email'];

   $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
   $update_profile->execute([$name, $email, $user_id]);

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $prev_pass = $_POST['prev_pass'];
   $old_pass = sha1($_POST['old_pass']);
   $new_pass = sha1($_POST['new_pass']);
   $cpass = sha1($_POST['cpass']);

   if($old_pass == $empty_pass){
      // $message[] = 'please enter old password!';
   }elseif($old_pass != $prev_pass){
      // $message[] = 'old password not matched!';
   }elseif($new_pass != $cpass){
      // $message[] = 'confirm password not matched!';
   }else{
      if($new_pass != $empty_pass){
         $update_admin_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
         $update_admin_pass->execute([$cpass, $user_id]);
         // $message[] = 'password updated successfully!';
      }else{
         // $message[] = 'please enter a new password!';
      }
   }
   
}
include 'components/header.php';
?>

<br></br>
<section class="form-container">

   <form action="" method="post" >
      <h3>update now</h3>
      <!-- <input type="hidden" name="prev_pass" value="<?= $fetch_profile["password"]; ?>"> -->
      <input type="text" readonly name="name" required placeholder="Enter your username"  class="box" value="<?= $fetch_profile["name"]; ?>">
      <input type="email" readonly name="email" required placeholder="Enter your email"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile["email"]; ?>">
      <input type="password" name="old_pass" placeholder="Enter your old password"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" placeholder="Enter your new password"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" placeholder="Confirm your new password"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" style="font-size: 18px; background-color: #FA6868;" value="Update now" class="btn" name="submit">
   </form>

</section>

<?php include 'components/footer.php'; ?>



</body>
</html>