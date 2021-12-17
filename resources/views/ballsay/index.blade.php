<x-layouts-app>
    @include(theme().'.components.navbar')
    <div class="container">

        <div class="row">
            <div class="col-lg-3 col-12">
                @include(theme().'.components.sidebar')
            </div>
            <div class="col-lg-9 col-12 mb-3">
                @include(theme().'.components.banner')
                @if($blogs->count() > 0)
                <div class="p-3 bg-dark mb-3 rounded">
                    <h1 class="mb-3 text-danger m-0 text-shadow">ข่าวเด่นกีฬาดัง</h1>
                    <div class="row">
                        @foreach ($blogs as $blog)
                        <div class="col-sm-6 col-12 mb-3 item-index">
                            <a href="{{ url('view/'.$blog->slug) }}" class="row text-white">
                                <span class="col-5">
                                    <img src="{{ api_img($blog->image) }}" width="100%" class="float-left">
                                </span>
                                <span class="col-7">
                                    <i class="d-block" style="width: 100%; height: 80px; overflow:hidden;">
                                        {{$blog->title}}
                                    </i>
                                </span>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($ans->count() > 0)
                <div class="p-3 bg-dark mb-3 rounded">
                    <h1 class="mb-3 text-danger m-0 text-shadow">วิเคราะห์บอลดัง</h1>
                    <div class="row">
                        @foreach ($ans as $an)
                        <div class="col-sm-6 col-12 mb-3 item-index">
                            <a href="{{ url('item/'.$an->id) }}" class="row text-white">
                                <span class="col-5">
                                    <img src="{{ api_img($an->image) }}" width="100%" class="float-left">
                                </span>
                                <span class="col-7">
                                    <i class="d-block" style="width: 100%; height: 80px; overflow:hidden;">
                                        {{$an->title}}
                                    </i>
                                </span>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="p-3 bg-dark rounded">
                    <h1 class="mb-3 text-danger m-0 text-shadow">ผลบอลออนไลน์</h1>
                    <div class="p-1" style="background-color:rgba(0,0,0,0.7);">
                        <div class="bg-dark" style="border:1px solid #424242;">
                            {{-- {!! ball_odds() !!} --}}
                            {!! live_score() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include(theme().'.components.footer')
</x-layouts-app>