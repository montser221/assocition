<?php
$data = \App\Models\Settings::find(1);
return [

    'welcome'=>'مرحبا بك',
    'zakat'=>'حاسبة الزكاة',
    'dulni'=>'  دلني على يتيم',
    'phone'=>'الجوال',
    'location'=>'العنوان',
    'copyright'=>'جميع الحقوق محفوظة لدى '. $data->foundationName  .'   تصميم لاي اوت    ',
    

];
