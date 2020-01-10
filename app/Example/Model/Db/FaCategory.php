<?php

declare (strict_types=1);
namespace App\Model\Db;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id
 * @property int $pid
 * @property string $type
 * @property string $name
 * @property string $nickname
 * @property string $flag
 * @property string $image
 * @property string $keywords
 * @property string $description
 * @property string $diyname
 * @property int $createtime
 * @property int $updatetime
 * @property int $weigh
 * @property string $status
 */
class FaCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fa_category';
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
    protected $fillable = ['id', 'pid', 'type', 'name', 'nickname', 'flag', 'image', 'keywords', 'description', 'diyname', 'createtime', 'updatetime', 'weigh', 'status'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'pid' => 'integer', 'createtime' => 'integer', 'updatetime' => 'integer', 'weigh' => 'integer'];
}