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

    public function readBox($theme_id = 0, $year = 0, $select_fields = '*', $page = 0, $page_size = 20, $order = '')
    {
        $conditions = [];
        if (! empty($theme_id)) {
            $conditions['AND']['theme_id'] = $theme_id;
        }
        if (! empty($year)) {
            $conditions['AND']['year'] = $year;
        }
        $this->_selectFields = $select_fields;
        return $this->getPage($page, $page_size, $order, $conditions);
    }

}
