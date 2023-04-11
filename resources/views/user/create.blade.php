<x-base title="Data tersimpan">

    <form x-data="{courses: ['']}" method="POST" action="{{ route('user.store') }}">
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
        
        <div class="w-[100vh] p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none overflow-x-auto">
            
            <div class="mb-3">
                <label for="name" class="mb-2">Name</label>
                <x-input id="name" name="name" type="text" placeholder="Name" aria-label="Name" aria-describedby="email-addon" />
                <hr class="mt-4">
        
                <div class="flex justify-end mt-4">
                    <x-button type="button" @click="courses.push('')">Add</x-button>
                </div>
                
                <template x-for="(course, i) in courses" :key="i">
                    <div class="grid grid-cols-12 gap-y-6">

                        <div class="col-span-11">
                            <label for="course_id" class="mb-2">Courses</label>
                            <x-select x-bind:name="`courses[${i}]`" x-model="courses[i]" id="course_id">
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </x-select>
                            
                            <br><label for="score_id" class="my-2">Score</label>
                            <x-select x-bind:name="`scores[${i}]`" id="score_id" class="mb-4">
                                @foreach ($scores as $score)
                                    <option value="{{ $score }}">{{ $score }}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="flex items-center justify-end">
                            <i class="mdi mdi-trash-can text-red-500 text-lg cursor-pointer" @click="courses.splice(i, 1)"></i>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <x-button type="submit">Submit</x-button>
        </div>
    </form>
</x-base>