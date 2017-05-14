@extends('layouts.master')

@section('main')
  <div class="row">
    {!! Form::open(['route' => 'cooperative-stores.manage', 'method' => 'GET', 'class' => 'col s8']) !!}
      <div class="row">
        <div class="input-field col s6">
          {!! Form::text('keyword', Request::query('keyword')) !!}
          {!! Form::label('keyword') !!}
        </div>

        <div class="input-field col s6">
          <button class="btn waves-effect waves-light" type="submit">
            <span>搜尋</span>
            <i class="material-icons right">search</i>
          </button>
        </div>
      </div>
    {!! Form::close() !!}

    <div class="col s4 right-align">
      @include('components.internal-link', [
        'href' => route('cooperative-stores.create'),
        'class' => 'btn waves-effect waves-light light-green',
        'icon' => 'plus',
      ])
    </div>
  </div>

  <table class="bordered striped highlight centered" style="margin-bottom: 2rem;">
    <thead>
      <tr>
        <th>店名</th>
        <th>開始日期</th>
        <th>結束日期</th>
        <th>群組</th>
        <th>發布</th>
        <th>編輯 / 刪除</th>
      </tr>
    </thead>

    <tbody>
      @forelse ($css as $cs)
        <tr>
          <td>
            @include('components.external-link', [
              'href' => route('cooperative-stores.show', ['cs' => $cs->getAttribute('link')]),
              'title' => $cs->getAttribute('name'),
            ])
          </td>
          <td>{{ $cs->getAttribute('began_at') }}</td>
          <td>{{ $cs->getAttribute('ended_at') }}</td>
          <td>{{ $cs->getAttribute('group') }}</td>
          <td>
            @include('components.published-icon', ['published' => ! is_null($cs->getAttribute('published_at'))])
          </td>
          <td>
            @include('components.internal-link', [
              'href' => route('cooperative-stores.edit', ['cs' => $cs->getAttribute('link')]),
              'class' => 'btn waves-effect waves-light orange',
              'icon' => 'pencil',
            ])

            @include('components.delete-button', [
              'url' => route('cooperative-stores.destroy', ['cs' => $cs->getAttribute('link')]),
            ])
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6">無資料</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  {!! $css->render() !!}
@endsection
