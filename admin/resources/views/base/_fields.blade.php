@foreach($model->formFields() as $field)

    @if(is_string($field))
        @input([
            'label' => field_label($field),
            'name' => $field,
            'value' => field_value($model, $field)
        ])
    @elseif($field['type'] == 'password')
        @input([
            'type' => 'password',
            'label' => field_label($field),
            'name' => $field['name'],
            'value' => field_value($model, $field)
        ])
    @elseif($field['type'] == 'textarea')
        @textarea([
            'label' => field_label($field),
            'name' => $field['name'],
            'value' => field_value($model, $field)
        ])
    @elseif($field['type'] == 'editor')
        <div class="row">
            <div class="col-md-10">
                @textarea([
                    'label' => field_label($field),
                    'name' => $field['name'],
                    'class' => 'editor',
                    'value' => field_value($model, $field)
                ])
            </div>
            <div class="col-md-2" style="padding-top: 28px;">
                @image_for_drug()
            </div>
        </div>
    @elseif($field['type'] == 'builder')
        <div class="row">
            <div class="col-md-12">
                <label>{{ field_label($field) }}</label>
                <div id="builder">
                    <textarea allowed="{{ isset($field['allowed']) ? json_encode($field['allowed']) : '' }}" name="{{ $field['name'] }}">
                        {{ field_value($model, $field) ?? '[]' }}
                    </textarea>
                </div>
            </div>
        </div>
    @elseif($field['type'] == 'properties')
        <div class="row">
            <div class="col-md-12">
                <label>{{ field_label($field) }}</label>
                <div id="properties">
                    <textarea options="{{ $field['options'] }}" name="{{ $field['name'] }}">
                        {{ field_value($model, $field) ?? '[]' }}
                    </textarea>
                </div>
            </div>
        </div>
    @elseif($field['type'] == 'redirects')
        <div class="row">
            <div class="col-md-12">
                <label>{{ field_label($field) }}</label>
                <div id="redirects">
                    <textarea name="{{ $field['name'] }}">
                        {{ old($field['name']) ? json_encode(old($field['name'])) : $model->redirects()->pluck('from') ?? '[]' }}
                    </textarea>
                </div>
                @if ($errors->has($field['name']))
                    <span class="help-block">
                        <strong>{{ $errors->first($field['name']) }}</strong>
                    </span>
                @endif
            </div>
        </div>
    @elseif($field['type'] == 'requisites')
        <div class="row">
            <div class="col-md-12">
                <label>{{ field_label($field) }}</label>
                <div id="requisites">
                    <textarea name="{{ $field['name'] }}">
                        {{ field_value($model, $field) ?? '[]' }}
                    </textarea>
                </div>
                @if ($errors->has($field['name']))
                    <span class="help-block">
                        <strong>{{ $errors->first($field['name']) }}</strong>
                    </span>
                @endif
            </div>
        </div>
    @elseif($field['type'] == 'gallery')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="{{ $field['name'] }}" class="">{{ field_label($field) }}</label>
                    <div class="gallery">
                        <textarea name="{{ $field['name'] }}">
                            {{ field_value($model, $field) ?? '[]' }}
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
    @elseif($field['type'] == 'select')
        @select([
            'class'    => 'select2',
            'label'    => field_label($field),
            'name'     => multi_name($field['name']),
            'options'  => $field['options'],
            'multiple' => isset($field['multi']) && $field['multi'] === true,
            'value'    => field_value($model, $field),
            'data_placeholder' => isset($field['data_placeholder']) ? $field['data_placeholder'] : ''
        ])
    @elseif($field['type'] == 'checkbox')
        @checkbox([
            'label' => field_label($field),
            'name'  => $field['name'],
            'value' => field_value($model, $field)
        ])
    @elseif($field['type'] == 'image' && !empty($field['multi']))
        <div class="multi">
            @include('admin::ui.form.label', ['label' => field_label($field)])

            @php($miltiImages = $model->{multi_name($field)})
            @if($miltiImages)
                @foreach($miltiImages as $k => $item)
                    <div class="item">
                        @image([
                            'label' => false,
                            'name'  => str_replace('[]', "[{$k}]", $field['name']),
                            'value' => $model->{multi_name($field)}[$k]
                        ])
                    </div>
                @endforeach
            @else
                <div class="item">
                    @image([
                        'label' => false,
                        'name'  => str_replace('[]', "[0]", $field['name'])
                    ])
                </div>
            @endif
        </div>
    @elseif($field['type'] == 'image' && empty($field['multi']))
        @image([
            'label' => field_label($field),
            'name'  => $field['name'],
            'value' => field_value($model, $field)
        ])
    @elseif(isset($field['type']))
        @input([
            'type' => $field['type'],
            'label' => field_label($field),
            'name' => $field['name'],
            'custom' => isset($field['custom']) ? $field['custom'] :  [],
            'step' => isset($field['step']) ? $field['step'] :  '',
            'min' => isset($field['min']) ? $field['min'] :  '',
            'required' => isset($field['required']) ? $field['required'] :  '',
            'disabled' => isset($field['disabled']) ? $field['disabled'] :  '',
            'value' => field_value($model, $field)
        ])
    @else
        @input([
            'label' => field_label($field),
            'name' => $field['name'],
            'value' => field_value($model, $field)
        ])
    @endif

@endforeach
