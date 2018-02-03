<!DOCTYPE html>
<html>
<head>
    <title>Thesis Hub <?php echo isset($title) ? ' : '.$title : '' ;?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Thesis hub by Coloftech State of the Arts & technolog is an online thesis management and monitoring system of all research studies of students from BISU Bilar. It stored the title of the study, abstract, researchers, date of study, committee, and examining panel. It also allowed upload of pdf and images.">
<meta name="author" content="Harold Rita" />
<meta name="keywords" content="thesis hub, research study compilation system and monitoring system.coloftech project  " />

        <link href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
        <link href="<?=base_url('assets/bootstrap');?>/css/font-awesome.css" rel="stylesheet">
        <link href="<?=base_url('assets/css/animate.css');?>" rel="stylesheet">
        <link href="<?=base_url('assets/plugin/videoplayer/video-js.min.css');?>" rel="stylesheet">
        <link rel="icon" type="image/png" href="<?=base_url();?>favicon.png">
       

        <?php // add css files
        $this->minify->css(array('default.css'));
        echo $this->minify->deploy_css();
        ?>

    <style type="text/css">
    </style>
        <!-- CORE PLUGINS -->
        <script src="<?=base_url('assets/js/jquery-1.11.0.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/js/jquery-migrate.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/plugin/PDFObject/pdfobject.js"></script>

        <script src="<?=base_url();?>assets/plugin/videoplayer/video.min.js"></script>
</head>
<body>
<header class="wrapper" >
    <div class="container" >
        

        <div class="logo"><a href="<?=site_url();?>"><img src="<?=base_url();?>public/images/logob.png"></div></a>
        <div class="title"><a href="<?=site_url();?>"><h1 style="display:inline-block;color:#fff;"><span style='margin-top:-10px;position:absolute;font-size:1em;'>Thesis hub</span></h1></a></div>
    </div>
    <div class="container">
        <?php include VIEWPATH.'common/menu.php';?>
    </div>
</header>

<div class="body">
    <div class="container">
        <div class="col-md-12"><div class="container"><p id="heyboy" style="display: none;color:red;">Hey, it seems like you are using IE with lower version than 11. Some feature may not work properly. Pleas upgrade your browser or use other browser like google chrome.</p></div></div>

    <?php echo $body; ?>
    </div> <!-- container -->
</div> <!-- body -->

</body>
</html>

<script type="text/javascript">
    function msieversion() {

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))  // If Internet Explorer, return version number
    {
       // alert(parseInt(ua.substring(msie + 5, ua.indexOf(".", msie))));
      if( parseInt(ua.substring(msie + 5, ua.indexOf(".", msie))) < 11){

        $('#heyboy').show();

      }
    }
    
    else  // If another browser, return 0
    {
        //alert('otherbrowser');

        $('#heyboy').hide();

    }

    return false;
}
msieversion();
</script>