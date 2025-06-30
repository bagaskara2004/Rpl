@extends('components.layout_admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="p-6">
    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg p-6 text-white mb-6">
        <h1 class="text-2xl font-bold mb-2">Selamat Datang di Dashboard Admin</h1>
        <p class="text-blue-100">Kelola sistem RPL dengan mudah dan efisien</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total User</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalUsers ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Total Transkrip -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Transkrip</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalTranskrip ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Total Assessment -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Assessment</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalAssessment ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Data -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Users -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">User Terbaru</h3>
            <div class="space-y-3">
                @forelse($recentUsers ?? [] as $user)
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                        <span class="text-sm font-medium text-gray-600">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                    </div>
                    <div class="ml-auto">
                        <span class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-sm">Belum ada user terbaru</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Transkrip -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Transkrip Terbaru</h3>
            <div class="space-y-3">
                @forelse($recentTranskrip ?? [] as $transkrip)
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $transkrip->mata_kuliah }}</p>
                        <p class="text-xs text-gray-500">{{ $transkrip->user->name ?? 'Unknown' }} - Grade: {{ $transkrip->nilai_huruf }}</p>
                    </div>
                    <div class="ml-auto">
                        <span class="text-xs text-gray-500">{{ $transkrip->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-sm">Belum ada transkrip terbaru</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection