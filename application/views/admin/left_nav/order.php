<!-- main content -->
<div class="container-fluid">
    <div class="row">
        <!-- left nav -->
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li <?=('nextPlan' == $method_name || 'detail' == $method_name) ? 'class="active"' : ''?>><a href="<?=base_url('admin/order/nextPlan')?>">下期订单列表<?='nextPlan' == $method_name ? '<span class="sr-only">(current)</span>' : ''?></a></li>
                <li <?=('index' == $method_name) ? 'class="active"' : ''?>><a href="<?=base_url('admin/order')?>">订单列表<?='index' == $method_name ? '<span class="sr-only">(current)</span>' : ''?></a></li>
            </ul>
        </div>
        <!-- right content -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h3 class="page-header"><?=$h1_title?></h3>