<?php

function cURL_get_contents($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $db = curl_exec($ch);
    curl_close($ch);
    return $db;
}

function get_from_cache($url, $ext, $time = '300')
{
    $path = public_path() . '/cache';
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }

    $files = scandir($path);
    foreach ($files as $file) {
        $scan = str_replace('.' . $ext, '', $file);
        if ($scan != $file) {
            if (ceil(time() - $scan) < $time) {
                $db = file_get_contents($path . '/' . $file);
            } else {
                $db = cURL_get_contents($url);
                file_put_contents($path . '/' . time() . '.' . $ext, $db);
                if (is_file($path . '/' . $file) && file_exists($path . '/' . $file)) {
                    unlink($path . '/' . $file);
                }
            }
        }
    }
    if (!isset($db)) {
        $db = cURL_get_contents($url);
        file_put_contents($path . '/' . time() . '.' . $ext, $db);
    }
    return $db;
}

function ball_odds($w = '100%')
{
    $url = 'https://livescorethai.net/%E0%B8%A3%E0%B8%B2%E0%B8%84%E0%B8%B2%E0%B8%9A%E0%B8%AD%E0%B8%A5';
    $ext = 'odd';
    $db = get_from_cache($url, $ext);
    $t = explode('<table class="table table-default" id="liveprice-table">', $db);
    $t2 = explode('</table>', $t[1]);
    $table = $t2[0];
    return '<table class="table-default">' . $table . '</table>';
}

function live_score()
{
    $url = 'https://livescorethai.net/';
    $ext = 'res';
    $db = get_from_cache($url, $ext);
    $t = explode('<table class="table table-default" id="livescore-table">', $db);
    $t2 = explode('</table>', $t[1]);
    $table = $t2[0];
    return '<table class="table-default">' . str_replace(['https://livescorethai.net/ผลบอลสด/', 'https://livescorethai.net/ดูบอลสด/', 'class="badge badge-danger float-right">ดูบอลสด', '</strong><strong class="live">'], [url('watch') . '/?req=', url('watch') . '/?req=', 'class="badge badge-danger float-right blink-me">Hot', '</strong><strong class="live blink-me">'], $table) . '</table>';
}

function live_watch($uri)
{
    $url = 'https://livescorethai.net/%E0%B8%9C%E0%B8%A5%E0%B8%9A%E0%B8%AD%E0%B8%A5%E0%B8%AA%E0%B8%94/' . $uri;
    $db = cURL_get_contents($url);

    $ts = explode('<table class="table table-default watch-live">', $db);
    $t1 = explode('</table>', $ts[1]);
    $table = $t1[0];
    $res = '<table class="table table-default watch-live">' . $table . '</table>';

    $t = explode('<table class="table table-bordered watch-live">', $db);
    $t1 = explode('</table>', $t[1]);
    $table = $t1[0];
    $res .= '<table class="table table-bordered watch-live">' . $table . '</table>';

    $t1 = explode('</table>', $ts[2]);
    $table = $t1[0];
    $res .= '<table class="table table-default watch-live">' . $table . '</table>';

    $tz = explode('<table class="table table-default">', $db);
    $t1 = explode('</table>', $tz[1]);
    $table = $t1[0];
    $res .= '<table class="table table-default">' . $table . '</table>';

    $t1 = explode('</table>', $tz[2]);
    $table = $t1[0];
    $res .= '<table class="table table-default">' . $table . '</table>';

    // $t1 = explode('</table>',$ts[3]);
    // $table = $t1[0];
    // $res .= '<table class="table table-default watch-live">'.$table.'</table>';

    $t1 = explode('</table>', $ts[4]);
    $table = $t1[0];
    $res .= '<table class="table table-default watch-live">' . $table . '</table>';

    $t1 = explode('</table>', $ts[5]);
    $table = $t1[0];
    $res .= '<table class="table table-default watch-live">' . $table . '</table>';

    return $res;
}

function ball_table()
{
    $url = 'https://livescorethai.net/%E0%B8%95%E0%B8%B2%E0%B8%A3%E0%B8%B2%E0%B8%87%E0%B8%9A%E0%B8%AD%E0%B8%A5';
    $ext = 'btb';
    $db = get_from_cache($url, $ext);
    $t = explode('<table class="table table-default" id="livescore-table">', $db);
    $t2 = explode('</table>', $t[1]);
    $table = $t2[0];
    return '<table class="table-default">' . $table . '</table>';
}

