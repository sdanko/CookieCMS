<div class="row">
    <?php
    foreach ($themes as $theme):
        $style = null;
        $button = null;
        if (empty($theme['screenshot'])):
            $img = $this->Url->build('/admin/img/500X250.png');
        else:
            $img = $this->Url->build('/', true) . $theme['name'] . $theme['screenshot'];
        endif;
        if ($theme['name'] !== $currentTheme):
            $button = $this->Form->postLink(
                    __d('admin','Activate'), ['action' => 'activate', $theme['name']], ['class' => 'btn btn-info btn-xs', 'role' => 'button']
            );
        else:
            $style = "border: 1px solid red";
        endif;
        $description = isset($theme['description']) ? $theme['description'] : null;
        $regions = isset($theme['regions']) ? $theme['regions'] : null;
        ?>
        <div class="col-xs-18 col-sm-6 col-md-3">
            <div class="thumbnail" style="<?php echo $style ?>">
                <a href="<?php echo $img ?>" data-featherlight="image">
                    <img src="<?php echo $img ?>" alt="">
                </a>
                <div class="caption">
                    <h4><?php echo $theme['name'] ?></h4>
                    <p><?php echo $description ?></p>
                    <p>Regions:<?php echo $regions ?></p>
    <!--                <a href="#" class="btn btn-default btn-xs pull-right" role="button"><i class="glyphicon glyphicon-edit"></i></a>-->
                    <?php echo $button ?>
                    <!--                    <a href="#" class="btn btn-info btn-xs" role="button">Activate</a>-->
                </div>
            </div>
        </div>
        <?php
    endforeach;
    ?>

</div><!--/row-->

