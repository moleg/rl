@extends('layouts.app')

@section('content')
        @if(count($errors)>0)
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif

        <div class="row">

            <div class="col-md-2 col-md-offset-2" id="test">

                <div class="tab" >
                    {{ Form::open(array('url' => '/registerstudent')) }}
                    <div class="form-group {{$errors->has("first_name") ? "has-error" : ""}}">
                        <label for="first_name">Your Fist Name</label>
                       <!-- <input class="form-control" type="text" name="first_name" id="first_name" value="{{Request::old("first_name")}}" />-->

                            <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif

                    </div>
                    <div class="form-group {{$errors->has("last_name") ? "has-error" : ""}}">
                        <label for="last_name">Your Last Name</label>
                        <input class="form-control" type="text" name="last_name" id="last_name" value="{{Request::old("last_name")}}"/>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select id="type" name="type">
                            <option value="Олимпиада">Олимпиада</option>
                            <option value="Головоломки">Головоломки</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="class_num">Your Class</label>
                        <select id="class_num" name="class_num">
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                    </div>
                    <div class="form-group {{$errors->has("city") ? "has-error" : ""}}">
                        <label for="city">City</label>
                        <input class="form-control" type="text" name="city" id="city" />
                    </div>
                    <div class="form-group school {{$errors->has("school") ? "has-error" : ""}}"  >
                        <label for="school">School</label>
                        <input class="form-control" type="text" name="school"  id="school"/>
                    </div>
                    <div class="form-group {{$errors->has("teacher") ? "has-error" : ""}}">
                        <label for="teacher">Teacher</label>
                        <input class="form-control" type="text" name="teacher" id="teacher" value="{{Request::old("teacher")}}" />
                    </div>
                    <div class="form-group {{$errors->has("email") ? "has-error" : ""}}">
                        <label for="email">email</label>
                        <input class="form-control" type="email" name="email" id="email" value="{{Request::old("email")}}" required />
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has("phone") ? "has-error" : ""}}" >
                        <label for="phone">Phone</label>
                        <input class="form-control" type="text" name="phone" id="phone" value="{{Request::old("phone")}}" />
                    </div>
                    <div class="form-group">
                        <label for="lead_source">Lead Source</label>
                        <textarea class="form-control" name="lead_source" id="lead_source">{{Request::old("lead_source")}}</textarea>
                    </div>

                    @guest

                    @else
                        <div class="form-group">
                            <label for="registration">Reg</label>
                            <input  type="checkbox"   name="registration" id="registration" style="width: 20px; height: 20px;"/>
                        </div>
                    @endguest
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                    <button type="submit">Submit</button>
                    {{ Form::close() }}
                </div>
                <div class="tab" style="display: none">
                    {{ Form::open(array('url' => '/test')) }}
                    <div class="form-group">
                        <label for="teamName">Название тимы</label>
                        <input class="form-control" type="text" name="teamName" id="teamName" />
                    </div>
                    <div class="form-group">

                    </div>
                    @guest

                    @else
                        <div class="form-group">
                            <label for="registration">Reg</label>
                            <input  type="checkbox"   name="registration" id="registration" style="width: 20px; height: 20px;"/>
                        </div>
                        @endguest
                    <button type="submit">Submit</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <script src={{asset('js/city.js')}}></script>
    @endsection
