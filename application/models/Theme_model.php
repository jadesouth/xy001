<?php

/**
 * Class Theme_model 主题管理模型
 */
class Theme_model extends MY_Model
{
    /**
     * add
     *
     * @param $theme_info
     *
     * @return bool|mixed
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
