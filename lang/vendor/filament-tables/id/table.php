<?php

return [

    'column_toggle' => [

        'heading' => 'Kolom',

    ],

    'columns' => [

        'text' => [
            'more_list_items' => 'dan :count lagi',
        ],

    ],

    'fields' => [

        'bulk_select_page' => [
            'label' => 'Pilih/batalkan semua item untuk tindakan massal.',
        ],

        'bulk_select_record' => [
            'label' => 'Pilih/batalkan item :key untuk tindakan massal.',
        ],

        'search' => [
            'label' => 'Cari',
            'placeholder' => 'Cari',
            'indicator' => 'Cari',
        ],

    ],

    'summary' => [

        'heading' => 'Ringkasan',

        'subheadings' => [
            'all' => 'Semua :label',
            'group' => ':group ringkasan',
            'page' => 'Halaman ini',
        ],

        'summarizers' => [

            'average' => [
                'label' => 'Rata-rata',
            ],

            'count' => [
                'label' => 'Jumlah',
            ],

            'sum' => [
                'label' => 'Total',
            ],

        ],

    ],

    'actions' => [

        'disable_reordering' => [
            'label' => 'Selesai mengatur ulang data',
        ],

        'enable_reordering' => [
            'label' => 'Atur ulang data',
        ],

        'filter' => [
            'label' => 'Filter',
        ],

        'group' => [
            'label' => 'Kelompokkan',
        ],

        'open_bulk_actions' => [
            'label' => 'Tindakan massal',
        ],

        'toggle_columns' => [
            'label' => 'Tampilkan kolom',
        ],

    ],

    'empty' => [

        'heading' => 'Tidak ada :model ditemukan',

        'description' => 'Buat :model untuk memulai.',

    ],

    'filters' => [

        'actions' => [

            'remove' => [
                'label' => 'Hapus filter',
            ],

            'remove_all' => [
                'label' => 'Hapus semua filter',
                'tooltip' => 'Hapus semua filter',
            ],

            'reset' => [
                'label' => 'Atur ulang',
            ],

        ],

        'heading' => 'Filter',

        'indicator' => 'Filter aktif',

        'multi_select' => [
            'placeholder' => 'Semua',
        ],

        'select' => [
            'placeholder' => 'Semua',
        ],

        'trashed' => [

            'label' => 'Data dihapus',

            'only_trashed' => 'Hanya data dihapus',

            'with_trashed' => 'Dengan data dihapus',

            'without_trashed' => 'Tanpa data dihapus',

        ],

    ],

    'grouping' => [

        'fields' => [

            'aggregate' => [
                'label' => 'Agregat',
            ],

            'field' => [
                'label' => 'Kelompokkan berdasarkan',
            ],

            'direction' => [

                'label' => 'Arah pengelompokan',

                'options' => [
                    'asc' => 'Naik',
                    'desc' => 'Turun',
                ],

            ],

        ],

    ],

    'reorder_indicator' => 'Seret dan lepas data ke urutan yang diinginkan.',

    'selection_indicator' => [

        'selected_count' => '1 data dipilih|:count data dipilih',

        'actions' => [

            'select_all' => [
                'label' => 'Pilih semua :count',
            ],

            'deselect_all' => [
                'label' => 'Batalkan semua pilihan',
            ],

        ],

    ],

    'sorting' => [

        'fields' => [

            'column' => [
                'label' => 'Urutkan berdasarkan',
            ],

            'direction' => [

                'label' => 'Arah pengurutan',

                'options' => [
                    'asc' => 'Naik',
                    'desc' => 'Turun',
                ],

            ],

        ],

    ],

];
