<h5 class="white-text">相關連結</h5>

<ul>
  <li>
    @include('footer.components.external-link', [
      'href' => 'https://www.facebook.com/NCCUSAbest',
      'icon' => 'facebook-official',
      'title' => '粉絲專頁',
    ])
  </li>

  <li>
    @include('footer.components.external-link', [
      'href' => 'https://github.com/BePsvPT/CCUSA',
      'icon' => 'github-square',
      'title' => '原始碼',
    ])
  </li>

  <li>
    @include('footer.components.internal-link', [
      'href' => route(Auth::guest() ? 'auth.sign-in' : 'auth.sign-out'),
      'icon' => 'user',
      'title' => Auth::guest() ? '管理員登入' : '登出',
    ])
  </li>
</ul>
