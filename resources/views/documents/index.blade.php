@extends('layouts.master')

@section('title')
  文件 |
@endsection

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

  @forelse($documents as $name => $group)
    <ul class="collection with-header">
      <li class="collection-header"><h5>{{ $name }}</h5></li>

      @foreach($group as $document)
        @php($attachment = $document->getRelation('attachments')->first())

        <li class="collection-item document-item">
          @include('components.external-link', [
            'href' => route('documents.show', ['hashid' => $document->getHashId()]),
            'title' => $attachment->getAttribute('name'),
          ])

          <div class="secondary-content">
            <span>{{ human_filesize($attachment->getAttribute('size')) }}</span>

            @if (Auth::check() && Auth::user()->hasRole(['documents']))
              @include('components.internal-link', [
                'href' => route('documents.edit', ['hashid' => $document->getHashId()]),
                'class' => 'btn waves-effect waves-light orange',
                'icon' => 'pencil',
              ])

              @include('components.delete-button', [
                'target' => 'li',
                'url' => route('documents.destroy', ['hashid' => $document->getHashId()]),
              ])
            @endif
          </div>
        </li>
      @endforeach
    </ul>
  @empty
    @include('components.empty-data')
  @endforelse
@endsection
