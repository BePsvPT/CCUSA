@extends('layouts.master')

@section('main')
  @if (Auth::check() && Auth::user()->hasRole('documents'))
    <div class="right-align">
      @include('components.internal-link', [
        'href' => route('documents.create'),
        'class' => 'btn waves-effect waves-light light-green',
        'icon' => 'plus',
      ])
    </div>
  @endif

  @foreach($documents as $name => $group)
    <ul class="collection with-header">
      <li class="collection-header"><h5>{{ $name }}</h5></li>

      @foreach($group as $document)
        @php($attachment = $document->getRelation('attachments')->first())

        <li class="collection-item document-item">
          <a
            href="{{ route('documents.show', ['hashid' => $document->getHashId()]) }}"
            target="_blank"
          >{{ $attachment->getAttribute('name') }}</a>

          <div class="secondary-content">
            <span>{{ human_filesize($attachment->getAttribute('size')) }}</span>

            @if (Auth::check() && Auth::user()->hasRole(['documents']))
              @include('components.internal-link', [
                'href' => route('documents.edit', ['hashid' => $document->getHashId()]),
                'class' => 'btn waves-effect waves-light orange',
                'icon' => 'pencil',
              ])

              <a
                class="btn waves-effect waves-light red"
                data-delete="li"
                data-url="{{ route('documents.destroy', ['hashid' => $document->getHashId()]) }}"
              ><i class="fa fa-trash"></i></a>
            @endif
          </div>
        </li>
      @endforeach
    </ul>
  @endforeach
@endsection
