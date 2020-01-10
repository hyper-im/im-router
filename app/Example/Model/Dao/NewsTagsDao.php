<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2018 https://www.t12.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：19-7-22 下午2:14
 * | Author: Bada (346025425@qq.com) QQ：346025425
 * +----------------------------------------------------------------------
 */

namespace App\Model\Dao;

use App\Model\Db\FaBlockRelationtags;

/**
 * Notes: 快讯tags-Dao层,封装sql操作
 * Class NewsTagsDao
 * @package App\Model\Dao
 */
class NewsTagsDao
{
    /**
     * 通过relationId，获取tags
     * @param $ids
     * @return
     */
    public function getTagsByRelationId($ids){

        $tags = [];
        if(is_array($ids))
        {
            $data = FaBlockRelationtags::query()->findMany($ids,['tagId','relationId'])->toArray();
            array_walk($data, function($v) use(&$tags){
                $tags[$v['relationId']][] = $v['tagId'];
            });
        }else{
            $tags = FaBlockRelationtags::query()->find($ids,['tagId','relationId']);
        }
        return $tags;
    }
}
