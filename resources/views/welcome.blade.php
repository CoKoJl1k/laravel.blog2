@include('header')

@include('success_message')


@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Album example</h1>
            <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
            <p>
                <a href="{{ route('form') }}" class="btn btn-primary my-2">Создать пост</a>
                <a href="#" class="btn btn-secondary my-2">Secondary action</a>
            </p>
        </div>
    </section>

    @include('search')

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                @foreach( $posts as $post )
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <div class="card-body">
                                <p class="card-text">{{ $post->title }}</p>
                            </div>
                            <img class="card-img-top" src="{{ isset($post->images) ?  asset('storage/'.$post->images) :  asset( 'storage/images/images.png') }}" alt="Card image cap" height="230px;">

                            <div class="card-body">
                                <p class="card-text">{{ $post->description }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ route('edit_form_get', $post->id) }}" class="btn btn-sm btn-outline-secondary">Редактировать</a>
                                        <!-- <a href="{{ route('delete', $post->id) }}"type="button" class="btn btn-sm btn-outline-secondary">Удалить</a> -->
                                    </div>
                                    <small class="text-muted">{{ date('d.m.Y H:i:s', strtotime($post->created_at)) }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
               {{  $posts->onEachSide(1)->links('vendor.pagination.bootstrap-4')}}
            </div>
        </div>
    </div>
@endsection

<main role="main">
    @yield('content')
</main>

@include('footer')
