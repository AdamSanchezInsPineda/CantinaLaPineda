<x-admin-layout>
    <x-slot:title>Orders</x-slot>
    
    <div class="flex flex-col gap-4">
        <div class="flex items-center gap-4">
            <h1 class="text-lg font-semibold md:text-2xl">Orders</h1>
        </div>
        
        <div x-data="{ activeTab: 'pending' }" class="flex flex-col gap-6 px-4 sm:px-0">
            {{-- Tabs --}}
            <div class="border-b">
                <nav class="flex gap-4 overflow-x-auto pb-2 -mb-2" aria-label="Tabs">
                    <button 
                        @click="activeTab = 'pending'" 
                        :class="{ 'border-primary text-primary': activeTab === 'pending' }"
                        class="px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-muted-foreground hover:text-foreground"
                    >
                        Pending Orders
                    </button>
                    <button 
                        @click="activeTab = 'accepted'" 
                        :class="{ 'border-primary text-primary': activeTab === 'accepted' }"
                        class="px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-muted-foreground hover:text-foreground"
                    >
                        Accepted Orders
                    </button>
                    <button 
                        @click="activeTab = 'canceled'" 
                        :class="{ 'border-primary text-primary': activeTab === 'canceled' }"
                        class="px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-muted-foreground hover:text-foreground"
                    >
                        Canceled Orders
                    </button>
                    <button 
                        @click="activeTab = 'history'" 
                        :class="{ 'border-primary text-primary': activeTab === 'history' }"
                        class="px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-muted-foreground hover:text-foreground"
                    >
                        Order History
                    </button>
                </nav>
            </div>

            {{-- Paneles --}}
            <div>
                <!-- Pending Orders -->
                <div x-show="activeTab === 'pending'" class="rounded-lg border">
                    <div class="relative w-full overflow-auto">
                        <table class="w-full caption-bottom text-sm">
                            <thead class="[&_tr]:border-b">
                                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Order ID</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Customer</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Date</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Total</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Status</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground w-[100px]"></th>
                                </tr>
                            </thead>
                            <tbody class="[&_tr:last-child]:border-0">
                                @foreach($pendingOrders as $order)
                                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                    <td class="p-4 align-middle font-medium">#{{ $order->id }}</td>
                                    <td class="p-4 align-middle">{{ $order->customer_name }}</td>
                                    <td class="p-4 align-middle">{{ $order->created_at->format('M d, Y') }}</td>
                                    <td class="p-4 align-middle">${{ number_format($order->total, 2) }}</td>
                                    <td class="p-4 align-middle">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    </td>
                                    <td class="p-4 align-middle">
                                        <div class="flex gap-2">
                                            <form method="POST">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-green-500 text-white hover:bg-green-600 h-8 w-8">
                                                    <i data-lucide="check" class="h-4 w-4"></i>
                                                </button>
                                            </form>
                                            <form method="POST">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-red-500 text-white hover:bg-red-600 h-8 w-8">
                                                    <i data-lucide="x" class="h-4 w-4"></i>
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

                <!-- Accepted Orders -->
                <div x-show="activeTab === 'accepted'" class="rounded-lg border">
                    <div class="relative w-full overflow-auto">
                        <table class="w-full caption-bottom text-sm">
                            <thead class="[&_tr]:border-b">
                                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Order ID</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Customer</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Date</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Total</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Status</th>
                                </tr>
                            </thead>
                            <tbody class="[&_tr:last-child]:border-0">
                                @foreach($acceptedOrders as $order)
                                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                    <td class="p-4 align-middle font-medium">#{{ $order->id }}</td>
                                    <td class="p-4 align-middle">{{ $order->customer_name }}</td>
                                    <td class="p-4 align-middle">{{ $order->created_at->format('M d, Y') }}</td>
                                    <td class="p-4 align-middle">${{ number_format($order->total, 2) }}</td>
                                    <td class="p-4 align-middle">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-green-100 text-green-800">
                                            Accepted
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Canceled Orders -->
                <div x-show="activeTab === 'canceled'" class="rounded-lg border">
                    <div class="relative w-full overflow-auto">
                        <table class="w-full caption-bottom text-sm">
                            <thead class="[&_tr]:border-b">
                                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Order ID</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Customer</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Date</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Total</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Status</th>
                                </tr>
                            </thead>
                            <tbody class="[&_tr:last-child]:border-0">
                                @foreach($canceledOrders as $order)
                                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                    <td class="p-4 align-middle font-medium">#{{ $order->id }}</td>
                                    <td class="p-4 align-middle">{{ $order->customer_name }}</td>
                                    <td class="p-4 align-middle">{{ $order->created_at->format('M d, Y') }}</td>
                                    <td class="p-4 align-middle">${{ number_format($order->total, 2) }}</td>
                                    <td class="p-4 align-middle">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-red-100 text-red-800">
                                            Canceled
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Order History -->
                <div x-show="activeTab === 'history'" class="rounded-lg border">
                    <div class="relative w-full overflow-auto">
                        <table class="w-full caption-bottom text-sm">
                            <thead class="[&_tr]:border-b">
                                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Order ID</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Customer</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Date</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Total</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Status</th>
                                </tr>
                            </thead>
                            <tbody class="[&_tr:last-child]:border-0">
                                @foreach($orderHistory as $order)
                                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                    <td class="p-4 align-middle font-medium">#{{ $order->id }}</td>
                                    <td class="p-4 align-middle">{{ $order->customer_name }}</td>
                                    <td class="p-4 align-middle">{{ $order->created_at->format('M d, Y') }}</td>
                                    <td class="p-4 align-middle">${{ number_format($order->total, 2) }}</td>
                                    <td class="p-4 align-middle">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium 
                                            @if($order->status === 'ordered')
                                                bg-blue-100 text-blue-800
                                            @elseif($order->status === 'denied')
                                                bg-red-100 text-red-800
                                            @elseif($order->status === 'confirmed')
                                                bg-green-100 text-green-800
                                            @endif
                                        ">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>