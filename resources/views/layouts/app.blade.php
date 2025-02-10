<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=delete" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>

        pre {
            /* Cor de fundo */
            background-color: #181D28;
            /* Espaçamento interno */
            padding: 15px;
            /* Borda */
            border-radius: 5px;
            /* Barra de rolagem horizontal se necessário */
            overflow: auto;
            /* Fonte monoespaçada */
            font-family: 'Courier New', monospace;
            /* Espaçamento entre linhas */
            line-height: 1.5;
            /* Margem externa */
            margin: 20px 0;
        }

        code {
            color: #ffffff;
            /* Cor do texto do código */
            font-size: 14px;
            /* Tamanho da fonte */
            overflow: auto;
        }

        ::-webkit-scrollbar{
            width: 7px;
            background-color: #ccc
        }

        ::-webkit-scrollbar-thumb{
            background-color: #29E06F;
            border-radius: 24px;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased h-screen">

    <!-- Page Content -->
    <main class="h-screen">
        {{ $slot }}
    </main>

    </div>

    @stack('modals')

    @livewireScripts

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/typeit@8.7.1/dist/index.umd.js"></script>

</body>

</html>
