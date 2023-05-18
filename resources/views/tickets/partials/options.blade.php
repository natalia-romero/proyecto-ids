@include('partials.options', [
    'options' => [
        [
            //'can' => Auth::user()->can('viewAny', \App\Models\Ticket::class),
            'route' => 'tickets.index',
            'route_url' => route('tickets.index'),
            'icon' => 'fas fa-list',
            'btn_class' => 'btn-primary',
            'text' => 'Listado de Tickets',
        ],
        [
            //'can' => Auth::user()->can('viewAny', \App\Models\Ticket::class),
            'route' => 'tickets.create',
            'route_url' => route('tickets.create'),
            'icon' => 'fas fa-fw fa-clipboard-check',
            'btn_class' => 'btn-primary',
            'text' => 'Agregar Ticket',
        ],
    ],
])