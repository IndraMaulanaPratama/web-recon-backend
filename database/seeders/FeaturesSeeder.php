<?php

namespace Database\Seeders;

use App\Models\Features;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeaturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Features::insert([
            // AUTH AREA //
            [ // 1
                'modul' => 1,
                'name' => 'auth-register',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 2
                'modul' => 1,
                'name' => 'auth-login',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 3
                'modul' => 1,
                'name' => 'auth-forgot-password',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 4
                'modul' => 1,
                'name' => 'auth-reset-password',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 5
                'modul' => 1,
                'name' => 'auth-profile',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 6
                'modul' => 1,
                'name' => 'auth-logout',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            // END OF AUTH AREA //

            // PRODUCT AREA //
            [ // 7
                'modul' => 3,
                'name' => 'product-list-config',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 8
                'modul' => 3,
                'name' => 'product-filter',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 9
                'modul' => 3,
                'name' => 'product-add',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 10
                'modul' => 3,
                'name' => 'product-get-data',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 11
                'modul' => 3,
                'name' => 'product-update-name',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 12
                'modul' => 3,
                'name' => 'product-delete-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 13
                'modul' => 3,
                'name' => 'product-trash',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 14
                'modul' => 3,
                'name' => 'product-get-count',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 15
                'modul' => 3,
                'name' => 'product-data-column',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 16
                'modul' => 3,
                'name' => 'product-test-data',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            // END OF PRODUCT AREA //

            // DOWN CENTRAl //
            [ // 17
                'modul' => 4,
                'name' => 'cid-list-config',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 18
                'modul' => 4,
                'name' => 'cid-get-data',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 19
                'modul' => 4,
                'name' => 'cid-add',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 20
                'modul' => 4,
                'name' => 'cid-update-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 21
                'modul' => 4,
                'name' => 'cid-delete-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 22
                'modul' => 4,
                'name' => 'cid-filter',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 23
                'modul' => 4,
                'name' => 'cid-trash',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 24
                'modul' => 4,
                'name' => 'cid-data-profile',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 25
                'modul' => 4,
                'name' => 'cid-list-unmapping-profile',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 26
                'modul' => 4,
                'name' => 'cid-update-profile-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 27
                'modul' => 4,
                'name' => 'cid-many-update-profile',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            // END OF DOWN CENTRAl //

            // BILLER AREA //
            [ // 28
                'modul' => 5,
                'name' => 'biller-list-config',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 29
                'modul' => 5,
                'name' => 'biller-add',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 30
                'modul' => 5,
                'name' => 'biller-get-data',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 31
                'modul' => 5,
                'name' => 'biller-update-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 32
                'modul' => 5,
                'name' => 'biller-delete-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 33
                'modul' => 5,
                'name' => 'biller-filter',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 34
                'modul' => 5,
                'name' => 'biller-trash',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 35
                'modul' => 5,
                'name' => 'biller-list-gop',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 36
                'modul' => 5,
                'name' => 'biller-list-account',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 37
                'modul' => 5,
                'name' => 'biller-data-account',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 38
                'modul' => 5,
                'name' => 'biller-add-account',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 39
                'modul' => 5,
                'name' => 'biller-delete-account-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 40
                'modul' => 5,
                'name' => 'biller-list-product',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 41
                'modul' => 5,
                'name' => 'biller-list-add-product',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 42
                'modul' => 5,
                'name' => 'biller-product-add',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 43
                'modul' => 5,
                'name' => 'biller-delete-product-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 44
                'modul' => 5,
                'name' => 'biller-list-calendar',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 45
                'modul' => 5,
                'name' => 'biller-data-calendar',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 46
                'modul' => 5,
                'name' => 'biller-add-calendar',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 47
                'modul' => 5,
                'name' => 'biller-delete-calendar',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],

            // END OF BILLER AREA //


            // PARTNER AREA //
            [ // 48
                'modul' => 6,
                'name' => 'partner-list-config',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 49
                'modul' => 6,
                'name' => 'partner-add',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 50
                'modul' => 6,
                'name' => 'partner-get-data',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 51
                'modul' => 6,
                'name' => 'partner-update-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 52
                'modul' => 6,
                'name' => 'partner-delete-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 53
                'modul' => 6,
                'name' => 'partner-filter',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 54
                'modul' => 6,
                'name' => 'partner-trash',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 55
                'modul' => 6,
                'name' => 'partner-list-cid',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 56
                'modul' => 6,
                'name' => 'partner-add-cid',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 57
                'modul' => 6,
                'name' => 'partner-delete-cid-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 58
                'modul' => 6,
                'name' => 'partner-unmapping-cid',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 59
                'modul' => 6,
                'name' => 'partner-update-unmapping-cid',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            // END OF PARTNER AREA //

            // BANK AREA //
            [ // 60
                'modul' => 7,
                'name' => 'bank-list-config',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 61
                'modul' => 7,
                'name' => 'bank-get-data',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 62
                'modul' => 7,
                'name' => 'bank-update-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 63
                'modul' => 7,
                'name' => 'bank-delete-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 64
                'modul' => 7,
                'name' => 'bank-filter',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 65
                'modul' => 7,
                'name' => 'bank-trash',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            // END OF BANK AREA //

            // ACCOUNT AREA //
            [ // 66
                'modul' => 8,
                'name' => 'account-list-config',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 67
                'modul' => 8,
                'name' => 'account-add',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 68
                'modul' => 8,
                'name' => 'account-get-data',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 69
                'modul' => 8,
                'name' => 'account-update-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 70
                'modul' => 8,
                'name' => 'account-delete-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 71
                'modul' => 8,
                'name' => 'account-filter',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 72
                'modul' => 8,
                'name' => 'account-trash',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            // ACCOUNT AREA //

            // GROUP BILLER AREA //
            [ // 73
                'modul' => 9,
                'name' => 'group-biller-list-config',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 74
                'modul' => 9,
                'name' => 'group-biller-add',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 75
                'modul' => 9,
                'name' => 'group-biller-get-data',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 76
                'modul' => 9,
                'name' => 'group-biller-update-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 77
                'modul' => 9,
                'name' => 'group-biller-delete-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 78
                'modul' => 9,
                'name' => 'group-biller-filter',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 79
                'modul' => 9,
                'name' => 'group-biller-trash',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 80
                'modul' => 9,
                'name' => 'group-biller-list-biller',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],

            [ // 81
                'modul' => 9,
                'name' => 'group-biller-list-add-biller',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 82
                'modul' => 9,
                'name' => 'group-biller-add-biller',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 83
                'modul' => 9,
                'name' => 'group-biller-delete-biller',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            // END OF GROUP BILLER AREA //

            // GROUP FUNDS AREA //
            [ // 84
                'modul' => 10,
                'name' => 'group-funds-list-config',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 85
                'modul' => 10,
                'name' => 'group-funds-add',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 86
                'modul' => 10,
                'name' => 'group-funds-get-data',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 87
                'modul' => 10,
                'name' => 'group-funds-update-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 88
                'modul' => 10,
                'name' => 'group-funds-delete-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 89
                'modul' => 10,
                'name' => 'group-funds-filter',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 90
                'modul' => 10,
                'name' => 'group-funds-trash',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            // END OF GROUP FUNDS AREA //

            // GROUP PRODUCT AREA //
            [ // 91
                'modul' => 10,
                'name' => 'group-list-product',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 92
                'modul' => 10,
                'name' => 'group-list-add-product',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 93
                'modul' => 10,
                'name' => 'group-add-product',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 94
                'modul' => 10,
                'name' => 'group-delete-product',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            // END OF GROUP PRODUCT

            // EXCLUDE PARTNER AREA //
            [ // 95
                'modul' => 11,
                'name' => 'exclude-partner-list-config',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 96
                'modul' => 11,
                'name' => 'exclude-partner-add',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 97
                'modul' => 11,
                'name' => 'exclude-partner-delete-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 98
                'modul' => 11,
                'name' => 'exclude-partner-filter',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            // END OF EXCLUDE PARTNER //

            // CALENDAR AREA //
            [ // 99
                'modul' => 12,
                'name' => 'calendar-list-config',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 100
                'modul' => 12,
                'name' => 'calendar-add',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 101
                'modul' => 12,
                'name' => 'calendar-get-data',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 102
                'modul' => 12,
                'name' => 'calendar-calendar-view',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ //103
                'modul' => 12,
                'name' => 'calendar-update-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 104
                'modul' => 12,
                'name' => 'calendar-delete-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 105
                'modul' => 12,
                'name' => 'calendar-filter',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 106
                'modul' => 12,
                'name' => 'calendar-trash',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 107
                'modul' => 12,
                'name' => 'calendar-set-default-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 108
                'modul' => 12,
                'name' => 'calendar-get-data-copy',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 109
                'modul' => 12,
                'name' => 'calendar-copy',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 110
                'modul' => 12,
                'name' => 'calendar-list-day',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 111
                'modul' => 12,
                'name' => 'calendar-add-day',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 112
                'modul' => 12,
                'name' => 'calendar-get-data-day',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 113
                'modul' => 12,
                'name' => 'calendar-update-day',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 114
                'modul' => 12,
                'name' => 'calendar-delete-day',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            // END OF CALENDAR //

            // PROFILE FEE AREA //
            [ // 115
                'modul' => 13,
                'name' => 'profile-list-config',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ //116
                'modul' => 13,
                'name' => 'profile-add',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 117
                'modul' => 13,
                'name' => 'profile-get-data',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 118
                'modul' => 13,
                'name' => 'profile-update-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 119
                'modul' => 13,
                'name' => 'profile-delete-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 120
                'modul' => 13,
                'name' => 'profile-filter',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 121
                'modul' => 13,
                'name' => 'profile-trash',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 122
                'modul' => 13,
                'name' => 'profile-get-count-product',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 123
                'modul' => 13,
                'name' => 'profile-get-data-copy',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 124
                'modul' => 13,
                'name' => 'profile-copy',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 125
                'modul' => 13,
                'name' => 'profile-list-product',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 126
                'modul' => 13,
                'name' => 'profile-add-product',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 127
                'modul' => 13,
                'name' => 'profile-get-data-product',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 128
                'modul' => 13,
                'name' => 'profile-update-product-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 129
                'modul' => 13,
                'name' => 'profile-delete-product-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            // END OF PROFILE FEE //

            // CORRECTION AREA //
            [ // 130
                'modul' => 14,
                'name' => 'correction-list-config',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 131
                'modul' => 14,
                'name' => 'correction-add',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 132
                'modul' => 14,
                'name' => 'correction-get-data',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 133
                'modul' => 14,
                'name' => 'correction-update-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 134
                'modul' => 14,
                'name' => 'correction-delete-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 135
                'modul' => 14,
                'name' => 'correction-filter',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 136
                'modul' => 14,
                'name' => 'correction-trash',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            // END OF CORRECTION //

            // API 137 Add New Bank
            [ // 137
                'modul' => 7,
                'name' => 'bank-add',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],

            // API 133 Set Default  Profile Fee
            [ // 138
                'modul' => 13,
                'name' => 'profile-set-default-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],

            // API Tambahan Biller List GOP
            [ // 139
                'modul' => 5,
                'name' => 'biller-by-gop',
            ],

            // Api Tambahan Biller List Modul
            [ // 140
                'modul' => 5,
                'name' => 'biller-list-modul',
            ],

            // Api Tambahan Profile Fee Product Not Existing
            [ // 141
                'modul' => 5,
                'name' => 'profile-list-product-unexists',
            ],

            // API Tambahan Group Transfer Funds Get Amount
            [ // 142
                'modul' => 5,
                'name' => 'group-funds-get-amount',
            ],

            // Formula Transfer Area //
            [ // 143
                'modul' => 5,
                'name' => 'formula-transfer-list-config',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 144
                'modul' => 5,
                'name' => 'formula-transfer-get-data',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 145
                'modul' => 5,
                'name' => 'formula-transfer-add',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 146
                'modul' => 5,
                'name' => 'formula-transfer-update-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 147
                'modul' => 5,
                'name' => 'formula-transfer-delete-id',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 148
                'modul' => 5,
                'name' => 'formula-transfer-filter',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            // END OF Formula Transfer Area //

            // API Tambahan Biller List Add Account
            [ // 149
                'modul' => 5,
                'name' => 'biller-list-add-account',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],

            // RECON DATA AREA //
            [ // 150
                'modul' => 14,
                'name' => 'recon-data-list',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 151
                'modul' => 14,
                'name' => 'recon-data-settled',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 152
                'modul' => 15,
                'name' => 'recon-data-list-suspect',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 153
                'modul' => 14,
                'name' => 'recon-data-by-product',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 154
                'modul' => 14,
                'name' => 'recon-data-by-cid',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 155
                'modul' => 14,
                'name' => 'recon-data-history',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            // END OF RECON DATA //
        ]);
    }
}
