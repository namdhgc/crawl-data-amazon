<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ' :attribute phải được chấp nhận.',
    'active_url'           => ' :attribute không phải là đường dẫn hợp lệ.',
    'after'                => ' :attribute phải là ngày sau ngày :date.',
    'after_or_equal'       => ' :attribute phải là ngày sau hoặc bằng với ngày :date.',
    'alpha'                => ' :attribute chỉ chứa chữ.',
    'alpha_dash'           => ' :attribute chỉ chứ chữ, số và dấu gạch ngang.',
    'alpha_num'            => ' :attribute chỉ chứa chữ và số.',
    'array'                => ' :attribute phải là một mảng.',
    'before'               => ' :attribute phải là ngày trước ngày :date.',
    'before_or_equal'      => ' :attribute phải là ngày trước hoặc bằng với ngày :date.',
    'between'              => [
        'numeric' => ' :attribute phải nằm giữa :min và :max.',
        'file'    => ' :attribute phải nằm giữa :min và :max kilobytes.',
        'string'  => ' :attribute phải nằm giữa :min và :max kí tự.',
        'array'   => ' :attribute phải nằm giữa :min và :max items.',
    ],
    'boolean'              => ' :attribute phải là true hoặc false.',
    'confirmed'            => ' :attribute xác nhận không trùng khớp.',
    'date'                 => ' :attribute không phải là ngày đúng.',
    'date_format'          => ' :attribute không khớp với đinh dạng :format.',
    'different'            => ' :attribute và :other phải khác nhau.',
    'digits'               => ' :attribute phải là :digits chữ số.',
    'digits_between'       => ' :attribute phải nằm giữa :min và :max chữ số.',
    'dimensions'           => ' :attribute có kích thước ảnh không hợp lệ.',
    'distinct'             => ' :attribute có giá trị bị trùng lặp.',
    'email'                => ' :attribute phải đúng định dạng email.',
    'exists'               => ' :attribute đã chọn không hợp lệ.',
    'file'                 => ' :attribute phải là tập tin.',
    'filled'               => ' :attribute phải có giá trị.',
    'image'                => ' :attribute phải là ảnh.',
    'in'                   => ' :attribute đã chọn không hợp lệ.',
    'in_array'             => ' :attribute không tồn tại trong :other.',
    'integer'              => ' :attribute phải là kiểu số nguyên.',
    'ip'                   => ' :attribute phải là địa chỉ IP hợp lệ.',
    'json'                 => ' :attribute phải là hcuỗi JSON hợp lệ.',
    'max'                  => [
        'numeric' => ' :attribute không được lớn hơn :max.',
        'file'    => ' :attribute không được lớn hơn :max kilobytes.',
        'string'  => ' :attribute không được lớn hơn :max kí tự.',
        'array'   => ' :attribute không được lớn hơn :max items.',
    ],
    'mimes'                => ' :attribute phải là file thuộc loại type: :values.',
    'mimetypes'            => ' :attribute phải là file thuộc loại type: :values.',
    'min'                  => [
        'numeric' => ' :attribute phải có ít nhất :min.',
        'file'    => ' :attribute phải có ít nhất :min kilobytes.',
        'string'  => ' :attribute phải có ít nhất :min kí tự.',
        'array'   => ' :attribute phải có ít nhất :min items.',
    ],
    'not_in'               => ' :attribute đã chọn không hợp lệ.',
    'numeric'              => ' :attribute phải là kiểu số.',
    'present'              => ' :attribute field must be present.',
    'regex'                => ' :attribute định dạng không hợp lệ.',
    'required'             => ' :attribute là bắt buộc.',
    'required_if'          => ' :attribute là bắt buộc khi :other là :value.',
    'required_unless'      => ' :attribute là bắt buộc trừ khi :other nằm trong :values.',
    'required_with'        => ' :attribute là bắt buộc khi :values có mặt.',
    'required_with_all'    => ' :attribute là bắt buộc khi :values có mặt.',
    'required_without'     => ' :attribute là bắt buộc khi :values không có mặt.',
    'required_without_all' => ' :attribute là bắt buộc khi none of :values có mặt.',
    'same'                 => ' :attribute và :other phải trùng khớp nhau.',
    'size'                 => [
        'numeric' => ' :attribute phải là :size.',
        'file'    => ' :attribute phải là :size kilobytes.',
        'string'  => ' :attribute phải là :size characters.',
        'array'   => ' :attribute phải chứa :size items.',
    ],
    'string'               => ' :attribute phải là một chuỗi.',
    'timezone'             => ' :attribute phải là vùng hợp lệ.',
    'unique'               => ' :attribute đã được lấy.',
    'uploaded'             => ' :attribute tải lên thất bại.',
    'url'                  => ' :attribute định dạng không hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
