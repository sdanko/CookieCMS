<div class="node-more-info">
<?php
    $type = $types_for_layout[$this->Nodes->field('type')];

    if (is_array($this->Nodes->node['Taxonomy']) && count($this->Nodes->node['Taxonomy']) > 0) {
            $nodeTerms = Hash::combine($this->Nodes->node, 'Taxonomy.{n}.Term.slug', 'Taxonomy.{n}.Term.title');
            $nodeTermLinks = array();
            if (count($nodeTerms) > 0) {
                    foreach ($nodeTerms as $termSlug => $termTitle) {
                            $nodeTermLinks[] = $this->Html->link($termTitle, array(
                                    'plugin' => 'nodes',
                                    'controller' => 'nodes',
                                    'action' => 'term',
                                    'type' => $this->Nodes->field('type'),
                                    'slug' => $termSlug,
                            ));
                    }
                    echo __d('cookie', 'Posted in') . ' ' . implode(', ', $nodeTermLinks);
            }
    }
?>
</div>