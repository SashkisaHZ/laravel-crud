<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Posts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7f8;
            margin: 20px auto;
            max-width: 700px;
            color: #333;
        }
        h1 {
            color: #2c3e50;
            border-bottom: 3px solid #3498db;
            padding-bottom: 10px;
        }
        a.create-btn {
            display: inline-block;
            margin: 10px 0 20px;
            padding: 10px 15px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        a.create-btn:hover {
            background-color: #2980b9;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            background: white;
            margin-bottom: 12px;
            padding: 15px 20px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgb(0 0 0 / 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        ul li a {
            color: #34495e;
            font-weight: 600;
            text-decoration: none;
            font-size: 1.1em;
        }
        ul li a:hover {
            color: #3498db;
        }
        form {
            margin: 0;
        }
        button {
            background-color: #e74c3c;
            border: none;
            color: white;
            padding: 7px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
        }
        button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
<h1>Posts</h1>
<a href="/posts/create" class="create-btn">Create Post</a>
<ul>
    @foreach ($posts as $post)
        <li>
            <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
            <form method="POST" action="/posts/{{ $post->id }}">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this post?')">Delete</button>
            </form>
        </li>
    @endforeach
</ul>
</body>
</html>
