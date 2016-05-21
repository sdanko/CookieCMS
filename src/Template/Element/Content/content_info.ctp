<?php
    use Cake\Core\Configure;
?>
<p class="blog-post-meta content-info">
<?php
    if($content->content_type->format_show_date) {
        echo __d('cookie', 'Posted');
        echo ' ' . __d('cookie', 'on') . ' ';
        echo $this->Html->tag('span', $this->Time->format($content->created, Configure::read('Reading.date_time_format'), null, Configure::read('Site.timezone')), array('class' => 'date'));
    }
    
	
?>
</p>