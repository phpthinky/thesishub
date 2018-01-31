<script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: '<?php echo site_url(); ?>/posts/ajaxPaginationData/'+page_num,
        data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (html) {
            $('#postList').html(html);
            $('.loading').fadeOut("slow");
        }
    });
}
</script>

<div class="container">
    <h1>Ajax Pagination with Search in CodeIgniter</h1>
    <div class="row">
        <div class="post-search-panel">
            <input type="text" id="keywords" placeholder="Type keywords to filter posts" onkeyup="searchFilter()"/>
            <select id="sortBy" onchange="searchFilter()">
                <option value="">Sort By</option>
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>
        </div>
        <div class="post-list" id="postList">
            <?php if(!empty($posts)): foreach($posts as $post): ?>
                <div class="list-item"><a href="javascript:void(0);"><h2><?php echo $post['title']; ?></h2></a></div>
            <?php endforeach; else: ?>
            <p>Post(s) not available.</p>
            <?php endif; ?>
            <?php echo $this->ajax_pagination->create_links(); ?>
        </div>
        <div class="loading" style="display: none;"><div class="col-md-6 content"><img style="width:100%" src="<?php echo base_url().'public/images/loading1.gif'; ?>"/></div></div>
    </div>
</div>