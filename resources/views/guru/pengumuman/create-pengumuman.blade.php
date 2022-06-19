@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Tambah Pengumuman</h2>
                </div>
                <form action="{{ route("guru.pengumuman.store") }}" method="post" class="card-body">
                    @csrf
                    <x-text-input
                        type="text"
                        name="judul"
                        title="judul"
                        id="judul-input"
                        required="required"
                        />

                    <x-select-input
                        name="kategori"
                        title="kategori"
                        id="kategori-input"
                        required="required"
                        >
                        <option value="libur">libur</option>
                        <option value="masuk">masuk</option>
                        <option value="acara besar">acara besar</option>
                        <option value="kegiatan">kegiatan</option>
                    </x-select-input>
                    
                    <x-text-input
                        name="deskripsi"
                        title="deskripsi"
                        id="deskripsi-input"
                        required="required"
                        />

                    <div class="mb-3">
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection