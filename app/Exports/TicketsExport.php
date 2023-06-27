<?php

namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TicketsExport implements FromCollection, WithMapping, WithHeadings
{
    protected $tickets;

    public function __construct($tickets)
    {
        $this->tickets = $tickets;
    }
    
    public function collection()
    {
        return $this->tickets;
    }
    
    public function headings(): array
    {
        return [
            'ID',
            'Responsable',
            'Funcionario',
            'Categoría',
            'Descripción',
            'Fecha',
            'SLA',
            'Estado',
        ];
    }

    public function map($ticket): array
    {
        return [
            $ticket->id,
            $ticket->user == null ? 'Sin asignar' : $ticket->user->name,
            $ticket->functionary->name,
            $ticket->category->name,
            $ticket->description,
            $ticket->created_at,
            $ticket->sla->name,
            $ticket->state->name,
        ];
    }
}

