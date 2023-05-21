@include('partials.options', [
    'options' => [
        [
            'can' => Auth::user()->can('viewAnyDisabled', \App\Models\User::class),
            'route' => 'users.disabled',
            'route_url' => route('users.disabled'),
            'icon' => 'fas fa-list',
            'btn_class' => 'btn-primary',
            'text' => 'Listado de usuarios eliminados',
        ],
        [
            'can' => Auth::user()->can('viewAny', \App\Models\User::class),
            'route' => 'users.index',
            'route_url' => route('users.index'),
            'icon' => 'fas fa-list',
            'btn_class' => 'btn-primary',
            'text' => 'Listado de usuarios',
        ],
    ],
])