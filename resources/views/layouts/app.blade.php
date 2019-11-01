<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="https://lh3.googleusercontent.com/a0Zy3qN9A_F3AvM6KydzZaQ6OAvQfRz2AeYr9Mqr5iHrepT3BaJaa7mbTYKbpV4Wh-fKz8_PjsA5LbeEaiCvh_KZgWzV-O00OHAhsLGokI3FVkqH3zjZnPrElyio0DDADzDN95XQbBEKwYth8O_7yxQEr0SjsYWY1FmREjHclrVC1Ar8qZ_cKMInQl4vf_oxgA_X9Fzsvs5kLUMkBVBpRqswRrc9_wQPWM4MCu2MMjylgyn-ZCIhyQ5jcVMr4MHmpvn4iMrTNNsBugwtxEciebGA0UqAYgj9pJ_1JOM8WrM50_kWRqK94PBRGBrJV3LEoyBTeDZAAiu8zGMowNW6VVzYZkyNe0REpNoYnv2EbUlF8fH7dRflgX1-nl6CZeSTX8IZitHhpsIgVv1AFAiJUxhkc4wKzPV2Na0CN3PkBSet8vTJ9W07c8DnaB-LoxblBSxLbCgiumNBjUNYJTeljNG1klRuelY30XjsTQBPL_pXPdVaJRe63EauTgaRSoT5kKiIcCVOJPTDi_IzS_aEETa4E8ICGkbqAgRoW6EZeXX80GV4q5m584SWSqWICtMa2GjpMnpNcAtX_CcmaUduqQBPUXriFGOooyVZ3S5UXNrPbn7WVsVSeMXxTKrjUFfTyAIOP5pHoskjvfCwJtv1OKwryO-2Xp3_38RLEK0_xdHC0fG00elTFQ=w1134-h262-no" style="width: 320px; height: 70px; margin-left: 40px">
                </a>
                <!-- <form class="form-inline" style="width:45%; margin-left:70px">
                    <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm câu hỏi" aria-label="Search" style="width:80%">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
                </form> -->
                <tim-kiem></tim-kiem>
                <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button> -->
                <tai-khoan></tai-khoan>
                <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <ul class="navbar-nav ml-auto">
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><button type="button" class="btn btn-light">Đăng nhập</button></a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}"><button type="button" class="btn btn-primary">Đăng ký</button></a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Đăng xuất') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div> -->
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<footer>
    <img src="https://lh3.googleusercontent.com/LIcKXcSTGeCpFl9olxz_BM4RYSNI448BfZQUxr-5CnABkAGraFIW7TfYX8FJuW-oipMXmPtaVLBegdWSSK6-2vjTB-xIS4OgPlGPwOH20Ue2v_4o2YMWABYp3Nf4uE0ohV9J75VDsf6WOPxMiuMqS8EPAL9-PdokiGE2xPpBFVOC4VcYtJobEvV9mOxnySkIXFQ3sUa2EiT1cf8DhfuSeg4nPuHtXJyappmubH6XZObIjk_4WMJT4f3rm_ULGZr8Pl-9IBeKv__KWsX-C80aICNLsTYnS-AuA5t9jqipnlUXoEkGaW8ah1D2cUGmw8RfnRz9JmKkKDoZ6g47Z2MeNmwgstfJT2gWi8ezynYn6JNAI4ikVvDrjMihDnmR89MxaqwQPYG01toS-hGrZboVHnPnN-iEDQZDJ9iE7P0f-QrYgJELg7i2VAZQlaIAuvkozslj4bj0_bpJ_wF_1MOmMOD16RN_jv8vzrjPu5loYy4C4WLdW1EwNs9qETvRKxJpgwonpJGclbYsndLUMQAUr4bhgWT_w3rl7uGtvNpBnKbQrAq0QV0Osr9aZg7Sv9Vkv3yjeQKRdTIyuE1utI91BvE28xbF32DR9RXRC8SUfzPgV61sPFJtwxRncTwPvWjtyG_Yj5hfXreJ08HbTVlqNPySyYqZ6l1ZlrmzJQ6xJI7PCkzVcoYeww=w1366-h167-no" style="width: 100%">
</footer>

</html>