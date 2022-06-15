@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Assign Siswa</h2>
                </div>
                <form action="{{ route("guru.semester.assignSiswa", ["semester_id" => $semester->id]) }}" method="POST" enctype="multipart/form-data" class="card-body">
                    @csrf
                    <x-select-input
                        name="siswa_id"
                        title="siswa"
                        id="siswa-input">
                        @foreach ($siswas as $siswa)
                            <option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
                        @endforeach
                    </x-select-input>

                    <div class="mb-3">
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection