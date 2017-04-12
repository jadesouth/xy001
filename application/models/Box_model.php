<?php

class Box_model extends MY_Model
{
    /**
     * 获取所有主题以及年份
     *
     * @return array
    array (
     * 1 =>
     * array (
     * 'theme_id' => '1',
     * 'theme_name' => 'Amazing   Fun',
     * 'year' =>
     * array (
     * 0 => '2017',
     * 1 => '2016',
     * ),
     * ),
     * )
     */
    public function readAllThemeAndYear()
    {
        $return = [];
        $this->_selectFields = 'count(1) as count,theme_id,theme_name,year';
        $this->_conditions = [
            'GROUP' => ['theme_id', 'year'],
            'ORDER' => 'year desc',
        ];
        $theme_and_year_list = $this->read();
        if (empty($theme_and_year_list)) {
            return $return;
        }

        foreach ($theme_and_year_list as $key => $value) {
            $return[$value['theme_id']]['theme_id'] = $value['theme_id'];
            $return[$value['theme_id']]['theme_name'] = $value['theme_name'];
            $return[$value['theme_id']]['year'][] = $value['year'];
            if (empty($return[$value['theme_id']]['count'])) {
                $return[$value['theme_id']]['count'] = $value['count'];
            } else {
                $return[$value['theme_id']]['count'] += $value['count'];
            }
        }
        return $return;
    }

    public function readBox($theme_id = 0, $year = 0, $month = 0,$select_fields = '*', $page = 0, $page_size = 20, $order = '',$conditions = [])
    {
        if (! empty($theme_id)) {
            $conditions['AND']['theme_id'] = $theme_id;
        }
        if (! empty($year)) {
            $conditions['AND']['year'] = $year;
        }
        if (! empty($month)) {
            $conditions['AND']['month'] = $month;
        }
        $this->_selectFields = $select_fields;
        return $this->getPage($page, $page_size, $order, $conditions);
    }

    public function getLastBoxId($theme_id = 0)
    {
        $this->_conditions['ORDER'] = 'id desc';
        $this->_conditions['LIMIT'] = 1;
        if (! empty($theme_id)) {
            $this->_conditions['AND']['theme_id'] = $theme_id;
        }
        $return = $this->read();
        if (empty($return[0]['id'])) {
            return false;
        }
        return $return[0]['id'];
    }

    /**
     * 获取首页的3个盒子数据
     *
     * @return array
     */
    public function getHomePageBoxInfo(){
        $return = [];
        $year = date('Y',strtotime('-1 month'));
        $month = date('n',strtotime('-1 month'));
        $sql = "SELECT `id`, `theme_id`, `theme_name`, `monthly_price`, `image1`, `image2`, `image3`, `image4` FROM (SELECT * from box order by id desc) as box WHERE   ( `theme_id` IN(1, 2, 3) AND `year` <= '{$year}' AND `month` <= '{$month}'  ) AND `deleted_at` = '0000-00-00 00:00:00' GROUP BY `theme_id`";
        $box_list = $this->query($sql);
        if(empty($box_list)){
            return $return;
        }
        foreach ($box_list as $box){
            $return[$box['theme_id']] = $box;
        }
        return $return;
;
    }

}
