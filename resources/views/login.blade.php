@extends('logintemplate')

@section('cuerpo')
<!-- <div style="width:30em; margin:1em auto; padding:.5em; border:1px solid #999"> -->
    <div class="wrapper">
        <div class="logo">
            <img src="../assets/img/logobunglebuild.png" alt="">
        </div>
        <div class="text-center mt-4 name">
            Bunglebuild S.L.
        </div>
        <form class="p-3 mt-3" method="post">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input name="user" type="text" placeholder="Username" value="@if(isset($_COOKIE['ult_usuario'])){{$_COOKIE['ult_usuario']}}@endif">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="passwd" id="pwd" placeholder="Password" value="@if(isset($_COOKIE['ult_usuario_pass'])){{$_COOKIE['ult_usuario_pass']}}@endif">
            </div> 
            <input type="checkbox" name="recordar" id="" > Recordar
            <button class="btn mt-3" type="submit">Login</button>
        </form>
        <!-- <div class="text-center fs-6">
            <a href="#">Forget password?</a> or <a href="#">Sign up</a>
        </div> -->
    </div>
<!-- </div> -->
@endsection