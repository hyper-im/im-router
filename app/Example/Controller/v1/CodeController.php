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
use App\Model\Dao\UserDao;
use App\Model\Logic\CodeLogic;
use App\Model\Service\CodeService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\RequestMapping;

/**
 * Class CodeController
 * @package App\Controller
 * @\Hyperf\HttpServer\Annotation\Controller(prefix="/v1/code")
 */
class CodeController extends Controller
{

    /**
     * @Inject()
     * @var CodeLogic
     */
    protected $codeLogic;

    /**
     * @Inject()
     * @var UserDao
     */
    protected $codeDao;

    /**
     * @Inject()
     * @var CodeService
     */
    protected $codeService;

    /**
     * 获取验证码
     * @RequestMapping(path="getcode")
     */
    public function getCode()
    {
        $params = $this->request->query();
        $this->codeLogic->getcode($params);
        $this->codeService->getcode($params);
        return success('短信已发送');
    }
}
