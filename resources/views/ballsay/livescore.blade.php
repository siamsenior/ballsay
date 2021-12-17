<x-layouts-app>
    @section('title')ผลบอลสด ดูผลบอลด่วน ตารางราคาบอล คาสิโนออนไลน์ มั่งคงปลอดภัย 100%@endsection
    @section('description')ผลบอลสด ดูผลบอลด่วน ตารางราคาบอลดูบอล ราคาบอลสเต็ป ราคาบอลเดี่ยว วิเคราะห์บอล วิเคราะห์บอล อัพเดทรายการกีฬาให้ท่านได้ดูกันอย่างจุใจ@endsection
    @section('keywords')ดูผลบอลด่วน, ตารางราคาบอล, ผลบอลสด, โปรแกรมบอล, วิเคราะห์บอล, ราคาบอลสเต็ป, ราคาบอลเดี่ยว, วิเคราะห์บอล, ผลบอลสด, วิเคราะห์บอล@endsection

    @include(theme().'.components.navbar')
    <div class="container">

        <div class="row">
            <div class="col-lg-3 col-12">
                @include(theme().'.components.sidebar')
            </div>
            <div class="col-lg-9 col-12 mb-3">
                @include(theme().'.components.banner')
                <div class="p-3 bg-dark rounded">
                    <h1 class="mb-3 text-danger m-0 text-shadow">ผลบอลออนไลน์</h1>
                    <div class="p-1" style="background-color:rgba(0,0,0,0.7);">
                        <div class="bg-dark" style="border:1px solid #424242;">
                            {!! live_score() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include(theme().'.components.footer')
</x-layouts-app>