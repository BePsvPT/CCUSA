<div class="container">
    <div class="row">
        <div class="col s12 m12 l6">
            <h5 class="white-text">For you, for us</h5>
            <p class="grey-text text-lighten-4">國 立 中 正 大 學 學 生 會 © 2016</p>
        </div>
        <div class="col s6 l3">
            <h5 class="white-text">意見回饋</h5>
            <ul>
                <li>
                    <a class="grey-text text-lighten-3" href="https://goo.gl/forms/PVPmjX8mwF" target="_blank">
                        <span><i class="fa fa-check-square fa-fw fa-lg"></i> 網站</span>
                    </a>
                </li>
                <li>
                    <a class="grey-text text-lighten-3" href="https://docs.google.com/forms/d/1j4rGF-bax4LyIlaXgjkKbje3MVHX13HDDp2ITEpphWI/viewform" target="_blank">
                        <span><i class="fa fa-check-square fa-fw fa-lg"></i> 會刊</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col s6 l3">
            <h5 class="white-text">相關連結</h5>
            <ul>
                <li>
                    <a class="grey-text text-lighten-3" href="https://www.facebook.com/NCCUSAbest" target="_blank">
                        <span><i class="fa fa-facebook-official fa-fw fa-lg"></i> 粉絲專頁</span>
                    </a>
                </li>
                <li>
                    <a class="grey-text text-lighten-3" href="mailto:ccusa2010@gmail.com">
                        <span><i class="fa fa-envelope fa-fw fa-lg"></i> 信箱</span>
                    </a>
                </li>
                <li>
                    <a class="grey-text text-lighten-3" href="https://github.com/BePsvPT/CCUSA" target="_blank">
                        <span><i class="fa fa-github-square fa-fw fa-lg"></i> 原始碼</span>
                    </a>
                </li>
                <li>
                    <a class="grey-text text-lighten-3" href="{{ route(Auth::guest() ? 'auth.sign-in' : 'auth.sign-out') }}">
                        <span><i class="fa fa-user fa-fw fa-lg"></i> {{ Auth::guest() ? '管理員登入' : '登出' }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
