<?php

namespace App\Console\Commands;
use Carbon\Carbon;
use App\Models\Ticket;
use App\Models\SLA;
use App\Models\State;
use Illuminate\Console\Command;

class SlaCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sla:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para verificar el sla de cada ticket por cada día';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now()->format('d-M-Y');
        $tickets = Ticket::all();
        foreach ($tickets as $ticket) {
            $days = $ticket->created_at->diffInDays($now);
            if (!($ticket->state_id == State::CLOSE_ID)) {
                if ($days >= 2 && $days <= 4) {
                    $ticket->update(['sla_id' => SLA::MEDIUM_ID]);
                } else if ($days >= 5) {
                    $ticket->update(['sla_id' => SLA::HIGH_ID]);
                }
                $ticket->save();
            }
        }
    }
}
