<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3" style="border-bottom:0px solid rgb(54, 54, 170);">
    <div class="container">
        <a class="navbar-brand logo text-shadow" href="{{url('/')}}" style="font-size:30px; color:rgb(220, 20, 60, 1);">
            Ball<i class="text-warning">S</i>ay !
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link {{ ($active=='home') ? 'active' : '' }}" href="{{url('/')}}">หน้าแรก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($active=='news') ? 'active' : '' }}" href="{{url('cat/'.cat_news())}}">ข่าวกีฬา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($active=='live') ? 'active' : '' }}" href="{{url('/live')}}">ดูบอลสด</a>
                </li>                
                <li class="nav-item">
                    <a class="nav-link {{ ($active=='ans') ? 'active' : '' }}" href="{{url('cat/'.cat_ans())}}">วิเคราะห์บอล</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($active=='odds') ? 'active' : '' }}" href="{{url('/odds')}}"><i class="fab fa-hotjar text-danger blink-me"></i>ตารางราคาบอล</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($active=='livescore') ? 'active' : '' }}" href="{{url('/livescore')}}"><i class="fab fa-hotjar text-danger blink-me"></i>ผลบอลฮอตไลน์</a>
                </li>   
                <li class="nav-item">
                    <a class="nav-link" href="https://line.me/R/ti/p/%40085gesnl" target="_blank">ติดต่อทีมงาน</a>
                </li>                               
            </ul>
        </div> <!-- navbar-collapse.// -->
    </div>
</nav>
