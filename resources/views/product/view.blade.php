<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">        
        <meta name="csrf-token" content="{{ csrf_token() }}" />  

        <title>Тестовое задание - {{$product->name}}</title>

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">  
    </head>
    <body>
        <div class="wrapper">
            <div align="right">
                <b><a class="basket-btn" href="/shop">Корзина <i class="fas fa-shopping-cart"></i></i></a></b> 
                <hr>          
            </div>            
            <div class="back" align="left">
                <b><a href="/"><i class="fas fa-arrow-left"></i> на Главную</a></b>
            </div>
            <div align="center">
                <h2>
                    {{$product->name}} 
                    @if ($product->isNew == 1)                        
                        Новое
                    @endif
                </h2>
            </div>  
            <h3>Описание:</h3> 
            <p>{{$product->description}}</p>
            <h3>Цена:</h3>
            <h2>{{$product->price}} б.р.</h2>
            
            <? $inShop = 0?>
                            @foreach ($shops as $shop)
                                @if ($product->id_product==$shop->id_product)
                                    <? $inShop++ ?>
                                    @break
                                @endif
                            @endforeach

                            @if ($inShop == 0)
                                <button class="btn-add-to-basket" data-id-product="{{$product->id_product}}" type="button">Добавить в корзину</button>
                            @else
                                <b>Товар уже в корзине</b>
                            @endif      
        </div>        
    </body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    $(".btn-add-to-basket").on("click", function(event) {

        var idProduct = $(this).data("idProduct");

        $.ajaxSetup
        ({
           headers : {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}
        });

        $.ajax({
                url: "/addProduct",
                data: {
                        'idProduct': idProduct,
                        '_token': '{{ csrf_token() }}'
                },
                type: "POST",
                success: function (data) {
                    if (data.success === 'success') {
                        console.log(data.success); 
                    } else {
                        console.log(data.success);
                    }                
                },
                error: function () {
                        console.log("Error AJAX!");
                }
        });

        $(this).after("Товар добавлен в корзину");
        $(this).remove();

    });
</script>