function thai($date, $tme = '')
{
    $d = explode('-', str_replace(' ', '-', $date));
    $mn = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
    $mth = [' ม.ค.', 'ก.พ.', 'มี.ค', 'เม.ย', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
    $d[1] = str_replace($mn, $mth, $d[1]);
    $d[0] = ceil($d[0] + 543);
    if ($tme == '') {
        $t = explode(':', $d[3]);
        return $d[2] . ' ' . $d[1] . ' ' . $d[0] . ' | ' . $t[0] . ':' . $t[1];
    } else {
        return $d[2] . ' ' . $d[1] . ' ' . $d[0];
    }
}

function dooball()
{
    $url = "https://linkdooball.com/";

    $path = public_path() . '/uploads';
    if (!file_exists($path . '/live_new')) {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
            if (!file_exists($path . '/live_new')) {
                mkdir($path . '/live_new', 0777, true);
            }
        }
        mkdir($path . '/live_new', 0777, true);
    }

    $files = scandir(public_path('uploads/live_new/'));
    foreach ($files as $file) {
        $scan = str_replace('.md', '', $file);
        if ($scan != $file) {
            if (ceil(time() - $scan) < 600) {
                $db = file_get_contents(public_path('uploads/live_new/' . $file));
            } else {
                $db = cURL_get_contents($url);
                file_put_contents(public_path('uploads/live_new/' . time() . '.md'), $db);
                if (is_file(public_path('uploads/live_new/' . $file)) && file_exists(public_path('uploads/live_new/' . $file))) {
                    unlink(public_path('uploads/live_new/' . $file));
                }
            }
        }
    }
    if (!isset($db)) {
        $db = cURL_get_contents($url);
        file_put_contents(public_path('uploads/live_new/' . time() . '.md'), $db);
    }
    $listAll = explode('data-toggle="modal"', $db);
    $res = '';
    for ($i = 1; $i < count($listAll); $i++) {

        $c = explode("data-ch='", $listAll[$i]);
        $c2 = explode("'>", $c[1]);
        $channel = $c2[0];

        $l = explode('</h3></div>', $listAll[$i]);
        $l2 = explode('<i class="fas fa-trophy"></i>', $l[0]);

        $league = trim($l2[1]);
        $pBtn = explode('<i class="fas fa-video live-status" style="color: #FF2626;">', $listAll[$i]);

        $h = explode('<td class="home_th"><span>', $listAll[$i]);
        $h2 = explode('</td>', $h[1]);
        $home = $h2[0];

        $d = explode('<span class="date-vs">', $listAll[$i]);
        $d2 = explode('</span>', $d[1]);
        $date = inDateTH($d2[0]);

        $t = explode('<span class="time-vs">', $listAll[$i]);
        $t2 = explode('</span>', $t[1]);
        $time = $t2[0];

        $a = explode('<td class="away_th"><span>', $listAll[$i]);

        $a2 = explode('</td>', $a[1]);
        // dd($a2[0]);
        $away = $a2[0];

        if (!empty($pBtn[1])) {
            $disp = 'style="background-color: rgba(50, 50, 50, 0.8);"';
            $pBtn2 = explode('</i></div>', $pBtn[1]);
            $playBtn = '<div class="col-3 text-right text-danger blink-me">
            <a class="text-danger" href="' . url('/ch?channel=' . $channel) . '" target="_blank" style="text-decoration:none;">
            <i class="fas fa-video"></i> ถ่ายทอดสด
            </a>
            </div>';
        } else {
            $disp = 'style="background-color: rgba(100, 100, 100, 0.6);"';
            $playBtn = '<div class="col-3 text-right" style="color:#999;"><i class="far fa-clock"></i> รอสัญญาณ.</div>';
        }
        $res .= '<div class="col-12 border border-warning p-3 rounded mb-3" ' . $disp . '>
            <div class="row">
                <div class="col-9 text-warning">' . $league . '</div>
                ' . $playBtn . '
                <div class="col-4 text-right align-self-center">' . str_replace('ทีม ', '', $home) . '</div>
                <div class="col-4">
                    <span class="d-block text-info small text-center">' . $date . '</span>
                    <span class="d-block text-dark text-center">
                        <span class="bg-warning rounded px-3">' . $time . '</span>
                    </span>
                </div>
                <div class="col-4 align-self-center">
                ' . str_replace('ทีม ', '', $away) . '
                </div>
            </div>
        </div>';
    }
    return $res;
}

