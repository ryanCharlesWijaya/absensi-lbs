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
                        <div class="mb-3">
                            <label for="kurikulum-input" class="form-label text-capitalize">Tahun Ajaran</label>
                            <select name="kurikulum_id" id="kurikulum_id-input" class="form-control">
                                <option value="">Pilih Tahun Ajaran</option>
                                @foreach ($kurikulums as $kurikulum)
                                    <option value="{{$kurikulum->kelas}}">{{$kurikulum->tahun_ajaran}}</option> 
                                @endforeach
                            </select>
                        </div>
                    {{-- <x-text-input
                    type="number"
                    name="kurikulum_id"
                    title="Kurikulum"
                    id="kurikulum_id-input"
                    required="required"
                    /> --}}

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
