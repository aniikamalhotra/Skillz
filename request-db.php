<?php

include 'connect-db.php';

function insertUser($user_name, $email, $phone_number, $bio, $password)
{
    global $db;

    // // check if email is already registered
    // $query = "SELECT * FROM Users WHERE email = $1";
    // $existingUser = $db->query($query, $email);

    // // need this for later to give user information about already registered emails
    // if ($existingUser) {
    //   $_SESSION["feedback"] = "Email already registered!";
    //   return;
    // }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare("
        INSERT INTO Users (user_name, email, phone_number, bio, password)
        VALUES (:user_name, :email, :phone_number, :bio, :password)
    ");

    $stmt->execute([
        ':user_name'    => $user_name,
        ':email'        => $email,
        ':phone_number' => $phone_number,
        ':bio'          => $bio,
        ':password'     => $hashedPassword
    ]);
}

function insertArticle($user_id, $title, $link, $date_article, $author)
{
    global $db;
    $stmt = $db->prepare("
        INSERT INTO Article (user_id, title, link, date_article, author)
        VALUES (:user_id, :title, :link, :date_article, :author)
    ");

    $stmt->execute([
        ':user_id'    => $user_id,
        ':title'      => $title,
        ':link'       => $link,
        ':date_article' => $date_article,
        ':author'     => $author
    ]);
}

function insertFavorite($user_id, $article_id)
{
    global $db;
    $stmt = $db->prepare("
        INSERT INTO Favorite(user_id, article_id)
        VALUES (:user_id, :article_id)
    ");

    $stmt->execute([
        ':user_id'    => $user_id,
        ':article_id' => $article_id
    ]);
}

function insertReview($user_id, $article_id, $review_text)
{
    global $db;
    $stmt = $db->prepare("
        INSERT INTO Review(user_id, article_id, review_text)
        VALUES (:user_id, :article_id, :review_text)
    ");

    $stmt->execute([
        ':user_id'    => $user_id,
        ':article_id' => $article_id,
        ':review_text'=> $review_text
    ]);
}

function insertSportArticle($article_id, $sport_type)
{
    global $db;
    $stmt = $db->prepare("
        INSERT INTO Sports(article_id, sport_type)
        VALUES (:article_id, :sport_type)
    ");

    $stmt->execute([
        ':article_id' => $article_id,
        ':sport_type' => $sport_type
    ]);
}

function insertArtArticle($article_id, $media_type)
{
    global $db;
    $stmt = $db->prepare("
        INSERT INTO Art(article_id, media_type)
        VALUES (:article_id, :media_type)
    ");

    $stmt->execute([
        ':article_id' => $article_id,
        ':media_type' => $media_type
    ]);
}

function insertMusicArticle($article_id, $musical_instrument)
{
    global $db;
    $stmt = $db->prepare("
        INSERT INTO Music(article_id, musical_instrument)
        VALUES (:article_id, :musical_instrument)
    ");

    $stmt->execute([
        ':article_id' => $article_id,
        ':musical_instrument' => $musical_instrument
    ]);
}

function insertVote($user_id, $article_id, $is_up, $is_down)
{
    global $db;
    $stmt = $db->prepare("
        INSERT INTO Vote(user_id, article_id, is_up, is_down)
        VALUES (:user_id, :article_id, :is_up, :is_down)
    ");

    $stmt->execute([
        ':user_id' => $user_id,
        ':article_id' => $article_id,
        ':is_up' => $is_up,
        ':is_down' => $is_down
    ]);
}

function insertFriend($user_1_id, $user_2_id)
{
    global $db;
    $stmt = $db->prepare("
        INSERT INTO Friend(user_1_id, user_2_id)
        VALUES (:user_1_id, :user_2_id)
    ");

    $stmt->execute([
        ':user_1_id' => $user_1_id,
        ':user_2_id' => $user_2_id
    ]);
}

function insertRequest($sender_id, $receiver_id)
{
    global $db;
    $stmt = $db->prepare("
        INSERT INTO Request (sender_id, receiver_id)
        VALUES (:sender_id, :receiver_id)
    ");

    $stmt->execute([
        ':sender_id' => $sender_id,
        ':receiver_id' => $receiver_id
    ]);
}

function getUser($user_id)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM Users WHERE user_id = :user_id");
    $stmt->execute([
        ':user_id' => $user_id
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getAllSportsArticles($search_query)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM Sports NATURAL JOIN Article WHERE title LIKE :search OR author LIKE :search");
    $stmt->execute([
        ':search' => '%' . $search_query . '%'
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllSportsArticlesOrderedByAuthor()
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM Sports NATURAL JOIN Article ORDER BY author ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllSportsArticlesOrderedByTitle()
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM Sports NATURAL JOIN Article ORDER BY title ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getSpecificSportsArticles($sportType)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM Sports NATURAL JOIN Article WHERE Sports.sport_type = :sport_type");
    $stmt->execute([':sport_type' => $sportType]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllMusicArticles($search_query)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM Music NATURAL JOIN Article WHERE title LIKE :search OR author LIKE :search");
    $stmt->execute([
        ':search' => '%' . $search_query . '%'
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllMusicArticlesOrderedByAuthor()
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM Music NATURAL JOIN Article ORDER BY author ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllMusicArticlesOrderedByTitle()
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM Music NATURAL JOIN Article ORDER BY title ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getSpecificMusicArticles($musical_instrument)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM Music NATURAL JOIN Article WHERE Music.musical_instrument = :musical_instrument");
    $stmt->execute([':musical_instrument' => $musical_instrument]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllArtArticles($search_query)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM Art NATURAL JOIN Article WHERE title LIKE :search OR author LIKE :search");
    $stmt->execute([
        ':search' => '%' . $search_query . '%'
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllArtArticlesOrderedByAuthor()
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM Art NATURAL JOIN Article ORDER BY author ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllArtArticlesOrderedByTitle()
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM Art NATURAL JOIN Article ORDER BY title ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getSpecificArtArticles($media_type)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM Art NATURAL JOIN Article WHERE Art.media_type = :media_type");
    $stmt->execute([':media_type' => $media_type]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getSpecificReview($userId)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM Review WHERE user_id = :user_id");
    $stmt->execute([':user_id' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getSpecificArticleReview($userId, $articleId)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM Review WHERE user_id = :user_id AND article_id = :article_id");
    $stmt->execute([':user_id' => $userId, ':article_id' => $articleId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getArticleReviews($articleId, $search_query)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM Review NATURAL JOIN Users WHERE article_id = :article_id AND (user_name LIKE :search OR review_text LIKE :search)");
    $stmt->execute([':article_id' => $articleId, ':search' => '%' . $search_query . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getFavoritedArticles($userId)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM Article JOIN Favorite ON Article.article_id = Favorite.article_id WHERE user_id = :user_id");
    $stmt->execute([':user_id' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateUsername($newName, $userId)
{
    global $db;
    $stmt = $db->prepare("UPDATE Users SET user_name = :user_name WHERE user_id = :user_id");
    $stmt->execute([
        ':user_name' => $newName,
        ':user_id' => $userId
    ]);
}

function updatePhone($newPhone, $userId)
{
    global $db;
    $stmt = $db->prepare("UPDATE Users SET phone_number = :phone_number WHERE user_id = :user_id");
    $stmt->execute([
        ':phone_number' => $newPhone,
        ':user_id' => $userId
    ]);
}

function updateBio($newBio, $userId)
{
    global $db;
    $stmt = $db->prepare("UPDATE Users SET bio = :bio WHERE user_id = :user_id");
    $stmt->execute([
        ':bio' => $newBio,
        ':user_id' => $userId
    ]);
}

function updatePassword($newPassword, $userId)
{
    global $db;
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $stmt = $db->prepare("UPDATE Users SET password = :passwords WHERE user_id = :user_id");
    $stmt->execute([
        ':passwords' => $hashedPassword,
        ':user_id' => $userId
    ]);
}

function upVote($userId, $articleId)
{
    global $db;
    $stmt = $db->prepare("UPDATE Vote SET is_up = TRUE, is_down = FALSE WHERE user_id = :user_id AND article_id = :article_id");
    $stmt->execute([
        ':user_id' => $userId,
        ':article_id' => $articleId
    ]);
}

function downVote($userId, $articleId)
{
    global $db;
    $stmt = $db->prepare("UPDATE Vote SET is_up = FALSE, is_down = TRUE WHERE user_id = :user_id AND article_id = :article_id");
    $stmt->execute([
        ':user_id' => $userId,
        ':article_id' => $articleId
    ]);
}

function cancelVote($userId, $articleId)
{
    global $db;
    $stmt = $db->prepare("UPDATE Vote SET is_up = FALSE, is_down = FALSE WHERE user_id = :user_id AND article_id = :article_id");
    $stmt->execute([
        ':user_id' => $userId,
        ':article_id' => $articleId
    ]);
}

function updateReviewText($userId, $articleId, $reviewText)
{
    global $db;
    $stmt = $db->prepare("UPDATE Review SET review_text = :review_text WHERE user_id = :user_id AND article_id = :article_id");
    $stmt->execute([
        ':user_id' => $userId,
        ':article_id' => $articleId,
        ':review_text' => $reviewText
    ]);
}

function updateArticleTitle($articleId, $title)
{
    global $db;
    $stmt = $db->prepare("UPDATE Article SET title = :title WHERE article_id = :article_id");
    $stmt->execute([
        ':article_id' => $articleId,
        ':title' => $title
    ]);
}

function updateArticleAuthor($articleId, $author)
{
    global $db;
    $stmt = $db->prepare("UPDATE Article SET author = :author WHERE article_id = :article_id");
    $stmt->execute([
        ':article_id' => $articleId,
        ':author' => $author
    ]);
}

function deleteUser($userId)
{
    global $db;
    $stmt = $db->prepare("DELETE FROM Users WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
}

function deleteVote()
{
    global $db;
    $stmt = $db->prepare("DELETE FROM Vote WHERE is_down = FALSE AND is_up = FALSE");
    $stmt->execute();
}

function deleteFavorite($userId, $articleId)
{
    global $db;
    $stmt = $db->prepare("DELETE FROM Favorite WHERE user_id = :user_id AND article_id = :article_id");
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':article_id', $articleId);
    $stmt->execute();
}

function deleteReview($userId, $articleId)
{
    global $db;
    $stmt = $db->prepare("DELETE FROM Review WHERE user_id = :user_id AND article_id = :article_id");
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':article_id', $articleId);
    $stmt->execute();
}

function deleteArticle($articleId)
{
    global $db;
    $stmt = $db->prepare("DELETE FROM Article WHERE article_id = :article_id");
    $stmt->bindParam(':article_id', $articleId);
    $stmt->execute();
}

function deleteFriend($user1Id, $user2Id)
{
    global $db;
    $stmt = $db->prepare("DELETE FROM Friend WHERE user_1_id = :user_1_id AND user_2_id = :user_2_id");
    $stmt->bindParam(':user_1_id', $user1Id);
    $stmt->bindParam(':user_2_id', $user2Id);
    $stmt->execute();
}

function deleteRequest($senderId, $receiverId)
{
    global $db;
    $stmt = $db->prepare("DELETE FROM Request WHERE sender_id = :sender_id AND receiver_id = :receiver_id");
    $stmt->bindParam(':sender_id', $senderId);
    $stmt->bindParam(':receiver_id', $receiverId);
    $stmt->execute();
}

function getReviewsByUser($user_id) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM Review r JOIN Article a ON r.article_id = a.article_id WHERE r.user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>