<?php
$class = 'alert alert-info';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
?>
<div class="<?= h($class) ?>" role="alert"><?= h($message) ?></div>
