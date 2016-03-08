
<?php
$crumbs='';
if(isset($breadcrumbs))
{
    foreach ($breadcrumbs as $breadcrumb)
    {
        $this->Html->addCrumb(__d('admin', $breadcrumb['text']), $breadcrumb['link']);
    }
    
    $crumbs = $this->Html->getCrumbs(' > ', [
    'text' => $this->Html->image('icons/home.png'),
    'url' => ['controller' => 'Home', 'action' => 'index'],
    'escape' => false
    ]);
    
}

//$crumbs = $this->Html->getCrumbs(
//	$this->Html->tag('span', '/', array(
//		'class' => 'divider',
//	))
//);

?>
<?php if ($crumbs): ?>
<div id="breadcrumb-container">
	<div class="breadcrumb">
		<?php echo $crumbs; ?>
	</div>
</div>
<?php endif; ?>