@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Tambah Semester</h2>
                </div>
                <form action="{{ route("guru.semester.store") }}" method="post" class="card-body">
                    @csrf

                    @if ($errors->any())
                        {{ $errors }}
                    @endif
                    <x-text-input
                        type="number"
                        name="kelas"
                        title="kelas"
                        id="kelas-input"
                        min="1"
                        max="12"
                        required="required"
                        />

                    <x-select-input
                        name="kurikulum_id"
                        title="kurikulum"
                        id="kurikulum-input"
                        required="required"
                        >
                        @foreach (\App\Models\Kurikulum::all() as $kurikulum)
                            <option value="{{ $kurikulum->id }}">{{ $kurikulum->nama }}</option>
                        @endforeach
                    </x-select-input>

                    <x-select-input
                        name="sekolah_id"
                        title="Sekolah"
                        id="sekolah-input"
                        required="required"
                        >
                        @foreach (\App\Models\Sekolah::all() as $sekolah)
                            <option value="{{ $sekolah->id }}">{{ $sekolah->nama }}</option>
                        @endforeach
                    </x-select-input>

                    <x-select-input
                        name="guru_id"
                        title="Guru"
                        id="guru-input"
                        required="required"
                        >
                        @foreach (\App\Models\User::role("admin")->get() as $guru)
                            <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                        @endforeach
                    </x-select-input>

                    <x-text-input
                        type="number"
                        name="semester"
                        title="semester"
                        id="semester-input"
                        min="1"
                        max="2"
                        required="required"
                        info="Contoh nya: 1/2"
                        />

                    <x-text-input
                        name="tahun_ajaran"
                        title="Tahun Ajaran"
                        id="tahun-ajaran-input"
                        info="Contoh nya: 2019/2020"
                        />

                    <div class="mb-3">
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection