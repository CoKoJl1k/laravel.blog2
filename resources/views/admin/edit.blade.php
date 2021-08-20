@include('header')

@section('content')
    @include('errors')
    @include('success_message')
    <div class="container">
        <h1>Изменение поста</h1>

        <div class="row">
            <div class="col-7">
                <form method="POST" action="{{ route('posts.update', $posts[0]->id )}}" enctype="multipart/form-data"  >
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="formGroupExampleInput">Название</label>
                        <input name="title" type="text" class="form-control" id="formGroupExampleInput" placeholder="Название" value="{{$posts[0]->title}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea">Содержание</label>
                        <textarea name="description"  class="form-control" id="exampleFormControlTextarea" rows="3" >{{ $posts[0]->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <input name="file_name"  type="file" class="form-control-file" id="exampleFormControlFile">
                    </div>
                    <div class="form-group">
                        <img src="{{ isset($posts[0]->images) ? asset( 'storage/'.$posts[0]->images) : asset( 'storage/images/images.png')  }}" alt="альтернативный текст" width="300px;" height="230px;">
                    </div>
                    <button value="update" name="btn_type" type="submit" class="btn btn-primary my-1">Сохранить</button>
                </form>
            </div>

            <div class="col-5">
                <form method="POST" action="{{route('posts.destroy', $posts[0]->id )}}" style="margin-top: 512px;" >
                    @method('DELETE')
                    @csrf
                    <button value="delete" name="btn_type" type="submit" class="btn btn-secondary my-1" >Удалить</button>
                </form>
            </div>

        </div>


    <div>
@show

@include('footer')
