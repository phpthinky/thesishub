<div class="container">
    <div class="row">
        <!-- Carousel -->
        <div id="slideshow" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#slideshow" data-slide-to="0" class="active"></li>
                <li data-target="#slideshow" data-slide-to="1"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="<?=base_url('public/images/untitled.png');?>" alt="First slide">
                    <!-- Static Header -->
                    <div class="header-text hidden-xs">
                        <div class="col-md-12 text-center">
                           
                            <div class="signin_signup">
                                <a class="btn btn-theme btn-sm btn-min-block" href="<?=site_url('signin');?>">Login</a><a class="btn btn-theme btn-sm btn-min-block" href="<?=site_url('signup');?>">Register</a></div>
                        </div>
                    </div><!-- /header-text -->
                </div>
                <div class="item">
                    <img src="<?=base_url('public/images/untitled.png');?>" alt="Second slide">
                    <!-- Static Header -->
                    <div class="header-text hidden-xs">
                        <div class="col-md-12 text-center">
                            
                            <div class="signin_signup">
                                <a class="btn btn-theme btn-sm btn-min-block" href="<?=site_url('signin');?>">Login</a><a class="btn btn-theme btn-sm btn-min-block" href="<?=site_url('signup');?>">Register</a></div>
                        </div>
                    </div><!-- /header-text -->
                </div>
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#slideshow" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#slideshow" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div><!-- /carousel -->
    </div>
</div>
<script type="text/javascript">
    $(document).ready( function() {
    $('#slideshow').carousel({
        interval:   4000
    });
    
    var clickEvent = false;
    $('#slideshow').on('click', '.nav a', function() {
            clickEvent = true;
            $('.nav li').removeClass('active');
            $(this).parent().addClass('active');        
    }).on('slid.bs.carousel', function(e) {
        if(!clickEvent) {
            var count = $('.nav').children().length -1;
            var current = $('.nav li.active');
            current.removeClass('active').next().addClass('active');
            var id = parseInt(current.data('slide-to'));
            if(count == id) {
                $('.nav li').first().addClass('active');    
            }
        }
        clickEvent = false;
    });
});

</script>