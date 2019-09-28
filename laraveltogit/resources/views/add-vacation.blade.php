@extends('layouts.site')

@section('content')

    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3">{{$authUser->name}}</h1>
            <p>На этой странице Вы можете добавить или редактировать отпуск</p>
            <p><a class="btn btn-primary btn-lg" href="{{ route('vacationOne', ['id' => $authUser->id])}}" role="button">&laquo; Назад к списку отпусков</a></p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="form col-md-6">
                <form method="POST" action="{{ route('vacationSave') }}">
                    <div class="form-group ">
                        <input type="hidden" name="id_user" value="{{$authUser->id}}">
                        <input type="hidden" name="accept" value="0">

                        <label for="start_vacation">Начало отпуска</label>

                        @if(isset($editVacation))
                            <input type="date" id="start_vacation" name="start_vacation"
                                   value="{{$editVacation->start_vacation}}">
                            <input type="hidden" name="id" value="{{$editVacation->id}}">
                        @else
                            <input type="date" id="start_vacation" name="start_vacation" value="YYYY-MM-DD">
                        @endif
                    </div>
                    <div class="form-group ">
                        <label for="finish_vacation">Конец отпуска</label>
                        @if(isset($editVacation))
                            <input type="date" id="finish_vacation" name="finish_vacation"
                                   value="{{$editVacation->finish_vacation}}">
                        @else
                            <input type="date" id="finish_vacation" name="finish_vacation" placeholder="YYYY-MM-DD">
                        @endif
                    </div>
                    <button type="submit" class="btn btn-success ">Сохранить</button>
                    {{csrf_field()}}
                </form>
                <div class="col-md-3">
                </div>
            </div>
        </div>

    </div>



@endsection