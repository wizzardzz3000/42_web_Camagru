<?php $this->_t = 'Camagru';
    foreach($users as $user): ?>
    <h2><?= $user->pseudo() ?></h2>
    <?php endforeach; ?>