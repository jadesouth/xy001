<?php

class Home extends Home_Controller
{
    /**
     * index 网站首页
     */
    public function index()
    {
        $this->load->model('box_model');
        $box_list = $this->box_model->getHomePageBoxInfo();
        $this->_viewVar['box_list'] = $box_list;
        // 获取图片墙
        $this->load->model('show_wall_model');
        $showWalls = $this->show_wall_model->setSelectFields('id,image,url,type')
            ->read();
        $videosWall = null;
        $imagesWall = null;
        if (! empty($showWalls)) {
            foreach ($showWalls as $showWall) {
                0 == $showWall['type'] && $videosWall[] = $showWall;
                1 == $showWall['type'] && $imagesWall[] = $showWall;
            }
        }
        $this->_viewVar['videosWall'] = $videosWall;
        $this->_viewVar['imagesWall'] = $imagesWall;
        $this->_viewVar['body_attr'] = ' id="homepage-index" class="homepage homepage is-mobile"';
        $this->load_view();
    }
}
