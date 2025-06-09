@extends('layouts.app')

@section('content')
    <style>
        .form-container {
            background: white;
            padding: 25px 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 20px auto;
        }

        .form-container h1 {
            color: #2c3e50;
            margin-bottom: 20px;
            border-bottom: 3px solid #3498db;
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            color: #34495e;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1em;
            box-sizing: border-box;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #2980b9;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #34495e;
            text-decoration: none;
            font-weight: 600;
        }

        .back-link:hover {
            color: #3498db;
        }
    </style>

    <div class="form-container">
        <h1>Edit Post</h1>

        <form action="/posts/{{ $post->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required>
            </div>

            <div class="form-group">
                <label for="body">Body</label>
                <textarea id="body" name="body" rows="5" required>{{ old('body', $post->body) }}</textarea>
            </div>

            <button type="submit">Update</button>
        </form>

        <a href="/posts" class="back-link">← Back to Posts</a>
    </div>
@endsection
