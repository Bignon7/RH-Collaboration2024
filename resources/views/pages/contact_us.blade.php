<x-guest-layout>
    <form action="#" method="GET" class="max-w-screen-lg">
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Nom :</label>
            <input type="text" id="name" name="name"
                class="form-input w-full border-gray-300 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                placeholder="Entrez votre nom" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Email :</label>
            <input type="email" id="email" name="email"
                class="form-input w-full border-gray-300 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                placeholder="Entrez votre email" required>
        </div>
        <div class="mb-4">
            <label for="message" class="block text-gray-700 font-bold mb-2">Message :</label>
            <textarea id="message" name="message" rows="4"
                class="form-textarea w-full border-gray-300 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                placeholder="Votre message" required></textarea>
        </div>
        <div class="text-right">
            <button type="submit"
                class="bg-indigo-500 text-white font-bold py-2 px-4 rounded hover:bg-gray-500">Envoyer</button>
        </div>
    </form>
</x-guest-layout>
