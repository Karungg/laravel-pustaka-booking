<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice {{ now()->format('d/m/Y') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="text-[0.8rem] p-24">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Invoice</h1>
                <p class="mt-2 text-gray-600">Date : {{ now() }}
                </p>
            </div>
        </div>
        <div class="-mx-4 mt-8 flow-root sm:mx-0">
            <table class="min-w-full">
                <colgroup>
                    <col class="w-full sm:w-1/2">
                    <col class="sm:w-1/6">
                    <col class="sm:w-1/6">
                    <col class="sm:w-1/6">
                </colgroup>
                <thead class="border-b border-gray-300 text-gray-900">
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left font-semibold text-gray-900 sm:pl-0">
                            Book
                        </th>
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-right font-semibold text-gray-900 sm:table-cell">
                        </th>
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-right font-semibold text-gray-900 sm:table-cell">
                            Booking Date
                        </th>
                        <th scope="col" class="py-3.5 pl-3 pr-4 text-right font-semibold text-gray-900 sm:pr-0">Take
                            Limit
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr class="border-b border-gray-200">
                            <td class="max-w-0 py-5 pl-4 pr-3 sm:pl-0">
                                <div class="font-medium text-gray-900">{{ $item->author }}</div>
                                <div class="mt-1 text-gray-500">{{ $item->title }}</div>
                            </td>
                            <td class="hidden px-3 py-5 text-right font-mono text-gray-500 sm:table-cell">
                            </td>
                            <td class="hidden px-3 py-5 text-right font-mono text-gray-500 sm:table-cell">
                                {{ $item->created_at }}</td>
                            <td class="hidden px-3 py-5 text-right font-mono text-gray-500 sm:table-cell">
                                {{ $item->take_limit }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
