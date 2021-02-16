<form class="flex px-6"
      method="POST"
      action="{{ route('books.search') }}">
    @csrf

    <div class="flex">
        <input id="search_input" type="text"
               class="form-input border border-gray-500"
               name="search"
               value="{{ old('search') }}"
               placeholder="Search by book title and Author">
    </div>

    <div class="flex justify-center items-center pl-6">
        <button type="submit"
                class="select-none font-bold whitespace-no-wrap p-2 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700">
            {{ __('Search') }}
        </button>
    </div>
</form>
