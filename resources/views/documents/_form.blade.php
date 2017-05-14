@include('layouts.form-errors')

<div class="input-field">
  <i class="material-icons prefix">attach_file</i>
  {!! Form::text('name', isset($document) ? $document->getRelation('attachments')->first()->getAttribute('name') : null, ['class' => 'validate', 'required', 'maxlength' => 32]) !!}
  {!! Form::label('name', '檔案名稱') !!}
</div>

<div class="input-field">
  <i class="material-icons prefix">group_work</i>
  {!! Form::text('group', null, ['list' => 'groupName', 'class' => 'validate', 'required', 'maxlength' => 32]) !!}
  {!! Form::label('group', '檔案群組') !!}

  <datalist id="groupName">
    @foreach($groups as $item)
      <option value="{{ $item }}">{{ $item }}</option>
    @endforeach
  </datalist>
</div>

<div>
  <p>
    {!! Form::checkbox('published', true, null, ['id' => 'published']) !!}
    {!! Form::label('published', '發布') !!}
  </p>
</div>

@if (Route::currentRouteNamed('documents.create'))
  <div class="file-field input-field">
    <div class="btn">
      <span>File</span>
      {!! Form::file('attachment', ['accept' => 'application/pdf']) !!}
    </div>

    <div class="file-path-wrapper">
      <input class="file-path validate" type="text" placeholder="僅支援 PDF 檔">
    </div>
  </div>
@endif

@include('components.submit-button', compact('submitButton'))
