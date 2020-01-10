<?php

declare (strict_types=1);
namespace App\Model\Db;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id
 * @property int $group_id
 * @property string $username
 * @property string $nickname
 * @property string $password
 * @property string $salt
 * @property string $email
 * @property string $mobile
 * @property string $avatar
 * @property int $level
 * @property int $gender
 * @property string $birthday
 * @property string $bio
 * @property int $score
 * @property int $successions
 * @property int $maxsuccessions
 * @property int $prevtime
 * @property int $logintime
 * @property string $loginip
 * @property int $loginfailure
 * @property string $joinip
 * @property int $jointime
 * @property int $createtime
 * @property int $updatetime
 * @property string $token
 * @property string $status
 * @property string $verification
 * @property int $joinplatform
 */
class FaUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fa_user';
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'default';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'group_id', 'username', 'nickname', 'password', 'salt', 'email', 'mobile', 'avatar', 'level', 'gender', 'birthday', 'bio', 'score', 'successions', 'maxsuccessions', 'prevtime', 'logintime', 'loginip', 'loginfailure', 'joinip', 'jointime', 'createtime', 'updatetime', 'token', 'status', 'verification', 'joinplatform'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'group_id' => 'integer', 'level' => 'integer', 'gender' => 'integer', 'score' => 'integer', 'successions' => 'integer', 'maxsuccessions' => 'integer', 'prevtime' => 'integer', 'logintime' => 'integer', 'loginfailure' => 'integer', 'jointime' => 'integer', 'createtime' => 'integer', 'updatetime' => 'integer', 'joinplatform' => 'integer'];
}