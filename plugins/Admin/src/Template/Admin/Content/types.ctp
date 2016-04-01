
    <h2><?php echo __d('admin', 'Choose content type') ?></h2>
    <?php
    foreach ($types as $type):
        ?>
        <blockquote>
                <p><?= $this->Html->link($type['title'], ['action' => 'index', "contentTypeId" => $type['id']]) ?></p>
                <small><?= $type['description'] ?></small>
        </blockquote>
        <?php
    endforeach;
    ?>

