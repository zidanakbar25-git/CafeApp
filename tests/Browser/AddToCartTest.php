<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AddToCartTest extends DuskTestCase
{
    /**
     * KU-2.1
     * Tambah menu ke cart
     */
    public function test_add_menu_to_cart()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/table/1')

                // tunggu halaman load
                ->pause(2000)

                // klik tombol add
                ->click('@add-cart')

                // tunggu proses ajax/session
                ->pause(1000)


                // cek cart count berubah jadi 1
                ->assertSeeIn('@cart-count', '1');
        });
    }
}