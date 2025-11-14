<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ToDo App</title>

    <!-- BOOTSTRAP 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .todo-card {
            transition: transform .2s;
        }
        .todo-card:hover {
            transform: scale(1.02);
        }
        .done {
            text-decoration: line-through;
            color: gray;
        }
    </style>
</head>

<body>
<div class="container py-5">

    <h2 class="text-center mb-4 fw-bold">✨ ToDo App - Laravel</h2>

    <!-- Form Tambah -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <h5 class="card-title">Tambah ToDo Baru</h5>

            <form class="mt-3" action="{{ route('todo.add') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Judul ToDo</label>
                    <input type="text" name="title" class="form-control" placeholder="Judul..." required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Keterangan tambahan"></textarea>
                </div>

                <button class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>

    <h4 class="mb-3">Daftar ToDo</h4>

    @foreach ($todos as $todo)
        <div class="card mb-3 todo-card shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>
                    <h5 class="{{ $todo->is_done ? 'done' : '' }}">
                        {{ $todo->title }}
                    </h5>

                    @if($todo->description)
                        <p class="text-muted small">{{ $todo->description }}</p>
                    @endif

                    @if($todo->completed_at)
                        <span class="badge bg-success">Selesai: {{ $todo->completed_at }}</span>
                    @endif
                </div>

                <div>
                    <a href="{{ route('todo.toggle', $todo->id) }}" 
                       class="btn btn-sm {{ $todo->is_done ? 'btn-warning' : 'btn-success' }}">
                        {{ $todo->is_done ? 'Batalkan' : 'Selesai' }}
                    </a>

                    <form action="{{ route('todo.delete', $todo->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </div>

            </div>
        </div>
    @endforeach
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
