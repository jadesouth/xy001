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
     * generateOrderNumber 生成订单编号
     *
     * @return string
     */
    public function generateOrderNumber()
    {
        do {
            $orderNumber = date('YmdHis') . random_number(4);
            $existed = (bool)$this->setAndCond(['order_number' => $orderNumber])
                ->count();
        } while ($existed);

        return $orderNumber;
    }
}
