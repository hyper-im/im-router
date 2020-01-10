<?php

declare (strict_types=1);
namespace App\Model\Db;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id
 * @property string $eventType
 * @property int $block_coin_coinId
 * @property string $eventTime
 * @property string $title
 * @property string $content
 * @property string $sourceLink
 * @property int $creatTime
 * @property int $updateTime
 */
class FaBlockEvents extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fa_block_events';
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
    protected $fillable = ['id', 'eventType', 'block_coin_coinId', 'eventTime', 'title', 'content', 'sourceLink', 'creatTime', 'updateTime'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'block_coin_coinId' => 'integer', 'creatTime' => 'integer', 'updateTime' => 'integer'];
}