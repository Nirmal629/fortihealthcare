
// Navbar & Active and Submenu Start
jQuery(document).ready(function () {
    //main Menu
    jQuery("#open_Sidebar").click(function () {
        jQuery(".menubar_box").toggleClass("open");
        jQuery(".responsivemenubar_btn").toggleClass("on");
    });
    //End

    //Sub Menu
    jQuery(".navber_wrap li .icon").click(function () {
        jQuery(this)
            .toggleClass("active")
            .next(".navber_wrap li ul")
            .slideToggle()
            .parent()
            .siblings()
            .find(".navber_wrap li ul")
            .slideUp()
            .prev()
            .removeClass("active");
    });
    //End
})
// Navbar & Active and Submenu End


//Hero banner slider
jQuery('.herobanner_slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    infinite: true,
    autoplay: true,
    dots: true,
    autoplaySpeed: 2000,
});


//Header Sticky
window.onscroll = function () { myheaderFunction() };
function myheaderFunction() {
    var header = document.querySelector(".custom-old-header");
    if (header) {
        if (window.pageYOffset > 60) {
            header.classList.add("sticky");
            document.body.style.paddingTop = header.offsetHeight + 'px';
        } else {
            header.classList.remove("sticky");
            document.body.style.paddingTop = '0';
        }
    }
}


//Scroll to top 
if (jQuery('.return-to-top').length) {
    var scrollTrigger = 150,
        backToTop = function () {
            var scrollTop = jQuery(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                jQuery('.return-to-top').addClass('show');
            } else {
                jQuery('.return-to-top').removeClass('show');
            }
        };
    backToTop();
    jQuery(window).on('scroll', function () {
        backToTop();
    });
    jQuery('.return-to-top').on('click', function (e) {
        e.preventDefault();
        jQuery('html,body').animate({
            scrollTop: 0
        }, 700);
    });
}



//////product deatails page
const imgs = document.querySelectorAll('.img-select a');
const imgBtns = [...imgs];
let imgId = 1;

imgBtns.forEach((imgItem) => {
    imgItem.addEventListener('click', (event) => {
        event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();
    });
});

function slideImage(){
    const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

    document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
}

window.addEventListener('resize', slideImage);

