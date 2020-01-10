<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2018 https://www.t12.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：19-7-23 下午10:50
 * | Author: Bada (346025425@qq.com) QQ：346025425
 * +----------------------------------------------------------------------
 */

namespace App\Controller\v1;

use App\Controller\Controller;
use App\Exception\ValidateException;
use App\JsonRpc\UserServiceConsumer;
use App\Model\Db\FaBlockFreshnews;
use App\Model\Db\FaUserInfo;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;

/**
 * Notes: ORM测试
 * Class DbTestController
 * @package App\Controller\v1
 * @\Hyperf\HttpServer\Annotation\Controller(prefix="/v1/orm")
 */
class DbTestController extends Controller
{

    /**
     * @Inject()
     * @var UserServiceConsumer
     */
    public $userService;

    /**
     * @GetMapping(path="getlist")
     */
    public function getlist(){
        return $this->userService->getList();
    }

    /**
     * @GetMapping(path="detail")
     */
    public function detail(){
        $uid = $this->request->query('uid',1111);
        return $this->userService->detail($uid);
    }

    /**
     * @PostMapping(path="add")
     */
    public function add()
    {
        $data = $this->request->post();
        $result = [333];
//        $result = FaUserInfo::query()->insert($data);

        $db = new FaUserInfo();
        $db->fill($data)->save();

//        $db = new FaUserInfo(); 有报错
//        $result = $db->save($data);
//        $model = $db->fill($data)->save();

//        var_dump($model);
//        FaUserInfo::unguard();
//        FaUserInfo::unguarded()
//        $result = FaUserInfo::query()->insert($data);


        return success($result);
    }

    /**
     * @GetMapping(path="get")
     */
    public function get(){
//        $id = $this->request->query("id");
//        $data = FaUserInfo::find($id);
//
//        FaUserInfo::query()
//            ->has()
//            ->where()
//            ->paginate();

//        $data = FaBlockFreshnews::query()
//            ->leftjoin('Fa_block_relationTags as tags',function($join){
//                $join->on('fa_block_freshnews.id','=','tags.relationId')
//                    ->where('tags.tagType','=','1')
//                    ->where('tags.relationType','=','4');
//            })
//            ->select("fa_block_freshnews.*,tags.tagId")
//            ->paginate();

        $data = FaBlockFreshnews::query()
            ->leftjoin('Fa_block_relationTags as tags','fa_block_freshnews.id','=','tags.relationId')
            ->where('tags.tagType','=','1')
            ->where('tags.relationType','=','4')
            ->select(["fa_block_freshnews.*","tags.tagId"])
            ->paginate();


        return success($data);
    }

    /**
     * 测试 快讯模型
     * @GetMapping(path="news")
     */
    public function news()
    {

        $query = $this->request->query('str','');
        if(is_string($query)){
            var_dump(func_get_args());
        }
        $data = FaBlockFreshnews::query()
            ->with('newsTags')
//            ->where('id','>',113856)
//            ->where('status','=',1)
            ->where([
                'status' => 1,
                ['id','>',113856]
            ])
            ->limit(2)
            ->get(['id','title']);

//        foreach ($data as $item)
//        {
//            $item->getRelation('newsTags');
//        }

        return $data;
    }

    /**
     * @GetMapping(path="autorun")
     */
    public function autoRun(){

        $db = FaUserInfo::query();
        for($i=1; $i<=1000; $i++){

            $rand = randNum(1)%5;
            $data = [
                'user_id' => $i,
                'address' => '安徽合肥————'.$i,
                'sex' => $rand>3? '0':'1',
                'hight' => 173+$i,
                'weight' => 66+$i,
                'creat_time' => time(),
                'update_time' => time(),
            ];

            $db->insert($data);
        }
    }

    /**
     * @GetMapping(path="test")
     */
    public function test(){
        return success($this->request->uid);
    }

    /**
     * @GetMapping(path="error")
     */
    public function error(){
        throw new ValidateException('参数错误');
    }
}
