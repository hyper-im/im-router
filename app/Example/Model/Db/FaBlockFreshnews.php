<?php

declare (strict_types=1);
namespace App\Model\Db;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id
 * @property string $title
 * @property int $freshNewsClass
 * @property string $abstract
 * @property string $content
 * @property string $sourceLink
 * @property string $source
 * @property int $good
 * @property int $bad
 * @property int $lh
 * @property int $lk
 * @property int $ShowNum
 * @property int $ShareNum
 * @property int $status
 * @property int $type
 * @property int $newsTime
 * @property int $addTime
 */
class FaBlockFreshnews extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fa_block_freshnews';
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
    protected $fillable = ['id', 'title', 'freshNewsClass', 'abstract', 'content', 'sourceLink', 'source', 'good', 'bad', 'lh', 'lk', 'ShowNum', 'ShareNum', 'status', 'type', 'newsTime', 'addTime'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'freshNewsClass' => 'integer', 'good' => 'integer', 'bad' => 'integer', 'lh' => 'integer', 'lk' => 'integer', 'ShowNum' => 'integer', 'ShareNum' => 'integer', 'status' => 'integer', 'type' => 'integer', 'newsTime' => 'integer', 'addTime' => 'integer'];

    public function newsTags()
    {
        $data = $this->hasMany(FaBlockRelationtags::class, 'relationId','id')
            ->select(['relationId','tagId','tagType']);
        return $data;
    }

}
