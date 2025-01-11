<x-layout>
    <div class="container mx-auto px-4 sm:px-8 h-screen">
        <div class="py-8">
            <div class="flex flex-row mb-1 sm:mb-0 justify-between w-full">
                <h2 class="text-2xl leading-tight">
                    Order History
                </h2>
            </div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">   
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Order ID
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Date
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Total
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                   ScreenShot
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($orders as $order)
                           <tr>
                                <td class="px-10 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                       {{$order->id}}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                       {{$order->created_at}}
                                    </p>
                                </td>
                               
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{$order->total}}MMK
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                    <a href="{{$order->screensshot}}" target="_balnk"><img src="{{$order->screensshot}}" width="40" height="40" alt=""</a>
                                    </p>
                                </td>
                            
                            </tr>
                            @endforeach
                            <!-- More rows... -->
                        </tbody>
                    </table>
                  
                </div>
                <div class="mt-5">
                    {{$orders->links()}}    
                    </div>
            </div>
        </div>
    </div>
</x-layout>
