@if ($errors->all())
    <div class="container">
        <div class="alert alert-danger" role="alert">
            <ul>
            @foreach ( $errors->all() as $message)
                    <li>{{$message}}</li>
            @endforeach
            </ul>
        </div>
    </div>
@endif


