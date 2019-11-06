<script>
    function loadRevenue(val, url) {
        if(val) {
                $.ajax({
                    processing : 'true',
                    serverSide : 'true',
                    url: url + val,
                    type:"get",
                    dataType:"json",

                    success:function(data) {
                        if(data){
                            $('#revenue').html('&#8369;' + data.revenue);
                            $('#expected').html('&#8369;' + data.expected_monthly_revenue);
                            $('#total_pax').html(data.total_pax);
                            $('#approved').html(data.approved);
                            $('#pending').html(data.pending);
                        }

                    },

                });
            } else {
                $('#revenue').html('&#8369; 0.00');
                $('#expected').html('&#8369; 0.00');
                $('#total_pax').html('0');
                $('#approved').html('0');
                $('#pending').html('0');
            } 
    }
    $(document).ready(function(){
        var url = '/admin/revenue/';
        loadRevenue($("#months").val(), url)
        $('#months').on('change', function(){
            var month_num = $(this).val();
            loadRevenue(month_num, url);
            
        });
    });
</script>
<script>
    function apexOrders(data,url)
    {
        var options2 = {
            chart: {
                height: 280,
                type: 'bar',
                toolbar: {
                    show: false,
                },
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    endingShape: 'arrow',
                    columnWidth: '50%',
                },
            },
            dataLabels: {
                enabled: false
            },
            colors: ['#1177be', '#00b894', '#fd7274'],
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            series: [{
                name: 'Online',
                data: data[2]
            }],
            legend: {
                show: true,
                position: 'bottom',
                horizontalAlign: 'center', 
                markers: {
                    width: 10,
                    height: 10,
                    radius: 20,
                },
                itemMargin: {
                    horizontal: 15,
                    vertical: 12
                },
            },
            xaxis: {
                categories: data[0],
            },
            yaxis: {
                title: {
                    text: 'No of pax (per reservations)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " pax"
                    }
                }
            }
        }
        var chart = new ApexCharts(
            document.querySelector("#apexOrders"),
            options2
        );
        chart.render();

        $('#months').on('change', function(){
                var month_num = $(this).val();
                updateChartPax(month_num, url);
            });

            function updateChartPax(val, url)
            {
                $.ajax({
                    processing : 'true',
                    serverSide : 'true',
                    url: url + val,
                    type:"get",
                    dataType:"json",

                    success:function(data) {
                        if(data){
                            $('#pax').html(data.total_pax);
                            chart.updateSeries([{
                                name: 'Series A',
                                data: data[2]
                            }])
                        }
                    },

                });
            }
    }
    function apexSales(data, url)
    {
        var options5 = {
            chart: {
                height: 280,
                type: 'bar',
                toolbar: {
                    show: false,
                },
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    barHeight: '35%',
                    endingShape: 'arrow',
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ['#1177be', '#00b894', '#fd7274'],
            fill: {
                gradient: {
                    color: '#80bcdc',
                    shadeIntensity: 1,
                    inverseColors: false,
                    opacityFrom: 0.8,
                    opacityTo: 0,
                    stops: [0, 90, 100]
                }
            },
            series: [{
                name: 'Sales',
                data: data[1]
            }],
            xaxis: {
                categories: data[0],
            },
        }
        var chartSale = new ApexCharts(
                document.querySelector("#apexSales"),
                options5
            );

            chartSale.render();

            $('#months').on('change', function(){
                var month_num = $(this).val();
                updateChart(month_num, url);
            });

            function updateChart(val, url)
            {
                $.ajax({
                    processing : 'true',
                    serverSide : 'true',
                    url: url + val,
                    type:"get",
                    dataType:"json",

                    success:function(data) {
                        if(data){
                            $('#total_sales').html('&#8369;' + data.total_sales);
                            chartSale.updateSeries([{
                                name: 'Series A',
                                data: data[1]
                            }])
                        }
                    },

                });
            }
    }
</script>

<script>
$(document).ready(function(){
    var url = '/admin/services-data/';
    var val = $("#months").val();
    $.ajax({
        processing : 'true',
        serverSide : 'true',
        url: url + val,
        type:"get",
        dataType:"json",

        success:function(data) {
            if(data){
                $('#total_sales').html('&#8369;' + data.total_sales);
                $('#pax').html(data.total_pax);
                apexSales(data, url);
                apexOrders(data, url);
                
            }
        },

    });
});
</script>