<?php
    $this->set(compact('menu'));
    $m = $menu;
    $class = 'menu menu-' . $m['alias'];
    if ($menu['class'] != null) {
        $class .= ' ' . $m['class'];
    }
?>
<div id="menu-<?php echo $menu['id']; ?>" class="<?php echo $class; ?>">
<?php
	echo $this->Menus->nestedLinks($menu['threaded'], $options);
?>
</div>