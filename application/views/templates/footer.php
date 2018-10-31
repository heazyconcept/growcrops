<footer class="footer">
<div class="footer-top">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h2 class="footer-title">About Growcrops Online</h2>

                <p class="foot-about">We are a team of professionals in the agriculture, insurance, IT and legal community dedicated to advancing massive wealth creation through the involvement of as many people as possible in agriculture</p>

            </div><!-- /.col-* -->

            <div class="col-sm-4">
                <h2 class="footer-title">Contact Information</h2>

                <ul class="contact-info">
              <li><i class="fa fa-map-marker"></i> <span>A 1 Spaces, Suite 203E, City Hall<br> Catholic Mission Street, <br>Island, Lagos</span></li>
              <li><i class="fa fa-phone"></i> <span>+234 902 405 7439</span>, <span>+234 802 269 4139</span> </li>
              <li><i class="fa fa-envelope-o"></i> <span>info@growcropsonline.com</span></li>
            </ul>
            </div><!-- /.col-* -->

            <div class="col-sm-4">
                <h2 class="footer-title">Useful Links </h2>

                <ul class="footer-links">
                    <li><a href="<?php echo base_url('/home/crops'); ?>">Crops</a></li>
                    <li><a href="<?php echo base_url('home/terms_and_condition'); ?>">Terms and Conditions</a></li>
                    <li><a href="<?php echo base_url("/home/faq"); ?>">Faqs</a></li>
                    <li><a href="<?php echo base_url("/home/about_us"); ?>">About Us</a></li>
                    <li><a href="<?php echo base_url('/home/contact_us'); ?>">Contact us</a></li>
                </ul><!-- /.header-nav-social -->
            </div><!-- /.col-* -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.footer-top -->

<div class="footer-bottom">
    <div class="container">
        <div class="footer-bottom-left">
            &copy; 2018 Grow Crops Online, All rights reserved.
        </div><!-- /.footer-bottom-left -->

        <div class="footer-bottom-right">
          <ul class="social-links nav nav-pills">
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
              <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
              <li><a href="#"><i class="fa fa-instagram"></i></a></li>
              <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
          </ul><!-- /.header-nav-social -->
        </div><!-- /.footer-bottom-right -->
    </div><!-- /.container -->
</div>
</footer><!-- /.footer -->

</div><!-- /.page-wrapper -->
<script type='text/javascript' src="<?php echo asset_url('js/map.js'); ?>"></script>

<script type='text/javascript' src="<?php echo asset_url('js/collapse.js'); ?>"></script>
<script type='text/javascript' src="<?php echo asset_url('js/carousel.js'); ?>"></script>
<script type='text/javascript' src="<?php echo asset_url('js/transition.js'); ?>"></script>
<script type='text/javascript' src="<?php echo asset_url('js/tooltip.js'); ?>"></script>
<script type='text/javascript' src="<?php echo asset_url('js/tab.js'); ?>"></script>
<script type='text/javascript' src="<?php echo asset_url('js/alert.js'); ?>"></script>

<script type='text/javascript' src="<?php echo asset_url('js/jquery.colorbox-min.js'); ?>"></script>

<script type='text/javascript' src="<?php echo asset_url('js/jquery.flot.min.js'); ?>"></script>
<script type='text/javascript' src="<?php echo asset_url('js/jquery.flot.spline.js'); ?>"></script>




<script type='text/javascript' src="<?php echo asset_url('js/owl.carousel.js'); ?>"></script>
<script type='text/javascript' src="<?php echo asset_url('js/slick.js'); ?>"></script>
<script type='text/javascript' src="<?php echo asset_url('js/fileinput.min.js'); ?>"></script>
<script type='text/javascript' src="<?php echo asset_url('js/selectize.min.js'); ?>"></script>
<script type='text/javascript' src="<?php echo asset_url('js/superlist.js'); ?>"></script>
<script type='text/javascript' src="<?php echo asset_url('js/jquery.rotapie.js'); ?>"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
$(document).ajaxStart(function() {
       Pace.restart();
});
$(document).ready(function () {

  $('.banner-lists').slick({
    infinite: true,
 slidesToShow: 1,
 slidesToScroll: 1,
 dots: true,
  speed: 500,
  fade: true,
  cssEase: 'linear',
  arrows: true,
  autoplay:true,
  autoplaySpeed:3000,
   adaptiveHeight: true,
  prevArrow: '<i class="fa slide-nav slide-prev fa-arrow-circle-left"></i>',
  nextArrow: '<i class="fa slide-nav slide-next fa-arrow-circle-right"></i>'
  });
  $('.brand-lists').slick({
    infinite: true,
 slidesToShow: 4,
 slidesToScroll: 1,
 dots: false,
  speed: 500,
  arrows: false,
  autoplay:false,
  autoplaySpeed:3000,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
  });
  $('.infog-slick').slick({
    infinite: true,
 slidesToShow: 4,
 slidesToScroll: 1,
 dots: false,
  speed: 500,
  arrows: true,
  autoplay:false,
  autoplaySpeed:1000,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
  });
})

</script>

</body>

</html>
