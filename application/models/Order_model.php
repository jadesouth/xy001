<?php

/**
 * Class Order_model 主题管理模型
 */
class Order_model extends MY_Model
{
    /**
     * nextPlanCount 下期计划总数
     */
    public function nextPlanCount()
    {
        $currentYear = (int)date('Y');
        $currentMonth = (int)date('m');
        $currentDate = date('Y-m-d');

        $nextTimestamp = strtotime(date('Y-m-d') . ' +1 month');
        $nextYear = (int)date('Y', $nextTimestamp);
        $nextMonth = (int)date('m', $nextTimestamp);

        return $this->db->from('order_plan')
            ->group_start()
            ->group_start()
            ->where('plan_year', $currentYear)
            ->where('plan_month', $currentMonth)
            ->where('plan_date >=', $currentDate)
            ->group_end()
            ->or_group_start()
            ->where('plan_year', $nextYear)
            ->where('plan_month', $nextMonth)
            ->group_end()
            ->group_end()
            ->where('order.status', 1)
            ->where('order_plan.status', 0)
            ->join('order', 'order_plan.order_id = order.id', 'left')
            ->count_all_results();
    }

    /**
     * nextPlan 下期计划数据
     *
     * @param int $page
     * @param int $page_size
     *
     * @return int
     */
    public function nextPlan($page = 0, $page_size = 20)
    {
        // page limit offset
        $page = 0 >= $page ? 1 : $page;
        $limit = 0 >= $page_size ? 20 : $page_size;
        $offset = 0 > $page ? 0 : ($page - 1) * $page_size;
        $this->db->limit($limit, $offset);

        $currentYear = (int)date('Y');
        $currentMonth = (int)date('m');
        $currentDate = date('Y-m-d');

        $nextTimestamp = strtotime(date('Y-m-d') . ' +1 month');
        $nextYear = (int)date('Y', $nextTimestamp);
        $nextMonth = (int)date('m', $nextTimestamp);

        $fields = 'order.id AS order_id,order_plan.id AS order_plan_id,order_number,post_name,post_phone,post_addr,plan_year,plan_month,plan_date,sign';

        return $this->db->select($fields)
            ->from('order_plan')
            ->group_start()
            ->group_start()
            ->where('plan_year', $currentYear)
            ->where('plan_month', $currentMonth)
            ->where('plan_date >=', $currentDate)
            ->group_end()
            ->or_group_start()
            ->where('plan_year', $nextYear)
            ->where('plan_month', $nextMonth)
            ->group_end()
            ->group_end()
            ->where('order.status', 1)
            ->where('order_plan.status', 0)
            ->join('order', 'order_plan.order_id = order.id', 'left')
            ->order_by('order.id', 'DESC')
            ->get()
            ->result_array();
    }

