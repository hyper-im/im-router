<?php

declare (strict_types=1);
namespace App\Model\Db;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id
 * @property int $action_type
 * @property int $platform
 * @property \Carbon\Carbon $updated_at
 * @property int $uid
 * @property \Carbon\Carbon $created_at
 */
class FaUserAction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fa_user_action';
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
    protected $fillable = ['id', 'action_type', 'platform', 'updated_at', 'uid', 'created_at'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'action_type' => 'integer', 'platform' => 'integer', 'updated_at' => 'datetime', 'uid' => 'integer', 'created_at' => 'datetime'];
}