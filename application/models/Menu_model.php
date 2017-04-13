<?php

/**
 * Class Menu_model 菜单管理模型
 *
 */
class Menu_model extends MY_Model
{
    /**
     * add
     *
     * @param $menu_info
     *
     * @return bool|mixed
     */
    public function add($menu_info)
    {
        if (empty($menu_info['name']) || empty($menu_info['url'] || empty($menu_info['list_order']))) {
            return false;
        }

        $this->_insertData['name'] = $menu_info['name'];
        $this->_insertData['url'] = $menu_info['url'];
        $this->_insertData['list_order'] = $menu_info['list_order'];
        return $this->create();
    }
}
