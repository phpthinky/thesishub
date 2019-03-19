<!DOCTYPE html>
<html>
<head>
	<title>Carousel</title>

<!-- core css plugin -->
  <link rel="stylesheet" type="text/css" href="//v4-alpha.getbootstrap.com/dist/css/bootstrap.min.css">
  <style type="text/css">

.carousel-inner>.carousel-item>img, .carousel-inner>.carousel-item>a>img {
display: block;
height: auto;
height: 500px;
max-width: 100%;
line-height: 1;
width: 100%; // Add this
}
.carousel-inner>.carousel-item>.carousel-caption{

}
.carousel-inner>.carousel-item>.carousel-caption:hover{
  background: rgba(0, 0, 0, 0.7);
}

/* Smaller than standard 960 (devices and browsers) */
@media only screen and (max-width: 959px) {
.carousel-inner>.carousel-item>img, .carousel-inner>.carousel-item>a>img {
display: block;
max-height: 450px;
max-width: 100%;
line-height: 1;
width: 100%; // Add this
}
}

/* Tablet Portrait size to standard 960 (devices and browsers) */
@media only screen and (min-width: 768px) and (max-width: 959px) {
  .carousel-inner>.carousel-item>img, .carousel-inner>.carousel-item>a>img {
display: block;
max-height: 400px;
max-width: 100%;
line-height: 1;
width: 100%; // Add this
}
}

/* All Mobile Sizes (devices and browser) */
@media only screen and (max-width: 767px) {
    .carousel-inner>.carousel-item>img, .carousel-inner>.carousel-item>a>img {
display: block;
max-height: 350px;
max-width: 100%;
line-height: 1;
width: 100%; // Add this
}
}

/* Mobile Landscape Size to Tablet Portrait (devices and browsers) */
@media only screen and (min-width: 480px) and (max-width: 767px) {
    .carousel-inner>.carousel-item>img, .carousel-inner>.carousel-item>a>img {
display: block;
max-height: 300px;
max-width: 100%;
line-height: 1;
width: 100%; // Add this
}
}

/* Mobile Portrait Size to Mobile Landscape Size (devices and browsers) */
@media only screen and (max-width: 479px) {
    .carousel-inner>.carousel-item>img, .carousel-inner>.carousel-item>a>img {
display: block;
max-height: 200px;
max-width: 100%;
line-height: 1;
width: 100%; // Add this
}
}

  </style>

<!-- core js plugin -->
  <script type="text/javascript" src="public/js/jquery.min.js"></script>
  <script type="text/javascript" src="//v4-alpha.getbootstrap.com/dist/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container">
  <div class="row">
    <?php include VIEWPATH.'/common/nav.html'; ?>
  </div>
</div>

    <div id="coloftechSlider" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#coloftechSlider" data-slide-to="0" class="active"></li>
      <li data-target="#coloftechSlider" data-slide-to="1" class=""></li>
      <li data-target="#coloftechSlider" data-slide-to="2" class=""></li>
    </ol>
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="d-block img-fluid" src="public/images/tablea1.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <h3>Hi</h3>
        <p>Text description</p>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="public/images/tablea2.jpg" alt="Second slide">
      <div class="carousel-caption d-none d-md-block">
        <h3>Hello </h3>
        <p>Text description</p>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="public/images/tablea3.jpg" alt="Third slide">
      <div class="carousel-caption d-none d-md-block">
        <h3>How are you</h3>
        <p>Text description</p>
      </div>
    </div>
  </div>
<!--
    <a class="carousel-control-prev" href="#coloftechSlider" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#coloftechSlider" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  -->
  </div>



</body>
</html>