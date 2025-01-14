<x-adminlayout>
<main>
  
          <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10 bg-gray-50">
            <div
              class="relative border border-gray-300 bg-white rounded-md shadow-sm shadow-gray-200 px-5 py-3"
            >
          
              <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 rounded-md overflow-hidden border"
              >
                <div class="overflow-x-auto w-full">
                  <table class="w-full text-sm text-left">
                    <thead class="text-white bg-primary">
                      <tr>
                        <th scope="col" class="px-6 py-3 min-w-[100px]">
                          <span class="capitalize p-1.5">Order ID</span>
                        </th>

                        <th scope="col" class="px-6 py-3 min-w-[100px]">
                          <span class="capitalize p-1.5"> Screenshot </span>
                        </th>
                        <th scope="col" class="px-6 py-3 min-w-[100px]">
                          <span class="capitalize p-1.5"> User </span>
                        </th>
                        <th scope="col" class="px-6 py-3 min-w-[100px]">
                          <span class="capitalize p-1.5"> Total </span>
                        </th>

                        <th scope="col" class="px-6 py-3 min-w-[100px]">
                          <span class="capitalize p-1.5"> Notes </span>
                        </th>

                        <th scope="col" class="px-6 py-3 min-w-[100px]">
                          <span class="capitalize p-1.5"> Address </span>
                        </th>
                        <th scope="col" class="px-6 py-3 min-w-[100px]">
                          <span class="capitalize p-1.5"> Actions </span>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($orders as $order)
                      <tr class="border-b">
                        <td class="px-6 py-4">
                          <span class="text-darkGray p-1.5 font-semibold block">
                             {{$order->id}}
                          </span>
                        </td>
                        <td class="px-6 py-4">
                          <span class="text-darkGray p-1.5 font-semibold block">
                            <img
                           src="{{$order->screensshot}}"
                              alt="Product Image"
                              class="w-16 h-16 object-cover"
                            />
                          </span>
                        </td>
                        <td class="px-6 py-4 min-w-[150px]">
                          <span class="text-darkGray p-1.5 font-semibold block">
                            {{$order->user->name}}
                          </span>
                        </td>
                        <td class="px-6 py-4 min-w-[150px]">
                          <span class="text-darkGray p-1.5 font-semibold block">
                          {{$order->total}}
                          </span>
                        </td>
                        <td class="px-6 py-4 min-w-[150px]">
                          <span class="text-darkGray p-1.5 font-semibold block">
                          {{$order->notes}}
                          </span>
                        </td>
                    
                        <td class="px-6 py-4">
                          <span
                            class="text-darkGray min-w-[200px] p-1.5 font-semibold w-full line-clamp-2 block"
                          >
                          {{$order->address}}
                          </span>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{route('orders.destroy' , $order->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button
                              type="submit"
                              href=""
                              class="text-sm px-4 flex items-center gap-3 shadow-md py-3 text-white bg-red-500 hover:bg-blue-900 font-semibold rounded-md transition-all active:animate-press"
                            >
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  fill="currentColor"
                                  d="M5 21V6H4V4h5V3h6v1h5v2h-1v15zm2-2h10V6H7zm2-2h2V8H9zm4 0h2V8h-2zM7 6v13z"
                                />
                              </svg>
                              Delete
                            </button>
                            </form>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </main>
</x-adminlayout>