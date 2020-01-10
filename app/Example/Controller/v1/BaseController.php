<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2018 https://www.t12.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：19-7-23 下午3:39
 * | Author: Bada (346025425@qq.com) QQ：346025425
 * +----------------------------------------------------------------------
 */

namespace App\Controller\v1;

use App\Controller\Controller;
use App\Exception\ValidateException;
use App\Model\Service\BaseService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\GetMapping;

/**
 * Notes: 网站通用接口
 * Class BaseController
 * @package App\Controller\v1
 * @\Hyperf\HttpServer\Annotation\Controller(prefix="/v1/base")
 */
class BaseController extends Controller
{

    /**
     * @Inject()
     * @var \Redis
     */
    protected $redis;

    /**
     * @Inject()
     * @var BaseService
     */
    protected $baseService;

    /**
     * 根据symbol匹配得到对应标识
     * @GetMapping(path="symbols")
     */
    public function symbols(){
        $symbol     = $this->request->query('symbol','');
        $symbolType = $this->request->query('type','');

        if(!$symbol){
            throw new ValidateException("symbol必填");
        }
        $result = $this->baseService->symbol($symbol,$symbolType);
        return success($result);
    }

    /**
     * 友情链接
     * @GetMapping(path="friendLink")
     */
    public function friendLink()
    {
//        $data = db("category")->where(["type" => "friendLink","status" => 'normal'])->select();
//        cache('frendlink',$data);
    }


}
