<div class="content-excerpt">
	<?php
            if(!empty($content->excerpt)) {
                 echo $content->excerpt;
            } else {
                echo $this->Cookie->firstPara($content->body);
            }          
        ?>
</div>