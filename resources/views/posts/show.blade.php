@extends('layouts.app')

@section('content')
    <style>
        .post-container {
            background: white;
            padding: 25px 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 15px;
            border-bottom: 3px solid #3498db;
            padding-bottom: 10px;
        }

        p {
            color: #555;
            font-size: 1.05em;
            line-height: 1.6;
        }

        .actions {
            margin-top: 20px;
        }

        .actions a,
        .actions button {
            display: inline-block;
            margin-right: 10px;
            padding: 8px 14px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
        }

        .edit-btn {
            background-color: #2ecc71;
            color: white;
        }

        .edit-btn:hover {
            background-color: #27ae60;
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        .back-link {
            display: inline-block;
            margin-top: 25px;
            color: #34495e;
            text-decoration: none;
            font-weight: 600;
        }

        .back-link:hover {
            color: #3498db;
        }
    </style>

    <div class="post-container">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->body }}</p>

        <div class="actions">
            <a href="/posts/{{ $post->id }}/edit" class="edit-btn">Edit</a>

            <form action="/posts/{{ $post->id }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>

        <a href="/posts" class="back-link">← Back to Posts</a>
    </div>
@endsection
