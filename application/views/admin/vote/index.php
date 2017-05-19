<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead><tr>
            <?php foreach($table_header as $header):echo "<th>{$header}</th>";endforeach;?>
        </tr></thead>
        <tbody>
        <?php
        if(! empty($data)){
            foreach($data as $tr) {
                echo "<tr><td>{$tr['id']}</td><td><img width='100' src='" . base_url('resources/uploads/' . $tr['image']) . "' /></td><td>{$tr['content']}</td><td>{$tr['count']}</td>";
                if (0 == $tr['status']) {
                    echo '<td><button class="btn btn-success btn-xs not-show-vote" data-vote="' . $tr['id'] .'">不显示</button>';
                } else {
                    echo '<td><button class="btn btn-danger btn-xs show-vote" data-vote="' . $tr['id'] .'">显示</button>';
                }
                echo '&nbsp;&nbsp;<button class="btn btn-delete btn-xs delete-vote" data-vote="'. $tr['id'] . '">删除</button></td></tr>';
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
        layui.use('layer', function(){
            var layer = layui.layer;
        });
        // 删除投票
        $('.delete-vote').click(function(){
            var vote = $(this).attr('data-vote');
            $.ajax({
                type: "POST",
                url: "<?=base_url('admin/vote/delete')?>",
                data: {id: vote},
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
        // 不显示投票
        $(".not-show-vote").click(function() {
            var vote = $(this).attr('data-vote');
            $.ajax({
                type: "POST",
                url: "<?=base_url("admin/vote/setNotShow")?>",
                data: {"vote": vote},
                dataType: "json",
                success: function(response){
                    if(0 == response.status) {
                        layer.alert(response.msg, {icon: 1}, function() {
                            window.location.reload();
                        });
                    } else {
                        layer.alert(response.msg, {icon: 2});
                    }
                }
            });
        });
        // 显示投票
        $(".show-vote").click(function() {
            var vote = $(this).data("vote");
            $.ajax({
                type: "POST",
                url: "<?=base_url("admin/vote/setShow")?>",
                data: {"vote": vote},
                dataType: "json",
                success: function(response){
                    if(0 == response.status) {
                        layer.alert(response.msg, {icon: 1}, function() {
                            window.location.reload();
                        });
                    } else {
                        layer.alert(response.msg, {icon: 2});
                    }
                }
            });
        });
    });
</script>