<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{asset('css/reset.css')}}"> <!--assetルートディレクトリをpublicからにする-->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--jqueryとのリンク-->

</head>
<body>
    <header>
        <div class="container">
            <div class="logo-area">
                <a href="/top"><img src="{{asset('images/main_logo.png')}}"></a>
            </div>
            <div class="login-user-area" id="menu">
                <div class="login-user-info">
                    <div class="user-name-area">
                        <span class="user-name">{{ $username }}さん</span>
                    </div>
                    <div class="arrow-01" id="userMenuArrow"><div class="arrow close"></div></div>
                    <div class="user-icon"><img src="{{asset('images/'.$userimage)}}"></div>
                </div>
            </div>
        </div>
    </header>
    <div class="wrapper" id="mainContent">
        <div class="container">
            <nav class="user-menu">
                <ul>
                    <li><a href="/top">ホーム</a></li>
                    <li><a href="/profile">プロフィール編集</a></li>
                    <li><a href="/logout">ログアウト</a></li>
                </ul>
            </nav>
            <div class="content-area">
                @yield('content')
            </div>
            <div id="sideBar">
                <div class="container">
                    <div class="label"><span class="user-name">
                        <p>{{ $username }}</p>さんの</div>
                    </div>
                    <div class="inner-container">
                        <div class="row">
                            <div class="label">フォロー数</div>
                            <div class="value-display">{{ $countFollow }}名</div>
                        </div>
                        <a class="btn" href="/followList">フォローリスト</a>
                        <div class="row">
                            <div class="label">フォロワー数</div>
                            <div class="value-display">{{ $countFollower }}名</div>
                        </div>
                        <a class="btn" href="/followerList">フォロワーリスト</a>
                    </div>
                    <hr class="lightgray-w1">
                    <div class="inner-container">
                        <a class="btn" href="/search">ユーザー検索</a>
                        <a class="btn" href="/ranking">ランキング</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="/js/script.js"></script>
</body>
</html>
