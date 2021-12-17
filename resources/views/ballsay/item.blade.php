<x-layouts-app>
    @section('title'){{$item->title}}@endsection
    @section('description'){{$item->description}}@endsection
    @section('keywords'){{$item->keywords}}@endsection
        
    @include(theme().'.components.navbar')
    <div class="container">

        <div class="row">
            <div class="col-lg-3 col-12">
                @include(theme().'.components.sidebar')
            </div>
            <div class="col-lg-9 col-12 mb-3">
                @include(theme().'.components.banner')
                <div class="p-3 bg-dark rounded">
                    <h1 class="mb-3 text-danger m-0 text-shadow">{{$item->title}}</h1>
                    <hr class="bg-warning">
                    <small class="d-block text-right mb-3">
                        <a href="{{ url('cat/'.$cat->id) }}" title="หมวด{{$cat->title}}" class="text-danger">
                            หมวด{{$cat->title}}
                        </a>
                        &nbsp;
                        <span class="text-danger"><i class="fas fa-clock"></i> {{ thai($item->created_at,'no-time') }}</span>
                    </small>
                    {{-- <div class="p-1" style="background-color:rgba(0,0,0,0.7);"> --}}
                        {{-- <div class="bg-dark" style="border:1px solid #424242;"> --}}
                            <p class="text-warning">
                                {!! $item->description !!}
                            </p>
                            <img src="{{ api_img($item->image) }}" alt="{{$item->image}}" title="{{$item->image}}" width="100%" class="mb-3">     
                        <div>
                            {!! $item->content !!}
                        </div>
                        {{-- </div> --}}
                    {{-- </div> --}}
                </div>

            </div>
        </div>
    </div>
    @include(theme().'.components.footer')
</x-layouts-app>