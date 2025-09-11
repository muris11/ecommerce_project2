<?php

return [
    'auth' => [
        'heading' => 'Masuk ke Admin',
        'actions' => [
            'authenticate' => [
                'label' => 'Masuk',
            ],
        ],
        'fields' => [
            'email' => [
                'label' => 'Email',
            ],
            'password' => [
                'label' => 'Kata Sandi',
            ],
            'remember' => [
                'label' => 'Ingat saya',
            ],
        ],
        'messages' => [
            'failed' => 'Email atau kata sandi salah.',
        ],
    ],
    
    'pagination' => [
        'label' => 'Navigasi halaman',
        'overview' => 'Menampilkan :first hingga :last dari :total hasil',
        'fields' => [
            'records_per_page' => [
                'label' => 'per halaman',
            ],
        ],
    ],
    
    'actions' => [
        'create' => [
            'label' => 'Buat baru',
        ],
        'edit' => [
            'label' => 'Edit',
        ],
        'delete' => [
            'label' => 'Hapus',
        ],
        'view' => [
            'label' => 'Lihat',
        ],
        'save' => [
            'label' => 'Simpan',
        ],
        'cancel' => [
            'label' => 'Batal',
        ],
        'confirm' => [
            'label' => 'Konfirmasi',
        ],
    ],
    
    'resources' => [
        'label' => 'Sumber Daya',
        'plural_label' => 'Sumber Daya',
    ],
    
    'fields' => [
        'search' => [
            'label' => 'Cari',
            'placeholder' => 'Cari...',
        ],
    ],
    
    'widgets' => [
        'account' => [
            'welcome' => 'Selamat datang, :app!',
        ],
    ],
];