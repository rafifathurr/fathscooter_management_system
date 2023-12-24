<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public static function listMenu()
    {
        return [
            [
                'auth' => 'admin',
                'menu' => [
                    [
                        'title' => 'Dashboard',
                        'list_menu' => [
                            [
                                'display_name' => 'Dashboard',
                                'icon' => 'fa-chart-bar',
                                'route' => 'admin.dashboard.index'
                            ],
                            [
                                'display_name' => 'Order',
                                'icon' => 'fa-clipboard-list',
                                'route' => 'admin.order.index'
                            ],
                        ],
                    ],
                    [
                        'title' => 'Master Data',
                        'list_menu' => [
                            [
                                'display_name' => 'Bundle Product',
                                'icon' => 'fa-boxes',
                                'route' => 'admin.bundle.index'
                            ],
                            [
                                'display_name' => 'Product',
                                'icon' => 'fa-boxes',
                                'route' => 'admin.product.index'
                            ],
                            [
                                'display_name' => 'Data Supplier',
                                'icon' => 'fa-warehouse',
                                'route' => 'admin.supplier.index'
                            ],
                            [
                                'display_name' => 'Category Product',
                                'icon' => 'fa-th',
                                'route' => 'admin.category.index'
                            ],
                            [
                                'display_name' => 'Source Payment',
                                'icon' => 'fa-wallet',
                                'route' => 'admin.source_purchase.index'
                            ],
                        ],
                    ],
                    [
                        'title' => 'User Management',
                        'list_menu' => [
                            [
                                'display_name' => 'Users',
                                'icon' => 'fa-user-plus',
                                'route' => 'admin.users.index'
                            ],
                            [
                                'display_name' => 'User Role',
                                'icon' => 'fa-user-cog',
                                'route' => 'admin.role.index'
                            ],
                        ],
                    ],
                ],
            ],
            [
                'auth' => 'user',
                'menu' => [
                    [
                        'title' => 'Management',
                        'list_menu' => [
                            [
                                'display_name' => 'Order',
                                'icon' => 'fa-clipboard-list',
                                'route' => 'user.order.index'
                            ],
                            [
                                'display_name' => 'Product',
                                'icon' => 'fa-boxes',
                                'route' => 'user.product.index'
                            ],
                        ],
                    ],
                ]
            ]
        ];
    }
}
