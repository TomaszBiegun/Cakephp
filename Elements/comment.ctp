<?php foreach ($comments as $comment): ?>
    <div class="col-sm-12">
        <div class="well sigle-comment">
            <div class="row">
                <div class="col-sm-12 comment-info">
                    <span><?php echo $comment['Comment']['user_name'] . ' - ' . date('d.m.Y', strtotime($comment['Comment']['created'])); ?></span>
                </div>
                <div class="col-sm-12 comment-content">
                    <blockquote> <?php echo '"' . $comment['Comment']['body'] . '"'; ?>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>