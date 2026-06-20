<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class UpdateQuantityComponent extends Component
{

    public $quantity = 1;

    public function mount()
    {
        // Keep the session in sync with the displayed quantity from the start.
        Session::put('quantity', $this->quantity);
    }

    public function increaseQuantites()
    {
        $this->quantity++;
        Session::put('quantity', $this->quantity);
        $this->dispatch('qtyRefresh')->to('update-quantity-component');
    }

    public function decreaseQuantities()
    {
        // Never go below 1.
        if ($this->quantity > 1) {
            $this->quantity--;
        }
        Session::put('quantity', $this->quantity);
        $this->dispatch('qtyRefresh')->to('update-quantity-component');
    }
    public function render()
    {
        return view('livewire.update-quantity-component');
    }


}
