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

namespace App\Model\Service;


use App\Exception\ServiceException;
use App\Model\Dao\UserDao;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Redis\Redis;

/**
 * Class CodeService,业务逻辑
 * @package App\Model\Service
 */
class CodeService
{

    /**
     * @Inject()
     * @var Redis
     */
    protected $redis;

    /**
     * @Inject()
     * @var UserDao
     */
    protected $userDao;

    /**
     * 获取验证码
     * @param array $params
     * @return array
     */
    public function getcode(array $params){
        $ttl = 60;
        $mobile = $params['mobile'];

        if($this->mobileExist($mobile)){
            throw new ServiceException( "已注册用户,请直接登录");
        }

        $second = $this->redis->ttl(self::getCodeCacheKey($mobile));
        if($second > 0){
            throw new ServiceException( "请在{$second}秒后载获取验证码");
        }

        $data = [
            'code' => randNum(),
            'status' => 1 //1未消费,0已消费
        ];
        $this->redis->set(self::getCodeCacheKey($mobile), $data, $ttl);
        return $data;
    }

    /**
     * 校验手机号码是否存在
     * @param $mobile
     * @return \Hyperf\Database\Model\Builder|\Hyperf\Database\Model\Builder[]|\Hyperf\Database\Model\Collection|\Hyperf\Database\Model\Model|null
     */
    public function mobileExist($mobile){
        return $this->userDao->getUserByMobile($mobile);
    }

    /**
     * 校验验证码是否正确
     * @param $mobile
     * @param $code
     * @return bool
     */
    public function checkCode($mobile, $code){

        $cache = $this->redis->get(self::getCodeCacheKey($mobile));
        if(empty($cache) || $cache['code'] != $code || $cache['status'] == 0){
            throw new ServiceException("验证码不正确或已过期");
        }

        $ttl = $this->redis->ttl(self::getCodeCacheKey($mobile));
        $cache['status'] = 0;
        $this->redis->set(self::getCodeCacheKey($mobile), $cache, $ttl);
        return true;
    }

    /**
     * 获取缓存键
     * @param $mobile
     * @return string
     */
    public function getCodeCacheKey($mobile){
        return "get_code_".$mobile;
    }
}
