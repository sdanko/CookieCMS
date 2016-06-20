<div class="content-excerpt">
	<?php
            if(isset($content->excerpt)) {
                 echo $content->excerpt;
            } else {
                echo $this->Cookie->firstPara($content->body);
            }          
        ?>
</div>