@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Ввода номера ОГРН X-XX-XX-XX-XXXXX-X</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="post" action="{{ route('postpage') }}">
                            <div class="form-group">
                                <input type="text" name="ogrn_value" class="form-control item" id="ogrn-number" placeholder="X-XX-XX-XX-XXXXX-X" required>
                                <small id="textOk"  hidden="true" class="form-text text-muted">корректен</small>
                            </div>
                            @csrf
                            <input type="submit" disabled value="Найти">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
