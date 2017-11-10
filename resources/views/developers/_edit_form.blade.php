<form class="form-horizontal" method="POST"
      action="{{ route('developers.update', $dev->id) }}">
    {!! csrf_field() !!}
    {!! method_field('PUT') !!}

    <div class="form-group" {{ $errors->has('name') ? 'has-error' : '' }}>
        <label for="name" class="col-sm-3 control-label">Name</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="name"
                   name="name"
                   value="{{ $dev->name }}">
            @if ($errors->has('name'))
                <span class="help-block">{{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group" {{ $errors->has('contact_persona') ? 'has-error' : '' }}>
        <label for="contact_persona" class="col-sm-3 control-label">Contact
            Persona</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="contact_persona"
                   name="contact_persona"
                   value="{{ $dev->contact_persona }}">
            @if ($errors->has('contact_persona'))
                <span class="help-block">{{ $errors->first('contact_persona') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group" {{ $errors->has('site') ? 'has-error' : '' }}>
        <label for="site" class="col-sm-3 control-label">Site URL</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="site"
                   name="site"
                   value="{{ $dev->site }}">
            @if ($errors->has('site'))
                <span class="help-block">{{ $errors->first('site') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group" {{ $errors->has('language_code') ? 'has-error' : '' }}>
        <label for="language_code" class="col-sm-3 control-label">Language</label>
        <div class="col-sm-6">
            <input type="radio"
                   {{ ($dev->language_code == 'ru') ? 'checked' : ''  }} name="language_code"
                   value="ru"> RU
            <input type="radio"
                   {{ ($dev->language_code == 'en') ? 'checked' : ''  }} name="language_code"
                   value="en"> EN
            @if ($errors->has('language_code'))
                <span class="help-block">{{ $errors->first('language_code') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group" {{ $errors->has('email') ? 'has-error' : '' }}>
        <label for="email" class="col-sm-3 control-label">Email</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="email"
                   name="email"
                   value="{{ $dev->email }}">
            @if ($errors->has('email'))
                <span class="help-block">{{ $errors->first('email') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group" {{ $errors->has('contact_url') ? 'has-error' : '' }}>
        <label for="contact_url" class="col-sm-3 control-label">Contact Form URL</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="contact_url"
                   name="contact_url"
                   value="{{ $dev->contact_url }}">
            @if ($errors->has('contact_url'))
                <span class="help-block">{{ $errors->first('contact_url') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-10">
            <button class="btn btn-default" type="submit">Save</button>
            @if($edit)
                <a href="#" class="btn btn-default">Back</a>
            @else
                <button name="next" value="1" class="btn btn-success" type="submit">Save
                    &
                    Next
                </button>
            @endif
            <a href="{{ route('developers.delete', ['id' => $dev->id]) }}"
               class="btn btn-danger btn-sm">d</a>
        </div>
    </div>
</form>