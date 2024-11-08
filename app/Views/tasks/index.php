<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>

    <title>Daftar Tugas</title>

    <style>
        .status-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .loading-icon {
            font-size: 14px;
            /* Atau gunakan ukuran yang sesuai */
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>

</head>

<body>
    <main class="p-4 flex flex-col gap-4">
        <h1 class="text-lg font-semibold">Daftar Tugas</h1>
        <form id="taskForm" class="flex flex-row gap-2">
            <input class="border w-1/2 outline-none p-2 rounded-sm" type="text" name="judul" placeholder="Judul Tugas" required>
            <button type="submit" class="bg-blue-600 rounded-sm p-1 text-white hover:bg-blue-500 transition-all ease duration-200">Tambah</button>
        </form>
        <table id="tasksTable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </main>


    <script src="/js/script.js"></script>

</body>

</html>