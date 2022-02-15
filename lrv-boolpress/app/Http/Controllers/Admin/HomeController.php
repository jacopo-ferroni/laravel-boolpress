<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Mail\SendWelcomeEmail;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    // Admin Homepage
    public function index() {

        /* CARBON */

        /* DATA ATTUALE */
        // $now = new Carbon();
        $now = Carbon::now();
        dump($now);
        dump($now -> toDateTimeString());
        dump($now -> toDateString());

        /* DATA DI IERI */
        $yesterday = Carbon::yesterday();
        dump($yesterday);
        dump($yesterday -> toDateTimeString());
        dump($yesterday -> format('d'));
        dump($yesterday -> format('m'));
        dump($yesterday -> format('y'));
        dump($yesterday -> format('d m y'));
        dump($yesterday -> format('l d m y'));

        /* DATA DI DOMANI */
        $tomorrow = Carbon::tomorrow();
        dump($tomorrow -> format('d m y'));

        /* CREA DATA CARBON */
        $expire = Carbon::create('2038/01/19');
        dump($expire);

        /* COMPARAZIONE */
        $first = Carbon::create('2021/01/10');
        $second = Carbon::create('2020/01/10');
        dump($first ->gt($second));
        dump($first ->lt($second));

        /* DIFFERENZE IN GIORNI */
        $date = Carbon::create('2022/02/06');
        // giorni in relazione ad oggi
        dump($date->diffInDays()); //se dentro la parentesi non metto nulla ci va in automatico la data attuale
        // giorni in relazione a data variabile
        dump($date->diffInDays('2022/02/15'));

        /* TRADUZIONI */
        $dt = Carbon::now();
        dump($dt -> isoFormat('dddd DD/MM/YYYY')); // isoFormat() è importante perchè ti permette di avere la traduzione
        dump($dt -> locale());

        Mail::to('account@mail.it')->send(new SendWelcomeEmail());

        return view('admin.home', compact('expire'));
    }
}
