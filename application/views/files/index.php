<?php if(!empty($files)){ foreach($files as $frow){ ?>
<div class="file-box">
    <div class="box-content">
        <h5><?php echo $frow['title']; ?></h5>
        <div class="preview">
            <embed src="<?php echo base_url().'uploads/files/'.$frow['file_name']; ?>">
        </div>
        <a href="<?php echo site_url().'/files/download/'.$frow['id']; ?>" class="dwn">Download</a>
    </div>
</div>
<?php } } ?>
