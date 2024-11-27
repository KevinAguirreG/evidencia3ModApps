<?php

namespace App\Jobs;

use App\Http\Controllers\ReportController;
use App\Http\Controllers\MailController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MonthlyReports implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		//General data
		$to = config("mailer.receiver_address");
		$name = config("mailer.receiver_name");
		$subject = __('mails.monthly_report_subject', ["param" => config('app.name')]);

		//Mail content
		$reports = new ReportController();
		$data = [
			'sellings' => $reports->getSellingsReport(),
			'buyings' => $reports->getBuyingsReport(),
			'inventories' => $reports->getInventoriesReport(),
		];
		$months = count($reports->range);

		//Call the function to send the email
		$resultMail = (new MailController)->sendMail($to, $name, $subject, 'mails.monthly-report', compact('data', 'months'));

		echo var_export($resultMail["status"]).($resultMail["message"] ?? false ? " - ".$resultMail["message"] : '')."\n";
	}
}
