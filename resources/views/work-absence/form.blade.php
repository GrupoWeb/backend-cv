<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('lack') }}
            {{ Form::text('lack', $workAbsence->lack, ['class' => 'form-control' . ($errors->has('lack') ? ' is-invalid' : ''), 'placeholder' => 'Lack']) }}
            {!! $errors->first('lack', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('sanction') }}
            {{ Form::text('sanction', $workAbsence->sanction, ['class' => 'form-control' . ($errors->has('sanction') ? ' is-invalid' : ''), 'placeholder' => 'Sanction']) }}
            {!! $errors->first('sanction', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $workAbsence->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('due_date') }}
            {{ Form::text('due_date', $workAbsence->due_date, ['class' => 'form-control' . ($errors->has('due_date') ? ' is-invalid' : ''), 'placeholder' => 'Due Date']) }}
            {!! $errors->first('due_date', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('user_id') }}
            {{ Form::text('user_id', $workAbsence->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>