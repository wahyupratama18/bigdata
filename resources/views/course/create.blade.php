<x-base title="Data tersimpan">

    <form x-data="{names: ['']}" method="POST" action="{{ route('course.store') }}">
        @csrf
        @if ($errors->any())
            <div class="bg-red-500 rounded-lg p-4 text-white mb-4">
                <ol>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ol>
            </div>
        @endif

        <div class="flex justify-end">
            <x-button type="button" @click="names.push('')">Add</x-button>
        </div>

        <div class="w-[100vh] p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none overflow-x-auto">

            <template x-for="(name, i) in names" :key="i">
                <div class="mb-3 grid grid-cols-12">
                    <div class="col-span-11">
                        <label for="name" class="mb-2">Name</label>
                        <x-input id="name" name="name[]" x-model="names[i]" type="text" placeholder="Name" aria-label="Name" aria-describedby="email-addon" />

                        <br><label for="expert_id" class="mb-2">Expert</label>
                        <x-select x-bind:name="`expert_id[${i}][]`" id="expert_id" multiple>
                            @foreach ($experts as $expert)
                                <option value="{{ $expert->id }}">{{ $expert->name }}</option>
                            @endforeach
                        </x-select>
                    </div>

                    <div class="flex items-center justify-end">
                        <i class="mdi mdi-trash-can text-red-500 text-lg cursor-pointer" @click="names.splice(i, 1)"></i>
                    </div>
                </div>
            </template>    
        </div>

        <div class="mt-6 flex justify-end" x-show="names.length > 0">
            <x-button type="submit">Submit</x-button>
        </div>
    </form>
</x-base>