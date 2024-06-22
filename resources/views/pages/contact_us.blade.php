@if (session('success'))
    <p class="text-base text-center text-white font-semibold px-6 py-3 bg-green-500">
        {{ session('success') }}</p>
@endif
@if ($errors->any())
    <div class="text-base text-center text-white font-semibold px-6 py-3 bg-red-500">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<x-guest-layout>
    <form action="{{ route('contact.store.message') }}" method="POST">
        @csrf
        @method('post')
        <div class="mb-4">
            <label for="nom_message" class="block text-gray-700 font-bold mb-2">Nom :</label>
            <input type="text" id="nom_message" name="nom_message"
                class="form-input w-full border-gray-300 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                placeholder="QUENUM Everest" required>
            <x-input-error :messages="$errors->get('nom_message')" class="mt-2" />
        </div>
        <div class="mb-4">
            <label for="email_message" class="block text-gray-700 font-bold mb-2">Email :</label>
            <input type="email" id="email_message" name="email_message"
                class="form-input w-full border-gray-300 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                placeholder="exemple@gmail.com" required>
            <x-input-error :messages="$errors->get('email_message')" class="mt-2" />
        </div>
        <div class="mb-4">
            <label for="contenu_message" class="block text-gray-700 font-bold mb-2">Message :</label>
            <textarea id="contenu_message" name="contenu_message" rows="4"
                class="form-textarea w-full border-gray-300 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                placeholder="Votre message..." required></textarea>
            <x-input-error :messages="$errors->get('contenu_message')" class="mt-2" />
        </div>
        <div class="text-right">
            <button type="submit"
                class="bg-indigo-500 text-white font-bold py-2 px-4 rounded hover:bg-gray-500">Envoyer</button>
        </div>
    </form>
</x-guest-layout>
