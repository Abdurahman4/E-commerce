<!DOCTYPE html>
<html lang="ar" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel App</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* تنسيقات مخصصة لرسائل التنبيه */
        .alert {
            padding: 15px 20px;
            margin: 15px 0;
            border: 1px solid transparent;
            border-radius: 5px;
            position: relative;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            animation: fadeIn 0.3s ease-in-out, fadeOut 0.5s ease-in-out 3s forwards;
        }
        
        .alert-success {
            color: #0f5132;
            background-color: #d1e7dd;
            border-color: #badbcc;
        }
        
        .alert-danger {
            color: #842029;
            background-color: #f8d7da;
            border-color: #f5c2c7;
        }
        
        .alert-warning {
            color: #664d03;
            background-color: #fff3cd;
            border-color: #ffecb5;
        }
        
        .alert-info {
            color: #055160;
            background-color: #cff4fc;
            border-color: #b6effb;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeOut {
            from { 
                opacity: 1;
                transform: translateY(0);
                max-height: 100px;
                margin: 15px 0;
                padding: 15px 20px;
            }
            to { 
                opacity: 0;
                transform: translateY(-10px);
                max-height: 0;
                margin: 0;
                padding: 0;
                overflow: hidden;
                border: none;
            }
        }
       
        
        /* تنسيقات عامة للصفحة */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* تنسيقات للعرض على الجوال */
        @media (max-width: 768px) {
            .alert {
                margin: 10px;
                font-size: 14px;
            }
            
            .container {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- رسائل التنبيه في أعلى الصفحة -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="container">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>