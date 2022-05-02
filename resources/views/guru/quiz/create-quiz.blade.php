@extends('layouts.app')

@push('head')
    <link href="{{ asset("assets/plugins/global/plugins.bundle.css") }}" rel="stylesheet" type="text/css"/>
@endpush

@push('scripts')
    <script src="{{ asset("assets/plugins/global/plugins.bundle.js") }}"></script>
@endpush

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Tambah Quiz</h2>
                </div>
                <form action="{{ route("guru.quiz.store") }}" method="post" class="card-body">
                    @csrf
                    @if ($errors->any())
                        {{ $errors }}
                    @endif
                    <x-select-input
                        name="pertemuan_id"
                        title="pertemuan"
                        id="pertemuan-input"
                        required="required"
                        >
                        @foreach ($pertemuans as $pertemuan)
                            <option value="{{ $pertemuan->id }}">{{ $pertemuan->id }}</option>
                        @endforeach
                        {{-- temporary --}}
                        <option value="1">1</option>
                    </x-select-input>

                    <x-text-input
                        type="date"
                        name="tanggal_kadaluarsa"
                        title="tanggal kadaluarsa"
                        id="tanggal-kadaluarsa-input"
                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                        required="required"
                        />

                    <x-select-input
                        name="soals[]"
                        title="soal-soal"
                        id="soal-input"
                        multiple="multiple"
                        error_name="soals.*"
                        >
                        @foreach ($soals as $soal)
                            <option value="{{ $soal->id }}">Kelas {{ $soal->kelas }} - {{ $soal->soal }}</option>
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