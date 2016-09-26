<h2><?= __d('admin', 'Workflow item: ') . $job['title']; ?></h2>
<hr>
<h3><?= __d('admin', 'Content: ') . $this->Html->link($job['content_title'], ['controller' => 'Content' ,'action' => 'edit', $job['content_id']]); ?></h3>
<?php
$this->Form->templates($form_templates['default']);

echo $this->Form->create($jobs);
echo $this->Form->hidden('node_job_id', ['value' => $node_job_id]);
if($job['type'] === 'Process') {
    echo $this->Form->radio('next_node', $job['targets']);
}

echo $this->Form->button(__d('admin', 'Finish workflow item'));
echo $this->Form->end();