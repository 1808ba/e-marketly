$(function(){
    var nbre = 0
    // Exécuter la fonction chaque 3 secondes
    var interval = window.setInterval(rotateSlides, 5000); 

    // Faire tourner les images avec animation
    function rotateSlides(){
            var $firstSlide = $('#carousel').find('div:first');
            var width = $firstSlide.width();
            $firstSlide.animate({marginLeft: -width}, 1000, function(){
            
            var $lastSlide = $('#carousel').find('div:last');
            $lastSlide.after($firstSlide);
            $firstSlide.css({marginLeft: 0});
        });
    };

})    