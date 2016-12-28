<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider');
            $table->string('token');
            $table->string('client_id');
            $table->string('client_secret');
            $table->string('ad_account_id');
            $table->timestamps();
        });

        DB::table('tokens')->insert(
            array(
                array(
                    'provider' => 'facebook',
                    'token' => 'EAAGAMXrBYAcBAF864ZCUQTpLn7V3z6u6FZAmlpmZBkRzvi28neCHuInRH1NZC75ZAZC1ZCPHPN0EYsui2O7k2cq2Qoy9CZBnhZCalbAe1NZA18crDDpkvmuSOnM8PjrsbBlTl3gyZA9PgNZBn93MJZCpjYZCxSBg5SGoYZCG8YZD',
                    'client_id' => '422424977956871',
                    'client_secret' => '066562b6bc782c597814f0dfea1acb42',
                    'ad_account_id' => 'act_936301983083925'
                ),
                array(
                    'provider' => 'facebook',
                    'token' => 'EAAG4qjkWFkoBALT20G5sMeZAoylE13MWZBNRd4RxVuAMCz4iguXxk6ZAU9KgcDnYoShAxITZCXnspCcQDC8em1kjyxsjWqW0K5k7ZCCIxZBqCGCPqGsSDr5RdYSE9smYdfaTWCiraDTTrWuxuoRMIPNarnjY83PlwZD',
                    'client_id' => '484516218410570',
                    'client_secret' => '22010cbfd050640218553ece43921377',
                    'ad_account_id' => 'act_1049757401738382'
                ),


            )
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tokens');
    }
}
