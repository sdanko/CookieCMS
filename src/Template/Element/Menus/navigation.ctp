<nav class="<?php echo $options['navClass']; ?>">
<?php
	echo $this->Menus->nestedLinks($menu['threaded'], $options);
?>
</nav>