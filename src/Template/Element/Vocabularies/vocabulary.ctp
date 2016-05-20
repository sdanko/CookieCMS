<div id="vocabulary-<?php echo $vocabulary['id']; ?>" class="vocabulary">
<?php
	echo $this->Taxonomies->nestedTerms($vocabulary['threaded'], $options);
?>
</div>