<?php 
    if(!empty($success_msg)){
        echo '<p class="statusMsg">'.$success_msg.'</p>';
    }elseif(!empty($error_msg)){
        echo '<p class="statusMsg">'.$error_msg.'</p>';
    }
?>

<form method="post" enctype="multipart/form-data">
    <p><input type="file" name="file"/></p>
    <?php echo form_error('file','<p class="help-block">','</p>'); ?>
    <p><input type="submit" name="uploadFile" value="UPLOAD"/></p>
</form>