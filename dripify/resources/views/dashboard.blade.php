@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h2 class="text-2xl font-semibold text-gray-800">Dashboard</h2>
            <p class="mt-2 text-gray-600">Welcome back, {{ Auth::user()->name }}!</p>
        </div>
    </div>

    <!-- Organizer Actions -->
    <div class="mt-8">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Organizer Tools</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- View Events Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900">Manage Your Events</h3>
                    <p class="mt-2 text-gray-600">View, edit, or delete your existing events and manage participants.</p>
                    <div class="mt-4">
                        <a href="{{ route('events.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                            View My Events
                        </a>
                    </div>
                </div>
            </div>

            <!-- Create Event Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900">Create a New Event</h3>
                    <p class="mt-2 text-gray-600">Set up a new class, meeting, or gathering and get ready to take attendance.</p>
                    <div class="mt-4">
                        <a href="{{ route('events.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                            Create New Event
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Participant Actions -->
    <div class="mt-8">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Participant Tools</h3>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900">Confirm Your Presence</h3>
                <p class="mt-2 text-gray-600">Open the camera to scan an event's QR code and check in.</p>
                <div class="mt-4">
                    <a href="{{ route('scan') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                        Scan QR Code
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

