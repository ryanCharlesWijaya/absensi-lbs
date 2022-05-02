@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Tambah Soal</h2>
                </div>
                <form action="{{ route("guru.soal.update", ["soal_id" => $soal->id]) }}" method="post" class="card-body">
                    @csrf
                    <x-text-input
                        type="number"
                        name="kelas"
                        title="kelas"
                        id="kelas-input"
                        min="1"
                        max="12"
                        value="{{ $soal->kelas }}"
                        />

                    <x-text-input
                        name="soal"
                        title="soal"
                        id="soal-id"
                        value="{{ $soal->soal }}"
                        />
                    
                    <x-text-input
                        name="pilihan_a"
                        title="pilihan a"
                        id="pilihan-a-id"
                        value="{{ $soal->pilihan_a }}"
                        />

                    <x-text-input
                        name="pilihan_b"
                        title="pilihan b"
                        id="pilihan-b-id"
                        value="{{ $soal->pilihan_b }}"
                        />

                    <x-text-input
                        name="pilihan_c"
                        title="pilihan c"
                        id="pilihan-c-id"
                        value="{{ $soal->pilihan_c }}"
                        />

                    <x-text-input
                        name="pilihan_d"
                        title="pilihan d"
                        id="pilihan-d-id"
                        value="{{ $soal->pilihan_d }}"
                        />

                    <x-select-input
                        name="jawaban"
                        title="jawaban"
                        id="jawaban-id" >
                        <option value="a"
                            @if(old("jawaban"))
                                @if(old("jawaban") == "a")
                                    selected
                                @endif
                            @else
                                @if($soal->jawaban == "a")
                                    selected
                                @endif
                            @endif>A</option>
                        <option value="b"
                            @if(old("jawaban"))
                                @if(old("jawaban") == "b")
                                    selected
                                @endif
                            @else
                                @if($soal->jawaban == "b")
                                    selected
                                @endif
                            @endif>B</option>
                        <option value="c"
                            @if(old("jawaban"))
                                @if(old("jawaban") == "c")
                                    selected
                                @endif
                            @else
                                @if($soal->jawaban == "c")
                                    selected
                                @endif
                            @endif>C</option>
                        <option value="d"
                            @if(old("jawaban"))
                                @if(old("jawaban") == "d")
                                    selected
                                @endif
                            @else
                                @if($soal->jawaban == "d")
                                    selected
                                @endif
                            @endif>D</option>
                    </x-select-input>

                    <div class="mb-3">
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection