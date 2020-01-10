<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2018 https://www.t12.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2019-02-27 23:03:56
 * | Author: Bada (346025425@qq.com) QQ：346025425
 * +----------------------------------------------------------------------
 */

namespace App\Controller\v1;

use App\Controller\Controller;
use App\Model\Db\FaBlockAnalysisdata;
use App\Model\Logic\CoinLogic;
use App\Model\Service\CoinService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;

/**
 * 币种类管理
 * Class CoinController
 * @package App\Controller
 * @\Hyperf\HttpServer\Annotation\Controller(prefix="/v1/coin")
 */
class CoinController extends Controller
{

    /**
     * @Inject()
     * @var CoinLogic
     */
    protected $coinLogic;

    /**
     * @Inject()
     * @var CoinService
     */
    protected $coinService;

    /**
     * 获取币种列表
     * @PostMapping(path="list")
     */
    public function list(){
        $data = $this->request->post();
        $result = $this->coinService->list($data);
        return success($result);
    }

    /**
     * 币种详情信息
     * @GetMapping(path="detail")
     */
    public function detail(){
        $data = $this->request->query();
        $this->coinLogic->detail($data);
        $result = $this->coinService->detail($data);
        return success($result);
    }

    /**
     * 获取币种K线
     * @GetMapping(path="kline")
     */
    public function kline()
    {

    }
}
