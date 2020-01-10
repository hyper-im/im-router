<?php

declare (strict_types=1);
namespace App\Model\Db;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id
 * @property int $exchangeid
 * @property string $title
 * @property string $abstract
 * @property string $content
 * @property string $sourceLink
 * @property string $source
 * @property int $ShowNum
 * @property int $ShareNum
 * @property int $status
 * @property int $noticeTime
 * @property int $addTime
 */
class FaBlockNotice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fa_block_notice';
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
    protected $fillable = ['id', 'exchangeid', 'title', 'abstract', 'content', 'sourceLink', 'source', 'ShowNum', 'ShareNum', 'status', 'noticeTime', 'addTime'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'exchangeid' => 'integer', 'ShowNum' => 'integer', 'ShareNum' => 'integer', 'status' => 'integer', 'noticeTime' => 'integer', 'addTime' => 'integer'];
}