@include('header')

@include('success_message')



@include('errors')
@section('content')

    <div class = "container" style="margin-top: 100px;">
        <div class="row justify-content-center">
            <h1>Введите данные для авторизации</h1>

            <div class="col-6">
                <form method="POST" action="{{route('login')}}">
                    @method('POST')
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

<main role="main">
    @yield('content')
</main>

@include('footer')
