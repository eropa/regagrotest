@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Страница обработки информации</div>
                    <div class="card-body">
                        <page2-component data='{{ $ogrn }}'>
                        </page2-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
