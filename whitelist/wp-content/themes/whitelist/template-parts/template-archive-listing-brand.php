<?php
$post_id = get_the_ID();
$type = !empty($args['type']) ? $args['type'] : 'grid';
if( isset($args['index']) && !empty($args['index'] ) ) {
    $index = str_pad(intval($args['index']), 2, '0', STR_PAD_LEFT);
}
else {
    $index = $post_id;
}
$post_title = get_the_title();
$permalink = get_permalink();
$create_on = get_the_date('j F Y H:s:i');
$history = get_field('history');
$last_update = '';
$last_history = '';
$last_edit = '';
if( !empty($history) ) {
    $last_row = end($history);
    $last_update = $last_row ['date'];
    $last_edit = $last_row['user']['user_firstname'];
}

if( $type == 'table') {
?>
    <tr data-row="tr-<?php echo $index;?>" data-id="<?php echo $post_id;?>">
        <td data-type="title" class="data-action"><?php echo "<a href='$permalink' class='td-link'>$post_title</a>";?></td>
        <td data-type="created" class="data-action"><?php echo $create_on;?></td>
        <td data-type="last-edit" class="data-action"><?php echo $last_update;?></td>
        <td data-type="last-edit-by" class="data-action"><?php echo $last_edit;?></td>
        <td data-type="butons" class="data-action">
            <div class="btn-wrapper"><a href="<?php echo $permalink;?>" class="btn btn-default btn-view px-3 py-2"><span class="d-none">View</span><i class="fa fa-eye"></i></a></div>
        </td>
    </tr>
<?php
}
else {
?>
<div class="grid-item grid-item-<?php echo $index;?>" id="grid-item-<?php echo $post_id;?>">
    <div class="grid-item-inner">
        <div class="grid-thumbnail">
            <a href="<?php echo $permalink;?>" class="grid-link">
            <?php
            if( has_post_thumbnail() ) {
                echo '<img src="'.get_the_post_thumbnail_url().'" class="img-fluid"/>';
            }
            ?>
            </a>
        </div>
        <div class="grid-entry">
            <h4 class="grid-title"><a href="<?php echo $permalink;?>" class="grid-link"><?php echo $post_title;?></a></h4>
        </div>
    </div>
</div>
<?php
}
?>