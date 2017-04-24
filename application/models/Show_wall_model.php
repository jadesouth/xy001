<?php

/**
 * Class Show_wall_model
 */
class Show_wall_model extends MY_Model
{
    /**
     * add 添加展示墙
     *
     * @param array $show_wall_info 展示墙信息
     * @return mixed
     */
    public function add(array $show_wall_info)
    {
        if (empty($show_wall_info['image']) || empty($show_wall_info['url']) || ! in_array($show_wall_info['type'], [0, 1])) {
            return false;
        }

        $this->_insertData = $show_wall_info;
        return $this->create();
    }
}
