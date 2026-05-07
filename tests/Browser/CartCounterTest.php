<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CartCounterTest extends DuskTestCase
{
    public function test_cart_counter_updates()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/table/1')

                // reset storage
                ->script('localStorage.clear();');

            $browser->refresh()

                ->pause(2000)

                ->click('@add-cart')

                ->pause(1000)

                ->click('@add-cart')

                ->waitForTextIn('@cart-count', '2', 10)

                ->assertSeeIn('@cart-count', '2');
        });
    }
}