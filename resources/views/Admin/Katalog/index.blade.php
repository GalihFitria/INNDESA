@extends('Admin.sidebar')

@section('title', 'Kelola Katalog - INNDESA')

@section('content')
<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Kelola Katalog::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg">
    <div class="flex justify-between mb-4">
        <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
            <i class="fas fa-plus mr-2"></i>Tambah
        </a>
        <input type="text" placeholder="Cari..." class="w-1/3 border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-50">
                <tr>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">Id Katalog</th>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Kelompok</th>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">Katalog</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-gray-300 p-3 text-center text-sm text-gray-900">1</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">P001</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">P02</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">pppppppppp</td>

                </tr>
            </tbody>
        </table>
    </div>
    <div class="mt-4 flex justify-between items-center">
        <button class="bg-gray-400 text-white px-3 py-1 rounded-lg hover:bg-gray-500">Previous</button>
        <span class="text-gray-700">Page 1 of 1</span>
        <button class="bg-gray-400 text-white px-3 py-1 rounded-lg hover:bg-gray-500">Next</button>
    </div>
</div>
@endsection