<div class="btn-group">
    @if (Auth::user()->role == 'Perusahaan')
        <a href="{{ route('lowongan-kerja.detail', $loker->id) }}" class="btn btn-sm btn-success ">Detail</a>
        <button class="btn btn-sm btn-primary" onclick="editCustomer({{ $loker->id }})">Edit</button>
        <button class="btn btn-sm btn-danger " onclick="deleteCustomers({{ $loker->id }})">Delete</button>
    @else
        <a href="{{ route('lowongan-kerja.detail', $loker->id) }}" class="btn btn-sm btn-success ">Detail</a>
    @endif
</div>
