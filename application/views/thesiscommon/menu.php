<div class="container welcome">
<div class="col-md-6 col-lg-6 welcome-robo">
	
	<div class="row">

	<div class="robot">
		
		<div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
  <!-- Overlay -->
  <div class="overlay"></div>

  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
    <li data-target="#bs-carousel" data-slide-to="1"></li>
    <li data-target="#bs-carousel" data-slide-to="2"></li>
  </ol>
  
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item slides active">
      <div class="slide-1"></div>
      <div class="hero">
        <hgroup>
            <h2>We are creative</h2>        
            <h4>Get start your next awesome project</h4>
        </hgroup>
        <button class="btn btn-hero btn-lg" role="button">See all features</button>
      </div>
    </div>
    <div class="item slides">
      <div class="slide-2"></div>
      <div class="hero">        
        <hgroup>
            <h2>We are smart</h2>        
            <h4>Get start your next awesome project</h4>
        </hgroup>       
        <button class="btn btn-hero btn-lg" role="button">See all features</button>
      </div>
    </div>
    <div class="item slides">
      <div class="slide-3"></div>
      <div class="hero">        
        <hgroup>
            <h2>We are amazing</h2>        
            <h4>Get start your next awesome project</h4>
        </hgroup>
        <button class="btn btn-hero btn-lg" role="button">See all features</button>
      </div>
    </div>
  </div> 
</div>



	</div>
	</div>
</div>
<div class="col-md-6 welcome-content">
	<div class="header">
	<div class="col-md-6">
		<a href=""><img src="<?=base_url('/public/images/thesishub.png');?>"></a>
		
	</div>
	<!-- <div class="col-md-6">
		<div class="form-search right">
			<form class="form " action="<?=site_url ('search');?>" method="get" id="frmsearch" name="frmsearch">
				<div class="form-inline">
					<label for="search"><input type="text" class="form-control input-search " placeholder="Search..." name="q" id="q"><button class="btn btn-info">Go</button></label>
				</div>
			</form>
		</div>
		
	</div> -->
	</div>
<div class="col-md-12">
	
<nav class="navbar navbar-default">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <!-- Collection of nav links and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
            <li ><a href="<?=site_url();?>">Home</a></li>
            <li><a href="<?=site_url('about');?>">About</a></li>
            <li><a href="<?=site_url('contact');?>">Contact</a></li>
            <?php if ($this->aauth->is_loggedin()) {
              # code...
            
            echo '<li><a href="'.site_url('logout').'">Logout</a></li>';
            } 

            print(isset($visits) ?  '<li class="active"><a href="#">Visits: '.$visits.'</a></li>' : ''); ?>
        </ul>

    </div>
</nav>
</div>