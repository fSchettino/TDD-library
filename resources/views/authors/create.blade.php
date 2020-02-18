@extends('layouts.app')

@section('content')
    <div class="w-2/3 bg-gray-200 mx-auto p-6 shadow">
        <form action="/authors" method="post" class="flex flex-col items-center">

            {{--{{ dump($errors->has('name')) }}--}}

            @csrf
            <h1>Add New Author</h1>
            <div class="pt-4">
                <input type="text" name="name" placeholder="Full name" class="px-4 py-2 rounded w-64">

                {{--@if( $errors->has('name') )
                    <p id="nameValidationMsg" class="text-red-600 text-sm pt-2">{{ $errors->first('name') }}</p>
                @endif--}}

                {{--<p id="nameValidationMsg" class="text-red-600 text-sm pt-2">{{ $errors->first('name') }}</p>--}}

                @error('name') <p id="nameValidationMsg" class="text-red-600 text-sm pt-2">{{ $message }}</p> @enderror
            </div>
            <div class="pt-4">
                <input type="text" name="dob" placeholder="Date of birth" class="px-4 py-2 rounded w-64">

                {{--@if( $errors->has('dob') )
                    <p id="dobValidationMsg" class="text-red-600 text-sm pt-2">{{ $errors->first('dob') }}</p>
                @endif--}}

                {{--<p id="dobValidationMsg" class="text-red-600 text-sm pt-2">{{ $errors->first('dob') }}</p>--}}

                @error('dob') <p id="dobValidationMsg" class="text-red-600 text-sm pt-2">{{ $message }}</p> @enderror
            </div>
            <div class="pt-4">
                <button class="bg-blue-400 text-white rounded py-2 px-4" type="submit">Add New Author</button>
            </div>
        </form>
    </div>
@endsection
