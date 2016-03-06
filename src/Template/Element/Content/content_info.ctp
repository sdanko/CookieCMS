<?php
    use Cake\Core\Configure;
?>
<div class="content-info">
<?php
    echo __d('cookie', 'Posted');
    echo ' ' . __d('cookie', 'on') . ' ';
    echo $this->Html->tag('span', $this->Time->format($content->create_date, Configure::read('Reading.date_time_format'), null, Configure::read('Site.timezone')), array('class' => 'date'));
	
?>
</div>