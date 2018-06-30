<?php
if (!$array = $this->select('qa')) {
    die("your table is empty");
}

?>
<table class='table table-bordered table-hover table-sm'>
    <tr>
        <?php foreach ($array[0] as $key => $value) {?>
        <th><?=$key?></th>
        <?php }?>
        <th>remove</th>
    </tr>
    <?php for ($i = 0; $i < count($array); $i++) {?>
    <tr>
    <?php foreach ($array[$i] as $key => $value) {
    if ($key == "answer") {?>
        <form action="<?=htmlentities($_SERVER['PHP_SELF'])?>" method='post'>
            <td>
                <div class='input-group'>
                    <input type='text' name='answer' class='form-control' value='<?=$value?>'>
                    <input type='hidden' value='<?=$array[$i]['id']?>' name='id'>
                        <div class='input-group-append'>
                            <button class='btn btn-outline-secondary' name='edit' type='submit'>edit</button>
                        </div>
                </div>
            </td>
        </form>
    <?php } else {?>
        <td><?=$value?></td>
    <?php }}?>
        <form action="<?=htmlentities($_SERVER['PHP_SELF'])?>" method='post'>
            <td>
                <div class='input-group'>
                    <input type='hidden' value='<?=$array[$i]['id']?>' name='removeId'>
                    <button class='btn btn-link' name='remove' type='submit'><img src='icons/x-button.png'></button>
                </div>
            </td>
        </form>
    </tr>
   <?php }?>
</table>
