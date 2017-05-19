<?php
/**
 * Class Vote 投票控制器
 */
class Vote extends Home_Controller
{
    /**
     * partake 投票
     */
    public function partake()
    {
        $show_vote_status = $this->session->userdata('show_vote_status');
        if (! $show_vote_status) {
            http_ajax_response(1, '非法请求');
            return;
        }
        $this->load->helper('http');
        $vote_id = (int)$this->input->post('vote', 0);
        if (0 >= $vote_id) {
            http_ajax_response(1, '非法请求');
            return;
        }

        $this->load->model('vote_model');
        if (true == $this->vote_model->plus1($vote_id)) {
            $this->session->unset_userdata('show_vote_status');
            http_ajax_response(0, '投票成功');
        } else {
            http_ajax_response(2, '投票失败');
        }
    }
}