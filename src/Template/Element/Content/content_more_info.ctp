<div class="node-more-info">
<?php
    use Cake\Utility\Hash;

    if (is_array($content->taxonomies) && count($content->taxonomies) > 0) {
            $contentTerms = Hash::combine($content->taxonomies, '{n}.term.slug', '{n}.term.title');
            $contentTermLinks = array();
            if (count($contentTerms) > 0) {
                    foreach ($contentTerms as $contentSlug => $contentTitle) {
                            $contentTermLinks[] = $this->Html->link($contentTitle, array(
                                    'controller' => 'Content',
                                    'action' => 'term',
                                    'type' => '',
                                    'slug' => $contentSlug,
                            ));
                    }
                    echo __d('cookie', 'Posted in') . ' ' . implode(', ', $contentTermLinks);
            }
    }
?>
</div>