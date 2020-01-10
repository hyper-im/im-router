<?php

declare (strict_types=1);
namespace App\Model\Db;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id
 * @property int $user_id
 * @property string $address
 * @property string $sex
 * @property float $hight
 * @property float $weight
 * @property int $creat_time
 * @property int $update_time
 */
class FaUserInfo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fa_user_info';
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
    protected $fillable = ['id', 'user_id', 'address', 'sex', 'hight', 'weight', 'creat_time', 'update_time'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'hight' => 'float', 'weight' => 'float', 'creat_time' => 'integer', 'update_time' => 'integer'];

}
