<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'nama' => 'Dashboard',
                'link' => '/dashboard',
                'urutan' => 1,
                'icon' => 'a'
            ],
            [
                'id' => 2,
                'nama' => 'Setting',
                'link' => '',
                'urutan' => 200,
                'icon' => 'a'
            ],
            [
                'id' => 3,
                'nama' => 'Menu',
                'link' => '/dashboard/menu',
                'urutan' => 202,
                'parent' => 2,
                'icon' => 'a'
            ],[
                'id' => 4,
                'nama' => 'User',
                'link' => '/dashboard/user',
                'urutan' => 203,
                'parent' => 2,
                'icon' => 'a'
            ],
            [
                'id' => 5,
                'nama' => 'Produk',
                'link' => '',
                'urutan' => 110,
                'icon' => 'a'
            ],
            [
                'id' => 6,
                'nama' => 'Tambah Produk',
                'link' => '/dashboard/produk/create',
                'urutan' => 111,
                'parent' => 5,
                'icon' => 'a'
            ],[
                'id' => 7,
                'nama' => 'Data Produk',
                'link' => '/dashboard/produk',
                'urutan' => 112,
                'parent' => 5,
                'icon' => 'a'
            ],
            [
                'id' => 8,
                'nama' => 'Pesanan',
                'link' => '',
                'urutan' => 120,
                'icon' => 'a'
            ],
            [
                'id' => 9,
                'nama' => 'Pesanan Masuk',
                'link' => '/dashboard/order/purchase-order',
                'urutan' => 121,
                'parent' => 8,
                'icon' => 'a'
            ],[
                'id' => 10,
                'nama' => 'Perintah Kirim',
                'link' => '/dashboard/order/perintah-kirim',
                'urutan' => 122,
                'parent' => 8,
                'icon' => 'a'
            ],[
                'id' => 11,
                'nama' => 'Pesanan Ditunda',
                'link' => '/dashboard/order/pending',
                'urutan' => 123,
                'parent' => 8,
                'icon' => 'a'
            ],
            [
                'id' => 22,
                'nama' => 'Riwayat Pesanan',
                'link' => '/dashboard/order/riwayat',
                'urutan' => 124,
                'parent' => 8,
                'icon' => 'a'
            ],
            [
                'id' => 13,
                'nama' => 'Return',
                'link' => '',
                'urutan' => 130,
                'icon' => 'a'
            ],
            [
                'id' => 14,
                'nama' => 'Pengajuan Return',
                'link' => '/dashboard/return/pesanan',
                'urutan' => 131,
                'parent' => 13,
                'icon' => 'a'
            ],
            [
                'id' => 15,
                'nama' => 'Approval Return',
                'link' => '/dashboard/return/approval',
                'urutan' => 132,
                'parent' => 13,
                'icon' => 'a'
            ],
            [
                'id' => 16,
                'nama' => 'Tagihan',
                'link' => '',
                'urutan' => 140,
                'icon' => 'a'
            ],
            [
                'id' => 17,
                'nama' => 'Kirim Tagihan',
                'link' => '/dashboard/return/approval',
                'urutan' => 141,
                'parent' => 16,
                'icon' => 'a'
            ],
            [
                'id' => 18,
                'nama' => 'Lihat Tagihan',
                'link' => '/dashboard/return/approval',
                'urutan' => 142,
                'parent' => 16,
                'icon' => 'a'
            ],
            [
                'id' => 19,
                'nama' => 'Bayar Tagihan',
                'link' => '/dashboard/return/approval',
                'urutan' => 143,
                'parent' => 16,
                'icon' => 'a'
            ],
            // [
            //     'id' => 20,
            //     'nama' => 'Pembayaran',
            //     'link' => '/dashboard/pembayaran',
            //     'urutan' => 150,
            //     'icon' => 'a'
            // ],
            // [
            //     'id' => 21,
            //     'nama' => 'Forecasting',
            //     'link' => '/dashboard/forecasting',
            //     'urutan' => 160,
            //     'icon' => 'a'
            // ],
            [
                'id' => 23,
                'nama' => 'Merek',
                'link' => '/dashboard/master/merek',
                'urutan' => 203,
                'parent' => 2,
                'icon' => 'a'
            ],
            [
                'id' => 24,
                'nama' => 'Kategori',
                'link' => '/dashboard/master/kategori',
                'urutan' => 204,
                'parent' => 2,
                'icon' => 'a'
            ],
            [
                'id' => 25,
                'nama' => 'Inventory',
                'link' => '/dashboard/produk/inventory/stock',
                'urutan' => 113,
                'parent' => 5,
                'icon' => 'a'
            ]
        ];

        $mapping = [
            [
                'group' => 'ALL',
                'menu_id' => 1
            ],
            [
                'group' => 'ADMINISTRATOR',
                'menu_id' => 2
            ],
            [
                'group' => 'ADMINISTRATOR',
                'menu_id' => 3
            ],
            [
                'group' => 'ADMINISTRATOR',
                'menu_id' => 4
            ],
            [
                'group' => 'ADMINISTRATOR',
                'menu_id' => 5
            ],
            [
                'group' => 'ADMINISTRATOR',
                'menu_id' => 6
            ],
            [
                'group' => 'ADMINISTRATOR',
                'menu_id' => 7
            ],
            [
                'group' => 'ADMINISTRATOR',
                'menu_id' => 8
            ],
            [
                'group' => 'ADMINISTRATOR',
                'menu_id' => 9
            ],
            [
                'group' => 'ADMINISTRATOR',
                'menu_id' => 10
            ],
            [
                'group' => 'ALL',
                'menu_id' => 11
            ],
            [
                'group' => 'ALL',
                'menu_id' => 13
            ],
            [
                'group' => 'ALL',
                'menu_id' => 14
            ],
            [
                'group' => 'ALL',
                'menu_id' => 15
            ],
            [
                'group' => 'ALL',
                'menu_id' => 16
            ],
            [
                'group' => 'ALL',
                'menu_id' => 17
            ],
            [
                'group' => 'ALL',
                'menu_id' => 18
            ],
            [
                'group' => 'ALL',
                'menu_id' => 19
            ],
            // [
            //     'group' => 'ALL',
            //     'menu_id' => 20
            // ],
            // [
            //     'group' => 'ALL',
            //     'menu_id' => 21
            // ],
            [
                'group' => 'ADMINISTRATOR',
                'menu_id' => 22
            ],
            [
                'group' => 'ADMINISTRATOR',
                'menu_id' => 23
            ],
            [
                'group' => 'ADMINISTRATOR',
                'menu_id' => 24
            ],
            [
                'group' => 'ADMINISTRATOR',
                'menu_id' => 25
            ]
        ];

        foreach($data as $i => $v) {
            DB::table('menus')->insert($v);
        }

        DB::table('mapping_menus')->insert($mapping);
    }
}
