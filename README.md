# Реализация
в задании сказано:
 - Можем грузить файлы с разным расширением (другие расширения не входят в задание)
 - Можем решить получать ответ в разных форматах в задании указан (JSON) но может быть например XML и т.д.
 ## Создаем форму загрузки файла
 - поле выбор файла
 - поле select формат ответа
 - resources\views\forms\index.blade.php
 ## Создаем контроллер выводящий форму ( работающий с формой )
 - app\Http\Controllers\UploadsController.php
 ## Создаем router на выдачу формы
 - routes\web.php 
 - Route::get('/', [UploadsController::class,'index'])->name('home');
 - Route::get('/uploadcsv', [UploadsController::class,'uploadcsv'])->name('uploadcsv');
 ## Создаем view формы
 - resources\views\forms\loadsoursefile.blade.php 
 ## Создаем router на прием формы
 - routes\web.php PostFormUploadFile() который в зависимости от расширения проверит наличие и запросит нужный класс в зависимости от расширения файла
 - в зависимости от запрашиваемого ответа будет проверено наличие и задействован класс в нашем случае Json_parse
 ## Создаем абстрактный класс app\AppUploads\AppUpload.php
 - abstract public function GetData( $data, $type_source): array;
 ## Создаем класс app\AppUploads\Uploads\Csv_parser.php расширяющий AppUpload.php
 - в дальнейшем мы сможем добавлять другие обслуживающие классы
 - в нем реализуем и парсинг csv и отдаем ассоциотивный массив
   