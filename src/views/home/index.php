<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <div class="container">
        <h2>Home <?php echo $this->d["user"]->getUsername(); ?></h2>
        <?php require_once "src/components/create.php"; ?>
        <?php 
        
        $user = $this->d["user"];
        $posts = $this->d["posts"];
        foreach($posts as $p){
            echo $p->getTitle() . "<br>" ;
        }

        ?>
    </div>
</body>
</html> 