<x-admin-layout>
    <div class="flex flex-col gap-4">
        <h1 class="text-lg font-semibold md:text-2xl">Dashboard</h1>
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                <div class="flex flex-row items-center justify-between space-y-0 p-6 pb-2">
                    <h3 class="text-sm font-medium">Ventas totales</h3>
                </div>
                <div class="p-6 pt-0">
                    <div class="text-2xl font-bold">0,00€</div>
                </div>
            </div>
            <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                <div class="flex flex-row items-center justify-between space-y-0 p-6 pb-2">
                    <h3 class="text-sm font-medium">Pedidos</h3>
                </div>
                <div class="p-6 pt-0">
                    <div class="text-2xl font-bold">+2350</div>
                </div>
            </div>
            <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                <div class="flex flex-row items-center justify-between space-y-0 p-6 pb-2">
                    <h3 class="text-sm font-medium">Productos</h3>
                </div>
                <div class="p-6 pt-0">
                    <div class="text-2xl font-bold">0</div>
                </div>
            </div>
            <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                <div class="flex flex-row items-center justify-between space-y-0 p-6 pb-2">
                    <h3 class="text-sm font-medium">Usuarios Activos</h3>
                </div>
                <div class="p-6 pt-0">
                    <div class="text-2xl font-bold">0</div>
                </div>
            </div>
        </div>
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-7">
            <div class="rounded-lg border bg-card text-card-foreground shadow-sm col-span-4">
                <div class="flex flex-col space-y-1.5 p-6">
                    <h3 class="text-lg font-semibold leading-none tracking-tight">Ventas generales</h3>
                </div>
                <div class="p-6 pt-0 pl-2">
                    <div id="overview-chart" class="h-[350px]"></div>
                </div>
            </div>
            <div class="rounded-lg border bg-card text-card-foreground shadow-sm col-span-3">
                <div class="flex flex-col space-y-1.5 p-6">
                    <h3 class="text-lg font-semibold leading-none tracking-tight">Ventas recientes</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-8">
                        <div class="flex items-center">
                            <div class="h-9 w-9 rounded-full bg-gray-200 flex items-center justify-center">
                                <span class="text-sm font-medium">BZ</span>
                            </div>
                            <div class="ml-4 space-y-1">
                                <p class="text-sm font-medium">Sarah Davis</p>
                                <p class="text-sm text-muted-foreground">sarah.davis@email.com</p>
                            </div>
                            <div class="ml-auto font-medium">+$1.00</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const data = [
                { name: 'Jan', total: Math.floor(Math.random() * 5000) + 1000 },
                { name: 'Feb', total: Math.floor(Math.random() * 5000) + 1000 },
                { name: 'Mar', total: Math.floor(Math.random() * 5000) + 1000 },
                { name: 'Apr', total: Math.floor(Math.random() * 5000) + 1000 },
                { name: 'May', total: Math.floor(Math.random() * 5000) + 1000 },
                { name: 'Jun', total: Math.floor(Math.random() * 5000) + 1000 },
                { name: 'Jul', total: Math.floor(Math.random() * 5000) + 1000 },
                { name: 'Aug', total: Math.floor(Math.random() * 5000) + 1000 },
                { name: 'Sep', total: Math.floor(Math.random() * 5000) + 1000 },
                { name: 'Oct', total: Math.floor(Math.random() * 5000) + 1000 },
                { name: 'Nov', total: Math.floor(Math.random() * 5000) + 1000 },
                { name: 'Dec', total: Math.floor(Math.random() * 5000) + 1000 }
            ];
    
            const options = {
                series: [{
                    name: 'Sales',
                    data: data.map(item => item.total)
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        columnWidth: '70%',
                    }
                },
                dataLabels: {
                    enabled: false
                },
                colors: ['#6366F1'],
                xaxis: {
                    categories: data.map(item => item.name),
                    labels: {
                        style: {
                            colors: '#888888',
                            fontSize: '12px'
                        }
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#888888',
                            fontSize: '12px'
                        },
                        formatter: function (value) {
                            return '$' + value;
                        }
                    }
                },
                grid: {
                    borderColor: '#E5E7EB',
                    strokeDashArray: 4,
                    xaxis: {
                        lines: {
                            show: false
                        }
                    }
                }
            };

            document.addEventListener("turbo:load", () => {
                const chart = new ApexCharts(document.querySelector("#overview-chart"), options);
                chart.render();
            });
        });
    </script>
</x-admin-layout>