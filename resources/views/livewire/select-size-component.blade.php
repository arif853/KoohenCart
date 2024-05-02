<ul class="list-filter size-filter font-small">

    @foreach ($sizes as $size)
       @php
        $sizeStock = DB::table('product_stocks')
            ->where('product_id', $productId)
            ->where('size_id', $size->id)
            ->first();
    
            if ($sizeStock) {
                # code...
                $b_stock = $sizeStock->inStock - $sizeStock->outStock;
            }
        @endphp
        @if ($sizeStock && $b_stock > 0)
            <li class="{{ $size->id == session()->get('product_size')  ? 'active' : '' }}">
                <a href="#" wire:click.prevent="selectSize({{ $size->id }})" class="{{ $size->size_name == session()->get('product_size')  ? 'active' : '' }}" >{{$size->size}}</a>
            </li>
        @else
        <li >
            {{-- <a href="#">{{$size->size}}</a> --}}
        </li>
        @endif
    @endforeach
      <!--<li><a class="btn size-button ml-15" href="#">Size Chart</a></li>-->
   </ul>