    /**
     * upgradePaymentCompleted 升级支付完成后的数据同步处理
     *
     * @param $userId
     * @param $orderNumber
     * @param $callbackData
     *
     * @return bool
     */
    public function upgradePaymentCompleted($userId, $orderNumber, $callbackData)
    {
        // 判断当前pay_callback_result记录是否已经存在
        $exists = $this->setTable('pay_callback_result')
            ->setAndCond([
                'user_id'      => $userId,
                'order_number' => $orderNumber,
                'notify_type'  => 0, // 0:支付宝同步通知
            ])
            ->count();
        if ($exists) {
            return true;
        }
        // 获取当前订单信息
        $fields = 'id,box_id,upgrade_before_order_value,upgrade_order_value'
            . 'upgrade_before_pay_value,upgrade_pay_value,'
            . 'upgrade_before_plan_number,upgrade_plan_number,'
            . 'post_name,post_phone,post_addr,'
            . 'upgrade_post_name,upgrade_post_phone,upgrade_post_addr';
        $order = $this->setTable('order')
            ->setSelectFields($fields)
            ->setAndCond(['order_number' => $orderNumber, 'user_id' => $userId, 'status' => 2])
            ->get();
        if (empty($order)) {
            return false;
        }
        // 获取最大一期的计划
        $fields = 'plan_date';
        $maxOrderPlan = $this->setTable('order_plan')
            ->setSelectFields($fields)
            ->setAndCond(['order_id' => $order['id'], 'user_id' => $userId, 'status' => 0])
            ->get();
        if (empty($maxOrderPlan)) {
            return false;
        }
        // 订单修改数据
        $updateOrderDate = [
            'order_value'        => $order['upgrade_before_order_value'] + $order['upgrade_order_value'],
            'pay_value'          => $order['upgrade_before_pay_value'] + $order['upgrade_pay_value'],
            'plan_number'        => $order['upgrade_before_plan_number'] + $order['upgrade_plan_number'],
            'post_name'          => $order['upgrade_post_name'],
            'post_phone'         => $order['upgrade_post_phone'],
            'post_addr'          => $order['upgrade_post_addr'],
            'upgrade_post_name'  => $order['post_name'],
            'upgrade_post_phone' => $order['post_phone'],
            'upgrade_post_addr'  => $order['post_addr'],
            'upgrade_status'     => 1, // 1:升级已确认
            'upgrade_pay_status' => 1, // 1:已支付
        ];
        // 订单计划数据
        $orderPlansDate = [];
        for ($i = 1; $i <= $order['upgrade_plan_number']; $i++) {
            $addMonthTimestamp = strtotime($maxOrderPlan['plan_date'] . " +{$i} month");
            $planYear = date('Y', $addMonthTimestamp);
            $planMonth = date('m', $addMonthTimestamp);
            $planDate = date('Y-m-d', $addMonthTimestamp);
            $orderPlansDate[] = [
                'order_id'       => $order['id'],
                'user_id'        => $userId,
                'box_id'         => $order['box_id'],
                'plan_year'      => $planYear,
                'plan_month'     => $planMonth,
                'plan_date'      => $planDate,
                'is_upgrade'     => 1, // 是否是升级的计划,1:是
                'upgrade_status' => 1, // 升级计划状态,1:升级已确认,
            ];
        }
        // 支付日志数据
        $insertCallbackData = [
            'user_id'      => $userId,
            'order_number' => $orderNumber,
            'notify_type'  => 0, // 0:支付宝同步通知
            'pay_type'     => 0, // 支付类型[0:支付宝电脑网站支付,1:支付宝手机网站支付]
            'http_method'  => 'GET',
            'content'      => json_encode($callbackData, JSON_UNESCAPED_UNICODE),
        ];

        $this->db->trans_start();
        // 修改order订单信息
        $this->setTable('order')
            ->setUpdateData($updateOrderDate)
            ->setAndCond(['id' => $order['id'], 'user_id' => $userId, 'status' => 2])
            ->update();
        // 存储支付计划order_plan
        $this->setTable('order_plan')
            ->setInsertData($orderPlansDate)
            ->createBatch();
        // 存储callback data
        $this->setTable('pay_callback_result')
            ->setInsertData($insertCallbackData)
            ->create();
        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    /**
     * upgradePaymentSuccess 升级支付完成后的数据异步处理
     *
     * @param $userId
     * @param $orderNumber
     * @param $callbackData
     *
     * @return bool
     */
    public function upgradePaymentSuccess($userId, $orderNumber, $callbackData)
    {
        // 判断当前pay_callback_result记录是否已经存在
        $exists = $this->setTable('pay_callback_result')
            ->setAndCond([
                'user_id'      => $userId,
                'order_number' => $orderNumber,
                'notify_type'  => 1, // 1:支付宝异步通知
            ])
            ->count();
        if ($exists) {
            return true;
        }
        // 获取当前订单信息
        $fields = 'id,box_id,upgrade_before_order_value,upgrade_order_value'
            . 'upgrade_before_pay_value,upgrade_pay_value,'
            . 'upgrade_before_plan_number,upgrade_plan_number,'
            . 'post_name,post_phone,post_addr,'
            . 'upgrade_post_name,upgrade_post_phone,upgrade_post_addr';
        $order = $this->setTable('order')
            ->setSelectFields($fields)
            ->setAndCond(['order_number' => $orderNumber, 'user_id' => $userId, 'status' => 2])
            ->get();
        if (empty($order)) {
            return false;
        }

        // 判断支付是否成功在进行业务处理
        if (in_array($callbackData['trade_status'], ['TRADE_SUCCESS', 'TRADE_PENDING', 'TRADE_FINISHED'])) {
            // 订单修改数据
            $updateOrderDate = [
                'upgrade_status'     => 2, // 2:升级已完成
                'upgrade_pay_status' => 2, // 2:支付成功
            ];
            $updateOrderCondition = [
                'id'      => $order['id'],
                'user_id' => $userId,
                'status'  => 2,
            ];
            // 订单计划修改数据
            $updateOrderPlansDate = [
                'upgrade_status' => 2, // 升级计划状态,1:升级已确认,2:升级已完成,3:升级失败
            ];
            $updateOrderPlanCondition = [
                'order_id'   => $order['id'],
                'user_id'    => $userId,
                'box_id'     => $order['box_id'],
                'is_upgrade' => 1, // 1. 是升级的计划
            ];
        } else { // 支付失败
            // 订单修改数据
            $updateOrderDate = [
                'order_value'        => $order['order_value'] - $order['upgrade_order_value'],
                'pay_value'          => $order['pay_value'] - $order['upgrade_pay_value'],
                'plan_number'        => $order['plan_number'] - $order['upgrade_plan_number'],
                'post_name'          => $order['upgrade_post_name'],
                'post_phone'         => $order['upgrade_post_phone'],
                'post_addr'          => $order['upgrade_post_addr'],
                'upgrade_post_name'  => $order['post_name'],
                'upgrade_post_phone' => $order['post_phone'],
                'upgrade_post_addr'  => $order['post_addr'],
                'upgrade_status'     => 3, // 3:升级失败
                'upgrade_pay_status' => 4, // 4:支付失败
            ];
            $updateOrderCondition = [
                'id'      => $order['id'],
                'user_id' => $userId,
                'status'  => 2,
            ];
            // 订单计划修改数据
            $updateOrderPlansDate = [
                'upgrade_status' => 3, // 升级计划状态,1:升级已确认,2:升级已完成,3:升级失败
            ];
            $updateOrderPlanCondition = [
                'order_id'   => $order['id'],
                'user_id'    => $userId,
                'box_id'     => $order['box_id'],
                'is_upgrade' => 1, // 1. 是升级的计划
            ];
        }

        // 支付日志数据
        $insertCallbackData = [
            'user_id'      => $userId,
            'order_number' => $orderNumber,
            'notify_type'  => 1, // 0:支付宝同步通知 1:支付宝异步通知
            'pay_type'     => 0, // 支付类型[0:支付宝电脑网站支付,1:支付宝手机网站支付]
            'http_method'  => 'POST',
            'content'      => json_encode($callbackData, JSON_UNESCAPED_UNICODE),
        ];

        $this->db->trans_start();
        // 修改order订单信息
        $this->setTable('order')
            ->setUpdateData($updateOrderDate)
            ->setAndCond($updateOrderCondition)
            ->update();
        // 存储支付计划order_plan
        $this->setTable('order_plan')
            ->setUpdateData($updateOrderPlansDate)
            ->setAndCond($updateOrderPlanCondition)
            ->update();
        // 存储callback data
        $this->setTable('pay_callback_result')
            ->setInsertData($insertCallbackData)
            ->create();
        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    /**
     * generateOrderNumber 生成订单编号
     *
     * @return string
     */
    public function generateOrderNumber()
    {
        do {
            $orderNumber = date('YmdHis') . random_number(4) . '0';
            $existed = (bool)$this->setAndCond(['order_number' => $orderNumber])
                ->count();
        } while ($existed);

        return $orderNumber;
    }
}
