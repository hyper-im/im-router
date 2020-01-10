<?php

declare (strict_types=1);
namespace App\Model\Db;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $coinId
 * @property float $price
 * @property float $high
 * @property float $low
 * @property float $hist_high
 * @property float $hist_low
 * @property float $price_div_histHigh
 * @property float $price_div_histLow
 * @property float $volume
 * @property float $amount
 * @property float $change_hourly
 * @property float $change_daily
 * @property float $change_weekly
 * @property float $change_monthly
 * @property int $available_supply
 * @property int $total_supply
 * @property float $flowratio_percent
 * @property int $market_cap_usd
 * @property float $handover_percent
 * @property float $amplitude
 * @property float $comp_with_hist_high
 * @property int $market_count
 * @property int $top10_market_count
 * @property int $otc_count
 * @property float $otc_amount
 * @property int $updatetime
 */
class FaBlockAnalysisdata extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fa_block_analysisdata';
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
    protected $fillable = ['coinId', 'price', 'high', 'low', 'hist_high', 'hist_low', 'price_div_histHigh', 'price_div_histLow', 'volume', 'amount', 'change_hourly', 'change_daily', 'change_weekly', 'change_monthly', 'available_supply', 'total_supply', 'flowratio_percent', 'market_cap_usd', 'handover_percent', 'amplitude', 'comp_with_hist_high', 'market_count', 'top10_market_count', 'otc_count', 'otc_amount', 'updatetime'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['coinId' => 'integer', 'price' => 'float', 'high' => 'float', 'low' => 'float', 'hist_high' => 'float', 'hist_low' => 'float', 'price_div_histHigh' => 'float', 'price_div_histLow' => 'float', 'volume' => 'float', 'amount' => 'float', 'change_hourly' => 'float', 'change_daily' => 'float', 'change_weekly' => 'float', 'change_monthly' => 'float', 'available_supply' => 'integer', 'total_supply' => 'integer', 'flowratio_percent' => 'float', 'market_cap_usd' => 'integer', 'handover_percent' => 'float', 'amplitude' => 'float', 'comp_with_hist_high' => 'float', 'market_count' => 'integer', 'top10_market_count' => 'integer', 'otc_count' => 'integer', 'otc_amount' => 'float', 'updatetime' => 'integer'];
}