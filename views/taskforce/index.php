<?php

/** @var yii\web\View $this
 * @var array $categories
 */

$this->title = Yii::$app->name;
?>

<table class="table">
    <tr>
        <th>id</th>
        <th>name</th>
        <th>icon</th>
    </tr>
    <?php
    foreach ($categories as $value) {
        echo "<tr>
<td>{$value['id']}</td>
<td>{$value['name']}</td>
<td>{$value['icon']}</td>
</tr>";
    }
    ?>
</table>