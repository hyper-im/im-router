<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2018 https://www.t12.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：19-7-22 上午10:25
 * | Author: Bada (346025425@qq.com) QQ：346025425
 * +----------------------------------------------------------------------
 */

namespace App\Model\Validate;

use App\Utils\Validate\Validate;

/**
 * Notes: 快讯验证层
 * Class NewsValidate
 * @package App\Model\Validate
 */
class NewsValidate extends Validate
{
    protected $rule = [
        'nclass' => 'require',
        'page' => 'require|number',
        'perPage' => 'require|number|max:50',
        'id' => 'require|number',
        'action_type' => 'require',
        'platform' => 'require',
        'objId' => 'require|number',
    ];

    protected $message = [
        'nclass.require' => '快讯分类必须填写',
        'page.require' => '分页必须传递',
        'page.number' => '分页必须是整形',
        'perPage.require' => '分页size必须传递',
        'perPage.number' => '分页size必须是整形',
        'perPage.max' => '分页最大为50',
        'id.require' => 'id必须传递',
        'id.number' => 'id必须为整形',
        'objId.require' => 'objId必须传递',
        'objId.number' => 'objId必须为整形',
    ];

    protected $scene = [
        'list' => [],//列表页参数不做验证
        'detail' => ['id'],
        'action' => ['objId', 'action_type', 'platform'],
    ];
}
