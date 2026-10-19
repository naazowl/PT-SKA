@extends('layouts.admin')

@section('title', 'Galeri')
@section('heading', 'Galeri')

@section('content')

@include('admin.partials.animations')

<div class="admin-heading">
    <div>
        <h1>Galeri kegiatan</h1>
        <p>Kelola foto kegiatan dengan unggahan langsung dari komputer.</p>
    </div>

    <a class="btn btn-primary px-3 py-2" href="{{ route('admin.galeri.create') }}">＋ Tambah foto</a>
</div>

<div class="row g-3">
    @forelse($items as $item)
        <div class="col-sm-6 col-xl-4 adm-card" style="--i: {{ $loop->index }}">
            <div class="panel h-100 p-3">
                @if($item->image)
                    <div class="adm-thumb mb-3">
                        <img src="{{ asset('storage/'.$item->image) }}" class="w-100 rounded" style="height:180px;object-fit:cover">
                    </div>
                @endif

                <h5 class="fw-bold">{{ $item->title }}</h5>

                <p class="text-secondary small">{{ $item->description }}</p>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.galeri.edit',$item) }}" class="btn btn-sm btn-outline-primary">Edit</a>

                    <form method="POST" action="{{ route('admin.galeri.destroy',$item) }}" onsubmit="return confirm('Hapus foto ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 adm-card">
            <div class="panel text-center text-secondary py-5">Belum ada foto. Tambahkan foto kegiatan pertama Anda.</div>
        </div>
    @endforelse
</div>

<div class="mt-4">{{ $items->links() }}</div>

@endsection