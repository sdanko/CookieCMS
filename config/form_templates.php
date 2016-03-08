<?php
$config = [
    'Templates'=>[
        'default' => [
            'formGroup' => '<div class="form-group">{{label}}{{input}}</div>',
            'input' => '<input type="{{type}}" {{attrs}} class="form-control"  name="{{name}}">',
            'inputContainer' => '{{content}}',
            'button' => '<button type="submit" {{attrs}} class="btn btn-default">{{text}}</button>',
            'textarea' => '<textarea {{attrs}} class="form-control"  name="{{name}}">{{value}}</textarea>',
            'select' => '<select name="{{name}}" {{attrs}} class="form-control" >{{content}}</select>',
            'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
            'checkboxFormGroup' => '<div class="checkbox">{{label}}</div>'],
        'login' => [
            'formGroup' => '{{label}}{{input}}',
            'input' => '<input type="{{type}}" {{attrs}} class="form-control"  name="{{name}}" required>',
            'inputContainer' => '{{content}}',
            'button' => '<button type="submit" {{attrs}} class="btn btn-lg btn-primary btn-block">{{text}}</button>']
    ]
];

