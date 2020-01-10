<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2018 https://www.t12.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：19-7-29 下午5:43
 * | Author: Bada (346025425@qq.com) QQ：346025425
 * +----------------------------------------------------------------------
 */

namespace App\Controller\v1;


use App\Controller\Controller;
use App\Model\Logic\NoticeLogic;
use App\Model\Service\NoticeService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\GetMapping;

/**
 * Notes: 公告接口
 * Class Notice
 * @package App\Controller\v1
 * @\Hyperf\HttpServer\Annotation\Controller(prefix="/v1/notice")
 */
class NoticeController extends Controller
{
    /**
     * @Inject()
     * @var NoticeLogic
     */
    protected $noticeLogic;

    /**
     * @Inject()
     * @var NoticeService
     */
    protected $noticeService;

    /**
     * @GetMapping(path="list")
     */
    public function list(){
        $data = $this->request->query();
        $this->noticeService->list($data);

    }
}
