@extends('layouts.site')

@section('content')
    @if(!isset($authUser))
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-3">Расписание отпусков сотрудников</h1>
                <p>Выберите пользователя (этакая заглушка на авторизацию =))</p>
                @foreach($users as $user)
                    <p><a class="btn btn-primary btn-lg" href="{{ route('vacationOne', ['id' => $user->id]) }}"
                          role="button">{{ $user->name}} &raquo;</a></p>
                @endforeach
            </div>
        </div>
    @else
        <div class="jumbotron">
            <div class="container">
                <h3>Вы авторизованы как </h3>
                <h1 class="display-3">{{$authUser->name}} ({{$role}})</h1>
                <p><a class="btn btn-primary btn-lg" href="{{ route('vacationAdd', ['id' => $authUser->id])}}" role="button">Личный кабинет</a></p>
                <p><a class="btn btn-primary btn-lg" href="{{ route('index')}}" role="button">&laquo; Назад к выбору пользователя </a></p>
            </div>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6 vacation_list_block">
                    <h2>Расписание отпусков</h2>

                    @foreach($vacations as $vacation)
                        @if($vacation->id_user === $authUser->id)
                            <div class="vacation_list_elem" style="background-color: rgba(122,223,50,0.49)">

                               @if($vacation->accept === 0)
                                   <div class="buttons_control">
                                       <a class="btn btn-primary btn-sm btn_edit" href="{{route('vacationEdit', ['id' => $vacation->id, 'id_user' => $authUser->id])}}" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                       <a class="btn btn-primary btn-sm btn_del" href="{{route('vacationDelete', ['id' => $vacation->id])}}" role="button"> <i class="fa fa-times-circle-o" aria-hidden="true"></i> </a>

                                   </div>
                                   <div class="vacation_list_elem__user">Ваш отпуск &raquo;</div>
                               @else
                                    <div class="vacation_list_elem__user">Ваш отпуск одобрен!</div>
                               @endif
                        @else

                             <div class="vacation_list_elem">
                                 @if($authUser->role === 100)

                                     @if($vacation->accept === 0)
                                         <p><a class="btn btn-primary btn-sm" href="{{route('vacationAccepted', ['id' => $vacation->id])}}" role="button"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> </a></p>
                                     @else
                                         <a class="btn btn-primary btn-sm btn_del" href="{{route('vacationDelete', ['id' => $vacation->id])}}" role="button"> <i class="fa fa-times-circle-o" aria-hidden="true"></i> </a>
                                         <p>Одобрено!</p>
                                     @endif
                                 @endif
                                 <div class="vacation_list_elem__user">{{\App\User::getUserName($vacation->id_user)->name}}</div>

                        @endif
                                        <div class="vacation_list_elem__dates">c {{ App\Vacation::changeFormatDate($vacation->start_vacation)}}
                                            до {{App\Vacation::changeFormatDate($vacation->finish_vacation)}}</div>
                                    </div>
                                    <hr>
                    @endforeach

                            </div>
                            <div class="col-md-3">
                            </div>
                </div>

                <hr>

            </div>
        </div>
    @endif
@endsection