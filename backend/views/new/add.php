<?php

$this->title = 'Додавання новини';
$submitButton = 'Додати новину';
?>

<?= $this->render('_form', [
    'model' => $model,
    'submitButton' => $submitButton
]) ?>