<x-base title="Data tersimpan">
    <div class="grid grid-cols-1 gap-6">
        <div>
            <div class="flex justify-end">
                <a href="{{ route('course.create') }}">
                    <x-button>Tambah Data</x-button>
                </a>
            </div>
        </div>

        <div class="p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none overflow-x-auto">
            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500 dark:text-slate-50">
                <thead>
                    <tr class="[&_th]:px-6 [&_th]:py-3 [&_th]:font-bold [&_th]:text-left [&_th]:uppercase [&_th]:align-middle [&_th]:border-b [&_th]:border-gray-200 [&_th]:shadow-none [&_th]:text-xs [&_th]:tracking-none [&_th]:whitespace-nowrap [&_th]:opacity-70">
                        <th>No</th>
                        <th>Nama Mata Kuliah</th>
                        <th>Jumlah diambil mahasiswa</th>
                        <th>KBK</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>

                <tbody class="[&_td]:p-2 [&_td]:align-middle [&_td]:border-b [&_td]:whitespace-nowrap">
                    @foreach ($courses as $course)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="min-w-[60vh]">{{ $course->name }}</td>
                            <td class="text-right">{{ $course->users_count }}</td>
                            <td>
                                <ol class="list-disc">
                                    @foreach ($course->experts as $expert)
                                        <li class="text-sm">
                                            {{ $expert->name }}
                                        </li>
                                    @endforeach
                                </ol>
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-base>