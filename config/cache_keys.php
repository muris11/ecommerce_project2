<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Cache Configuration
    |--------------------------------------------------------------------------
    |
    | Cache keys and TTL (Time To Live) configurations for the application
    |
    */

    'keys' => [
        'home_categories' => 'home_categories',
        'home_brands' => 'home_brands',
        'home_featured_products' => 'home_featured_products',
        'filter_brands' => 'filter_brands', 
        'filter_categories' => 'filter_categories',
        'product_reviews' => 'product_reviews_',  // Will append product_id
    ],

    'ttl' => [
        'home_data' => 3600,        // 1 hour for homepage data
        'filters' => 3600,          // 1 hour for filter data
        'product_data' => 1800,     // 30 minutes for product data
        'reviews' => 300,           // 5 minutes for reviews (for admin replies)
    ],

];