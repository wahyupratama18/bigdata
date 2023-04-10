<x-base title="Home">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
        <x-big-card :route="route('test.index')" title="Uji Coba" description="Uji coba prediksi dari data yang telah tersimpan" />

        <x-big-card :route="route('data.index')" title="Data tersimpan" description="Data yang telah tersimpan pada sistem" />
    </div>
</x-base>