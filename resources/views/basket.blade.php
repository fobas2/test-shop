<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Тестовое задание - Корзина</title>

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">  
    </head>
    <body>
        <div class="wrapper">
            <div class="back" align="left">
                <b><a href="/"><i class="fas fa-arrow-left"></i> на Главную</a></b>
            </div>
            <div align="center"><h2>Корзина <i class="fas fa-shopping-cart"></i></h2></div>    
                <table>
                    <tr>
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Цена</th>
                    </tr>

                    @foreach ($shops as $shop)

                        @foreach ($products as $product)    

                            @if ($shop->id_product == $product->id_product)

                                <tr>
                                    <td>
                                        {{$product->name}}
                                        @if ($product->isNew == 1) <b>Новый</b>
                                        @endif
                                    </td>
                                    <td>
                                        {{$product->description}} <br>
                                         <a href="/product/{{$product->id_product}}"><b>Подробнее</b> <i class="fas fa-eye"></i></a>
                                    </td>
                                    <td>
                                        {{$product->price}} б.р. <br>
                                        @if ($product->isStock == 1) <b>в наличии</b>
                                        @endif
                                    </td>
                                </tr>

                                <? $allPrice += $product->price ?>                                
                            @endif

                        @endforeach

                    @endforeach

                </table>

                <div align="center">
                    <h3>
                        Общая стоймость заказа - {{ $allPrice }} б.р.
                    </h3>
                </div>
        </div>        
    </body>
</html>