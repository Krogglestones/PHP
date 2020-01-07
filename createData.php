<?php

  require_once 'autoload.php';

  include 'includes/functions.php';

  $faker = Faker\Factory::create();
//  echo $faker->bs;

  $db = db_connect();
//
//  for( $i; $i < 10; $i++) {
//    $title = $faker->text(14);
//    $author = $faker->name;
//    $article_text = $faker->text(32000);
//    $date_posted = $faker->dateTimeThisDecade();
//    $date_posted = $date_posted->format("Y-m-d H:i:s");
//
//    $sql = "INSERT INTO `articles` (`article_id`, `title`, `author`, `article_text`, `date_posted`, `created_at`, `modified_at`) VALUES (NULL, '$title', '$author', '$article_text', '$date_posted' , CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
////  echo "SQL: $sql<br/>";
//    $result = $db->query($sql);
//  }
//  echo $date_posted;

//  for ($i=0; $i < 50; $i++)  {
//    $author = $faker->name;
//    $date_posted = $faker->dateTimeThisDecade();
//    $date_posted = $date_posted->format("Y-m-d H:i:s");
//    $blog_text = $faker->text(32000);
//    $blog_title = $faker->realText(24);
//
//    $sql = "INSERT INTO `blogs` (`blog_id`, `author`, `date_posted`, `blog_text`, `blog_title`) VALUES (NULL, '$author', '$date_posted', '$blog_text', '$blog_title' )";
////  echo "SQL: $sql<br/>";
//    $result = $db->query($sql);
//
//    $blog_idfk = $db->insert_id;

//    $num_reviews = rand(1,10);
//    for ($j=0; $j < $num_reviews; $j++){
//      $author = $faker->name;
//      $comment_text = $faker->text(200);
//      $rating = rand(1,5);
//
//      $sql = "INSERT INTO comments (comment_id, author, comment_text, rating, created_at, blog_idfk )
//              VALUES (NULL, '$author', '$comment_text' , '$rating', NOW(), '$blog_idfk')";
//      $result = $db->query($sql);
//    }
//  }


  for ($i = 0; $i < 5; $i++) {
    $product_name = $faker->name;
    $description = $faker->realText(40, 5);
    $price = rand(25.0, 500.0);
    $company_cost = rand(1.0, 20.0);
    $quantity = rand(1, 10);
    $image = $faker->imageUrl(720, 720, cats);
    $thumbnail_image = $faker->imageUrl(50, 50, cats);

    $sql = "INSERT INTO `products` (`product_id`, `product_name`, `description`, `price`, `company_cost`, `quantity`, `image`, `thumbnail_image`) 
            VALUES (NULL, '$product_name', '$description', '$price', '$company_cost', '$quantity', '$image', '$thumbnail_image' )";
//  echo "SQL: $sql<br/>";
    $result = $db->query($sql);

    $product_idfk = $db->insert_id;

    $num_reviews = rand(1, 5);
    for ($j = 0; $j < $num_reviews; $j++) {
      $review_author = $faker->name;
      $review_text = $faker->realText(40, 5);
      $review_rating = rand(1, 5);

      $sql = "INSERT INTO reviews (review_id, review_author, review_text, review_rating, review_created_at, product_idfk )
              VALUES (NULL, '$review_author', '$review_text' , '$review_rating', NOW(), '$product_idfk')";
      $result = $db->query($sql);
    }

  }


