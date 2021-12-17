<x-layouts-app>
    @section('title')ตารางราคาบอล คาสิโนออนไลน์ มั่งคงปลอดภัย 100%@endsection
    @section('description')ตารางราคาบอลดูบอล ดูผลบอลด่วน ราคาบอลสเต็ป ราคาบอลเดี่ยว วิเคราะห์บอล ผลบอลสด วิเคราะห์บอล อัพเดทรายการกีฬาให้ท่านได้ดูกันอย่างจุใจ@endsection
    @section('keywords')ตารางราคาบอล, ผลบอลสด, โปรแกรมบอล, วิเคราะห์บอล, ราคาบอลสเต็ป, ราคาบอลเดี่ยว, วิเคราะห์บอล, ผลบอลสด, วิเคราะห์บอล@endsection
    
    @include(theme().'.components.navbar')
    <div class="container">

        <div class="row">
            <div class="col-lg-3 col-12">
                @include(theme().'.components.sidebar')
            </div>
            <div class="col-lg-9 col-12 mb-3">
                @include(theme().'.components.banner')
                <div class="p-3 bg-dark rounded">
                    <h1 class="mb-3 text-danger m-0 text-shadow">ตารางราคาบอล - <span class="text-warning small text-shadow">{{ thai(now(),'shot') }}</span></h1>
                    <div class="p-1" style="background-color:rgba(0,0,0,0.7);">
                        <div class="bg-dark" style="border:1px solid #424242;">
                            {!! ball_odds() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include(theme().'.components.footer')
</x-layouts-app>