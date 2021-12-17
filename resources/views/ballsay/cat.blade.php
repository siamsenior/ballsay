<x-layouts-app>
    @section('title'){{$cat->title}} ข่าวบอล ดูบอล ผลบอลสด โปรแกรมบอล วิเคราะห์บอล คาสิโนออนไลน์ มั่งคงปลอดภัย
    100%@endsection
    @section('description'){{$cat->description}} ดูบอล ดูผลบอลด่วน ราคาบอลสเต็ป ราคาบอลเดี่ยว วิเคราะห์บอล ผลบอลสด
    วิเคราะห์บอล อัพเดทรายการกีฬาให้ท่านได้ดูกันอย่างจุใจ@endsection
    @section('keywords'){{$cat->keywords}}, ดูบอล, ผลบอลสด, โปรแกรมบอล, วิเคราะห์บอล, ราคาบอลสเต็ป, ราคาบอลเดี่ยว,
    วิเคราะห์บอล, ผลบอลสด, วิเคราะห์บอล@endsection    
    @include(theme().'.components.navbar')
    <div class="container">

        <div class="row">
            <div class="col-lg-3 col-12">
                @include(theme().'.components.sidebar')
            </div>
            <div class="col-lg-9 col-12 mb-3">
                @include(theme().'.components.banner')
                <div class="p-3 bg-dark rounded">
                    <h1 class="mb-3 text-danger m-0 text-shadow">หมวด{{$cat->title}}</h1>
                    <hr class="bg-warning mb-3">
                    @if($items->count() > 0)
                    <div class="row">
                        @foreach ($items as $item)
                        <div class="col-sm-4 col-12 item-index mb-3">
                            <a href="{{ url('view/'.$item->slug) }}">
                                <img src="{{api_img($item->image)}}" alt="{{$item->title}}" width="100%">
                                <span class="d-block overflow-hidden mt-1" style="height:55px;">
                                    {{$item->title}}
                                </span>
                            </a>
                        </div>
                        @endforeach
                        <div class="d-flex justify-content-center py-4">
                            {{ $items->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                    @else
                    <div>
                        <p class="text-warning text-center" style="font-size: 20px;"><i
                                class="fas fa-exclamation-triangle"></i> ขออภัย ไม่พบข้อมูลที่ต้องการค้นหา.</p>
                    </div>
                    @endif
            </div>
        </div>
    </div>
    @include(theme().'.components.footer')
</x-layouts-app>