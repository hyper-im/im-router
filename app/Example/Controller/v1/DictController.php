<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2018 https://www.t12.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：19-7-23 下午3:30
 * | Author: Bada (346025425@qq.com) QQ：346025425
 * +----------------------------------------------------------------------
 */

namespace App\Controller\v1;

use App\Controller\Controller;
use App\Model\Service\DictService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\GetMapping;
use PDepend\Util\Cache\CacheDriver;

/**
 * Notes: 网站缓存配置相关
 * Class DictController
 * @package App\Controller\v1
 * @\Hyperf\HttpServer\Annotation\Controller(prefix="/v1/dict")
 */
class DictController extends Controller
{

    /**
     * @Inject()
     * @var DictService
     */
    protected $dictService;

    /**
     * @Inject()
     * @var \Redis
     */
    protected $redis;

    /**
     * 全站缓存配置管理
     * @GetMapping(path="run")
     */
    public function run(){

    }


    /**
     * @GetMapping(path="symbol")
     */
    public function symbol()
    {
        $data = $this->dictService->symbols();

        foreach ($data as $key=>$val)
        {
            $hash_key = 'dict_symbol_'.$key;
            foreach ($val as $k=>$v){
                $hash_key_field = (string) $k;
                $hash_key_value = json_encode($v);
                $this->redis->hSet($hash_key, $hash_key_field, $hash_key_value);
            }
        }
        return true;
    }
}
