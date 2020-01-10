<?php

declare (strict_types=1);
namespace App\Model\Db;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id
 * @property int $coinId
 * @property string $tokenExchange
 * @property string $icoDistribution
 * @property string $investorShare
 * @property string $icoVolume
 * @property string $icoSellVolume
 * @property string $crowdStartDate
 * @property string $crowdEndDate
 * @property float $sellPrice
 * @property string $crowdMethod
 * @property string $crowdTarget
 * @property string $crowdMoney
 * @property float $avePrice
 * @property string $crowdSuccessNums
 * @property int $crowdSuccessMoney
 * @property string $feature
 * @property string $safeAudit
 * @property string $legalForm
 * @property string $jurisdiction
 * @property string $legalCounselor
 * @property string $forSaleSite
 * @property string $blogLink
 */
class FaBlockCoinico extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fa_block_coinico';
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
    protected $fillable = ['id', 'coinId', 'tokenExchange', 'icoDistribution', 'investorShare', 'icoVolume', 'icoSellVolume', 'crowdStartDate', 'crowdEndDate', 'sellPrice', 'crowdMethod', 'crowdTarget', 'crowdMoney', 'avePrice', 'crowdSuccessNums', 'crowdSuccessMoney', 'feature', 'safeAudit', 'legalForm', 'jurisdiction', 'legalCounselor', 'forSaleSite', 'blogLink'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'coinId' => 'integer', 'sellPrice' => 'float', 'avePrice' => 'float', 'crowdSuccessMoney' => 'integer'];
}