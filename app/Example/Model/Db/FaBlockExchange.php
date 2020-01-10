<?php

declare (strict_types=1);
namespace App\Model\Db;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id
 * @property string $symbol
 * @property string $fullSymbol
 * @property string $cnSymbol
 * @property string $display_url
 * @property string $typeData
 * @property string $feature
 * @property string $logoImage
 * @property string $website
 * @property string $inviteUrl
 * @property string $inviteRemark
 * @property string $weibo
 * @property string $telegram
 * @property string $facebook
 * @property string $twitter
 * @property string $reddit
 * @property string $gitHub
 * @property int $block_country_id
 * @property string $descContent
 * @property string $hasCoin
 * @property int $block_coin_coinId
 * @property int $coinNum
 * @property int $pairsNum
 * @property string $exchangeMode
 * @property string $isDig
 * @property string $source
 * @property string $isHot
 * @property string $viewStatus
 * @property int $star
 * @property int $createtime
 * @property int $updatetime
 */
class FaBlockExchange extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fa_block_exchange';
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
    protected $fillable = ['id', 'symbol', 'fullSymbol', 'cnSymbol', 'display_url', 'typeData', 'feature', 'logoImage', 'website', 'inviteUrl', 'inviteRemark', 'weibo', 'telegram', 'facebook', 'twitter', 'reddit', 'gitHub', 'block_country_id', 'descContent', 'hasCoin', 'block_coin_coinId', 'coinNum', 'pairsNum', 'exchangeMode', 'isDig', 'source', 'isHot', 'viewStatus', 'star', 'createtime', 'updatetime'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'block_country_id' => 'integer', 'block_coin_coinId' => 'integer', 'coinNum' => 'integer', 'pairsNum' => 'integer', 'star' => 'integer', 'createtime' => 'integer', 'updatetime' => 'integer'];
}