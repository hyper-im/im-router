<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2018 https://www.t12.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：19-7-30 下午4:31
 * | Author: Bada (346025425@qq.com) QQ：346025425
 * +----------------------------------------------------------------------
 */

namespace App\Controller\v1;

use App\Controller\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;

/**
 * Notes: apidoc测试
 * Class ApiController
 * @package App\Controller\v1
 * @\Hyperf\HttpServer\Annotation\Controller(prefix="/v1/test")
 */
class ApiController extends Controller
{
    /**
     * @api {get} /test/add 添加用户
     * @apiDescription 添加用户
     * @apiGroup Test
     * @apiPermission none
     * @apiParam {uid} uid     用户uid
     * @apiVersion 1.7.11
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 201 Created
     *     {
     *         "code": 200,
     *         "msg": "success",
     *         "data": "添加成功"
     *     }
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 101
     *     {
     *         "code": 101,
     *         "msg": "error",
     *         "data": "添加失败"
     *     }
     *
     * @GetMapping(path="add")
     */
    public function add()
    {
        if($this->request->query('uid','') == 10){
            return success('添加成功');
        }else{
            return error('添加失败');
        }
    }
}
