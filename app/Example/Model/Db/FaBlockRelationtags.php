<?php

declare (strict_types=1);
namespace App\Model\Db;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id
 * @property int $tagId
 * @property int $tagType
 * @property int $relationType
 * @property int $relationId
 */
class FaBlockRelationtags extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fa_block_relationtags';
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
    protected $fillable = ['id', 'tagId', 'tagType', 'relationType', 'relationId'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'tagId' => 'integer', 'tagType' => 'integer', 'relationType' => 'integer', 'relationId' => 'integer'];

    protected $primaryKey = 'relationId';
}
