<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2018 https://www.t12.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：19-7-22 上午10:35
 * | Author: Bada (346025425@qq.com) QQ：346025425
 * +----------------------------------------------------------------------
 */

namespace App\Model\Dao;

use App\Exception\DaoException;
use App\Exception\ServiceException;
use App\Model\Db\FaBlockFreshnews;
use App\Model\Db\FaUserAction;
use Carbon\Carbon;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Database\Model\Builder;
use Hyperf\Database\Model\Collection;
use Hyperf\DbConnection\Db;
use Hyperf\Di\Annotation\Inject;

/**
 * Notes: 快讯数据层,封装sql操作
 * Class NewsDao
 * @package App\Model\Dao
 */
class NewsDao
{

    /**
     * @Inject()
     * @var ConfigInterface
     */
    protected $config;

    /**
     * @Inject()
     * @var NewsTagsDao
     */
    protected $tagsDao;

    /**
     * @Inject()
     * @var UserActionDao
     */
    protected $userActionDao;

    /**
     * 快讯列表页
     * @param $data
     * @return \Hyperf\Contract\LengthAwarePaginatorInterface|\Hyperf\Contract\PaginatorInterface
     */
    public function list($data){
        list($where, $sort, $order, $page, $perPage, $join) = $this->buildparams($data);
        $model = FaBlockFreshnews::query();
        if($join){
            $model = $model->leftJoin($join['table'],function($conn) use($join){
                $conn->on($join['on'][0], $join['on'][1], $join['on'][2]);
                $join['where'] AND $conn->where($join['where']);
            });
        }
        $list = $model
            ->with('newsTags')
            ->where($where)
            ->orderBy($sort, $order)
            ->paginate($perPage, ['*'], 'page',$page);

//        $newsData = [];
//        foreach ($dbResult->items() as $_news){
//            $newsData['data'][] = collect($_news)->toArray();
//        }
//
//        $idArr = array_column($newsData['data'], 'id');
//        $tags = [];
//        if(!empty($idArr)){
//            $tags = $this->tagsDao->getTagsByRelationId($idArr);
//        }
//
//        //tags
//        $dictNews = $this->config->get("news_freshNewsClass");
//        array_walk($newsData['data'], function(&$v) use($tags, $dictNews){
//            $v['freshNewsStr'] = $dictNews[$v['freshNewsClass']]??'';
//            $v['tags'] = $tags[$v['id']]??'';
//        });


        return $list;
    }

    /**
     * 处理参数
     * @param $data_
     * @return array
     */
    public function buildparams($data){

        $nclass = $data['nclass']??'';
        $title = $data['title']??'';
        $timeLimit = $data['timeLimit']??'';
        $coinId = $data['coinId']??'';
        $sort = $data['sort']??"newsTime";
        $order = $data['order']??"DESC";
        $perPage = (int) $data['perPage'];
        $page = (int) $data['page'];

        $where[] = ["status", "=", 1];
        $join = '';
        if(!empty($coinId))
        {
            $join = [
                'table' => "fa_block_relationtags as tags",
                'on'    => ['fa_block_freshnews.id','=','tags.relationId'],
                'where' => ''
            ];
        }

        //nclass分类有0，判断不为空即可
        if($nclass != '')
        {
            $where[] = ["freshNewsClass", "=", $nclass];
        }

        //24h快讯
        if(!empty($timeLimit) && $timeLimit == 'today')
        {
            //当天凌晨0点
            $today_time = Carbon::today()->timestamp;
            $where[] = ["newsTime", ">=", $today_time];
        }

        //检索标题
        if(!empty($title))
        {
            $where[] = ["title",'like', "%{$title}%"];
        }

        $where = function($query) use($where){
            foreach ($where as $v){
                if(is_array($v)){
                    call_user_func_array([$query, 'where'], $v);
                }
            }
        };
        return [$where, $sort, $order, $page, $perPage, $join];
    }

    /**
     * 快讯详情页
     * @param $data
     * @return Collection|\Hyperf\Database\Model\Model|\Hyperf\Database\Model\Relations\BelongsTo|\Hyperf\Database\Model\Relations\BelongsTo[]|null
     */
    public function detail($data)
    {
        $newsDetail = FaBlockFreshnews::query()->find($data['id']);
        $newsDetail->newsTags; //由于 Hyperf 提供了『动态属性』 ，所以我们可以像访问模型的属性一样访问关联方法：
        return $newsDetail;
    }

    /**
     * 判断当前news-id是否存在
     * @param $id
     * @return Builder|Builder[]|Collection|\Hyperf\Database\Model\Model|null
     */
    public function exist($id)
    {
        return FaBlockFreshnews::query()->find($id);
    }

    /**
     * 快讯文章点赞/取消
     * @param $data
     * @return Builder|Builder[]|Collection|\Hyperf\Database\Model\Model|null
     */
    public function action($data)
    {
        $newsData = $this->exist($data['objId']) ;
        if(!$newsData){
            throw new ServiceException("当前objId不存在");
        }
        var_dump($newsData->toArray());
        //该用户是否已点赞
        $isThumbData = $this->userActionDao->isThumb($data);
        if(!$isThumbData){
            $this->userActionDao->create($data);
        }else{
            if($isThumbData['action_type'] == 1){
                $newsData->good--;
            }else if($isThumbData['action_type'] == 2){
                $newsData->bad--;
            }
        }

        if($data['action_type'] == 1){
            $newsData->good++;
        }else if($data['action_type'] == 2){
            $newsData->bad++;
        }

        var_dump($newsData->toArray());

//        if(!$newsData->save()){
//            throw new DaoException("更新数据错误");
//        }

        return [
            'good' => $newsData->good,
            'bad' => $newsData->bad
        ];
    }
}
