<?php
require "vendor/autoload.php";

use GuzzleHttp\Client;

function getBooks() {
    $token = '76a98e0fdc52807661eb8f0fde04209e778ee00a9bcddb92335ba6208145715d0f0053194b723a3c613b2ebda944402e3d151118f02c25fb7c3f178c8d029da3b16fe4801ca259524037190021672b23bf7c2e3cb51217d73238c1806150a75bd3b90dfa624348d82ae88c95b61ea092b572b84edc57d9db34f07d4dd15fec8c';
    try {
    $client = new Client(['base_uri' => 'http://localhost:1337/api/']);
    $response = $client->request('GET', 'books?pagination[pageSize]=66', [
      'headers' => [
        'Authorization' => 'Bearer ' . $token,        
        'Accept' => 'application/json',
    ]
  ]);
    $body = $response->getBody();
    $decoded_response = json_decode($body);
    return $decoded_response;

} catch (Exception $e) {
  error_log($e->getMessage());
  echo '<pre>';
  var_dump($e);
}
 return null;
   
    }
    
$books = getBooks();
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <title> Scriptures Books List </title>
    </head>

 <body>
    <div class="container">
      <div class="row">
        <div class="col-9">
          <h1> List of all Books of the Bible </h1> 
        </div>
      <table class="table">
    <thead class="table-primary">
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Author</th>
        <th scope="col">Category</th>
      </tr>
    </thead>
    <tbody>
        
      <?php foreach($books->data as $bookData){
        $book = $bookData->attributes;?>
        <tr>
          <th class="table-danger" scope="row"><?php echo $bookData->id ?></th>
          <td class="table-danger"><?php echo $book->Name ?></td>
          <td class="table-danger"><?php echo $book->Author ?></td>
          <td class="table-danger"><?php echo $book->Category ?></td>
        </tr>
        <?php } ?>
    </tbody>
  </table>
</div>
</body>
</html>