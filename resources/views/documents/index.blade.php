@extends('layouts.master')

@section('main')
    @if (Auth::check() && Auth::user()->hasRole(['documents']))
        <div class="right-align">
            <a href="{{ route('documents.create') }}" class="btn waves-effect waves-light light-green">
                <i class="fa fa-plus"></i>
            </a>
        </div>

        <br>
    @endif

    @foreach($documents as $name => $group)
        <ul class="collection with-header">
            <li class="collection-header"><h4>{{ $name }}</h4></li>

            @foreach($group as $document)
                @php($document = $document->getRelation('attachments')->first())

                <li class="collection-item">
                    <div>
                        <a
                            href="{{ route('documents.show', ['documents' => $document->getKey()]) }}"
                            target="_blank"
                        >
                            <span>{{ $document->getAttribute('name') }}</span>
                        </a>

                        <div class="secondary-content">
                            <span>{{ human_filesize($document->getAttribute('size')) }}</span>

                            @if( Auth::check())
                                <a
                                    href="{{ route('documents.edit', ['documents' => $document->getKey()]) }}"
                                    class="btn waves-effect waves-light orange"
                                    style="margin-left: 10px;"
                                ><i class="fa fa-pencil"></i></a>

                                <a
                                    class="btn waves-effect waves-light red"
                                    data-delete="li"
                                    data-url="{{ route('documents.destroy', ['documents' => $document->getKey()]) }}"
                                ><i class="fa fa-trash"></i></a>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endforeach
@endsection
