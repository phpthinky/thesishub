<?php if(!empty($posts)): foreach($posts as $post): ?>
    <div class="list-item"><a href="javascript:void(0);"><h2><?php echo $post['title']; ?></h2></a></div>
<?php endforeach; else: ?>
<p>Post(s) not available.</p>
<?php endif; ?>
<?php echo $this->ajax_pagination->create_links(); ?>