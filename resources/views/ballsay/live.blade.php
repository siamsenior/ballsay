<x-layouts-app>
    @section('title')ดูบอลสด คาสิโนออนไลน์ มั่งคงปลอดภัย 100%@endsection
    @section('description')ดูบอลสด ดูผลบอลด่วน ราคาบอลสเต็ป ราคาบอลเดี่ยว วิเคราะห์บอล ผลบอลสด วิเคราะห์บอล อัพเดทรายการกีฬาให้ท่านได้ดูกันอย่างจุใจ@endsection
    @section('keywords')ดูบอลสด, ผลบอลสด, โปรแกรมบอล, วิเคราะห์บอล, ราคาบอลสเต็ป, ราคาบอลเดี่ยว, วิเคราะห์บอล, ผลบอลสด, วิเคราะห์บอล@endsection
    
    @include(theme().'.components.navbar')
    <div class="container">

        <div class="row">
            <div class="col-lg-3 col-12">
                @include(theme().'.components.sidebar')
            </div>
            <div class="col-lg-9 col-12 mb-3">
                @include(theme().'.components.banner')
                <div class="p-3 bg-dark mb-3 rounded">
                    <h1 class="mb-3 m-0">
                        <i class="fas fa-layer-group text-warning"></i> <span
                            class="text-shadow text-danger">ดูบอลออนไลน์ <span
                            class="text-warning small text-shadow">{{ thai(now(),'shot') }}</span>
                    </h1>
                    {!! dooball() !!}
                </div>
            </div>
        </div>
    </div>
    @include(theme().'.components.footer')
</x-layouts-app>