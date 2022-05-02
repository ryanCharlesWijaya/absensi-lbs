@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Edit Kurikulum</h2>
                </div>
                <form action="{{ route("guru.kurikulum.pertemuan.update", ["pertemuan_id" => $pertemuan->id]) }}  " method="post" class="card-body">
                    {{-- @if ($errors->any())
                        {{$errors}}
                    @endif --}}
                 
                    @csrf
                    <x-text-input
                    type="text"
                    name="judul"
                    title="Judul Pertemuan"
                    id="judul-input"
                    value="{{ $pertemuan->judul}}"
                    />
                    
                    <div class="mb-3">
                      <label for="" class="form-label">Deskripsi</label>
                      <textarea class="form-control" name="deskripsi" id="deskripsi-input" rows="3">{{$pertemuan->deskripsi}}</textarea>
                    </div>

                    <x-text-input
                        type="date"
                        name="tanggal"
                        title="Tanggal Pertemuan"
                        id="tanggal-input"
                        value="{{ $pertemuan->tanggal}}"
                    />

                    <div class="mb-3">
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
