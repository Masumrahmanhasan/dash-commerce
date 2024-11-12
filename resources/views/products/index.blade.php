<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="p-4">
                            #SR
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Product
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Available
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr class="bg-white border-b">
                            <td class="w-4 p-4">
                                {{ $loop->iteration }}
                            </td>
                            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                                <img class="w-10 h-10 rounded-full" src="{{ $product->image }}"
                                     alt="{{ $product->name }}" loading="lazy">
                                <div class="ps-3">
                                    <div class="text-base font-semibold">{{ $product->name }}</div>
                                </div>
                            </th>
                            <td class="px-6 py-4">
                                <span class="bg-indigo-100 text-indigo-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded border border-indigo-400">{{ $product->category->name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->description }}
                            </td>
                            <td class="px-1 py-2">
                                    <span @class([
                                            'text-xs font-medium me-2 px-2.5 py-0.5 rounded-full border',
                                            'bg-green-100 text-green-800 border-green-600' => $product->availability,
                                            'bg-red-100 text-red-800 border-red-600' => !$product->availability
                                        ])>
                                                {{ $product->availability ? 'Available': 'Not Available'}}
                                            </span>
                            </td>
                            <td class="px-6 py-4">
                                ${{ $product->price }}
                            </td>
                            <td class="flex items-center px-6 py-4">
                                <a href="#"
                                   class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Remove</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
