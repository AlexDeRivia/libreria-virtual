<?php

return [
    'public_access' => env('PUBLIC_DEMO_ACCESS', false),
    'reset_database' => env('DEMO_RESET_DATABASE'),
    'roles' => [
        'cliente' => [
            'label' => 'Cliente',
            'description' => 'Explora el catálogo, crea un pedido y consulta su seguimiento.',
            'email' => 'cliente@example.test',
            'role_id' => 2,
            'home' => 'cliente.home',
        ],
        'especialista' => [
            'label' => 'Cliente especializado',
            'description' => 'Descubre recomendaciones según tus especialidades y haz un pedido.',
            'email' => 'especialista@example.test',
            'role_id' => 3,
            'home' => 'cliente.home',
        ],
        'envios' => [
            'label' => 'Envíos',
            'description' => 'Despacha pedidos y registra entregas simuladas.',
            'email' => 'envios@example.test',
            'role_id' => 4,
            'home' => 'encargado.home',
        ],
        'admin' => [
            'label' => 'Administración',
            'description' => 'Gestiona libros, ejemplares y catálogos; revisa los pedidos.',
            'email' => 'admin@example.test',
            'role_id' => 1,
            'home' => 'admin.home',
        ],
    ],
];
