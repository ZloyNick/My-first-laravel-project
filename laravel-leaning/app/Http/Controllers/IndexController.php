<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Str;

use function view;
use function time;

class IndexController
{


    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (!isset($_COOKIE['uuid']))
            return view('index');

        view('index');
        return view('index2');
    }

    public function generate()
    {

        /*
         * UUID generator
         */
        setcookie('uuid', $uuid = Str::uuid()->toString(), time() + 60 * 60 * 12, '/', '');
        setcookie('uuid-time', (string)($t = time() + 60 * 60), time() + 60 * 60 * 12, '/', '');

        $model = new User();
        $model->time = $t;
        $model->uuid = $uuid;
        $model->save();

        return redirect('/index');
    }

    public function closeSession()
    {
        if(!isset($_COOKIE['uuid']))
            return view('index');

        unset($_COOKIE['uuid'], $_COOKIE['uuid-time']);
        return $this->index();
    }


}
