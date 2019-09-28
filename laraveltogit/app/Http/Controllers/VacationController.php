<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Vacation;

class VacationController extends Controller
{
    /**
     * Отображение страницы для авторизованного пользователя
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function one($id) {

        $authUser = User::getUserName($id);

        return view('page')->with([
            'authUser'=>$authUser,
            'users' => User::select(['id','name','email','role'])->get(),
            'vacations' => Vacation::all(),
            'role' => User::getRole($authUser->role)
        ]);
    }

    public function add($id){

        return view('add-vacation') -> with([
            'authUser' => User::where('id',$id)->first(),
        ]);
    }

    public function save(Request $request){

        $this->validate($request, [
            'start_vacation' => 'required',
            'finish_vacation' => 'required',
        ]);
        if($request->id){
            Vacation::where('id',$request->id)->delete();
        }
        $vacation = new Vacation;
        $vacation->fill($request->all())->save();
        return redirect('/vacation/'.$vacation->id_user);

    }

    public function edit($id,$id_user){


        return view('add-vacation') -> with([
            'authUser' => User::where('id',$id_user)->first(),
            'editVacation' => Vacation::where('id',$id)->first()
        ]);
    }

    public function delete($id){
        Vacation::find($id)->delete();

        return back();
    }

    public function accepted($id){
       $vacation = Vacation::find($id);
        $vacation -> accept = '1';
        $vacation -> save();
        return back();
    }

}
