@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Edit Pengumuman</h2>
                </div>
                <form action="{{ route("guru.pengumuman.update", ["pengumuman_id" => $pengumuman->id]) }}" method="post" class="card-body">
                    @csrf
                    <x-text-input
                        type="text"
                        name="judul"
                        title="judul"
                        id="judul-input"
                        :value="$pengumuman->judul"
                        required="required"
                        />

                    <x-select-input
                        name="kategori"
                        title="kategori"
                        id="kategori-input"
                        required="required"
                        >
                        <option value="libur" {{ $pengumuman->kategori == "libur" ? "selected" : null }} >libur</option>
                        <option value="masuk" {{ $pengumuman->kategori == "masuk" ? "selected" : null }} >masuk</option>
                        <option value="acara besar" {{ $pengumuman->kategori == "acara besar" ? "selected" : null }} >acara besar</option>
                        <option value="kegiatan" {{ $pengumuman->kategori == "kegiatan" ? "selected" : null }} >kegiatan</option>
                    </x-select-input>
                    
                    <x-text-input
                        name="deskripsi"
                        title="deskripsi"
                        id="deskripsi-input"
                        :value="$pengumuman->deskripsi"
                        required="required"
                        />

                    <div class="mb-3">
                        <button class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection