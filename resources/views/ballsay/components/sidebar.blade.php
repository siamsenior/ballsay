<div class="mb-3" style="position: -webkit-sticky; position:sticky; top:16px;">
    <div>
        <div class="bg-dark col-12 rounded mb-3 shadow">

            <div class="pt-2">
                <a href="https://www.mm88online.com/" title="mm88online dot com">
                    <img src="{{ asset('images/logo-mm88online.png') }}" alt="tdedsccore" width="100%">
                </a>
            </div>
            <div>
                <h1 class="text-warning text-shadow-3d">สมัครสมาชิกออนไลน์</h1>
            </div>
            <form class="input-group py-3" name="line-notify" action="{{ url('/line-notify') }}" method="post"
                autocomplete="off">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-yellow border-dark" id="basic-addon1"><i
                                class="fas fa-user text-dark"></i></span>
                    </div>
                    <input type="text" name="fullname" id="fullname" class="form-control border-dark"
                        placeholder="ชื่อ - นามสกุล" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-yellow border-dark" id="basic-addon1">
                            <i class="fas fa-mobile-alt text-dark"></i><span style="color: rgba(0,0,0,0);">'</span>
                        </span>
                    </div>
                    <input name="phone" id="phone" class="form-control border-dark" placeholder="เบอร์โทรศัพท์"
                        maxlength="10" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                        required type="text">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-yellow border-dark" id="basic-addon1"><i
                                class="fab fa-line text-dark"></i></span>
                    </div>
                    <input name="lineid" id="lineid" class="form-control border-dark" placeholder="Line ID" required
                        type="text">
                </div>
                <div class="col-12 text-center px-0">
                    <button type="submit" class="btn btn-success col-12 shadow" name="submit" style="font-size:18px;">
                        <i class="fas fa-check-circle"></i> ยืนยันข้อมูลการสมัคร
                    </button>
                </div>
            </form>

        </div>
        <div class="bg-primary text-center mb-3 py-2 rounded">
            ทีมงานจะติดต่อกลับ ภายใน 5 นาที
        </div>
        <div class="mb-3">
            <a href="https://line.me/R/ti/p/%40085gesnl">
                <img src="{{asset('images/bannerlogin.png')}}" alt="promotion" width="100%">
            </a>
        </div>  
        
        <div class="mb-3">
            <a href="https://line.me/R/ti/p/%40085gesnl">
                <img src="{{asset('images/pro.png')}}" alt="promotion" width="100%">
            </a>
        </div>
    </div>
</div>