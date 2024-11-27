<?php

namespace App\Observers;

use App\Models\BuyingRow;

class BuyingRowObserver
{
	/**
	 * Handle the BuyingRow "created" event.
	 *
	 * @param  \App\Models\BuyingRow  $buyingRow
	 * @return void
	 */
	public function created(BuyingRow $buyingRow)
	{
		$this->updateBuyingTotal($buyingRow->buying);
	}

	/**
	 * Handle the BuyingRow "updated" event.
	 *
	 * @param  \App\Models\BuyingRow  $buyingRow
	 * @return void
	 */
	public function updated(BuyingRow $buyingRow)
	{
		$this->updateBuyingTotal($buyingRow->buying);
	}

	/**
	 * Handle the BuyingRow "deleted" event.
	 *
	 * @param  \App\Models\BuyingRow  $buyingRow
	 * @return void
	 */
	public function deleted(BuyingRow $buyingRow)
	{
		$this->updateBuyingTotal($buyingRow->buying);
	}

	/**
	 * Handle the BuyingRow "restored" event.
	 *
	 * @param  \App\Models\BuyingRow  $buyingRow
	 * @return void
	 */
	public function restored(BuyingRow $buyingRow)
	{
		$this->updateBuyingTotal($buyingRow->buying);
	}

	/**
	 * Handle the BuyingRow "force deleted" event.
	 *
	 * @param  \App\Models\BuyingRow  $buyingRow
	 * @return void
	 */
	public function forceDeleted(BuyingRow $buyingRow)
	{
		$this->updateBuyingTotal($buyingRow->buying);
	}

	public function updateBuyingTotal($buying)
	{
		$total = 0;
		foreach ($buying->buyingRows as $key => $br) {
			$total += floatval($br->total);
		}
		$buying->subtotal = $total;
		$buying->iva = 0;
		$buying->total = $total;
		$buying->save();
	}
}
