<?php

include 'components/connect.php';

;

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

include 'components/header.php';
?>



   <section class="about">

      <div class="row">

         <div class="image">
            <img src="images/marketly.png" alt="">
         </div>

         <div class="content">
            <h3>why choose us?</h3>
            <p>
               Marketly is an e-commerce platform dedicated to providing high-quality products for discerning shoppers. We are a family-owned business that is committed to providing an exceptional and enjoyable online shopping experience. We take pride in offering a wide range of products, from household essentials to fashion items, toys, and sporting goods.

               Our commitment to quality is unwavering, we ensure that all products we sell meet high standards. We work closely with our suppliers to ensure that products are ethically and sustainably manufactured.

               Our team is made up of experienced professionals who are passionate about what they do and are dedicated to providing top-notch customer service. We are here to assist you every step of the way, from product selection to delivery and after-sales service.

               We believe that you will enjoy your shopping experience on Marketly. We invite you to browse our website to discover our products and to contact us if you have any questions or comments. We look forward to serving you! </p>
            <a href="contact.php" class="btn">contact us</a>
         </div>

      </div>

   </section>









   <?php include 'components/footer.php'; ?>

   
   <script>
      var swiper = new Swiper(".reviews-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            0: {
               slidesPerView: 1,
            },
            768: {
               slidesPerView: 2,
            },
            991: {
               slidesPerView: 3,
            },
         },
      });
   </script>

</body>

</html>