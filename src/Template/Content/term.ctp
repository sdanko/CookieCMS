<div class="content term">
    <?php
    if (count($content) == 0) {
        echo __d('cookie', 'No items found.');
    }
    ?>

    <?php
    foreach ($content as $item):
        ?>
        <div class="content content-type-<?php echo $item->content_type->alias; ?>">
            <h2><?php echo $this->Html->link($item->title, $item->url); ?></h2>
            <?php
            echo $this->element('Content/content_info', [
                "content" => $item
            ]);
            echo $this->element('Content/content_body', [
                "content" => $item
            ]);
            echo $this->element('Content/content_more_info', [
                "content" => $item
            ]);
            ?>
        </div>
        <?php
    endforeach;
    ?>

     <div class="col-md-12 text-center">
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('< ' . __d('cookie','previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__d('cookie','next') . ' >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
    </div>
</div>