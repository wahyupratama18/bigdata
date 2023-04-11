<x-base title="Home">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
        <x-big-card :route="route('test.index')" title="Uji Coba" description="Uji coba prediksi dari data yang telah tersimpan" />

        <x-big-card :route="route('user.index')" title="Data tersimpan" description="Data mahasiswa tersimpan" />

        <x-big-card :route="route('course.index')" title="Mata Kuliah" description="Daftar Mata Kuliah yang telah tersimpan pada sistem" />
        
        <x-big-card :route="route('expert.index')" title="KBK" description="Daftar Kompetensi Bidang Keahlian yang tersimpan" />
    </div>
</x-base>