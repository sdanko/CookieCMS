
<div class="content content-type-<?php echo $content->content_type->alias; ?>">
    <h2><?php echo $content->title ?></h2>
    <?php
    echo $this->element('Content/content_info', [
        "content" => $content
    ]);
    echo $this->element('Content/content_body', [
        "content" => $content
    ]);
    echo $this->element('Content/content_more_info', [
        "content" => $content
    ]);
    ?>
</div>