function inDateTH($date)
{
    $d = explode('-', str_replace('/', '-', $date));
    $mn = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
    $mth = [' ม.ค.', 'ก.พ.', 'มี.ค', 'เม.ย', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
    $d[1] = str_replace($mn, $mth, $d[1]);
    return $d[0] . ' ' . str_replace($mn, $mth, $d[1]) . ' ' . ceil($d[2] + 543);
}

function get_zft()
{
    $url = 'https://lstded.com';
    $ext = 'zft';
    $db = get_from_cache($url, $ext, 1200);
    // dd($db);
    // return '
    // <table class="MuiTable-root table table-default" id="livescore-table">
    // <thead class="MuiTableHead-root">
    // <tr class="MuiTableRow-root league-sub-header MuiTableRow-head">
    // <th class="MuiTableCell-root MuiTableCell-head" scope="col"></th>
    // <th class="MuiTableCell-root MuiTableCell-head" scope="col">ทีม</th>
    // <th class="MuiTableCell-root MuiTableCell-head" scope="col">ผล</th>
    // <th class="MuiTableCell-root MuiTableCell-head" scope="col">อัตรา</th>
    // <th class="MuiTableCell-root MuiTableCell-head" scope="col">ทรรศนะ</th>
    // <th class="MuiTableCell-root MuiTableCell-head" scope="col">มั่นใจ</th>
    // </tr></thead><tbody class="MuiTableBody-root">
    // <tr class="MuiTableRow-root">
    // <td class="MuiTableCell-root MuiTableCell-body first-td text-center text-success" width="25" valign="middle">ขนะ</td>
    // <td class="MuiTableCell-root MuiTableCell-body match-link">
    // <div class="teamname  text-warning">ดอร์ทมุนด์</div>
    // <div class="teamname  ">Borussia Dortmund</div>
    // <div class="league-name"><div style="display:inline-block;max-width:100%;overflow:hidden;position:relative;box-sizing:border-box;margin:0">
    // <div style="box-sizing:border-box;display:block;max-width:100%">
    // <img style="max-width:100%;display:block;margin:0;border:none;padding:0" alt="" aria-hidden="true" role="presentation" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTUiIGhlaWdodD0iMTAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></div><img src="/_next/image?url=https%3A%2F%2Flivescorethai.net%2Fassets%2Fimages%2Fflags%2Fde.svg&amp;w=32&amp;q=75" decoding="async" style="visibility: inherit; position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;" srcset="/_next/image?url=https%3A%2F%2Flivescorethai.net%2Fassets%2Fimages%2Fflags%2Fde.svg&amp;w=16&amp;q=75 1x, /_next/image?url=https%3A%2F%2Flivescorethai.net%2Fassets%2Fimages%2Fflags%2Fde.svg&amp;w=32&amp;q=75 2x"></div><strong>บุนเดิสลีกา<!-- --> </strong></div></td><td class="MuiTableCell-root MuiTableCell-body text-center " width="45" data-score=" - "><strong class="score">3<!-- --> </strong><br><strong class="score">0<!-- --> </strong></td><td class="MuiTableCell-root MuiTableCell-body text-center " width="45"><strong class="text-info">2.5<!-- --> </strong></td><td class="MuiTableCell-root MuiTableCell-body text-left"><span class="text"> <!-- -->ทีเด็ด ฟันธง ดอร์ทมุนด์ ซัดกระจาย</span></td><td class="MuiTableCell-root MuiTableCell-body text-center " width="45"><span class="text-warning">80%</span></td></tr><tr class="MuiTableRow-root"><td class="MuiTableCell-root MuiTableCell-body first-td text-center text-success" width="25" valign="middle">ขนะ</td><td class="MuiTableCell-root MuiTableCell-body match-link"><div class="teamname  text-warning">FC Augsburg</div><div class="teamname  ">แอร์เบ ไลป์ซิก</div><div class="league-name"><div style="display:inline-block;max-width:100%;overflow:hidden;position:relative;box-sizing:border-box;margin:0"><div style="box-sizing:border-box;display:block;max-width:100%"><img style="max-width:100%;display:block;margin:0;border:none;padding:0" alt="" aria-hidden="true" role="presentation" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTUiIGhlaWdodD0iMTAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></div><img src="/_next/image?url=https%3A%2F%2Flivescorethai.net%2Fassets%2Fimages%2Fflags%2Fde.svg&amp;w=32&amp;q=75" decoding="async" style="visibility: inherit; position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;" srcset="/_next/image?url=https%3A%2F%2Flivescorethai.net%2Fassets%2Fimages%2Fflags%2Fde.svg&amp;w=16&amp;q=75 1x, /_next/image?url=https%3A%2F%2Flivescorethai.net%2Fassets%2Fimages%2Fflags%2Fde.svg&amp;w=32&amp;q=75 2x"></div><strong>บุนเดิสลีกา<!-- --> </strong></div></td><td class="MuiTableCell-root MuiTableCell-body text-center " width="45" data-score=" - "><strong class="score">1<!-- --> </strong><br><strong class="score">1<!-- --> </strong></td><td class="MuiTableCell-root MuiTableCell-body text-center " width="45"><strong class="text-info">1<!-- --> </strong></td><td class="MuiTableCell-root MuiTableCell-body text-left"><span class="text"> <!-- -->ทีเด็ด ฟันธง แอร์เบ ไลป์ซิก เด็ดดวง</span></td><td class="MuiTableCell-root MuiTableCell-body text-center " width="45"><span class="text-warning">80%</span></td></tr><tr class="MuiTableRow-root"><td class="MuiTableCell-root MuiTableCell-body first-td text-center text-success" width="25" valign="middle">ขนะ</td><td class="MuiTableCell-root MuiTableCell-body match-link"><div class="teamname  text-warning">Borussia Mönchengladbach</div><div class="teamname  ">แฟร้งค์เฟิร์ต</div><div class="league-name"><div style="display:inline-block;max-width:100%;overflow:hidden;position:relative;box-sizing:border-box;margin:0"><div style="box-sizing:border-box;display:block;max-width:100%"><img style="max-width:100%;display:block;margin:0;border:none;padding:0" alt="" aria-hidden="true" role="presentation" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTUiIGhlaWdodD0iMTAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></div><img src="/_next/image?url=https%3A%2F%2Flivescorethai.net%2Fassets%2Fimages%2Fflags%2Fde.svg&amp;w=32&amp;q=75" decoding="async" style="visibility: inherit; position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;" srcset="/_next/image?url=https%3A%2F%2Flivescorethai.net%2Fassets%2Fimages%2Fflags%2Fde.svg&amp;w=16&amp;q=75 1x, /_next/image?url=https%3A%2F%2Flivescorethai.net%2Fassets%2Fimages%2Fflags%2Fde.svg&amp;w=32&amp;q=75 2x"></div><strong>บุนเดิสลีกา<!-- --> </strong></div></td>
    // <td class="MuiTableCell-root MuiTableCell-body text-center " width="45" data-score=" - "><strong class="score">2<!-- --> </strong><br><strong class="score">3<!-- --> </strong></td>
    // <td class="MuiTableCell-root MuiTableCell-body text-center " width="45"><strong class="text-info">0.5<!-- --> </strong></td>
    // <td class="MuiTableCell-root MuiTableCell-body text-left"><span class="text"> <!-- -->ทีเด็ด ฟันธง แฟร้งค์เฟิร์ต เอาอยู่</span></td>
    // <td class="MuiTableCell-root MuiTableCell-body text-center " width="45"><span class="text-warning">80%</span></td>
    // </tr>
    // </tbody>
    // </table>';
    // return '<img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTUiIGhlaWdodD0iMTAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+">';
    $t = explode('<table class="MuiTable-root table table-default" id="livescore-table">', $db);
    $t2 = explode('</table>', $t[2]);
    $table = $t2[0];

    $all = explode('<td class="MuiTableCell-root MuiTableCell-body">', $t2[0]);
    $res = '<ul>';
    dd($all);
    for ($i = 1; $i < ceil(count($all) - 1); $i++) {
        if ((2 % $i) == 0) {
            
            $l = explode('<a href="https://livescorethai.net/post/', $all[$i]);

            $l2 = explode('"', $l[1]);
            $link = $l2[0];

            $ti = explode('วิเคราะห์บอล', $l[1]);
            $ti2 = explode('</a></td>', $ti[1]);
            $title = $ti2[0];
            $res .= '<li><a href="' . url('gans') . '/?req=' . $link . '">วิเคราะห์บอล ' . $title . '</a></li>';

        }


    }
    $res = '</ul>';
    return $res;

    return '<table class="table table-default" id="livescore-table">' . $table . '</table>';

    // $t = explode('<table class="MuiTable-root table table-default" id="livescore-table">',$db);
    // $t2 = explode('</table>',$t[1]);
    // $table = $t2[0];
    // return '<table class="table table-default" id="livescore-table">'
    // .$table.
    // '</table>';
}
