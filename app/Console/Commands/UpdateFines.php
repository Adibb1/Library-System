<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Loan;
use App\Models\Fine;
use Carbon\Carbon;

class UpdateFines extends Command
{
    protected $signature = 'fines:update';
    protected $description = 'Update fines for overdue books daily';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $overdueLoans = Loan::where('return_date', '<', Carbon::today())
            ->whereDoesntHave('fine', function ($query) {
                $query->where('paid', false);
            })
            ->get();

        foreach ($overdueLoans as $loan) {
            Fine::updateOrCreate(
                ['loan_id' => $loan->id],
                ['user_id' => $loan->user_id, 'amount' => 2.00]
            );
        }

        $this->info('Fines updated successfully.');
    }
}
