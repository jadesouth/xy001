<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <?php foreach ($table_header as $header):echo "<th>{$header}</th>";endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <?php
        if (! empty($data)) {
            foreach ($data as $tr) {
                echo '<tr>';
                foreach ($tr as $column_name => $value) {
                    echo "<td>{$value}</td>";
                }
                echo '<td>';
                echo '<a class="btn btn-default btn-xs box-info" href="/admin/box/detail/' . $tr['id'] . '">查看详情</a>&nbsp;';
                echo '<a class="btn btn-default btn-xs box-info" href="/admin/box/edit/' . $tr['id'] . '">编辑</a>';
                echo '</td></tr>';
            }
        } else {
            echo '<tr><td style="text-align:center;font-size:16px;padding:30px 0px;" colspan="' . (count($table_header) + 1) . '">暂无数据</td></tr>';
        }
        ?>
        </tbody>
    </table>
</div>
<?php if (! empty($page)) {
    echo $page;
} ?>