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

    'accepted' => ':attribute sahəsi qəbul edilməlidir.',
    'accepted_if' => ':other :value olduqda :attribute sahəsi qəbul edilməlidir.',
    'active_url' => ':attribute sahəsi etibarlı bir URL olmalıdır.',
    'after' => ':attribute sahəsi :date tarixindən sonra olmalıdır.',
    'after_or_equal' => ':attribute sahəsi :date tarixi ilə eyni və ya daha sonra olmalıdır.',
    'alpha' => ':attribute sahəsi yalnız hərflərdən ibarət olmalıdır.',
    'alpha_dash' => ':attribute sahəsi yalnız hərflər, rəqəmlər, tire və alt xətlərlə olmalıdır.',
    'alpha_num' => ':attribute sahəsi yalnız hərflər və rəqəmlərdən ibarət olmalıdır.',
    'array' => ':attribute sahəsi bir massiv olmalıdır.',
    'ascii' => ':attribute sahəsi yalnız tək-bayt alfanümerik simvollar və işarələrdən ibarət olmalıdır.',
    'before' => ':attribute sahəsi :date tarixindən əvvəl olmalıdır.',
    'before_or_equal' => ':attribute sahəsi :date tarixi ilə eyni və ya əvvəl olmalıdır.',
    'between' => [
        'array' => ':attribute sahəsində :min ilə :max arasında elementlər olmalıdır.',
        'file' => ':attribute sahəsi :min ilə :max kilobayt arasında olmalıdır.',
        'numeric' => ':attribute sahəsi :min ilə :max arasında olmalıdır.',
        'string' => ':attribute sahəsi :min ilə :max simvollar arasında olmalıdır.',
    ],
    'boolean' => ':attribute sahəsi doğru və ya yanlış olmalıdır.',
    'can' => ':attribute sahəsi icazəsiz bir dəyər ehtiva edir.',
    'confirmed' => ':attribute təsdiqi uyğun gəlmir.',
    'current_password' => 'Şifrə yalnışdır.',
    'date' => ':attribute sahəsi etibarlı bir tarix olmalıdır.',
    'date_equals' => ':attribute sahəsi :date ilə eyni olmalıdır.',
    'date_format' => ':attribute sahəsi :format formatına uyğun olmalıdır.',
    'decimal' => ':attribute sahəsi :decimal onluq yerlərinə malik olmalıdır.',
    'declined' => ':attribute sahəsi rədd edilməlidir.',
    'declined_if' => ':other :value olduqda :attribute sahəsi rədd edilməlidir.',
    'different' => ':attribute və :other fərqli olmalıdır.',
    'digits' => ':attribute sahəsi :digits rəqəm olmalıdır.',
    'digits_between' => ':attribute sahəsi :min ilə :max rəqəmlər arasında olmalıdır.',
    'dimensions' => ':attribute sahəsinin səhv şəkil ölçüləri var.',
    'distinct' => ':attribute sahəsində təkrarlanan bir dəyər var.',
    'doesnt_end_with' => ':attribute sahəsi aşağıdakılardan biri ilə bitməməlidir: :values.',
    'doesnt_start_with' => ':attribute sahəsi aşağıdakılardan biri ilə başlamamalıdır: :values.',
    'email' => ':attribute sahəsi etibarlı bir email ünvanı olmalıdır.',
    'ends_with' => ':attribute sahəsi aşağıdakılardan biri ilə bitməlidir: :values.',
    'enum' => 'Seçilmiş :attribute etibarsızdır.',
    'exists' => 'Seçilmiş :attribute etibarsızdır.',
    'extensions' => ':attribute sahəsi aşağıdakı uzantılardan birinə malik olmalıdır: :values.',
    'file' => ':attribute sahəsi bir fayl olmalıdır.',
    'filled' => ':attribute sahəsinin bir dəyəri olmalıdır.',
    'gt' => [
        'array' => ':attribute sahəsində :value elementdən çox olmalıdır.',
        'file' => ':attribute sahəsi :value kilobaytdan çox olmalıdır.',
        'numeric' => ':attribute sahəsi :value-dən böyük olmalıdır.',
        'string' => ':attribute sahəsi :value simvoldan çox olmalıdır.',
    ],
    'gte' => [
        'array' => ':attribute sahəsi :value və ya daha çox elementlər olmalıdır.',
        'file' => ':attribute sahəsi :value kilobaytdan çox və ya bərabər olmalıdır.',
        'numeric' => ':attribute sahəsi :value-dən böyük və ya bərabər olmalıdır.',
        'string' => ':attribute sahəsi :value simvoldan çox və ya bərabər olmalıdır.',
    ],
    'hex_color' => ':attribute sahəsi etibarlı heksadecimal rəng olmalıdır.',
    'image' => ':attribute sahəsi bir şəkil olmalıdır.',
    'in' => 'Seçilmiş :attribute etibarsızdır.',
    'in_array' => ':attribute sahəsi :other sahəsində mövcud olmalıdır.',
    'integer' => ':attribute sahəsi bir tam ədəd olmalıdır.',
    'ip' => ':attribute sahəsi etibarlı bir IP ünvanı olmalıdır.',
    'ipv4' => ':attribute sahəsi etibarlı bir IPv4 ünvanı olmalıdır.',
    'ipv6' => ':attribute sahəsi etibarlı bir IPv6 ünvanı olmalıdır.',
    'json' => ':attribute sahəsi etibarlı bir JSON sətri olmalıdır.',
    'lowercase' => ':attribute sahəsi kiçik hərflə olmalıdır.',
    'lt' => [
        'array' => ':attribute sahəsində :value elementdən az olmalıdır.',
        'file' => ':attribute sahəsi :value kilobaytdan az olmalıdır.',
        'numeric' => ':attribute sahəsi :value-dən az olmalıdır.',
        'string' => ':attribute sahəsi :value simvoldan az olmalıdır.',
    ],
    'lte' => [
        'array' => ':attribute sahəsində :value elementdən çox olmamalıdır.',
        'file' => ':attribute sahəsi :value kilobaytdan az və ya bərabər olmalıdır.',
        'numeric' => ':attribute sahəsi :value-dən az və ya bərabər olmalıdır.',
        'string' => ':attribute sahəsi :value simvoldan az və ya bərabər olmalıdır.',
    ],
    'mac_address' => ':attribute sahəsi etibarlı bir MAC ünvanı olmalıdır.',
    'max' => [
        'array' => ':attribute sahəsində :max elementdən çox olmamalıdır.',
        'file' => ':attribute sahəsi :max kilobaytdan çox olmamalıdır.',
        'numeric' => ':attribute sahəsi :max-dan çox olmamalıdır.',
        'string' => ':attribute sahəsi :max simvoldan çox olmamalıdır.',
    ],
    'max_digits' => ':attribute sahəsi :max rəqəmdən çox olmamalıdır.',
    'mimes' => ':attribute sahəsi aşağıdakı növdə fayl olmalıdır: :values.',
    'mimetypes' => ':attribute sahəsi aşağıdakı növdə fayl olmalıdır: :values.',
    'min' => [
        'array' => ':attribute sahəsində ən azı :min element olmalıdır.',
        'file' => ':attribute sahəsi ən azı :min kilobayt olmalıdır.',
        'numeric' => ':attribute sahəsi ən azı :min olmalıdır.',
        'string' => ':attribute sahəsi ən azı :min simvoldan ibarət olmalıdır.',
    ],
    'min_digits' => ':attribute sahəsi ən azı :min rəqəm olmalıdır.',
    'missing' => ':attribute sahəsi yox olmalıdır.',
    'missing_if' => ':other :value olduqda :attribute sahəsi yox olmalıdır.',
    'missing_unless' => ':other :value olmadıqda :attribute sahəsi yox olmalıdır.',
    'missing_with' => ':values mövcud olduqda :attribute sahəsi yox olmalıdır.',
    'missing_with_all' => ':values mövcud olduqda :attribute sahəsi yox olmalıdır.',
    'multiple_of' => ':attribute sahəsi :value-nun çoxluğu olmalıdır.',
    'not_in' => 'Seçilmiş :attribute etibarsızdır.',
    'not_regex' => ':attribute sahəsinin formatı etibarsızdır.',
    'numeric' => ':attribute sahəsi rəqəm olmalıdır.',
    'password' => [
        'letters' => ':attribute sahəsi ən azı bir hərf ehtiva etməlidir.',
        'mixed' => ':attribute sahəsi ən azı bir böyük və bir kiçik hərf ehtiva etməlidir.',
        'numbers' => ':attribute sahəsi ən azı bir rəqəm ehtiva etməlidir.',
        'symbols' => ':attribute sahəsi ən azı bir simvol ehtiva etməlidir.',
        'uncompromised' => 'Verilən :attribute bir məlumat sızmasında görünmüşdür. Zəhmət olmasa fərqli bir :attribute seçin.',
    ],
    'present' => ':attribute sahəsi mövcud olmalıdır.',
    'present_if' => ':other :value olduqda :attribute sahəsi mövcud olmalıdır.',
    'present_unless' => ':other :value olmadıqda :attribute sahəsi mövcud olmalıdır.',
    'present_with' => ':values mövcud olduqda :attribute sahəsi mövcud olmalıdır.',
    'present_with_all' => ':values mövcud olduqda :attribute sahəsi mövcud olmalıdır.',
    'prohibited' => ':attribute sahəsi qadağandır.',
    'prohibited_if' => ':other :value olduqda :attribute sahəsi qadağandır.',
    'prohibited_unless' => ':other :values içində olmadıqda :attribute sahəsi qadağandır.',
    'prohibits' => ':attribute sahəsi :other sahəsinin mövcud olmasını qadağan edir.',
    'regex' => ':attribute sahəsinin formatı etibarsızdır.',
    'required' => ':attribute sahəsi zəruridir.',
    'required_if' => ':other :value olduqda :attribute sahəsi zəruridir.',
    'required_unless' => ':other :values içində olmadıqda :attribute sahəsi zəruridir.',
    'required_with' => ':values mövcud olduqda :attribute sahəsi zəruridir.',
    'required_with_all' => ':values mövcud olduqda :attribute sahəsi zəruridir.',
    'required_without' => ':values mövcud olmadıqda :attribute sahəsi zəruridir.',
    'required_without_all' => ':values mövcud olmadıqda :attribute sahəsi zəruridir.',
    'same' => ':attribute sahəsi və :other uyğun olmalıdır.',
    'size' => [
        'array' => ':attribute sahəsi :size element ehtiva etməlidir.',
        'file' => ':attribute sahəsi :size kilobayt olmalıdır.',
        'numeric' => ':attribute sahəsi :size olmalıdır.',
        'string' => ':attribute sahəsi :size simvol olmalıdır.',
    ],
    'starts_with' => ':attribute sahəsi aşağıdakılardan biri ilə başlamalıdır: :values.',
    'string' => ':attribute sahəsi sətir olmalıdır.',
    'url' => ':attribute sahəsi etibarlı bir URL olmalıdır.',
    'uuid' => ':attribute sahəsi etibarlı bir UUID olmalıdır.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
