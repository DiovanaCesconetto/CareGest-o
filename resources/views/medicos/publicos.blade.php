<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médicos Cadastrados</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0fdf4; /* Cor de fundo verde-clara */
        }
    </style>
</head>
<body class="bg-gray-100">
    <x-app-layout>
        <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

            <h1 class="text-3xl sm:text-4xl font-extrabold mb-8 text-center text-emerald-800">
                Médicos Cadastrados
            </h1>

            <!-- Seção de pesquisa -->
            <form method="GET" action="{{ route('consulta_publica') }}" class="mb-8 flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Buscar por nome..."
                    class="flex-grow max-w-lg w-full rounded-l-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all duration-300 shadow-sm"
                >
                <select
                    name="specialty"
                    class="flex-grow max-w-lg w-full sm:w-auto border rounded-r-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all duration-300 shadow-sm"
                >
                    <option value="">Todas as Especialidades</option>
                    <option value="Clínico Geral" @if(request('specialty') == 'Clínico Geral') selected @endif>Clínico Geral</option>
                    <option value="Dermatologia" @if(request('specialty') == 'Dermatologia') selected @endif>Dermatologia</option>
                    <option value="Ortopedia" @if(request('specialty') == 'Ortopedia') selected @endif>Ortopedia</option>
                    <option value="Cardiologia" @if(request('specialty') == 'Cardiologia') selected @endif>Cardiologia</option>
                    <option value="Neurologia" @if(request('specialty') == 'Neurologia') selected @endif>Neurologia</option>
                    <option value="Geriatria" @if(request('specialty') == 'Geriatria') selected @endif>Geriatria</option>
                    <!-- Adicione mais especialidades conforme necessário -->
                </select>
                <button type="submit" class="bg-emerald-600 text-white px-5 py-2 rounded-lg hover:bg-emerald-700 transition-all duration-300 shadow-sm">
                    🔍
                </button>
            </form>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($medicos as $medico)
                    @php
                        // Nova paleta de cores para as especialidades em tons de verde e azul
                        $colors = [
                            'Cardiologia' => 'bg-emerald-100 text-emerald-800',
                            'Geriatria' => 'bg-lime-100 text-lime-800',
                            'Dermatologia' => 'bg-teal-100 text-teal-800',
                            'Ortopedia' => 'bg-cyan-100 text-cyan-800',
                            'Neurologia' => 'bg-sky-100 text-sky-800',
                            'Clínico Geral' => 'bg-green-100 text-green-800',
                        ];
                        $specialtyColor = $colors[$medico->especialidade] ?? 'bg-gray-100 text-gray-800';
                    @endphp

                    <div class="bg-white p-6 rounded-2xl shadow-lg relative flex flex-col items-center border-t-4 border-emerald-500 transform transition-transform duration-300 hover:scale-105">

                        <!-- Lógica para exibir a foto do médico -->
                        @if($medico->foto)
                            <img src="{{ asset('storage/' . $medico->foto) }}"
                                 alt="{{ $medico->nome }}"
                                 class="w-28 h-28 rounded-full mb-4 object-cover mx-auto ring-4 ring-emerald-300 shadow-md">
                        @else
                            <div class="w-28 h-28 rounded-full bg-gray-200 mb-4 mx-auto flex items-center justify-center text-gray-400 ring-4 ring-emerald-300 shadow-md">
                                <i class="fas fa-user text-4xl"></i>
                            </div>
                        @endif

                        <h2 class="text-xl font-bold mb-1 text-center text-emerald-900">{{ $medico->nome }}</h2>

                        <span class="inline-block mb-2 px-3 py-1 rounded-full {{ $specialtyColor }} text-center">
                            {{ $medico->especialidade ?? 'Não informado' }}
                        </span>

                        <p class="text-center text-gray-600"><span class="font-medium text-gray-800">CRM:</span> {{ $medico->crm ?? 'Não informado' }}</p>
                        <p class="text-center text-gray-600"><span class="font-medium text-gray-800">Email:</span> {{ $medico->email ?? 'Não informado' }}</p>

                        <!-- Lógica para exibir o ícone do WhatsApp -->
                        @if($medico->whatsapp)
                            <div class="flex justify-center mt-4">
                                <a href="https://wa.me/{{ preg_replace('/\D/', '', $medico->whatsapp) }}" target="_blank">
                                    <img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp" class="w-10 h-10 rounded-full hover:opacity-80 transition">
                                </a>
                            </div>
                        @endif

                    </div>
                @endforeach
            </div>
        </div>
    </x-app-layout>
</body>
</html>
