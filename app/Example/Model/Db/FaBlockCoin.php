<?php

declare (strict_types=1);
namespace App\Model\Db;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $coinId
 * @property string $symbol
 * @property string $fullSymbol
 * @property string $cnSymbol
 * @property string $alias
 * @property string $display_url
 * @property string $display_symbol
 * @property string $coinLogoImage
 * @property string $coinLogoBigImage
 * @property string $coinColor
 * @property int $protocolStatus
 * @property string $otcName
 * @property string $pubTime
 * @property string $pubPrice
 * @property string $whitePaper
 * @property string $sourceAdress
 * @property string $supportWallet
 * @property string $tokenAdress
 * @property string $website
 * @property string $weibo
 * @property string $telegram
 * @property string $facebook
 * @property string $twitter
 * @property string $reddit
 * @property string $gitHub
 * @property string $algorithm
 * @property string $proofType
 * @property string $wechat
 * @property string $wechatImage
 * @property string $email
 * @property string $icoStatus
 * @property string $coinViewStatus
 * @property string $isHot
 * @property string $isRank
 */
class FaBlockCoin extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fa_block_coin';
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
    protected $fillable = ['coinId', 'symbol', 'fullSymbol', 'cnSymbol', 'alias', 'display_url', 'display_symbol', 'coinLogoImage', 'coinLogoBigImage', 'coinColor', 'protocolStatus', 'otcName', 'pubTime', 'pubPrice', 'whitePaper', 'sourceAdress', 'supportWallet', 'tokenAdress', 'website', 'weibo', 'telegram', 'facebook', 'twitter', 'reddit', 'gitHub', 'algorithm', 'proofType', 'wechat', 'wechatImage', 'email', 'icoStatus', 'coinViewStatus', 'isHot', 'isRank'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['coinId' => 'integer', 'protocolStatus' => 'integer'];


}
