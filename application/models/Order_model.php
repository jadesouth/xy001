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
            ->where_in('order.status', [1, 2])
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
            ->where_in('order.status', [1, 2])
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
        $fields = 'id,box_id,upgrade_before_order_value,upgrade_order_value,'
            . 'upgrade_before_pay_value,upgrade_pay_value,'
            . 'upgrade_before_plan_number,upgrade_plan_number,'
            . 'post_name,post_phone,post_addr,upgrade_post_name,'
            . 'upgrade_post_phone,upgrade_post_addr,upgrade_status';
        $realOrderNumber = substr($orderNumber, 0, 18) . 0;
        $order = $this->setTable('order')
            ->setSelectFields($fields)
            ->setAndCond(['order_number' => $realOrderNumber, 'user_id' => $userId, 'status' => 2])
            ->get();
        if (empty($order)) {
            return false;
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

        // 判断是否已经异步调用
        if (2 == $order['upgrade_status'] || 3 == $order['upgrade_status']) { // 已经异步调用,只写入同步回调记录
            // 存储callback data
            return (bool)$this->setTable('pay_callback_result')
                ->setInsertData($insertCallbackData)
                ->create();
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
     * upgradePaymentZfbSuccess 升级,支付宝支付完成后的数据异步处理
     *
     * @param $userId
     * @param $orderNumber
     * @param $callbackData
     *
     * @return bool
     */
    public function upgradePaymentZfbSuccess($userId, $orderNumber, $callbackData)
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
        $fields = 'id,box_id,upgrade_before_order_value,upgrade_order_value,'
            . 'upgrade_before_pay_value,upgrade_pay_value,'
            . 'upgrade_before_plan_number,upgrade_plan_number,'
            . 'post_name,post_phone,post_addr,upgrade_post_name,'
            . 'upgrade_post_phone,upgrade_post_addr,upgrade_status';
        $realOrderNumber = substr($orderNumber, 0, 18) . 0;
        $order = $this->setTable('order')
            ->setSelectFields($fields)
            ->setAndCond(['order_number' => $realOrderNumber, 'user_id' => $userId, 'status' => 2])
            ->get();
        if (empty($order)) {
            return false;
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

        // 判断是否已经同步调用
        if (1 == $order['upgrade_status']) { // 已经同步调用,修改订单相关状态数据
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

            $this->db->trans_start();
            // 修改order订单信息
            $this->setTable('order')
                ->setUpdateData($updateOrderDate)
                ->setAndCond($updateOrderCondition)
                ->update();
            // 修改订单计划order_plan
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
        } else { // 还没有调用同步,直接写入支付成功的订单状态数据
            // 判断支付是否成功在进行业务处理
            if (in_array($callbackData['trade_status'], ['TRADE_SUCCESS', 'TRADE_PENDING', 'TRADE_FINISHED'])) { // 成功
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
                    'upgrade_status'     => 2, // 2:支付成功
                    'upgrade_pay_status' => 2, // 2:支付成功
                ];
                $updateOrderCondition = [
                    'id'      => $order['id'],
                    'user_id' => $userId,
                    'status'  => 2,
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
                        'upgrade_status' => 2, // 升级计划状态,1:升级已确认,2:升级已完成,3:升级失败
                    ];
                }

                $this->db->trans_start();
                // 修改order订单信息
                $this->setTable('order')
                    ->setUpdateData($updateOrderDate)
                    ->setAndCond($updateOrderCondition)
                    ->update();
                // 存储订单计划order_plan
                $this->setTable('order_plan')
                    ->setInsertData($orderPlansDate)
                    ->createBatch();
                // 存储callback data
                $this->setTable('pay_callback_result')
                    ->setInsertData($insertCallbackData)
                    ->create();
                $this->db->trans_complete();

                return $this->db->trans_status();
            } else { // 支付失败
                // 订单修改数据
                $updateOrderDate = [
                    'upgrade_status'     => 3, // 3:升级失败
                    'upgrade_pay_status' => 4, // 4:支付失败
                ];
                $updateOrderCondition = [
                    'id'      => $order['id'],
                    'user_id' => $userId,
                    'status'  => 2,
                ];

                $this->db->trans_start();
                // 修改order订单信息
                $this->setTable('order')
                    ->setUpdateData($updateOrderDate)
                    ->setAndCond($updateOrderCondition)
                    ->update();
                // 存储callback data
                $this->setTable('pay_callback_result')
                    ->setInsertData($insertCallbackData)
                    ->create();
                $this->db->trans_complete();

                return $this->db->trans_status();
            }
        }
    }

    /**
     * upgradePaymentWxSuccess 升级,微信支付完成后的数据异步处理
     *
     * @param $callbackData
     *
     * @return array
     */
    public function upgradePaymentWxSuccess($callbackData)
    {
        if (empty($callbackData)) {
            return ['status' => -1, 'msg' => '回调数据为空'];
        }

        if (empty($callbackData['out_trade_no']) || empty($callbackData['attach'])) {
            return ['status' => -1, 'msg' => '订单编号错误'];
        }

        $userId = (int)$callbackData['attach'];
        $orderNumber = (int)$callbackData['out_trade_no'];

        // 判断当前pay_callback_result记录是否已经存在
        $exists = $this->setTable('pay_callback_result')
            ->setAndCond([
                'user_id'      => $userId,
                'order_number' => $orderNumber,
                'notify_type'  => 3, // 3:微信同步通知
            ])
            ->count();
        if ($exists) {
            return ['status' => 0, 'msg' => '回调业务已处理'];
        }
        // 获取当前订单信息
        $fields = 'id,box_id,upgrade_before_order_value,upgrade_order_value,'
            . 'upgrade_before_pay_value,upgrade_pay_value,'
            . 'upgrade_before_plan_number,upgrade_plan_number,'
            . 'post_name,post_phone,post_addr,upgrade_post_name,'
            . 'upgrade_post_phone,upgrade_post_addr,upgrade_status';
        $realOrderNumber = substr($orderNumber, 0, 18) . 0;
        $order = $this->setTable('order')
            ->setSelectFields($fields)
            ->setAndCond(['order_number' => $realOrderNumber, 'user_id' => $userId, 'status' => 2])
            ->get();
        if (empty($order)) {
            return ['status' => -1, 'msg' => '订单不存在'];
        }

        // 支付日志数据
        $insertCallbackData = [
            'user_id'      => $userId,
            'order_number' => $orderNumber,
            'notify_type'  => 3, // 0:支付宝同步通知 1:支付宝异步通知,3:微信异步通知
            'pay_type'     => 2, // 支付类型[0:支付宝电脑网站支付,1:支付宝手机网站支付,微信PC支付]
            'http_method'  => 'POST',
            'content'      => json_encode($callbackData, JSON_UNESCAPED_UNICODE),
        ];

        // 判断支付是否成功在进行业务处理
        if (! empty($callbackData['return_code']) && 'SUCCESS' == $callbackData['return_code'] && ! empty($callbackData['result_code']) && 'SUCCESS' == $callbackData['result_code']) { // 成功
            // 获取最大一期的计划
            $fields = 'plan_date';
            $maxOrderPlan = $this->setTable('order_plan')
                ->setSelectFields($fields)
                ->setAndCond(['order_id' => $order['id'], 'user_id' => $userId, 'status' => 0])
                ->get();
            if (empty($maxOrderPlan)) {
                return ['status' => -1, 'msg' => '订单计划不存在'];
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
                'upgrade_status'     => 2, // 2:支付成功
                'upgrade_pay_status' => 2, // 2:支付成功
            ];
            $updateOrderCondition = [
                'id'      => $order['id'],
                'user_id' => $userId,
                'status'  => 2,
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
                    'upgrade_status' => 2, // 升级计划状态,1:升级已确认,2:升级已完成,3:升级失败
                ];
            }

            $this->db->trans_start();
            // 修改order订单信息
            $this->setTable('order')
                ->setUpdateData($updateOrderDate)
                ->setAndCond($updateOrderCondition)
                ->update();
            // 存储订单计划order_plan
            $this->setTable('order_plan')
                ->setInsertData($orderPlansDate)
                ->createBatch();
            // 存储callback data
            $this->setTable('pay_callback_result')
                ->setInsertData($insertCallbackData)
                ->create();
            $this->db->trans_complete();
            $status = intval(! $this->db->trans_status());
            $msg = 'OK';
            0 !== $status && $msg = '业务处理失败';

            return ['status' => $status, 'msg' => $msg];
        } else { // 支付失败
            // 订单修改数据
            $updateOrderDate = [
                'upgrade_status'     => 3, // 3:升级失败
                'upgrade_pay_status' => 4, // 4:支付失败
            ];
            $updateOrderCondition = [
                'id'      => $order['id'],
                'user_id' => $userId,
                'status'  => 2,
            ];

            $this->db->trans_start();
            // 修改order订单信息
            $this->setTable('order')
                ->setUpdateData($updateOrderDate)
                ->setAndCond($updateOrderCondition)
                ->update();
            // 存储callback data
            $this->setTable('pay_callback_result')
                ->setInsertData($insertCallbackData)
                ->create();
            $this->db->trans_complete();
            $status = intval(! $this->db->trans_status());
            $msg = 'OK';
            0 !== $status && $msg = '业务处理失败';

            return ['status' => $status, 'msg' => $msg];
        }
    }

    /**
     * productPaymentWxSuccess 购买,微信支付完成后的数据异步处理
     *
     * @param $callbackData
     *
     * @return array
     */
    public function productPaymentWxSuccess($callbackData)
    {
        if (empty($callbackData)) {
            return ['status' => -1, 'msg' => '回调数据为空'];
        }

        if (empty($callbackData['out_trade_no']) || empty($callbackData['attach'])) {
            return ['status' => -1, 'msg' => '订单编号错误'];
        }

        $userId = (int)$callbackData['attach'];
        $orderNumber = (int)$callbackData['out_trade_no'];

        // 判断当前pay_callback_result记录是否已经存在
        $exists = $this->setTable('pay_callback_result')
                       ->setAndCond([
                           'user_id'      => $userId,
                           'order_number' => $orderNumber,
                           'notify_type'  => 3, // 3:微信同步通知
                       ])
                       ->count();
        if ($exists) {
            return ['status' => 0, 'msg' => '回调业务已处理'];
        }
        $realOrderNumber = substr($orderNumber, 0, 18) . 0;
        $order = $this->setTable('order')
                      ->setSelectFields('*')
                      ->setAndCond(['order_number' => $realOrderNumber, 'user_id' => $userId, 'status' => 0])
                      ->get();
        if (empty($order)) {
            return ['status' => -1, 'msg' => '订单不存在'];
        }

        // 支付日志数据
        $insertCallbackData = [
            'user_id'      => $userId,
            'order_number' => $orderNumber,
            'notify_type'  => 3, // 0:支付宝同步通知 1:支付宝异步通知,3:微信异步通知
            'pay_type'     => 2, // 支付类型[0:支付宝电脑网站支付,1:支付宝手机网站支付,2:微信PC支付]
            'http_method'  => 'POST',
            'content'      => json_encode($callbackData, JSON_UNESCAPED_UNICODE),
        ];

        // 判断支付是否成功在进行业务处理
        if (! empty($callbackData['return_code']) && 'SUCCESS' == $callbackData['return_code'] && ! empty($callbackData['result_code']) && 'SUCCESS' == $callbackData['result_code']) { // 成功
            $updateOrderData = ['status' => 2];
        } else { // 支付失败
            // 订单修改数据
            $updateOrderData = ['status' => 4];
        }
        $updateOrderCondition = [
            'id'      => $order['id'],
            'user_id' => $userId,
            'status'  => 0,
        ];
        $this->db->trans_start();
        // 修改order订单信息
        $this->setTable('order')
             ->setUpdateData($updateOrderData)
             ->setAndCond($updateOrderCondition)
             ->update();
        // 存储callback data
        $this->setTable('pay_callback_result')
             ->setInsertData($insertCallbackData)
             ->create();
        $this->db->trans_complete();
        $status = intval(! $this->db->trans_status());
        if ($status && $order['is_gift'] == 1 && $order['is_send_gift_email'] == 0) {
            $query_url = base_url('gift/info') . '?id=' . $order['id'] . '&k=' . md5($order['created_at'] . md5($order['id']));
            $result = $this->sendGiftEmail($order['gift_email'], $order['post_name'], $order['gift_sender_name'], $query_url);
            if($result){
                $this->setTable('order')
                     ->setUpdateData(['is_send_gift_email' => 1])
                     ->setAndCond(['id' => $order['id']])
                     ->update();
            }
        }
        // 优惠券
        if ($status && ! empty($order['coupon_id']) && ! empty($order['coupon_value'])) {
            $coupon_update['use_time'] = date('Y-m-d H:i:s');
            $coupon_update['status'] = 1;
            $this->setTable('coupon')
                 ->setUpdateData($coupon_update)
                 ->setAndCond(['id' => $order['coupon_id'], 'status' => 0])
                 ->update();
        }
        // 发送电子凭据
        if ($status && $order['is_send_email'] == 0) {
            $this->load->model('user_model');
            $this->load->model('box_model');
            $user_info = $this->user_model->setSelectFields('*')->find($userId);
            $box_info = $this->box_model->setSelectFields('theme_name,logistics_image')->find($order['box_id']);
            if (! empty($user_info) && ! empty($box_info)) {
                $send_result = $this->sendReceipt($user_info['login_email'], $user_info['login_email'], $order['order_number'], $user_info['post_name'], $user_info['post_addr'], $order['coupon_value'], $order['order_value'], $order['pay_value'], $order['plan_number'], $box_info['theme_name'], $box_info['logistics_image']);
                if ($send_result) {
                    $this->setTable('order')
                         ->setUpdateData(['is_send_email' => 1])
                         ->setAndCond(['id' => $order['id']])
                         ->update();
                }
            }
        }
        $msg = 'OK';
        0 !== $status && $msg = '业务处理失败';

        return ['status' => $status, 'msg' => $msg];
    }
    /**
     * productPaymentZfbCompleted 购买盒子支付完成后的数据同步处理
     *
     * @param $userId
     * @param $orderNumber
     * @param $callbackData
     *
     * @return bool
     */
    public function productPaymentZfbCompleted($userId, $orderNumber, $callbackData)
    {
        $exists = $this->setTable('pay_callback_result')
                                ->setSelectFields('user_id')
                                ->setAndCond([
                                    'order_number' => $orderNumber,
                                    'notify_type'  => 0,
                                ])
                                ->count();
        if ($exists) {
            return true;
        }

        // 获取当前订单信息
        $realOrderNumber = substr($orderNumber, 0 ,18) . 0;
        $order = $this->setTable('order')
                      ->setSelectFields('*')
                      ->setAndCond(['order_number' => $realOrderNumber, 'user_id' => $userId])
                      ->get();
        if (empty($order)) {
            return false;
        }

        // 支付日志数据
        $insertCallbackData = [
            'user_id'      => $userId,
            'order_number' => $orderNumber,
            'notify_type'  => 0, // 0:支付宝同步通知
            'pay_type'     => 1, // 支付类型[0:支付宝电脑网站支付,1:支付宝手机网站支付]
            'http_method'  => 'GET',
            'content'      => json_encode($callbackData, JSON_UNESCAPED_UNICODE),
        ];

        // 判断是否已经异步调用
        if (2 == $order['status']) { // 已经异步调用,只写入同步回调记录
            // 存储callback data
            return (bool)$this->setTable('pay_callback_result')
                              ->setInsertData($insertCallbackData)
                              ->create();
        }

        // 订单修改数据
        $updateOrderDate = [
            'status'        => 1,
        ];

        $this->db->trans_start();
        // 修改order订单信息
        $this->setTable('order')
             ->setUpdateData($updateOrderDate)
             ->setAndCond(['id' => $order['id'], 'user_id' => $userId, 'status' => 0])
             ->update();
        // 存储callback data
        $this->setTable('pay_callback_result')
             ->setInsertData($insertCallbackData)
             ->create();
        $this->db->trans_complete();
        $trans_status = $this->db->trans_status();
        if ($trans_status && $order['is_gift'] == 1 && $order['is_send_gift_email'] == 0) {
            $query_url = base_url('gift/info').'?id='.$order['id'].'&k='.md5($order['created_at'] . md5($order['id']));
            $result = $this->sendGiftEmail($order['gift_email'], $order['post_name'], $order['gift_sender_name'], $query_url);
            if($result){
                $this->setTable('order')
                     ->setUpdateData(['is_send_gift_email' => 1])
                     ->setAndCond(['id' => $order['id']])
                     ->update();
            }
        }
        // 优惠券
        if ($trans_status && ! empty($order['coupon_id']) && ! empty($order['coupon_value'])) {
            $coupon_update['use_time'] = date('Y-m-d H:i:s');
            $coupon_update['status'] = 1;
            $this->setTable('coupon')
                 ->setUpdateData($coupon_update)
                 ->setAndCond(['id' => $order['coupon_id'], 'status' => 0])
                 ->update();
        }
        // 发送电子凭据
        if ($trans_status && $order['is_send_email'] == 0) {
            $this->load->model('user_model');
            $this->load->model('box_model');
            $user_info = $this->user_model->setSelectFields('*')->find($userId);
            $box_info = $this->box_model->setSelectFields('theme_name,logistics_image')->find($order['box_id']);
            if (! empty($user_info) && ! empty($box_info)) {
                $send_result = $this->sendReceipt($user_info['login_email'], $user_info['login_email'], $order['order_number'], $user_info['post_name'], $user_info['post_addr'], $order['coupon_value'], $order['order_value'], $order['pay_value'], $order['plan_number'], $box_info['theme_name'], $box_info['logistics_image']);
                if ($send_result) {
                    $this->setTable('order')
                         ->setUpdateData(['is_send_email' => 1])
                         ->setAndCond(['id' => $order['id']])
                         ->update();
                }
            }
        }
        return $trans_status;
    }

    /**
     * productPaymentZfbSuccess 购买盒子支付完成后的数据异步处理
     *
     * @param $userId
     * @param $orderNumber
     * @param $callbackData
     *
     * @return bool
     */
    public function productPaymentZfbSuccess($userId, $orderNumber, $callbackData)
    {
        $exists = $this->setTable('pay_callback_result')
                                ->setSelectFields('user_id')
                                ->setAndCond([
                                    'user_id' =>$userId,
                                    'order_number' => $orderNumber,
                                    'notify_type'  => 1,
                                ])
            ->count();
        if ($exists) {
            log_message('error','已经写过了');
            return true;
        }
        // 获取当前订单信息
        $realOrderNumber = substr($orderNumber, 0, 18) . 0;
        $order = $this->setTable('order')
                      ->setSelectFields('*')
                      ->setAndCond(['order_number' => $realOrderNumber, 'user_id' => $userId])
                      ->get();
        log_message('error',json_encode($order));
        if (empty($order)) {
            log_message('error','没有订单');
            return false;
        }

        // 支付日志数据
        $insertCallbackData = [
            'user_id'      => $userId,
            'order_number' => $orderNumber,
            'notify_type'  => 1, // 0:支付宝同步通知 1:支付宝异步通知
            'pay_type'     => 1, // 支付类型[0:支付宝电脑网站支付,1:支付宝手机网站支付]
            'http_method'  => 'POST',
            'content'      => json_encode($callbackData, JSON_UNESCAPED_UNICODE),
        ];

        // 判断是否已经同步调用
        if (1 == $order['status']) { // 已经同步调用,修改订单相关状态数据
            // 判断支付是否成功在进行业务处理
            if (in_array($callbackData['trade_status'], ['TRADE_SUCCESS', 'TRADE_FINISHED'])) {
                $updateOrderData = ['status' => 2];
            } else { // 支付失败
                $updateOrderData = ['status' => 4];
            }
            $updateOrderCondition = [
                'id'      => $order['id'],
                'user_id' => $userId,
                'status'  => 1,
            ];
        } else { // 还没有调用同步,直接写入支付成功的订单状态数据
            // 判断支付是否成功再进行业务处理
            if (in_array($callbackData['trade_status'], ['TRADE_SUCCESS', 'TRADE_FINISHED'])) { // 成功
                $updateOrderData = ['status' => 2,];
            } else { // 支付失败
                $updateOrderData = ['status' => 4,];
            }
            $updateOrderCondition = [
                'id'      => $order['id'],
                'user_id' => $userId,
                'status'  => 0,
            ];
        }
        $this->db->trans_start();
        // 修改order订单信息
        $this->setTable('order')
             ->setUpdateData($updateOrderData)
             ->setAndCond($updateOrderCondition)
             ->update();
        // 存储callback data
        $this->setTable('pay_callback_result')
             ->setInsertData($insertCallbackData)
             ->create();
        $this->db->trans_complete();
        $trans_status = $this->db->trans_status();
        if ($trans_status && $order['is_gift'] == 1 && $order['is_send_gift_email'] == 0) {
            $query_url = base_url('gift/info') . '?id=' . $order['id'] . '&k=' . md5($order['created_at'] . md5($order['id']));
            $result = $this->sendGiftEmail($order['gift_email'], $order['post_name'], $order['gift_sender_name'], $query_url);
            if($result){
                $this->setTable('order')
                     ->setUpdateData(['is_send_gift_email' => 1])
                     ->setAndCond(['id' => $order['id']])
                     ->update();
            }
        }
        // 优惠券
        if ($trans_status && ! empty($order['coupon_id']) && ! empty($order['coupon_value'])) {
            $coupon_update['use_time'] = date('Y-m-d H:i:s');
            $coupon_update['status'] = 1;
            $this->setTable('coupon')
                 ->setUpdateData($coupon_update)
                 ->setAndCond(['id' => $order['coupon_id'], 'status' => 0])
                 ->update();
        }
        // 发送电子凭据
        if ($trans_status && $order['is_send_email'] == 0) {
            $this->load->model('user_model');
            $this->load->model('box_model');
            $user_info = $this->user_model->setSelectFields('*')->find($userId);
            $box_info = $this->box_model->setSelectFields('theme_name,logistics_image')->find($order['box_id']);
            if (! empty($user_info) && ! empty($box_info)) {
                $send_result = $this->sendReceipt($user_info['login_email'], $user_info['login_email'], $order['order_number'], $user_info['post_name'], $user_info['post_addr'], $order['coupon_value'], $order['order_value'], $order['pay_value'], $order['plan_number'], $box_info['theme_name'], $box_info['logistics_image']);
                if ($send_result) {
                    $this->setTable('order')
                         ->setUpdateData(['is_send_email' => 1])
                         ->setAndCond(['id' => $order['id']])
                         ->update();
                }
            }
        }
        return $trans_status;
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

    /**
     * createOrder 创建订单
     * @param array $user_info 用户
     * @param array $box_info 盒子
     * @param array $coupon_info 优惠券
     * @param array $extra_data 其他信息
     *
     * @return bool
     */
    public function createOrder($user_info, $box_info, $coupon_info, $extra_data)
    {
        $this->db->trans_start();

        if (! empty($coupon_info)) {
            $insert_order['coupon_id'] = $coupon_info['id'];
            $insert_order['coupon_value'] = $coupon_info['value'];
        }
        // 订单
        $insert_order['order_number'] = empty($extra_data['order_number']) ? $this->generateOrderNumber() : $extra_data['order_number'];
        $insert_order['user_id'] = $user_info['id'];
        $insert_order['box_id'] = $box_info['id'];
        $insert_order['box_name'] = $box_info['name'];
        $insert_order['order_value'] = $extra_data['order_value'];
        $insert_order['pay_value'] = $extra_data['pay_value'];
        $insert_order['plan_number'] = $extra_data['plan'];
        $insert_order['shirt_sex'] = $extra_data['shirt_sex'];
        $insert_order['shirt_size'] = $extra_data['shirt_size'];
        $insert_order['post_name'] = $extra_data['post_name'];
        $insert_order['post_phone'] = $extra_data['post_phone'];
        $insert_order['post_addr'] = $extra_data['post_addr'];
        if(!empty($extra_data['is_gift'])){
            $insert_order['is_gift'] = 1;
            $insert_order['gift_email'] = $extra_data['gift_email'];
            $insert_order['gift_sender_name'] = $extra_data['gift_sender_name'];
        }
        $order_id = $this->setTable('order')->setInsertData($insert_order)->create();
        // 订单计划数据
        $insert_order_plan = [];
        for ($i = 1;$i <= $extra_data['plan'];$i++) {
            $plan_timestamp = strtotime(" + $i months");
            $plan_year = date('Y', $plan_timestamp);
            $plan_month = date('m', $plan_timestamp);
            $plan_date = date('Y-m-d', $plan_timestamp);
            $insert_order_plan[] = [
                'order_id'   => $order_id,
                'user_id'    => $user_info['id'],
                'box_id'     => $box_info['id'],
                'plan_year'  => $plan_year,
                'plan_month' => $plan_month,
                'plan_date'  => $plan_date,
            ];
        }
        $this->setTable('order_plan')
             ->setInsertData($insert_order_plan)
             ->createBatch();
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function sendReceipt($email, $mz_email, $order_number, $user_name, $user_addr, $coupon, $order_value, $pay_value, $plan, $theme_name, $logistics_image)
    {
        $this->load->library('email');
        // 以下设置Email参数
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.exmail.qq.com';
        $config['smtp_user'] = 'weloveyou@amazingfun.cn';
        $config['smtp_pass'] = 'Amazing123';
        $config['smtp_port'] = '25';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = true;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $this->email->from('weloveyou@amazingfun.cn', 'AmazingFun');
        $this->email->to($email);

        $this->email->subject('AmazingFun-收据');
        $date = date("Y年m月d日");
        $message = "<div class=\"\" style=\"display:block;padding:0;margin:0;height:100%;max-height:none;min-height:none;line-height:normal;overflow:visible;\">
    <table class=\"\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" style=\"border-collapse:collapse;border-spacing:0;width:742px;\">
        <tbody><tr>
            <td align=\"left\" style=\"font-size:32px; font-weight:300; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: rgb(153,153,153)\">订阅收据</td>
            <td class=\"\" style=\"width:40px;\"></td>
        </tr>
        <tr height=\"20\"><td colspan=\"4\"></td></tr><tr>

        </tr><tr>
            <td colspan=\"4\" align=\" center\">
                <table class=\"\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"660\" style=\"border-collapse:collapse;border-spacing:0;\">
                    <tbody><tr>
                        <td>
                            <table class=\"\" border=\"0\" bordercolor=\"#ffffff\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse:collapse;border-spacing:0;color:rgb(51,51,51);background-color: rgb(245,245,245);border-radius:3px;font-size:12px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;\">
                                <tbody><tr height=\"46\">
                                    <td width=\"320\" colspan=\"2\" style=\"padding-left:20px;border-style: solid;border-color: white;border-left-width: 0px;border-right-width: 1px;border-bottom-width: 1px;border-top-width: 0px;\"><span style=\"color:rgb(153,153,153);font-size:10px;\">AmazingFun ID</span><br>{$mz_email}</td>
                                    <td width=\"220\" rowspan=\"3\" style=\"padding-left:20px;border-style:solid;border-color:white;border-left-width:0px;border-right-width:0px;border-bottom-width:0px;border-top-width:0px;\">
                                        <span style=\"color:rgb(153,153,153);font-size:10px;\">付款信息</span><br>
                                                   {$user_name}<br>
                                        {$user_addr}                                                       </td>
                                    <td width=\"120\" rowspan=\"3\" align=\"right\" style=\"padding-right: 20px;border-style:solid;border-color:white; border-left-width:1px;border-right-width:0px;border-bottom-width:0px;border-top-width:0px;\"><span style=\"color:rgb(153,153,153);font-size:10px;\">总计</span><br><span style=\"font-size:16px;font-weight:bold;\">¥{$pay_value}</span></td>
                                </tr>
                                <tr height=\"46\">
                                    <td colspan=\"2\" style=\"padding-left:20px;border-style:solid; border-color:white;border-left-width:0px;border-right-width:1px;border-bottom-width:1px;border-top-width:0px;\"><span style=\"color:rgb(153,153,153);font-size:10px;\">日期</span><br>{$date}</td>
                                </tr>
                                <tr height=\"46\">
                                    <td style=\"padding-left:20px;border-style:solid;border-color:white;border-left-width:0px;border-right-width:1px;border-bottom-width:0px;border-top-width:0px;\"><span style=\"color:rgb(153,153,153);font-size:10px;\">订单号</span><br><span style=\"color:#0073ff;\"><a target=\"_blank\" href=\"http://www.amazingfun.cn/\" _act=\"check_domail\">{$order_number}</a></span></td>
                                </tr>
                                </tbody></table>
                        </td>
                    </tr>

                    <tr height=\"30\"><td></td></tr>
                    <tr>
                        <td>
                            <table class=\"\" width=\"660\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse:collapse;border-spacing:0;width:660px;color:rgb(51,51,51);font-size:12px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;\">
                                <tbody><tr height=\"24\" style=\"background-color: rgb(245,245,245);\" class=\"\">
                                    <td colspan=\"2\" width=\"350\" style=\"width:350px;padding-left:10px;border-top-left-radius:3px;border-bottom-left-radius:3px;\"><span style=\"font-size:14px;font-weight:500;\">盒子类型</span></td>
                                    <td width=\"100\" style=\"width:100px;padding-left:20px;\"><span style=\"color:rgb(153,153,153);font-size:10px;position:relative;top:1;\">订阅期限</span></td>
                                    <td width=\"120\" style=\"width:120px;padding-left:20px;\"><span style=\"color:rgb(153,153,153);font-size:10px;position:relative;top:1;\">优惠信息</span></td>
                                    <td width=\"90\" align=\"right\" style=\"width:100px;padding-right: 20px;position:relative;top:1;border-top-right-radius:3px;border-bottom-right-radius:3px;\"><span style=\"color:rgb(153,153,153);font-size:10px;white-space:nowrap;\">价格</span></td>
                                </tr>

                                <tr height=\"90\">
                                    <td width=\"60\" class=\"\" align=\"center\" style=\"padding:0 0 0 20px;margin:0;height:60px;width:60px;\">
                                        <img src=\"{$logistics_image}\" width=\"100\" height=\"60\" border=\"0\" alt=\"AmazingFunDx\" style=\"padding:0;margin:0;-ms-interpolation-mode: bicubic;border-radius:14px;border:1px solid rgba(128,128,128,0.2);\">
                                    </td>
                                    <td width=\"260\" style=\"padding:0 0 0 20px;width:260px;line-height:15px;\" class=\"\">
                                        <span class=\"\" style=\"font-weight:600;\">{$theme_name}</span><br>
                                    </td>
                                    <td width=\"100\" class=\"\" style=\"padding:0 0 0 20px;width:100px;\"><span style=\"color:rgb(153,153,153)\">{$plan}个月</span></td>
                                    <td width=\"120\" class=\"\" style=\"padding:0 0 0 20px;width:120px;\"><span style=\"color:rgb(153,153,153);\">¥{$coupon}</span></td>
                                    <td width=\"90\" class=\"\" align=\"right\" style=\"padding:0 20px 0 0;width:100px;\"><span style=\"font-weight:600;white-space:nowrap;\">¥{$order_value}</span></td>
                                </tr>

                                </tbody></table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class=\"\" width=\"660\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse:collapse;border-spacing:0;width:660px;color:rgb(51,51,51);font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;\">
                                <tbody><tr height=\"1\"><td height=\"1\" colspan=\"3\" style=\"padding:0 10px 0 10px;\"><div style=\"line-height:1px;height:1px;background-color:rgb(238,238,238);\"></div></td></tr>
                                <tr height=\"48\">
                                    <td align=\"right\" style=\"color:rgb(153,153,153);font-size:10px;font-weight:600;padding:0 30px 0 0;border-width:1px;border-color:rgb(238,238,238);\">总计</td>
                                    <td width=\"1\" style=\"background-color:rgb(238,238,238);width:1px;\"></td>
                                    <td width=\"90\" align=\"right\" style=\"width:120px;padding:0 20px 0 0;font-size:16px;font-weight:600;white-space:nowrap;\">¥{$pay_value}</td>
                                </tr>
                                <tr height=\"1\"><td height=\"1\" colspan=\"3\" style=\"padding:0 10px 0 10px;\"><div style=\"line-height:1px;height:1px;background-color:rgb(238,238,238);\"></div></td></tr>
                                </tbody></table>
                        </td>
                    </tr>
                    </tbody></table>
            </td>
        </tr>
        </tbody></table>
</div>";
        $this->email->message($message);

        return $this->email->send(false);
    }

    public function sendGiftEmail($email, $to_name, $sender_name,$query_url)
    {
        $this->load->library('email');
        // 以下设置Email参数
        $config['crlf']="\r\n";
        $config['newline']="\r\n";
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.exmail.qq.com';
        $config['smtp_user'] = 'weloveyou@amazingfun.cn';
        $config['smtp_pass'] = 'Amazing123';
        $config['smtp_port'] = '25';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = true;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $this->email->from('weloveyou@amazingfun.cn', 'AmazingFun');
        $this->email->to($email);

        $this->email->subject('您的朋友给你送了一个礼物');
        $message = "<div class=\"\" style=\"display:block;padding:0;margin:0;height:100%;max-height:none;min-height:none;line-height:normal;overflow:visible;\">
    <span style=\"font-family: 'proxima_nova_rgregular', Helvetica; font-weight: normal;\">
{$to_name},你好 :<br><br>
        &nbsp; &nbsp; &nbsp; &nbsp;您拥有一个爱您的家人和朋友{$sender_name}给你送了一份惊喜，我们很荣幸为您准备这份充满爱意的礼物，请您注意接收来自AmazingFun的快递。
        <br><br>自收到本邮件7个工作日内未收到礼物,您可通过您的邮箱地址来<a href=\"{$query_url}\">此处</a>查询订单详情

        <br/><br/>
AmazinFun 团队,
        <br><br>
    </span>
</div>";
        $this->email->message($message);

        return $this->email->send(false);
    }

    public function show_vote_status($order_number)
    {
        $order = $this->setSelectFields('box_id')->setTable('order')->setAndCond(['order_number' => $order_number])->get();
        if (! empty($order['box_id'])) {
            $this->load->model('box_model');
            $box_info = $this->box_model->setSelectFields('theme_id')->find($order['box_id']);
            if (! empty($box_info['theme_id'])) {
                if ($box_info['theme_id'] == 1) {
                    $this->session->set_userdata('show_vote_status', 1);
                }
            }
        }
    }
}
