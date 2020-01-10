<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2018 https://www.t12.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：19-7-22 上午9:36
 * | Author: Bada (346025425@qq.com) QQ：346025425
 * +----------------------------------------------------------------------
 */

namespace App\Controller\v1;

use App\Annotation\Login;
use App\Controller\Controller;
use App\Model\Logic\NewsLogic;
use App\Model\Service\NewsService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;

/**
 * Notes: 快讯接口
 * Class NewsController
 * @package App\Controller
 * @\Hyperf\HttpServer\Annotation\Controller(prefix="/v1/news")
 */
class NewsController extends Controller
{

    /**
     * @Inject()
     * @var NewsLogic
     */
    protected $newsLogic;

    /**
     * @Inject()
     * @var NewsService
     */
    protected $newsService;

    /**
     * 快讯列表页接口
     * @GetMapping(path="list")
     */
    public function list(){
        $data = $this->request->query();
        $result = $this->newsService->list($data);
        return success($result);
    }

    /**
     * 快讯详情页列表
     * @GetMapping(path="detail")
     * @return array
     */
    public function detail(){
        $data = $this->request->query();
        $this->newsLogic->detail($data);
        $result = $this->newsService->detail($data);
        return success($result);
    }

    /**
     * 快讯点赞/取消
     * @PostMapping(path="action")
     * @Login()
     * 未完善，待完成
     */
    public function action()
    {
        $data = $this->request->post();
        $this->newsLogic->action($data);
        $data['uid'] = $this->request->uid;
        $result = $this->newsService->action($data);
        return success($result);
    }

}
