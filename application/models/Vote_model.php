<?php

/**
 * Class Vote_model 投票模型
 *
 */
class Vote_model extends MY_Model
{
    /**
     * add 添加投票
     *
     * @param array $vote 投票信息
     * @return mixed
     */
    public function add(array $vote)
    {
        if (empty($vote['image']) || empty($vote['content'])) {
            return false;
        }

        $this->_insertData = $vote;
        return $this->create();
    }
}
