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
                    <h2 class="py-8">Edit Quiz</h2>
                </div>
                <form action="{{ route("guru.kurikulum.pertemuan.quiz.update", ["pertemuan_id" => $quiz->pertemuan_id, "quiz_id" => $quiz->id]) }}" method="post" class="card-body">
                    @csrf
                    
                    <x-text-input
                        type="date"
                        name="tanggal_kadaluarsa"
                        title="tanggal kadaluarsa"
                        id="tanggal-kadaluarsa-input"
                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                        value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $quiz->tanggal_kadaluarsa)->format('Y-m-d') }}"
                        />

                    <x-select-input
                        name="soals[]"
                        title="soal-soal"
                        id="soal-input"
                        multiple="multiple"
                        error_name="soals.*"
                        >
                        @foreach ($soals as $soal)
                            <option value="{{ $soal->id }}"
                                @if(old("soals"))
                                    @foreach (old("soals") as $soal_id)
                                        @if ($soal_id == $soal->id)
                                            selected
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($quiz->soals as $quiz_soal)
                                        @if ($quiz_soal->id == $soal->id)
                                            selected
                                        @endif
                                    @endforeach
                                @endif>Kelas {{ $soal->kelas }} - {{ $soal->soal }}</option>
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