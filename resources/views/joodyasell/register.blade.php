<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{url('global_assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('admin_assets/css/jquery.toast.min.css') }}">

    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{url('global_assets/js/main/jquery.min.js')}}"></script>
    <script src="{{url('global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{url('assets/js/app.js')}}"></script>
    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            background-image: url(../nsite_assets/images/joodyasell.png);
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="container">
<div class="flex-center position-ref full-height">
    <div class="content d-flex justify-content-center align-items-center">

        <!-- Registration form -->
        <form action="{{url('joodyasell/register_user')}}" method="post" class="flex-fill">
            {{csrf_field()}}
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <div>
                                    <img src="{{url('images/logo.png')}}" style="width: 100px">
                                </div>                                <h5 class="mb-0">انشاء حساب</h5>
                                <span class="d-block text-muted">جميع الحقول مطلوبة</span>
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-right">
                                <input required type="text" name="email" class="form-control" placeholder="اختر تعريف مستخدم, ايميل أو جوال" dir="rtl">
                                <div class="form-control-feedback">
                                    <i class="icon-user-plus text-muted"></i>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input required type="text" name="first_name" class="form-control" placeholder="الاسم الأول" dir="rtl">
                                        <div class="form-control-feedback">
                                            <i class="icon-user-check text-muted"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input required type="text" name="last_name" class="form-control" placeholder="العائلة" dir="rtl">
                                        <div class="form-control-feedback">
                                            <i class="icon-user-check text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6" dir="rtl">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input required type="password" name="password" class="form-control" placeholder="كلمة المرور" dir="rtl">
                                        <div class="form-control-feedback">
                                            <i class="icon-user-lock text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="text-align: right">
                                        <input type="checkbox" name="contract" required  dir="rtl">
                                        <div >
                                            أوافق على بنود
                                            <a href="#" data-toggle="modal" data-target="#modal_default">اتفاقية الاستخدام </a>
                                        </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success btn-block">التالي <i class="icon-circle-left2 ml-2"></i></button>
                            <a href="{{url('joodyasell')}}" class="btn btn-warning btn-block">عودة <i class="icon-circle-left2 ml-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div id="modal_default" class="modal fade show" tabindex="-1" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Basic modal</h5>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                    <div class="modal-body">
                        <h6 class="font-weight-semibold">Text in a modal</h6>

                        <hr>

                        <h6 class="font-weight-semibold">Another paragraph</h6>
                        <p>
                        ‏1. المقدمة
                        شكرًا لاختيارك Joodya
                        في Joodya، نريد منحك أفضل تجربة ممكنة لنضمن أن تستمتع بخدمتنا اليوم وغدًا ومستقبلاً. وللقيام بذلك، يجب أن نفهم عادات الاستماع لديك لنتمكن من تزويدك بخدمة استثنائية ومخصّصة لك. وبالتالي، نحن نولي خصوصيتك وأمان بياناتك الشخصية أهميةً كبرى، وسيظل هذا هدفنا دائمًا. لذا نريد أن نشرح بشفافية كيف نجمع بياناتك الشخصية ونخزّنها ونشاركها ونستخدمها ولأي سبب نفعل ذلك، إضافةً إلى تلخيص الضوابط والخيارات التي تملكها حيال متى وكيف تختار مشاركة بياناتك الشخصية. هذا هدفنا وستشرح سياسة الخصوصية هذه (يُشار إليها لاحقًا بعبارة "السياسة") تمامًا ما نعنيه بمزيد من التفاصيل أدناه. ‏2. حول هذه السياسة تبيّن هذه السياسة التفاصيل الأساسية المتعلقة بعلاقة بياناتك الشخصية مع Joodya وتنطبق السياسة على كل خدمات Joodya وأي خدمات مرتبطة بها (يُشار إليها بعبارة "خدمة Joodya"). وتُحدّد الشروط التي تحكم استخدامك لخدمة Joodya في شروط الاستخدام وأحكامه الخاصة بنا (يُشار إليها لاحقًا بعبارة "شروط الاستخدام وأحكامه"). من وقت لآخر، قد نطوّر خدمات جديدة أو نقدّم خدمات إضافية. وفي حال أدى إدخال هذه الخدمات الجديدة أو الإضافية إلى أي تغيير في الطريقة التي نجمع أو نعالج فيها بياناتك الشخصية، فسوف نقدّم لك المزيد من المعلومات وشروطًا أو سياسات إضافية. وما لم يُذكر خلاف ذلك حين ندخل هذه الخدمات الجديدة أو الإضافية، ستخضع الأخيرة لهذه السياسة. تهدف هذه السياسة إلى: ضمان فهمك لماهية البيانات الشخصية التي نجمعها عنك وأسباب جمعها واستخدامها والأشخاص الذين نشاركها معهم؛ شرح طريقة استخدامنا للبيانات الشخصية التي تشاركها معنا بهدف منحك تجربه ممتازة حين تستخدم خدمة Joodya؛ و شرح حقوقك وخياراتك المتعلقة بالبيانات الشخصية التي نجمعها ونعالجها عنك والطريقة التي سنحمي فيها خصوصيتك. نأمل أن يساعدك هذا على فهم التزاماتنا في ما يتعلق باحترام خصوصيتك. لمزيد من التوضيح حول الشروط المُستخدمة في هذه السياسة، يُرجى زيارة مركز الخصوصية على الموقع Joodya.com. وللحصول على معلومات حول كيفية الاتصال بنا في حال كان لديك أي أسئلة أو ساورتك أي شكوك، يُرجى مراجعة القسم 14 "كيفية الاتصال بنا" أدناه. وبشكل بديل، إذا لم توافق على محتوى هذه السياسة، فيُرجى حينئذٍ التذكر أنّ الخيار يعود إليك إذا كنت تريد استخدام خدمة Joodya أم لا. ‏3. حقوقك وتفضيلاتك: تمنحك الخيار والتحكم قد تكون على علم بأنّ قانونًا جديدًا للاتحاد الأوروبي يحمل اسم اللائحة العامة لحماية البيانات أو "GDPR" يمنح بعض الحقوق للأفراد في ما يتعلق ببياناتهم الشخصية. وفقًا لذلك، قمنا بتطبيق شفافية وضوابط وصول إضافية في مركز الخصوصية التابع لنا وفي إعدادات الخصوصية لمساعدة المستخدمين على الاستفادة من هذه الحقوق. وكما تتوفر وباستثناء ما هو محصور بموجب القانون المعمول به، إنّ الحقوق المقدّمة للأفراد هي: الحق في الوصول - الحق بإعلامك بالبيانات الشخصية التي نعالجها عنك وطلب الوصول إليها؛ الحق في التصحيح - الحق في طلب أن نعدّل بياناتك الشخصية أو نحدّثها حيث تكون غير دقيقة أو غير كاملة؛ الحق في الحذف - الحق في طلب أن نحذف بياناتك الشخصية؛ الحق في التقييد - الحق في طلب أن نوقف بشكل مؤقت أو دائم معالجة كل بياناتك الشخصية أو بعضها؛ الحق في الاعتراض - الحق في أن تعترض في أي وقت على معالجتنا لبياناتك الشخصية على أسس ترتبط بوضع معيّن تجد نفسك فيه؛ الحق في الاعتراض على معالجة بياناتك الشخصية لأغراض التسويق المباشر؛ الحق في قابلية حمل البيانات - الحق في طلب نسخة من بياناتك الشخصية في صيغة إلكترونية والحق في نقل تلك البيانات الشخصية لاستخدامها في خدمة جهة أخرى؛ و الحق في عدم الخضوع لعملية مؤتمتة لاتخاذ القرارات - الحق في عدم الخضوع لقرار مستند فقط على عملية مؤتمتة لاتخاذ القرارات، بما في ذلك التعريف، حيث يكون للقرار أثر قانوني عليك أو ينتج أثرًا مهمًا مماثلاً. لتمكينك من ممارسة هذه الحقوق بسهولة ولتسجيل تفضيلاتك في ما يتعلق بالطريقة التي يستخدم فيها Joodya بياناتك الشخصية، نوفر لك الوصول إلى الإعدادات التالية عبر صفحة إعدادات الحساب الخاصة بك: إعدادات الخصوصية - تسمح لك بالتحكم ببعض فئات البيانات الشخصية التي نعالجها عنك، وتمكّنك من الوصول إلى بياناتك الشخصية عبر الزر "تنزيل بياناتي"، وتتضمن رابطًا إلى مركز الخصوصية على موقع Joodya.com حيث يمكنك معرفة المزيد من المعلومات عن الطريقة التي يستخدم فيها Joodya بياناتك الشخصية وماهية حقوقك؛ و إعدادات الإشعار - تسمح لك باختيار المراسلات التي تريد استلامها من Joodya وإدارة بياناتك الشخصية المتوفرة علنًا وإعداد تفضيلات المشاركة الخاصة بك. يجعلك مركز الخصوصية تتحكم بالطريقة التي يعالج فيها Joodya بياناتك الشخصية. ويزوّدك بمعلومات عما يحصل إذا عدّلت إعداداتك على صفحة إعدادات الحساب الخاصة بك وطريقة اختيارك لعدم استلام بعض الرسائل من Joodya. فإذا أرسلنا لك رسائل تسويق إلكترونية بناءً على موافقتك أو بخلاف ذلك بحسب ما يسمح به القانون المعمول به، فيمكنك، في أي وقت، على التوالي سحب هذه الموافقة أو إعلان اعتراضك ("اختيار عدم الاشتراك") من دون كلفة. وستتضمن رسائل التسويق الإلكترونية التي تستلمها من Joodya (مثلاً تلك المرسلة عبر البريد الإلكتروني) أيضًا آلية اختيار عدم الاشتراك ضمن الرسالة نفسها (مثلاً رابط لإلغاء الاشتراك في رسائل البريد الإلكتروني التي نرسلها إليك). يمكنك معرفة المزيد عن حقوق اللائحة العامة لحماية البيانات المبينة أعلاه والضوابط التي نقدمها إلى جميع مستخدمي Joodya في ما يتعلق بهذه الحقوق في القسم "حقوقك" المشمولة في مركز الخصوصية. إذا كان لديك أي أسئلة عن خصوصيتك أو حقوقك أو طريقة ممارستها، فيُرجى الاتصال بمسؤول حماية البيانات لدينا باستخدام النموذج "الاتصال بنا" على مركز الخصوصية. وسنجيب على طلبك ضمن فترة زمنية معقولة على أثر التحقق من هويتك. وفي حال لم تكن راضيًا عن الطريقة التي نستخدم فيها بياناتك الشخصية، فيمكنك أيضًا الاتصال ولك حرية تقديم شكوى لدى هيئة حماية البيانات السويدية (Datainspektionen) أو هيئة حماية البيانات المحلية لديك. ‏4. كيف نجمع بياناتك الشخصية؟ نجمع بياناتك الشخصية بالطرق التالية: حين تتسجل في خدمة Joodya‏ - نجمع بعض البيانات الشخصية لتتمكّن من استخدام خدمة Joodya مثل عنوان بريدك الإلكتروني وتاريخ ميلادك وجنسك وبلدك. من خلال استخدام خدمة Joodya‏ - حين تستخدم خدمة Joodya، نجمع البيانات الشخصية عن استخدامك لخدمة Joodya، مثل الطلبات التي قمت باجراءها و الاصناف التي اشتريتها.
                        </p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- /registration form -->

    </div>
</div>
</div>
</body>
</html>
