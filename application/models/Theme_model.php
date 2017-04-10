<?php

/**
 * Class Theme_model 主题管理模型
 *
 * @author wangnan <wangnanphp@163.com>
 * @date   2017-04-09 13:42:48
 */
class Theme_model extends MY_Model
{
    /**
     * add
     *
     * @param $theme_info
     *
     * @return bool|mixed
     * @author wangnan <wangnanphp@163.com>
     * @date   2017-04-09 14:36:53
     */
    public function add($theme_info)
    {
        if (empty($theme_info['name'])) {
            return false;
        }

        $this->_insertData['name'] = $theme_info['name'];
        return $this->create();
    }
}
