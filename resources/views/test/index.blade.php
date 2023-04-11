<x-base title="Data tersimpan">
    <div class="grid grid-cols-1 gap-6" x-data="{
        training: collect([]),
        testing: null,
        student: null,
        result: null,
    }">

        <h2 class="text-lg font-semibold">Pilih Data Training</h2>

        <div class="p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none overflow-x-auto">
            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500 dark:text-slate-50">
                <thead>
                    <tr class="[&_th]:px-6 [&_th]:py-3 [&_th]:font-bold [&_th]:text-left [&_th]:uppercase [&_th]:align-middle [&_th]:border-b [&_th]:border-gray-200 [&_th]:shadow-none [&_th]:text-xs [&_th]:tracking-none [&_th]:whitespace-nowrap [&_th]:opacity-70">
                        <th>No</th>
                        <th>Nama</th>
                    </tr>
                </thead>

                <tbody class="[&_td]:p-2 [&_td]:align-middle [&_td]:border-b [&_td]:whitespace-nowrap">
                    @foreach ($users as $user)
                        <tr class="cursor-pointer via-transparent motion-safe:hover:scale-[1.02]"
                        :class="{
                            'scale-[1.02] bg-gradient-to-bl from-cyan-700 to-blue-500 text-slate-200 rounded-xl': training.contains({{ $user->id }}),
                            'scale-100': ! training.contains({{ $user->id }}),
                        }"
                        @click="training.contains({{ $user->id }})
                        ? training = training.reject(id => id == {{ $user->id }})
                        : training.push({{ $user->id }});"
                        >
                            <td>{{ $loop->iteration }}</td>
                            <td class="min-w-[50vh]">{{ $user->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div x-show="training.count() > 4">
            <h2 class="text-lg font-semibold mb-6">Pilih Data Testing</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($users as $user)
                    <div class="scale-100 p-6 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-cyan-500 cursor-pointer"
                    :class="{
                        'bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50': testing != {{ $user->id }},
                        'bg-gradient-to-bl from-cyan-700 to-blue-500 text-slate-200 rounded-xl': testing == {{ $user->id }}
                    }"
                    @click="testing = {{ $user->id }}; student = '{{ $user->name }}'; result = null"
                    >
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $user->name }}</h2>
                    
                            {{-- <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                {{ $description }}
                            </p> --}}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-end mt-6" x-show="testing != null">
                <x-button type="button" @click="
                    console.log('post')
                    axios.post('{{ route('test.store') }}', {
                        training: training,
                        testing: testing,
                    }).then(response => {
                        result = response.data.result;
                    }).catch(error => {
                        iziToast.error({
                            title: 'Error',
                            message: error.response.data.message,
                            position: 'topRight',
                        })
                    })">
                    Submit
                </x-button>
            </div>
        </div>

        <div x-show="result != null">
            <h2 class="text-lg font-semibold mb-6">Hasil pengujian:</h2>

            <h4 class="font-medium">Mahasiswa a.n. <span x-text="student"></span> diprediksi mampu dalam KBK <span x-text="result"></span></h4>
        </div>
    </div>
</x-base>