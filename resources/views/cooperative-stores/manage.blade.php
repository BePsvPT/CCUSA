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
    {{ Form::close() }}

    <div class="col s4 right-align">
      <a
        href="{{ route('cooperative-stores.create') }}"
        class="btn waves-effect waves-light light-green"
      ><i class="fa fa-plus"></i></a>
    </div>
  </div>
  <table class="bordered striped highlight centered">
    <thead>
      <tr>
        <th>店名</th>
        <th>開始日期</th>
        <th>結束日期</th>
        <th>發布</th>
        <th>編輯 / 刪除</th>
      </tr>
    </thead>

    <tbody>
      @foreach ($css as $cs)
        <tr>
          <td>
            {!! Html::linkRoute('cooperative-stores.show', $cs->getAttribute('name'), ['cs' => $cs->getAttribute('link')], ['target' => '_blank']) !!}
          </td>
          <td>{{ $cs->getAttribute('began_at') }}</td>
          <td>{{ $cs->getAttribute('ended_at') }}</td>
          <td>
            <i class="fa {{ $cs->getAttribute('published') ? 'fa-check green-text' : 'fa-times red-text' }}"></i>
          </td>
          <td>
            <a
              href="{{ route('cooperative-stores.edit', ['cs' => $cs->getAttribute('link')]) }}"
              class="btn waves-effect waves-light orange"
            ><i class="fa fa-pencil"></i></a>

            <a
              class="btn waves-effect waves-light red"
              data-delete="tr"
              data-url="{{ route('cooperative-stores.destroy', ['cs' => $cs->getAttribute('link')])  }}"
            ><i class="fa fa-trash"></i></a>
          </td>
        </tr>
      @endforeach

      @if($css->isEmpty())
        <tr>
          <td colspan="3">無資料</td>
        </tr>
      @endif
    </tbody>
  </table>

  @include('layouts.simple-paginate', ['pagination' => $css])
@endsection
