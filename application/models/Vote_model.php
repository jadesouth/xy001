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

    /**
     * plus1 投票+1
     *
     * @param $vote_id
     * @return bool
     */
    public function plus1($vote_id)
    {
        $vote_id = (int)$vote_id;
        if (0 >= $vote_id) {
            return false;
        }
        $this->db->set('count', 'count+1', false);
        $this->db->where('id', $vote_id);
        return $this->db->update('vote');
    }
}
