<div class="row">
    <div class="col-lg-6">
        <div class="">
            <label for="s_division" class="form-label">Division <span>*</span></label>
            <select required class="form-control mb-2" name="s_division" id="s_division" wire:model="selectedDivision" wire:change="triggerUpdatedSelectedDivision">
                <option value="0">Select Division...</option>
                @foreach($divisions as $division)
                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                @endforeach
            </select>
            @error('s_division')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="">
            <label for="s_district" class="form-label">District <span>*</span></label>
            <select required class="form-control mb-2" name="s_district" id="s_district" wire:model="selectedDistrict" wire:change="triggerUpdatedSelectedDistrict">
                <option value="0">Select District...</option>
                @foreach($districts as $district)
                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                @endforeach
            </select>
            @error('s_district')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="">
            <label for="s_area" class="form-label">Area/ Postoffice</label>
            <select required class="form-control mb-2" name="s_area" id="s_area" wire:change="updateDeliveryCharge" wire:model="selectedPostOffice">
                <option value="0">Select Area/ Postoffice</option>
                @foreach($postOffices as $postOffice)
                    <option value="{{ $postOffice->id }}">{{ $postOffice->postOffice }} - {{$postOffice->postCode}} - {{$postOffice->zone_charge}}</option>
                @endforeach
            </select>
            @error('s_area')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
     {{-- <div class="col-lg-6">
        <div class="">
            <label for="shipping_zipcode" class="form-label">Postcode / ZIP <span>*</span></label>
            <select name="shipping_zipcode" id="shipping_zipcode" class="form-control mb-2" wire:model="selectedPostOffice">
                <option value="0">Select Postcode / ZIP</option>
                @foreach($postOffices as $postOffice)
                <option value="{{ $postOffice->postCode }}">{{ $postOffice->postCode }}</option>
            @endforeach
            </select>
        </div>
    </div> --}}
</div>
