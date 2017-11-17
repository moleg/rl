@extends('layouts.app')

@section('content')
<div class="container">

    <div id="myModal" class="modal">

        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Оценки</h2>
            </div>
            <div class="modal-body">
                <table >
                    <tr>
                        <th>Задание 1</th>
                        <th>Задание 2</th>
                        <th>Задание 3</th>
                        <th>Задание 4</th>
                        <th>Задание 5</th>
                        <th>Задание 6</th>
                        <th>Задание 7</th>
                        <th>Задание 8</th>
                        <th>Задание 9</th>
                        <th>Задание 10</th>
                        <th>Сума</th>
                        <th></th>
                    </tr>
                    <tr id="modal-table-tr">
                        <td><input type="number" size="2" min="0" max="20" class="marks"/></td>
                        <td><input type="number" size="2" min="0" max="20" class="marks"/></td>
                        <td><input type="number" size="2" min="0" max="20" class="marks"/></td>
                        <td><input type="number" size="2" min="0" max="20" class="marks"/></td>
                        <td><input type="number" size="2" min="0" max="20" class="marks"/></td>
                        <td><input type="number" size="2" min="0" max="20" class="marks"/></td>
                        <td><input type="number" size="2" min="0" max="20" class="marks"/></td>
                        <td><input type="number" size="2" min="0" max="20" class="marks"/></td>
                        <td><input type="number" size="2" min="0" max="20" class="marks"/></td>
                        <td><input type="number" size="2" min="0" max="20" class="marks"/></td>
                        <td><p class="marks"></p></td>
                        <th><th><i class="fa fa-check fa-lg" aria-hidden="true" onclick="sendMarks()" ></i></th></th>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <h3></h3>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-20 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div><input type="text" id="search-field"><i class="fa fa-search fa-lg" id="search-button" aria-hidden="true"></i></div>
                        @if(count($students)==0)
                            <p>не найдено ни одного зареестрированого ученика</p>
                        @else
                           <table style="width:100%">
                               <tr>
                                   <th >FirstName </th>
                                   <th >LastName</th>
                                   <th >City</th>
                                   <th >School</th>
                                   <th >Class</th>
                                   <th >Email</th>
                                   <th >OlympType</th>
                                   <th >Teacher</th>
                                   <th >PhoneNumber</th>
                                   <th>RegisterDate</th>
                                   <th class="controls"></th>
                                   <th class="controls"></th>
                               @if(Auth::user()->name == "admin")
                                   <th class="controls"></th>
                                   @endif
                               </tr>

                               @foreach($students as $student)

                               <tr>
                                   <th data-type="text" data-name="firstName"><input type="hidden" value="{{$student->FirstName}}"/>{{$student->FirstName}}</th>
                                   <th data-type="text" data-name="lastName"><input style="display: none" type="text" value={{$student->FirstName}}/>{{$student->LastName}}</th>
                                   <th data-type="text" data-name="city">{{$student->City}}</th>
                                   <th data-type="text" data-name="school">{{$student->School}}</th>
                                   <th data-type="enum:4,5,6,7,8" data-name="class">{{$student->Class}}</th>
                                   <th data-type="text" data-name="email">{{$student->Email}}</th>
                                   <th data-type="enum:Олимпиада,Головоломки" data-name="olympType">{{$student->OlympType}}</th>
                                   <th data-type="text" data-name="teacher">{{$student->Teacher}}</th>
                                   <th data-type="text" data-name="phone">{{$student->PhoneNumber}}</th>
                                   <th data-type="text" data-name="date">{{$student->created_at}}</th>
                                   <th><i class="fa fa-pencil fa-lg "  data-id="{{$student->idStudents}}" aria-hidden="true" onclick="edit(this)" ></i></th>
                                   <th><i class="fa fa-times fa-lg "  data-id="{{$student->idStudents}}" aria-hidden="true" onclick="deleting(this)"></i></th>
                                   @if(Auth::user()->name == "admin")
                                       <th><i class="fa fa-gavel fa-lg "  data-id="{{$student->idStudents}}" aria-hidden="true" onclick="marks(this)"></i></th>
                                   @endif
                               </tr>
                               @endforeach
                           </table>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script src={{asset("js/menu.js")}}></script>
@endsection
