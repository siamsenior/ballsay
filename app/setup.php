<?php
function theme() {
    return 'ballsay';
}

function url_shot() {
    $u = explode('//',url(''));
    return $u[1];
}

function template() {
    return 'guduball';
    // return 'doball24hd';
}

function api_img($img) {
    return 'https://api-tded.com/uploads/images/'.$img;
}

function api_url() {
    return 'https://api-tded.com';
}

function logo() {
    return 'guduball.png';
    // return 'doball24hd-logo.png';
}
function cat_news() {
    return '1';
}
function cat_ans() {
    return '2';
}
function zft_wid () {
    return '1';
}
function line_token() {
    // mm88online
    return 'E85WI8wJ3xDUBlxLR0xGl9zOeep3TseAQMmyKA4kJw0';
}