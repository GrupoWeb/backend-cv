<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('salary') }}
            {{ Form::text('salary', $salario->salary, ['class' => 'form-control' . ($errors->has('salary') ? ' is-invalid' : ''), 'placeholder' => 'Salary']) }}
            {!! $errors->first('salary', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('bonus') }}
            {{ Form::text('bonus', $salario->bonus, ['class' => 'form-control' . ($errors->has('bonus') ? ' is-invalid' : ''), 'placeholder' => 'Bonus']) }}
            {!! $errors->first('bonus', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('agreed_bonus') }}
            {{ Form::text('agreed_bonus', $salario->agreed_bonus, ['class' => 'form-control' . ($errors->has('agreed_bonus') ? ' is-invalid' : ''), 'placeholder' => 'Agreed Bonus']) }}
            {!! $errors->first('agreed_bonus', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('user_id') }}
            {{ Form::text('user_id', $salario->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>