<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead><tr>
            <?php foreach($table_header as $header):echo "<th>{$header}</th>";endforeach;?>
        </tr></thead>
        <tbody>
        <?php
        if(! empty($data)){
            $type = ['<span class="label label-success">视频</span>', '<span class="label label-warning">图片</span>'];
            foreach($data as $tr) {
                echo '<tr>';
                foreach ($tr as $column_name => $td) {
                    $td = 'image' == $column_name ? '<img src="' . base_url('resources/uploads/') . $td . '" width="200" height="120"/>' : $td;
                    $td = 'type' == $column_name ? $type[$td] : $td;
                    echo "<td>{$td}</td>";
                }
                echo '<td><button class="btn btn-info btn-xs but-delete" data-show-wall="' . $tr['id'] . '">删除</button></td></tr>';
            }
        } else {
            echo '<tr><td style="text-align:center;font-size:16px;padding:30px 0;" colspan="' . (count($table_header) + 1) .'">暂无数据</td></tr>';
        }
        ?>
        </tbody>
    </table>
</div>
<?php if(! empty($page)){echo $page;}?>

<script type="application/javascript">
    $(function() {
        // 删除图片墙
        $('.but-delete').click(function(){
            var show_wall = $(this).attr('data-show-wall');
            $.ajax({
                type: "POST",
                url: "<?=base_url('admin/show_wall/delete')?>",
                data: {id: show_wall},
                dataType: "JSON",
                success: function(response){
                    if(0 == response.status) {
                        window.location.reload();
                    } else {
                        layer.alert(response.msg, {icon: 2});
                    }
                }
            });
        });
    });
</script>