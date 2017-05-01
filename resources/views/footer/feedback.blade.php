<h5 class="white-text">意見回饋</h5>

<ul>
  <li>
    @include('footer.components.internal-link', [
      'href' => Html::obfuscate('mailto:ccusa2010@gmail.com'),
      'icon' => 'envelope',
      'title' => '信箱',
    ])
  </li>

  <li>
    @include('footer.components.external-link', [
      'href' => 'https://docs.google.com/forms/d/1j4rGF-bax4LyIlaXgjkKbje3MVHX13HDDp2ITEpphWI/viewform',
      'icon' => 'check-square',
      'title' => '會刊',
    ])
  </li>
</ul>
