<?php

$this->Form->templates($form_templates['default']);

echo $this->Form->create($contact);
echo $this->Form->input('name');
echo $this->Form->input('email');
echo $this->Form->input('subject');
echo $this->Form->input('body');
echo $this->Form->button('Submit');
echo $this->Form->end();