@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Программа формирующая json из csv файла</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('uploadcsv') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Выберите файл для обработки в формате csv</label>
                                <input type="file" class="form-control" name="filecsv" id="" placeholder=""
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Выберите формат ответа</label>
                                <select class="form-control" name="output" id="" required>
                                    <option value="">Выберите формат ответа</option>
                                    <option value="to_json">JSON</option>
                                    <option value="to_display">DISPLAY</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
