@extends('layouts.master')

@section('main')
  <div class="right-align">
    @include('components.internal-link', [
      'href' => route('zinc.create'),
      'class' => 'btn waves-effect waves-light light-green',
      'icon' => 'plus',
    ])
  </div>

  <table class="bordered highlight centered">
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
              'href' => route('zinc.show', $zinc->getAttribute('identify')),
              'title' => $zinc->getAttribute('topic'),
            ])
          </td>
          <td>
            @include('components.published-icon', ['published' => ! is_null($zinc->getAttribute('published_at'))])
          </td>
          <td>
            @include('components.internal-link', [
              'href' => route('zinc.edit', ['zinc' => $zinc->getAttribute('id')]),
              'class' => 'btn waves-effect waves-light orange',
              'icon' => 'pencil',
            ])

            @include('components.delete-button', [
              'url' => route('zinc.destroy', ['zinc' => $zinc->getAttribute('id')]),
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
