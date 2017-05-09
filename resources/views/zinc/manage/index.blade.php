@extends('layouts.master')

@section('main')
  <div class="right-align">
    @include('components.internal-link', [
      'href' => route('zinc.manage.create'),
      'class' => 'btn waves-effect waves-light light-green',
      'icon' => 'plus',
    ])
  </div>

  <table class="bordered striped highlight centered">
    <thead>
      <tr>
        <th>時間</th>
        <th>主題</th>
        <th>發布</th>
        <th>編輯 / 刪除</th>
      </tr>
    </thead>

    <tbody>
      @forelse ($zincs as $zinc)
        <tr>
          <td>{{ $zinc->getAttribute('year') }} 年 {{ $zinc->getAttribute('month') }} 月份</td>
          <td>
            @include('components.external-link', [
              'href' => route('zinc.show', ['year' => $zinc->getAttribute('year'), 'month' => $zinc->getAttribute('month')]),
              'title' => $zinc->getAttribute('topic'),
            ])
          </td>
          <td>
            <i class="fa {{ $zinc->getAttribute('published') ? 'fa-check green-text' : 'fa-times red-text' }}"></i>
          </td>
          <td>
            @include('components.internal-link', [
              'href' => route('zinc.manage.edit', [$zinc->getAttribute('id')]),
              'class' => 'btn waves-effect waves-light orange',
              'icon' => 'pencil',
            ])

            @include('components.delete-button', [
              'url' => route('zinc.manage.destroy', ['manage' => $zinc->getAttribute('id')]),
            ])
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="4">無資料</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  {!! $zincs->render() !!}
@endsection
