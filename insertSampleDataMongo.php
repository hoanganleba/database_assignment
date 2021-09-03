<?php
require 'core/mongoConnect.php';

$collection = $client->auction->products;

$collection->insertMany([
    [
        'product_name' => 'Razer phone 1',
        'product_type' => 'phone',
        'minPrice' => 100,
        'createDate' => date('Y-m-d H:i:s'),
        'closeTime' => '2022-08-11 20:00:00',
        'belong_to' => (object)array(
            'user_id' => 2,
            'last_name' => 'Nguyen',
            'first_name' => 'Van A',
            'profile_pic' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQa9aZaBVIwyx-C6Os35WtNviD00boWcWfpQ&usqp=CAU'),
        'img_url' => 'https://m.media-amazon.com/images/I/61tfletWziL._AC_SL1073_.jpg',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Amet aliquam id diam maecenas ultricies mi.'
    ],
    [
        'product_name' => 'Razer phone 2',
        'product_type' => 'phone',
        'minPrice' => 150,
        'createDate' => date('Y-m-d H:i:s'),
        'closeTime' => '2022-08-11 20:00:00',
        'belong_to' => (object)array(
            'user_id' => 2,
            'last_name' => 'Nguyen',
            'first_name' => 'Van A',
            'profile_pic' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQa9aZaBVIwyx-C6Os35WtNviD00boWcWfpQ&usqp=CAU'),
        'img_url' => 'https://cdn.tgdd.vn/Products/Images/42/193569/razer-phone-2-600x600.jpg',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Amet aliquam id diam maecenas ultricies mi.'
    ],
    [
        'product_name' => 'ASUS ROG phone 1',
        'product_type' => 'phone',
        'minPrice' => 200,
        'createDate' => date('Y-m-d H:i:s'),
        'closeTime' => '2022-08-11 20:00:00',
        'belong_to' => (object)array(
            'user_id' => 3,
            'last_name' => 'Huynh',
            'first_name' => 'Le B',
            'profile_pic' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQa9aZaBVIwyx-C6Os35WtNviD00boWcWfpQ&usqp=CAU'),
        'img_url' => 'https://techshark.vn/wp-content/uploads/2020/07/asus-rog-phone-1-8gb-128gb.jpg',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Amet aliquam id diam maecenas ultricies mi.'
    ],
    [
        'product_name' => 'ASUS ROG phone 2',
        'product_type' => 'phone',
        'minPrice' => 250,
        'createDate' => date('Y-m-d H:i:s'),
        'closeTime' => '2022-08-11 20:00:00',
        'belong_to' => (object)array(
            'user_id' => 3,
            'last_name' => 'Huynh',
            'first_name' => 'Le B',
            'profile_pic' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQa9aZaBVIwyx-C6Os35WtNviD00boWcWfpQ&usqp=CAU'),
        'img_url' => 'https://cdn.tgdd.vn/Products/Images/42/204088/asus-rog-phone-2-1-600x600.jpg',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Amet aliquam id diam maecenas ultricies mi.'
    ],
    [
        'product_name' => 'ASUS Vivobook E210KA',
        'product_type' => 'laptop',
        'minPrice' => 200,
        'createDate' => date('Y-m-d H:i:s'),
        'closeTime' => '2022-08-11 20:00:00',
        'belong_to' => (object)array(
            'user_id' => 4,
            'last_name' => 'Pham',
            'first_name' => 'Thi Minh C',
            'profile_pic' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQa9aZaBVIwyx-C6Os35WtNviD00boWcWfpQ&usqp=CAU'),
        'img_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQfQ5lsSend6uUNPPYLmVBABg8dDTHJc2gX_g&usqp=CAU',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Amet aliquam id diam maecenas ultricies mi.'
    ],
    [
        'product_name' => 'Steelseries Apex PRO',
        'product_type' => 'other',
        'minPrice' => 250,
        'createDate' => date('Y-m-d H:i:s'),
        'closeTime' => '2022-08-22 22:00:00',
        'belong_to' => (object)array(
            'user_id' => 4,
            'last_name' => 'Pham',
            'first_name' => 'Thi Minh C',
            'profile_pic' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQa9aZaBVIwyx-C6Os35WtNviD00boWcWfpQ&usqp=CAU'),
        'img_url' => 'https://product.hstatic.net/1000026716/product/gvn_steel_apexpro_437eae419aaa4a4a8e83ad04772215a4.png',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Amet aliquam id diam maecenas ultricies mi.'
    ],
]);