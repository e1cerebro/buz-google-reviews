jQuery(document).ready(function($) {

    console.log("hey");
    $('.more').readmore({
        speed: 300,
        collapsedHeight: 100,
        moreLink: '<a href="#">Read more &gt;</a>',
        lessLink: '<a href="#">Read less</a>',
        heightMargin: 16
    });
});