<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />        

        <title>Тестовое задание - {{$Title}}</title>      
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
            <div align="center">
                <h2>{{$Title}}</h2>
                <table>
                    <tr>
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Цена</th>
                        <th></th>
                    </tr>                    
                    @foreach ($products as $product)    
                    <tr>
                        <td>
                            {{$product->name}}
                            @if ($product->isNew == 1) <b>Новое</b>
                            @endif
                        </td>
                        <td>
                            {{$product->description}} <br>
                            <a href="/product/{{$product->id_product}}"><b>Подробнее</b> <i class="fas fa-eye"></i></a>
                        </td>
                        <td>
                            {{$product->price}} б.р. <br>
                            @if ($product->isStock == 1)<b> в наличии</b>
                            @else</b> нет в наличии
                            @endif
                        </td>
                        <td>
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
                                В корзине
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>         
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
        $(this).after("В корзине");
        $(this).remove();
    });
</script>
