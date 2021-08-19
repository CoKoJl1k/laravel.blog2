@include('header')

@section('content')
    @include('errors')
    @include('success_message')
    <div class="container">
        <h1>Создание поста</h1>
        <form method="POST" action="{{route('create_form')}}" enctype="multipart/form-data"  >

            @method('POST')
            @csrf
            <div class="form-group">
                <label for="formGroupExampleInput">Название</label>
                <input name="title" type="text" class="form-control" id="formGroupExampleInput" placeholder="Название">
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea">Содержание</label>
                <textarea name="description"  class="form-control" id="exampleFormControlTextarea" rows="3"></textarea>
            </div>

            <div class="form-group">
                <input name="file_name"  type="file" class="form-control-file" id="exampleFormControlFile">
            </div>

            <button type="submit" class="btn btn-primary my-1">Создать пост</button>
        </form>
    <div>
@show

@include('footer')
