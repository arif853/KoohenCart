<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\District;
use App\Models\Division;
use App\Models\Postcode;

class AreaSelectComponent extends Component
{
    public $selectedDivision;
    public $selectedDistrict;
    public $selectedPostOffice;

    public $divisions;
    public $districts;
    public $postOffices;

    public function render()
    {
        $this->divisions = Division::all();
        $this->districts = $this->selectedDivision
            ? District::where('division_id', $this->selectedDivision)->get()
            : collect();

        $this->postOffices = $this->selectedDistrict
            ? Postcode::where('district_id', $this->selectedDistrict)->get()
            : collect();

        return view('livewire.area-select-component');
    }

    public function triggerUpdatedSelectedDivision()
    {
        $this->selectedDistrict = null;
        $this->selectedPostOffice = null;
    }

    public function triggerUpdatedSelectedDistrict()
    {
        $this->selectedPostOffice = null;
    }
}
