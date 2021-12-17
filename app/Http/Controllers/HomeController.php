<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;


class HomeController extends Controller
{
    public function index()
    {
        $blogs = DB::table('blogs')->where('cid', cat_news())->orderBy('id', 'desc')->take(4)->get();
        $ans = DB::table('blogs')->where('cid', cat_ans())->orderBy('id', 'desc')->take(6)->get();
        $zfts = DB::table('zfts')->where('wid', zft_wid())->where('pin', '1')->orderBy('id', 'desc')->take(3)->get();
        return view(theme() . '.index', [
            'blogs' => $blogs,
            'ans' => $ans,
            'zfts' => $zfts,
            'active' => 'home',
        ]);
    }

    function view($slug) {
        $item = DB::table('blogs')->where('slug',$slug)->first();
        $c = DB::table('categories')->where('id',$item->cid)->first();
        if ($c->id == cat_news()) { $active = 'news'; }
        elseif ($c->id == cat_ans()) { $active = 'ans'; }
        return view(theme().'.item',[
            'active' => $active,
            'cat' => $c,
            'item' => $item
        ]);
    }

    function item($id) {
        $item = DB::table('blogs')->where('id',$id)->first();
        $c = DB::table('categories')->where('id',$item->cid)->first();
        if ($c->id == cat_news()) { $active = 'news'; }
        elseif ($c->id == cat_ans()) { $active = 'ans'; }
        return view(theme().'.item',[
            'active' => $active,
            'cat' => $c,
            'item' => $item
        ]);
    }

    function cat($id) {
        $c = DB::table('categories')->where('id',$id)->first();
        $items = DB::table('blogs')->where('cid',$c->id)->orderBy('id','desc')->paginate(15);
        if ($c->id == cat_news()) { $active = 'news'; }
        elseif ($c->id == cat_ans()) { $active = 'ans'; }
        else { $active = 'unknown'; }

        return view(theme().'.cat',[
            'active' => $active,
            'cat' => $c,
            'items' => $items
        ]);
    }

    public function liveCh(Request $req) {
        // https://api.db-ip.com/v2/free/self
        $ch = 'https://linkdooball.com/player/?channel='.$req->channel.'&ip=119.76.128.15';
        return view(theme().'.live_ch',[
            'active' => 'live',
            'ch_url' => $ch
        ]);
    }

    public function lineNotify(Request $request) {
        $message="\n".'Send from: '.url('/')."\n".'ชื่อ: '.$request->fullname."\n".'เบอร์โทรศัพท์: '.$request->phone."\n".'LineID: '.$request->lineid;
        // $token = 'PKeaJt2BPn1U0U6NVxW0XBABiELIkcW9nDjCKaCtJjp';
        $token = line_token();
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, "message=$message");
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        $headers = array( "Content-type: application/x-www-form-urlencoded", "Authorization: Bearer $token", );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec( $ch );
        curl_close( $ch );
        return view(template().'.info',[
            'active' => 'home',
            'title' => 'ระบบลงทะเบียน',
            'message' => '<h3 class="text-center text-success my-3">ท่านได้ลงทะเบียนเรียบร้อย</h3>
            <p class="text-center">ทางทีมงานได้รับข้อมูลการลงทะเบียนสมาชิกจากท่านแล้ว</p>
            <p class="text-info text-center">กรุณารอสักครู่... ทางทีมงานจะติดต่อกลับ ให้เร็วที่สุด ขอบคุณค่ะ</p>
            <br />
            <p class="text-center text-danger"><i>ทีมงาน <span class="text-warning">'.url('/').'</span></i></p>
            <br />
            '
        ]);
    }   

}
