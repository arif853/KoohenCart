<div class="row">
    <div class="col-lg-6">
        <div class="">
            <label for="division" class="form-label">Division <span>*</span></label>
            <select required class="form-control mb-2" name="division" id="division" wire:model="selectedDivisions" wire:change="triggerUpdatedSelectedDivisions">
                <option value="">Select Division...</option>
                @foreach($divisionss as $division)
                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="">
            <label for="district" class="form-label">District <span>*</span></label>
            <select required class="form-control mb-2" name="district" id="district" wire:model="selectedDistricts" wire:change="triggerUpdatedSelectedDistricts">
                <option value="">Select District...</option>
                @foreach($districtss as $district)
                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="">
            <label for="area" class="form-label">Area/ Postoffice</label>
            <select required class="form-control mb-2" name="area" id="area" wire:change="updateDeliveryCharge" wire:model="selectedPostOffices" >
                <option value="">Select Area/ Postoffice</option>
                @foreach($postOfficess as $postOffice)
                    <option value="{{ $postOffice->id }}">{{ $postOffice->postOffice }} - {{$postOffice->postCode}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
