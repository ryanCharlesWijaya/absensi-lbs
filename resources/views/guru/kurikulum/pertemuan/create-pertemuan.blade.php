@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Tambah Pertemuan</h2>
                </div>
                <form action="{{ route("guru.kurikulum.pertemuan.store") }}" method="post" class="card-body">
                    @csrf
                    <input type="hidden" name="kurikulum_id" value="{{ request()->input("kurikulum_id") }}">

                    <x-text-input
                    type="text"
                    name="judul"
                    title="Judul Pertemuan"
                    id="judul-input"
                    required="required"
                    />

                    <div class="mb-3">
                      <label for="" class="form-label">Deskripsi</label>
                      <textarea class="form-control" name="deskripsi" id="deskripsi-input" rows="3" required="require"></textarea>
                    </div>

                    <x-text-input
                    type="date"
                    name="tanggal"
                    title="Tanggal Pertemuan"
                    id="tanggal-input"
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
