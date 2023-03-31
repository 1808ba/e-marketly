let navbar = document.querySelector('.header .flex .navbar');
let profile = document.querySelector('.header .flex .profile');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   navbar.classList.remove('active');
   profile.classList.remove('active');
}

let mainImage = document.querySelector('.quick-view .box .row .image-container .main-image img');
let subImages = document.querySelectorAll('.quick-view .box .row .image-container .sub-image img');

subImages.forEach(images =>{
   images.onclick = () =>{
      src = images.getAttribute('src');
      mainImage.src = src;
   }
});

function to_cart(form) {
   var formData = {
      pid: $("form[name='" + form + "'] [name='pid']").val(),
      name: $("form[name='" + form + "'] [name='name']").val(),
      price: $("form[name='" + form + "'] [name='price']").val(),
      image: $("form[name='" + form + "'] [name='image']").val(),
      qty: $("form[name='" + form + "'] [name='qty']").val(),
      add_to_cart: $("form[name='" + form + "'] [name='add_to_cart']").val()
   };
   $.ajax({
      type: "POST",
      url: "components/wishlist_cart.php",
      data: formData,
      // encode: true,
      success: function(data) {
         console.log(data);
         json = JSON.parse(data);
         if (json.success == 0) {
            console.log("false");
            window.location.href = '../e-marketly/user_login.php';
         }
         if(json.success == 1 && json.type == 'add'){
            $("#count_cart_items").html(json.total);
         }

      }
   })
}


function to_wishlist(form) {
   var formData = {
      pid: $("form[name='" + form + "'] [name='pid']").val(),
      name: $("form[name='" + form + "'] [name='name']").val(),
      price: $("form[name='" + form + "'] [name='price']").val(),
      image: $("form[name='" + form + "'] [name='image']").val(),
      qty: $("form[name='" + form + "'] [name='qty']").val(),
      add_to_wishlist: $("form[name='" + form + "'] [name='add_to_wishlist']").val()
   };
   $.ajax({
      type: "POST",
      url: "components/wishlist_cart.php",
      data: formData,
      // encode: true,
      success: function(data) {
         console.log(data);
         json = JSON.parse(data);
         if (json.success == 0) {
            console.log("false");
            window.location.href = '../e-marketly/user_login.php';
         }
         if(json.success == 1 && json.exist == 0){
            $("#count_wishlist_items").html(json.total);
         }

      }
   })

}