<?php

/**
 * Class Plan
 */
class Plan extends Home_Controller
{
    /**
     * upgrade
     */
    public function upgrade()
    {
        $order_id = (int)$this->input->get('order', true);
        if (0 >= $order_id) {
            show_404();
        }

        // 获取订单信息
        $this->load->model('order_model');
        $fields = 'id,order_number,user_id,box_id,box_name,order_value,plan_number,shirt_sex,shirt_size,post_name,post_phone,post_addr';
        $order = $this->order_model
            ->setSelectFields($fields)
            ->setAndCond(['id' => $order_id, 'user_id' => $this->_loginUser['id'], 'status' => 1])
            ->get();
        if (empty($order) || 12 == $order['plan_number']) {
            show_404();
        }

        // 获取盒子详情
        $this->load->model('box_model');
        $box = $this->box_model
            ->setSelectFields('id,name,monthly_price,annually_price')
            ->find($order['box_id']);

        $this->_viewVar['order'] = $order;
        $this->_viewVar['box'] = $box;
        $this->_viewVar['body_attr'] = ' id="checkouts-steps"';

        $this->load_view();
    }
}
