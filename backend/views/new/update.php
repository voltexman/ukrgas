<?php

$this->title = 'Редагування новини';
$submitButton = 'Зберегти новину';
?>

<?= $this->render('_form', [
    'model' => $model,
    'submitButton' => $submitButton
]) ?>