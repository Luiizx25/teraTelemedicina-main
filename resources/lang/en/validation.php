<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | following language lines contain default error messages used by
    | validator class. Some of these rules have multiple versions such
    | as size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute deve ser aceito.',
    'active_url' => ':attribute não é um URL válido.',
    'after' => ':attribute deve ser uma data após :date.',
    'after_or_equal' => ':attribute deve ser uma data posterior ou igual a :date.',
    'alpha' => ':attribute pode conter apenas letras.',
    'alpha_dash' => ':attribute pode conter apenas letras, números, travessões e sublinhados.',
    'alpha_num' => ':attribute pode conter apenas letras e números.',
    'array' => ':attribute deve ser uma matriz.',
    'before' => ':attribute deve ser uma data antes de :date.',
    'before_or_equal' => ':attribute deve ser uma data anterior ou igual a :date.',
    'between' => [
        'numeric' => ':attribute deve estar entre :min e :max.',
        'file' => ':attribute deve estar entre :min e :max kilobytes.',
        'string' => ':attribute deve estar entre :min e :max caracteres.',
        'array' => ':attribute deve ter entre itens :min e :max.',
    ],
    'boolean' => ':attribute field deve ser true ou false.',
    'confirmed' => ':attribute a confirmação não corresponde.',
    'date' => ':attribute não é uma data válida.',
    'date_equals' => ':attribute deve ser uma data igual a :date.',
    'date_format' => ':attribute não corresponde ao formato :format.',
    'different' => ':attribute e :other devem ser diferentes.',
    'digits' => ':attribute deve ser :digits digits.',
    'digits_between' => ':attribute deve estar entre :min e :max dígitos.',
    'dimensions' => ':attribute tem dimensões de imagem inválidas.',
    'distinct' => ':attribute campo tem um valor duplicado.',
    'email' => ':attribute deve ser um endereço de e-mail válido.',
    'ends_with' => ':attribute deve terminar com um dos seguintes: :values.',
    'exists' => 'selecionado :attribute é inválido.',
    'file' => ':attribute deve ser um arquivo.',
    'filled' => ':attribute field deve ter um valor.',
    'gt' => [
        'numeric' => ':attribute deve ser maior que :value.',
        'file' => ':attribute deve ser maior que :value kilobytes.',
        'string' => ':attribute deve ser maior que :value characters.',
        'array' => ':attribute deve ter mais do que :value items.',
    ],
    'gte' => [
        'numeric' => ':attribute deve ser maior ou igual :value.',
        'file' => ':attribute deve ser maior ou igual :value kilobytes.',
        'string' => ':attribute deve ser maior ou igual :caracteres de valor.',
        'array' => ':attribute deve ter itens :value ou mais.',
    ],
    'image' => ':attribute deve ser uma imagem.',
    'in' => 'selecionado :attribute é inválido.',
    'in_array' => ':attribute campo não existe em :other.',
    'integer' => ':attribute deve ser um inteiro.',
    'ip' => ':attribute deve ser um endereço IP válido.',
    'ipv4' => ':attribute deve ser um endereço IPv4 válido.',
    'ipv6' => ':attribute deve ser um endereço IPv6 válido.',
    'json' => ':attribute deve ser uma string JSON válida.',
    'lt' => [
        'numeric' => ':attribute deve ser menor que :value.',
        'file' => ':attribute deve ser menor que :value kilobytes.',
        'string' => ':attribute deve ser menor que caracteres :value.',
        'array' => ':attribute deve ter menos que :value items.',
    ],
    'lte' => [
        'numeric' => ':attribute deve ser menor ou igual :value.',
        'file' => ':attribute deve ser menor ou igual :value kilobytes.',
        'string' => ':attribute deve ser menor ou igual :caracteres de valor.',
        'array' => ':attribute não deve ter mais do que :value items.',
    ],
    'max' => [
        'numeric' => ':attribute não pode ser maior que :max.',
        'file' => ':attribute não pode ser maior que :max kilobytes.',
        'string' => ':attribute não pode ser maior que :max caracteres.',
        'array' => ':attribute não pode ter mais do que :max items.',
    ],
    'mimes' => ':attribute deve ser um arquivo do tipo: :values.',
    'mimetypes' => ':attribute deve ser um arquivo do tipo: :values.',
    'min' => [
        'numeric' => ':attribute deve ser pelo menos :min.',
        'file' => ':attribute deve ter pelo menos :min kilobytes.',
        'string' => ':attribute deve ter pelo menos :min caracteres.',
        'array' => ':attribute deve ter pelo menos itens :min.',
    ],
    'not_in' => 'selecionado :attribute é inválido.',
    'not_regex' => ':attribute format is invalid.',
    'numeric' => ':attribute deve ser um número.',
    'password' => 'A senha está incorreta.',
    'present' => ':attribute field must be present.',
    'regex' => ':attribute format is invalid.',
    'required' => ':attribute Campo obrigatório.',
    'required_if' => ':attribute campo é obrigatório quando :other for :value.',
    'required_unless' => 'o campo :attribute é obrigatório, a menos que :other esteja em :values.',
    'required_with' => ':attribute campo é obrigatório quando :values ​​está presente.',
    'required_with_all' => 'o campo :attribute é obrigatório quando os valores :estão presentes.',
    'required_without' => ':attribute campo é obrigatório quando :values ​​não está presente.',
    'required_without_all' => 'campo :attribute é obrigatório quando nenhum dos valores :estão presentes.',
    'same' => ':attribute e :other devem corresponder.',
    'size' => [
        'numeric' => ':attribute deve ser :size.',
        'file' => ':attribute deve ser :size kilobytes.',
        'string' => ':attribute deve ser :size characters.',
        'array' => ':attribute deve conter itens :size.',
    ],
    'starts_with' => ':attribute deve começar com um dos seguintes: :values.',
    'string' => ':attribute deve ser uma string.',
    'timezone' => ':attribute deve ser uma zona válida.',
    'unique' => ':attribute já foi usado.',
    'uploaded' => ':attribute falhou ao carregar.',
    'url' => ':attribute formato inválido.',
    'uuid' => ':attribute deve ser um UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name lines. This makes it quick to
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
    | following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */
    
    'attributes' => [
        'password ' => 'Senha',
        'true' => 'Sim',
        'false' => 'Não',
        'cus_doc_type' => 'Tipo',
        'cus_doc_num' => 'Número',
        'cus_name' => 'Nome',
        'cus_name_company' => 'Razão Social',
        'cus_phone' => 'Telefone',
        'cus_email' => 'Email',
        'cus_street'=>'Endereço',
        'cus_street_num' => 'Número',
        'cus_street_complement' => 'Complemento',
        'cus_neighborhood' => 'Bairro',
        'cus_city' => 'Cidade',
        'cus_state' => 'UF',
        'cus_postalcode' => 'CEP',
        'cus_manager_name' => 'Nome',
        'cus_manager_phone' => 'Telefone',
        'cus_manager_email' => 'Email',
        'cus_financial_name' => 'Nome',
        'cus_financial_phone' => 'Telefone',
        'cus_financial_email' => 'Email',
        'cus_logo_use' => 'Usar Logo',
        'cus_logo' => 'Logo',
        'bank_agency_num' => 'Agência',
        'bank_agency_dv' => 'DV',
        'bank_account_type_id' => 'Tipo',
        'bank_account_operation' => 'Operação',
        'bank_account_num' => 'Número',
        'bank_account_dv' => 'DV',
        

    ],

];
